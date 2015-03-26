<?php

class Search {

	/*
	TAG ENUM
		default			
		remove
		require
	*/

	/**
	 * Searches for the 10 highest rated search results from the $searchQuery
	 */
	function basicSearch($searchQuery, $start = 0, $lenght = 10) {

		// TODO keep improving

		// TODO fungerar inte med ÅÄÖ

		$searchQuery = htmlspecialchars($searchQuery);

		$result = array();

		if (strPos($searchQuery, '+') !== FALSE) {
			$defaultTag = 'require';
		} else {
			$defaultTag = 'default';
		}

		$goodResult = PM::whereRaw("MATCH(content, title) AGAINST(? IN BOOLEAN MODE)", array("'".$searchQuery."'"))
		->addSelect(DB::raw("*, MATCH(content, title) AGAINST('".$searchQuery."' IN BOOLEAN MODE) AS score"))->where('verified', '=' , 1)->whereNotNull('deleted_at')->where('expiration_date', '<' , 'NOW()')->get();

		// ->where('verified', '=' , 1)->whereNotNull('deleted_at')->where('expiration_date', '<' , 'NOW()')

		// ->whereRaw('deleted_at IS NULL AND verified = 1 AND expiration_date < NOW()')

		foreach ($goodResult as $key => $pm) {
			$id = $pm['id'];

			$result[$id]['pm'] = $pm;
			$result[$id]['score'] = $pm->score;
			$result[$id]['tag'] = $defaultTag;
		}

		$splitQuery = explode(' ', $searchQuery);
		foreach ($splitQuery as $key => $query) {

			if (substr($query, 0, 1) === '+') {
				$score = 10;
				$query = substr($query, 1);
				$tagD = 'require';
			} else if (substr($query, 0, 1) === '-') {
				$score = -10;
				$query = substr($query, 1);
				$tagD = 'remove';
			} else if (substr($query, 0, 1) === '~') {
				$score = 2;
				$query = substr($query, 1);
				$tagD = 'default';
			} else {
				$score = 1;
				$tagD = 'default';
			}

			$tag = Tag::where('name', 'like', '%'.$query.'%')->get();
			foreach ($tag as $key => $value) {
				$tagpms = $value->pm->where('verified', '=' , 1)->whereNotNull('deleted_at')->where('expiration_date', '<' , 'NOW()');
				foreach ($tagpms as $key => $v) {
					$result = $this->updatePMScore($result, $v, 100 * $score, $tagD);
				}
			}

			$contentResult = Pm::where('content', 'like', '%'.$query.'%')->where('verified', '=' , 1)->whereNotNull('deleted_at')->where('expiration_date', '<' , 'NOW()')->get();
			foreach ($contentResult as $key => $v) {
				$result = $this->updatePMScore($result, $v, 1 * $score, $tagD);
			}

			$titleResult = PM::where('title', 'like', '%'.$query.'%')->where('verified', '=' , 1)->whereNotNull('deleted_at')->where('expiration_date', '<' , 'NOW()')->get();
			foreach ($titleResult as $key => $v) {
				$result = $this->updatePMScore($result, $v, 15 * $score, $tagD);
			}
		} 

		$this->removeUnwantedResults($result);

		// Sort the list
		usort($result, "cmp");

		$result = array_slice($result, $start, $lenght);

		return $result;
	}

	/**
	 * Removes unwanted search results from the result list. 
	 * Unwanted results are results with the tag 'remove' or results with a score less than zero
	 */
	private function removeUnwantedResults($result) {
		foreach ($result as $key => $value) {
			if ($value['tag'] == 'remove') {
				unset($result[$key]);
			} else if ($value['score'] <= 0) {
				unset($result[$key]);
			}
		}
	}

	/**
	 * Updates the score of the PM in the result list.
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
 * Returns the result with highest score if they have the same tag (remove, default, require).
 */
function cmp($res1, $res2) 
{
	if ($res1['score'] == $res2['score']) 
	{
		return 0;
	}
	if ($res1['tag'] == $res2['tag']) {
		return ($res1['score'] > $res2['score']) ? -1 : 1;	
	} else if ($res1['tag'] == 'require' Or $res2['tag'] == 'remove') {
		// 1 best
		return -1; // TODO check if -1 and not 1
	} else if ($res2['tag'] == 'require' Or $res1['tag'] == 'remove') {
		// 2 best
		return 1;  // TODO check if -1 and not 1
	} else {
		throw new Exception('Unknown compare ' . $res1['tag'] . ' ' . $res2['tag']);
	}

}