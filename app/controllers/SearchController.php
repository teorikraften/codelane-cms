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
	public function showSearchResultPage($searchQuery, $order = '', $page = 1) 
	{
		$search = new Search();
		$result = $search->basicSearch($searchQuery);

		return View::make('search.result')
		->with('searchQuery', $searchQuery)
		->with('result', $result);
	}

	/**
	 * Performs search with search request in POST.
	 * @return a redirect to search result view
	 */
	public function search() {
		return Redirect::route('search-result', Input::get('search-query'));
	}
}
