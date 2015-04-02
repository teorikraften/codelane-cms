<?php

class SearchController extends BaseController {
	/**
	 * Displays the search page view.
	 */
	public function showSearchPage()
	{
		return View::make('search.index');
	}

	/**
	 * Displays the search result for given query.
	 * @param $searchQuery the query to search for
	 * @param $order the sorting order, '' by default
	 * @param $page the page number, 1 by default
	 */ 
	public function showSearchResultPage($searchQuery, $order = 'score', $page = 1) 
	{
		try {
			$page = intval($page);
		} catch(Exception $e) {
			$page = 1;
		}


		if ($searchQuery == '') {
			return View::make('search.index')->with('error', 'Empty searchQuery');
		}

		if (Cache::has($searchQuery)) {

			$search = Cache::get($searchQuery);

			//echo 'Det finns något i cachen. HURRA!';
			//exit;
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
		->with('order', $order)
		->with('page', $page)
		->with('maxPage', $search->maximumPage());
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
