<?php

class Search {

	/*
	TAG ENUM
		default			
		remove
		require
	*/

	/**
	 * Searches and returns the highest rated search results from the $searchQuery
	 */
	function pmSearch($searchQuery, $start = 0, $lenght = 10, $order = 'default') {

		// TODO keep improving
		$error = array();
		// TODO fungerar inte med ÅÄÖ

		$searchQuery = htmlspecialchars($searchQuery);

		$result = array();

		if (strPos($searchQuery, '+') !== FALSE) {
			$defaultTag = 'require';
		} else {
			$defaultTag = 'default';
		}

		$apostofCount = substr_count($searchQuery, "'");
		if ($apostofCount % 2 != 0) {
			$searchQuery = str_replace("'", " ", $searchQuery);
			$error[] = 'Ojämnt antal apostorofer';
		}

		try {

			$fullTextSearchResult = PM::whereRaw("MATCH(content, title) AGAINST(? IN BOOLEAN MODE)", array("\"".$searchQuery."\""))
			->addSelect(DB::raw("*, MATCH(content, title) AGAINST(\"".$searchQuery."\" IN BOOLEAN MODE) AS score"))
			->where('verified', '=' , 1)->whereNull('pms.deleted_at')->where('expiration_date', '<' , 'CURDATE()')->get();
		} catch (Exception $e) {
			$error[] = $e->getMessage();
		}

		// ->where('verified', '=' , 1)->whereNull('pms.deleted_at')->where('expiration_date', '<' , 'CURDATE()')

		// ->whereRaw('deleted_at IS NULL AND verified = 1 AND expiration_date < CURDATE()')
		foreach ($fullTextSearchResult as $key => $pm) {
			$id = $pm['id'];

			$result[$id]['pm'] = $pm;
			$result[$id]['score'] = $pm->score;
			$result[$id]['tag'] = $defaultTag;
		}

		$splitQuote = explode("'", $searchQuery);
		foreach ($splitQuote as $key1 => $value2) {

			// For search terms between ' '
			if ($key1 % 2 ==  1) { 
				if (strrpos($splitQuote[$key1 - 1], 1, -1) === '+') {
					// REQUIRED
					$score = 10;
					$operator = 'require';
				} else if (strrpos($splitQuote[$key1 - 1], 1, -1) === '-') {
					// REMOVE
					$score = -10;
					$operator = 'remove';
				} else if (strrpos($splitQuote[$key1 - 1], 1, -1) === '~') {
					// NEGATIVE
					$score = -1;
					$operator = 'default';
				} else {
					// DEFAULT
					$score = 1;
					$operator = 'default';
				}


				$result = $this->searchQueryPart($value2, $operator, $score, $result);

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
						$operator = 'require';
						break;
						case '-':
						$score = -10;
						$query = substr($query, 1);
						$operator = 'remove';
						break;
						case '~':
						$score = -1;
						$query = substr($query, 1);
						$operator = 'default';
						break;
						default:
						$score = 1;
						$operator = 'default';
					}	

					$result = $this->searchQueryPart($query, $operator,$score, $result);
				} 
			}
		}

		if ($defaultTag == 'require') {
			$result = $this->keepRequired($result);
		} else {
			$result = $this->removeUnwantedResults($result);
		}

		// Sort the list
		if ($order == 'default') {
			usort($result, "cmp");	
		} else if ($order == 'alphabetical') {
			usort($result, "cmpAlphabetical");
		} else if ($order == 'view_count') {
			usort($result, "cmpViewCount");
		} else if ($order == 'revision_date') {
			usort($result, "cmpRevision");
		} else if ($order == 'expiration_date') {
			usort($result, "cmpExpiration");
		}

		$result = array_slice($result, $start, $lenght);

		// TODO send error array
		return $result;
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
	private function searchQueryPart($query, $operator, $score, $result = array()) {

		if (preg_match("/(\s)|(^$)/", $query)) {
			return $result;
		}

		$tag = Tag::where('name', 'like', '%'.$query.'%')->get();
		foreach ($tag as $key => $value) {
			$tagpms = $value->pm()->where('verified', '=' , 1)->whereNull('pms.deleted_at')->where('expiration_date', '<' , 'CURDATE()')->get();
			foreach ($tagpms as $key => $v) {
				$result = $this->updatePMScore($result, $v, 100 * $score, $operator);
			}
		}

		$contentResult = Pm::where('content', 'like', '%'.$query.'%')->where('verified', '=' , 1)->whereNull('pms.deleted_at')->where('expiration_date', '<' , 'CURDATE()')->get();
		foreach ($contentResult as $key => $v) {
			$result = $this->updatePMScore($result, $v, 1 * $score, $operator);
		}

		$titleResult = PM::where('title', 'like', '%'.$query.'%')->where('verified', '=' , 1)->whereNull('pms.deleted_at')->where('expiration_date', '<' , 'CURDATE()')->get();
		foreach ($titleResult as $key => $v) {
			$result = $this->updatePMScore($result, $v, 15 * $score, $operator);
		}
		return $result;
	}

	/**
	 * Removes unwanted search results from the result list. 
	 * Unwanted results are results with the tag 'remove' or results with a score less than zero
	 * @param array To be modified
	 * @return Modified array
	 */
	private function removeUnwantedResults($result) {
		foreach ($result as $key => $value) {
			if ($value['tag'] == 'remove') {
				unset($result[$key]);
			} else if ($value['score'] <= 0) {
				unset($result[$key]);
			}
		}

		return $result;
	}


	/**
	 *	Removes all unwanted search results and keeps only results tagged as required
	 * @param array To be modified
	 * @return Modified array
	 */
	private function keepRequired($result) {
		foreach ($result as $key => $value) {
			if ($value['tag'] != 'require') {
				unset($result[$key]);
			} else if ($value['score'] <= 0) {
				unset($result[$key]);
			}
		}

		return $result;
	}

	/**
	 * Updates the score of the PM in the result list.
	 *
	 * @param array $list  Array with the PM to modify
	 * @param pm $pm The pm with a changed score
	 * @param int $score The amount to add or remove from the pms score
	 * @param string tag If the result should be marked as required, default or remove
	 * @return Modified array
	 */
	private function updatePMScore($list, $pm, $score, $tag = 'default') {
		$id = $pm['id'];
		if (!isset($list[$id]['pm'])) {
			$list[$id]['pm'] = $pm;
			$list[$id]['score'] = $score;
			$list[$id]['tag'] = $tag;
		} else {
			$list[$id]['score'] += $score;
			if ($tag == 'require' AND $list[$id]['tag'] !== 'remove') {
				$list[$id]['tag'] = 'require';
			} else if ($tag == 'remove') {
				$list[$id]['tag'] = 'remove';
			} 
		}
		return $list;
	}
}

