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

		$start = ($page - 1)* 10;

		$search = new Search();
		$result = $search->pmSearch($searchQuery, $start, 10, $order);

		return View::make('search.result')
		->with('searchQuery', $searchQuery)
		->with('result', $result)
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
