<?php

class Search {

	private $result = array();
	private $error = array();
	private $query;


	// TODO check if correct syntax
	/*
	Operator ENUM
		default			
		remove
		require
	*/
		const defaultOperator = 0;
		const requireOperator = 1;
		const removeOperator = 2;

		function __construct($searchQuery) {
			$this->query = htmlspecialchars($searchQuery);
		}

	/**
	 * Returns the result array.
	 * Format
	 * $result['id'] = PM
	 * $result['score'] = score
	 * $result['operator'] = operator (require, default, remove)
	 * @return array with PMs and their search score.
	 */
	public function getResult() {
		return $this->result;
	}

	/**
	 * Get an array of errors from the search.
	 * @return array Strings with error meassages.
	 */
	public function getErrorArray() {
		return $this->error;
	}

	/**
	 * Return the searchquery the user submitted
	 * @return string The query.
	 */
	public function getQuery() {
		return $this->query;
	}

	/**
	 * Sort the search result based on param $order. If order is invalid sorts by 'score'
	 * @param string order Defines the order to search for. 'score' 'alphabetical' 'view_count' 'revision_date' 'expiration_date'
	 */
	public function sortSearchResult($order) {
		// Sort the list
		if ($order == 'score') {
			usort($this->result, "cmp");	
		} else if ($order == 'alphabetical') {
			usort($this->result, "cmpAlphabetical");
		} else if ($order == 'view_count') {
			usort($this->result, "cmpViewCount");
		} else if ($order == 'revision_date') {
			usort($this->result, "cmpRevision");
		} else if ($order == 'expiration_date') {
			usort($this->result, "cmpExpiration");
		} else {
			usort($this->result, "cmp");
			$this->error[] = "Unknown order. Sorted by score";
		}
	}

	/**
	 * @return int Maximum pagenumber.
	 */
	function maximumPage() {
		return ceil(count($this->result) / 10);
	}

	/**
	 * Return a specific page of the search result.
	 * Pages are result divided into slices of 10.
	 * @param int page The page to return.
	 * @return array The page defined in param page
	 */
	public function getPage($page = 1) {
		if ($page > ceil(count($this->result) / 10) || $page <= 0) {
			$this->error[] = "Illegal pagenumber, page 1 returned";
			return array_slice($this->result, 0, 10);
		}
		return array_slice($this->result, ($page -1) * 10, 10);
	}

	/**
	 * Searches and returns the highest rated search results from the $searchQuery
	 */
	public function pmSearch() {

		// TODO keep improving
		// TODO fungerar inte med ÅÄÖ
		$searchQuery = $this->query;

		if (strPos($searchQuery, '+') !== FALSE) {
			$defaultOperator = self::requireOperator;
		} else {
			$defaultOperator = self::defaultOperator;
		}

		$apostofCount = substr_count($searchQuery, "'");
		if ($apostofCount % 2 != 0) {
			$searchQuery = str_replace("'", " ", $searchQuery);
			$error[] = 'Ojämnt antal apostorofer';
		}

		$this->fulltextsearch($searchQuery, $defaultOperator);

		$splitQuote = explode("'", $searchQuery);
		foreach ($splitQuote as $key1 => $value2) {

			// For search terms between ' '
			if ($key1 % 2 ==  1) { 
				if (strrpos($splitQuote[$key1 - 1], 1, -1) === '+') {
					// REQUIRED
					$score = 10;
					$operator = self::requireOperator;
				} else if (strrpos($splitQuote[$key1 - 1], 1, -1) === '-') {
					// REMOVE
					$score = -10;
					$operator = self::removeOperator;
				} else if (strrpos($splitQuote[$key1 - 1], 1, -1) === '~') {
					// NEGATIVE
					$score = -1;
					$operator = self::defaultOperator;
				} else {
					// DEFAULT
					$score = 1;
					$operator = self::defaultOperator;
				}


				$this->searchQueryPart($value2, $operator, $score, $this->result);

			} else {
				if (strrpos($value2, 1, -1) == '+'  || strrpos($value2, 1, -1) == '-' || strrpos($value2, 1, -1) == '~') {
					$value2 = substr($value2, 0, -1);
				}

				$splitQuery = explode(' ', $value2);
				foreach ($splitQuery as $key => $query) {
					if ($query == '') {
						continue;
					}
					switch(substr($query, 0, 1)) {
						case '+':
						$score = 10;
						$query = substr($query, 1);
						$operator = self::requireOperator;
						break;
						case '-':
						$score = -10;
						$query = substr($query, 1);
						$operator = self::removeOperator;
						break;
						case '~':
						$score = -1;
						$query = substr($query, 1);
						$operator = self::defaultOperator;
						break;
						default:
						$score = 1;
						$operator = self::defaultOperator;
					}	

					$this->searchQueryPart($query, $operator,$score, $this->result);
				} 
			}
		}

		if ($defaultOperator == self::requireOperator) {
			$this->keepRequired($this->result);
		} else {
			$this->removeUnwantedResults($this->result);
		}
	}

