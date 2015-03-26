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

		// TODO fungerar inte med ÅÄÖ

		$searchQuery = htmlspecialchars($searchQuery);

		$result = array();

		if (strPos($searchQuery, '+') !== FALSE) {
			$defaultTag = 'require';
		} else {
			$defaultTag = 'default';
		}

		$goodResult = PM::whereRaw("MATCH(content, title) AGAINST(? IN BOOLEAN MODE)", array("'".$searchQuery."'"))
		->addSelect(DB::raw("*, MATCH(content, title) AGAINST('".$searchQuery."' IN BOOLEAN MODE) AS score"))
		->where('verified', '=' , 1)->whereNull('pms.deleted_at')->where('expiration_date', '<' , 'CURDATE()')->get();

		// ->where('verified', '=' , 1)->whereNull('pms.deleted_at')->where('expiration_date', '<' , 'CURDATE()')

		// ->whereRaw('deleted_at IS NULL AND verified = 1 AND expiration_date < CURDATE()')
		foreach ($goodResult as $key => $pm) {
			$id = $pm['id'];

			$result[$id]['pm'] = $pm;
			$result[$id]['score'] = $pm->score;
			$result[$id]['tag'] = $defaultTag;
		}

		$splitQuery = explode(' ', $searchQuery);
		foreach ($splitQuery as $key => $query) {
			if ($query == '') {
				continue;
			}

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
				$tagpms = $value->pm()->where('verified', '=' , 1)->whereNull('pms.deleted_at')->where('expiration_date', '<' , 'CURDATE()')->get();
				foreach ($tagpms as $key => $v) {
					$result = $this->updatePMScore($result, $v, 100 * $score, $tagD);
				}
			}

			$contentResult = Pm::where('content', 'like', '%'.$query.'%')->where('verified', '=' , 1)->whereNull('pms.deleted_at')->where('expiration_date', '<' , 'CURDATE()')->get();
			foreach ($contentResult as $key => $v) {
				$result = $this->updatePMScore($result, $v, 1 * $score, $tagD);
			}

			$titleResult = PM::where('title', 'like', '%'.$query.'%')->where('verified', '=' , 1)->whereNull('pms.deleted_at')->where('expiration_date', '<' , 'CURDATE()')->get();
			foreach ($titleResult as $key => $v) {
				$result = $this->updatePMScore($result, $v, 15 * $score, $tagD);
			}
		} 

		if ($defaultTag == 'require') {
			$result = $this->keepRequired($result);
		} else {
			$result = $this->removeUnwantedResults($result);
		}


		usort($result, "cmpExpiration"); // TODO remove
		/*

		// Sort the list
		if ($order == 'default') {
			usort($result, "cmp");	
		} else if ($order == 'alphabetical') {
			usort($result, "cmpAlphabetical");
		} else if ($order == 'view_count') {

		} else if ($order == 'revision_date') {

		} else if ($order == 'expiration_date') {

		}
		*/

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

		return $result;
	}


	/**
	 *	Removes all unwanted search results and keeps only results tagged as required
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
	// TODO make function
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
	throw new Exception("This functon is not done yet");
	if ($res1['tag'] == $res2['tag']) {
		if ($res1['pm']->X_date == $res2['pm']->X_date) 
		{
			return 0;
		}
		return ($res1['pm']->x_date < $res2['pm']->x_date) ? -1 : 1;	
	} else {
		throw new Exception('Unknown compare ' . $res1['tag'] . ' ' . $res2['tag']);
	}
}