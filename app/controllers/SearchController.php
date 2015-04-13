<?php

class SearchController extends BaseController {
	/**
	 * Displays the search page view.
	 */
	public function getSearch() {
		// TODO Används den här? @deprecated
		return View::make('search.index');
	}

	/**
	 * Displays the search result for given query.
	 * @param $searchQuery the query to search for
	 * @param $order the sorting order, '' by default
	 * @param $page the page number, 1 by default
	 * @param $options Array with boolean serach options in the order: tags, roles, text
	 */ 
	public function getResult($searchQuery = '', $order = 'score', $page = 1, $options = NULL) {
		$page = intval($page);
/*
		if ($searchQuery == '') {
			return View::make('search.index')->with('error', 'Du måste ange en sökfras.');
		}
*/
		if (Cache::has($searchQuery)) {

			$search = Cache::get($searchQuery);

			if (isset($options) && !$search->matchingOptions($options)) {
				$search->setSearchOptions($options);
				$search->pmSearch();
				$search->findRoles();
				Cache::add($searchQuery, $search, 5);
			}

		} else {
			$search = new Search($searchQuery);

			if (isset($options)) {
				$search->setSearchOptions($options);
			}

			$search->pmSearch();
			$search->findRoles();
			Cache::put($searchQuery, $search, 5);
		}

		$search->sortSearchResult($order);

		$returnResult = $search->getPage($page);

		return View::make('search.result')
		->with('searchQuery', $searchQuery)
		->with('result', $returnResult)
		->with('order', $order)
		->with('page', $page)
		->with('error', $search->getErrorString())
		->with('maxPage', $search->maximumPage());
	}

	/**
	 * 
	 */
	public function getLatest() {
		$search = new Search('latestAddedPms');

		$search->latestUpdatedPMs();
		$returnResult = $search->getPage(1);

		return View::make('search.result')
		->with('searchQuery', "")
		->with('result', $returnResult)
		->with('order', $order)
		->with('page', $page)
		->with('maxPage', $search->maximumPage());
	}

	/**
	 * Performs search with search request in POST.
	 * @return a redirect to search result view
	 */
	public function postSearch() {
		return Redirect::route('search-result', Input::get('search-query'));
	}

	public function getSearchAutocomplete() {
		$searchQuery = Input::get('term');

		$splitPosition = strrpos($searchQuery, " ");
		if ($splitPosition != false) {
			$str1 = substr($searchQuery, 0, $splitPosition+1);
			$str2 = substr($searchQuery, $splitPosition);
		} else {
			$str1 = '';
			$str2 = $searchQuery;
		}

		$tags = Tag::where('name', 'LIKE', '%' . $str2 . '%')->take(7)->get();
		$result = array();
		foreach($tags as $tag) {
			$result[] = $str1 . $tag->name;
		}
		return json_encode($result);
	}
}