	/**
	 * Makes a fulltextsearch on the text in title and content
	 */
	private function fullTextSearch($searchQuery, $defaultOperator) {
		try {

			$fullTextSearchResult = PM::whereRaw("MATCH(content, title) AGAINST(? IN BOOLEAN MODE)", array("\"".$searchQuery."\""))
			->addSelect(DB::raw("*, MATCH(content, title) AGAINST(\"".$searchQuery."\" IN BOOLEAN MODE) AS score"))
			->where('verified', '=' , 1)->whereNull('pms.deleted_at')->where('expiration_date', '<' , 'CURDATE()')->get();
		} catch (Exception $e) {
			$this->error[] = $e->getMessage();
		}

		// ->where('verified', '=' , 1)->whereNull('pms.deleted_at')->where('expiration_date', '<' , 'CURDATE()')

		// ->whereRaw('deleted_at IS NULL AND verified = 1 AND expiration_date < CURDATE()')
		foreach ($fullTextSearchResult as $key => $pm) {
			$id = $pm['id'];

			$this->result[$id]['pm'] = $pm;
			$this->result[$id]['score'] = $pm->score;
			$this->result[$id]['operator'] = $defaultOperator;
		}
	}


	/**
	 *	Searches after a matching PM. Searches for matches in tags, content and title.
	 * 
	 * @param string $query The string to search for in PM:s
	 * @param string $operator if the query is required, default or should remove the matching PM
	 * @param int $score score modifier for matches
	 * @param array $result An array to add the matching PMs to
	 * @return Modified array $result
	 *
	 */
	private function searchQueryPart($query, $operator, $score) {

		if (preg_match("/(\s)|(^$)/", $query)) {
			return;
		}

		$tag = Tag::where('name', 'like', '%'.$query.'%')->get();
		foreach ($tag as $key => $value) {
			$tagpms = $value->pm()->where('verified', '=' , 1)->whereNull('pms.deleted_at')->where('expiration_date', '<' , 'CURDATE()')->get();
			foreach ($tagpms as $key => $v) {
				$this->result = $this->updatePMScore($v, 100 * $score, $operator);
			}
		}

		$contentResult = Pm::where('content', 'like', '%'.$query.'%')->where('verified', '=' , 1)->whereNull('pms.deleted_at')->where('expiration_date', '<' , 'CURDATE()')->get();
		foreach ($contentResult as $key => $v) {
			$this->result = $this->updatePMScore($v, 1 * $score, $operator);
		}

		$titleResult = PM::where('title', 'like', '%'.$query.'%')->where('verified', '=' , 1)->whereNull('pms.deleted_at')->where('expiration_date', '<' , 'CURDATE()')->get();
		foreach ($titleResult as $key => $v) {
			$this->result = $this->updatePMScore($v, 15 * $score, $operator);
		}
		return;
	}

	/**
	 * Removes unwanted search results from the result list. 
	 * Unwanted results are results with the operator 'remove' or results with a score less than zero
	 * @param array To be modified
	 * @return Modified array
	 */
	private function removeUnwantedResults() {
		foreach ($this->result as $key => $value) {
			if ($value['operator'] == self::removeOperator) {
				unset($this->result[$key]);
			} else if ($value['score'] <= 0) {
				unset($this->result[$key]);
			}
		}
	}


	/**
	 *	Removes all unwanted search results and keeps only results tagged as required
	 * @return Modified array
	 */
	private function keepRequired() {
		foreach ($this->result as $key => $value) {
			if ($value['operator'] != self::requireOperator) {
				unset($this->result[$key]);
			} else if ($value['score'] <= 0) {
				unset($this->result[$key]);
			}
		}
	}