/**
 * Compares two searchresults and return the best result.
 * Returns the result with highest score if they have the same operator (remove, default, require).
 */
function cmp($res1, $res2) 
{
	if ($res1['tag'] == $res2['tag']) {
		if ($res1['score'] == $res2['score']) 
		{
			return 0;
		}
		return ($res1['score'] > $res2['score']) ? -1 : 1;	
	/* TODO REMOVE LATER
	} else if ($res1['tag'] == 'require' Or $res2['tag'] == 'remove') {
		// 1 best
		return -1; // TODO check if -1 and not 1
	} else if ($res2['tag'] == 'require' Or $res1['tag'] == 'remove') {
		// 2 best
		return 1;  // TODO check if -1 and not 1
	*/
	} else {
		throw new Exception('Unknown compare ' . $res1['tag'] . ' ' . $res2['tag']);
	}
}


/**
 * Compares two searchresults and return the results in alphabetical order.
 * Returns the result with highest score if they have the same tag (remove, default, require).
 */
function cmpAlphabetical($res1, $res2) 
{
	if ($res1['tag'] == $res2['tag']) {
		if ($res1['pm']->title == $res2['pm']->title) 
		{
			return 0;
		}
		return ($res1['pm']->title < $res2['pm']->title) ? -1 : 1;	
	} else {
		throw new Exception('Unknown compare ' . $res1['tag'] . ' ' . $res2['tag']);
	}
}

/**
 * Compares two searchresults and return the results by view count.
 */
function cmpViewCount($res1, $res2) 
{
	throw new Exception("This functon is not done yet");
	// TODO make function --------------------------------------------------------------------------------------------------
	if ($res1['tag'] == $res2['tag']) {
		if ($res1['pm']->title == $res2['pm']->title) 
		{
			return 0;
		}
		return ($res1['pm']->title < $res2['pm']->title) ? -1 : 1;	
	} else {
		throw new Exception('Unknown compare ' . $res1['tag'] . ' ' . $res2['tag']);
	}
}

function cmpExpiration($res1, $res2) 
{
	if ($res1['tag'] == $res2['tag']) {
		if ($res1['pm']->expiration_date == $res2['pm']->expiration_date) 
		{
			return 0;
		}
		return ($res1['pm']->expiration_date < $res2['pm']->expiration_date) ? -1 : 1;	
	} else {
		throw new Exception('Unknown compare ' . $res1['tag'] . ' ' . $res2['tag']);
	}
}

function cmpRevision($res1, $res2) 
{
	throw new Exception("We shuld use another column than updated_at");
	if ($res1['tag'] == $res2['tag']) {
		if ($res1['pm']->updated_at == $res2['pm']->updated_at) 
		{
			return 0;
		}
		return ($res1['pm']->updated_at < $res2['pm']->updated_at) ? -1 : 1;	
	} else {
		throw new Exception('Unknown compare ' . $res1['tag'] . ' ' . $res2['tag']);
	}
}