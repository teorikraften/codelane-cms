<?php

class SearchController extends BaseController {
	/**
	 * Displays the search page view.
	 */
	public function showSearchPage()
	{
		return View::make('search.index');
	}

	public function changeSearchResultPage($query, $page = 1, $order = '') {
		if (Cache::has($query)) {
			$search = Cache::get($query);
		} else {
			showSearchResultPage($searchQuery, $page, $order);
		}

		return null; // TODO
	}


	/**
	 * Displays the search result for given query.
	 * @param $searchQuery the query to search for
	 * @param $order the sorting order, '' by default
	 * @param $page the page number, 1 by default
	 */ 
	public function showSearchResultPage($searchQuery, $page = 1, $order = 'score') 
	{

		if ($searchQuery == '') {
			return View::make('search.index')->with('error', 'Empty searchQuery');
		}

		if (Cache::has($searchQuery)) {

			$search = Cache::get($searchQuery);

			echo 'Det finns något i cachen. HURRA!';
			exit;
		} else {
			$search = new Search($searchQuery);
			$search->pmSearch();
			Cache::put($searchQuery, $search, 5);
		}


		$search->sortSearchResult($order);
		$returnResult = $search->getPage($page);

		return View::make('search.result')
		->with('searchQuery', $searchQuery)
		->with('result', $returnResult)
		->with('page', $page)
		->with('order', $order);
	}

	/**
	 * Performs search with search request in POST.
	 * @return a redirect to search result view
	 */
	public function search() {
		return Redirect::route('search-result', Input::get('search-query'));
	}

	public function searchAutocomplete() {
		$searchQuery = Input::get('term');
		$tags = Tag::where('name', 'LIKE', '%' . $searchQuery . '%')->take(7)->get();
		$result = array();
		foreach($tags as $tag) {
			$result[] = $tag->name;
		}
		return json_encode($result);
	}
}