	/**
	 * Updates the score of the PM in the result list.
	 *
	 * @param array $list  Array with the PM to modify
	 * @param pm $pm The pm with a changed score
	 * @param int $score The amount to add or remove from the pms score
	 * @param string operator If the result should be marked as required, default or remove
	 * @return Modified array
	 */
	private function updatePMScore($pm, $score, $operator = self::defaultOperator) {
		$id = $pm['id'];
		if (!isset($this->result[$id]['pm'])) {
			$this->result[$id]['pm'] = $pm;
			$this->result[$id]['score'] = $score;
			$this->result[$id]['operator'] = $operator;
		} else {
			$this->result[$id]['score'] += $score;
			if ($operator == self::requireOperator AND $this->result[$id]['operator'] !== self::removeOperator) {
				$this->result[$id]['operator'] = self::requireOperator;
			} else if ($operator == self::removeOperator) {
				$this->result[$id]['operator'] = self::removeOperator;
			} 
		}
		return $this->result;
	}

	public function categorySearch($category) {
	$childcategories = $category->getAllChilds();

	foreach ($childcategories as $key => $cat) {
		$categoryPms = $cat->pms;
		foreach ($categoryPms as $key => $pm) {
			$this->result[$pm->id] = $pm;
		}
	}
}
}

/**
 * Compares two searchresults and return the best result.
 * Returns the result with highest score if they have the same operator (remove, default, require).
 */
function cmp($res1, $res2) 
{
	if ($res1['operator'] == $res2['operator']) {
		if ($res1['score'] == $res2['score']) 
		{
			return 0;
		}
		return ($res1['score'] > $res2['score']) ? -1 : 1;	
	/* TODO REMOVE LATER
	} else if ($res1['operator'] == self::requireOperator Or $res2['operator'] == self::removeOperator) {
		// 1 best
		return -1; // TODO check if -1 and not 1
	} else if ($res2['operator'] == self::requireOperator Or $res1['operator'] == self::removeOperator) {
		// 2 best
		return 1;  // TODO check if -1 and not 1
	*/
	} else {
		throw new Exception('Unknown compare ' . $res1['operator'] . ' ' . $res2['operator']);
	}
}

/**
 * Compares two searchresults and return the results in alphabetical order.
 * Returns the result with highest score if they have the same operator (remove, default, require).
 */
function cmpAlphabetical($res1, $res2) 
{
	if ($res1['operator'] == $res2['operator']) {
		if ($res1['pm']->title == $res2['pm']->title) 
		{
			return 0;
		}
		return ($res1['pm']->title < $res2['pm']->title) ? -1 : 1;	
	} else {
		throw new Exception('Unknown compare ' . $res1['operator'] . ' ' . $res2['operator']);
	}
}

/**
 * Compares two searchresults and return the results by view count.
 */
function cmpViewCount($res1, $res2) 
{
	throw new Exception("This functon is not done yet");
	// TODO make function --------------------------------------------------------------------------------------------------
	if ($res1['operator'] == $res2['operator']) {
		if ($res1['pm']->title == $res2['pm']->title) 
		{
			return 0;
		}
		return ($res1['pm']->title < $res2['pm']->title) ? -1 : 1;	
	} else {
		throw new Exception('Unknown compare ' . $res1['operator'] . ' ' . $res2['operator']);
	}
}

function cmpExpiration($res1, $res2) 
{
	if ($res1['operator'] == $res2['operator']) {
		if ($res1['pm']->expiration_date == $res2['pm']->expiration_date) 
		{
			return 0;
		}
		return ($res1['pm']->expiration_date < $res2['pm']->expiration_date) ? -1 : 1;	
	} else {
		throw new Exception('Unknown compare ' . $res1['operator'] . ' ' . $res2['operator']);
	}
}

function cmpRevision($res1, $res2) 
{
	throw new Exception("We shuld use another column than updated_at");
	if ($res1['operator'] == $res2['operator']) {
		if ($res1['pm']->updated_at == $res2['pm']->updated_at) 
		{
			return 0;
		}
		return ($res1['pm']->updated_at < $res2['pm']->updated_at) ? -1 : 1;	
	} else {
		throw new Exception('Unknown compare ' . $res1['operator'] . ' ' . $res2['operator']);
	}
}


