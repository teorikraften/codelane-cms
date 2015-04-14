<?php

class Search {

	private $result = array();
	private $error = array();
	private $query;

	private $searchTags = true;
	private $searchText = true;
	private $searchRoles = true;
	private $searchUsers = true;



	public function setSearchOptions($options) {
		$this->searchTags = (boolean)$options[0];
		$this->searchRoles = (boolean)$options[1];
		$this->searchText = (boolean)$options[2];
		$this->searchUsers = true;//issset((boolean)$options[3]) ? (boolean)$options[3] : $searchUsers;
	}

	public function matchingOptions($options) {
		if ($this->searchTags == (boolean)$options[0] 
			&& $this->searchRoles == (boolean)$options[1] && $this->searchText == (boolean)$options[2]) {
			return true;
	}
	return false;
}

	/**
	*Operator ENUM
	*	default			
	*	remove
	*	require
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
	 * $result['roles'] = roles matching the current user (only exsists if there is a matching role)
	 * @return array with PMs and their search score.
	 */
	public function getResult() {
		return $this->result;
	}

	/**
	 * Get an array of errors from the search.
	 * @return array Strings with error meassages.
	 */
	public function getErrorString() {
		$s = '';
		foreach ($this->error as $key => $value) {
			$s .= $value;
		}
		return $s;
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

		if ($this->searchText) {
			$this->fulltextsearch($searchQuery, $defaultOperator);
		}

		$splitQuote = explode("'", $searchQuery);
		foreach ($splitQuote as $key1 => $value2) {

			// For search terms between ' '
			if ($key1 % 2 ==  1) { 
				if (strrpos($splitQuote[$key1 - 1], 1, -1) === '+') {
					$score = 10;
					$operator = self::requireOperator;
				} else if (strrpos($splitQuote[$key1 - 1], 1, -1) === '-') {
					$score = -10;
					$operator = self::removeOperator;
				} else if (strrpos($splitQuote[$key1 - 1], 1, -1) === '~') {
					$score = -1;
					$operator = self::defaultOperator;
				} else {
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

					$this->searchQueryPart($query, $operator,$score);

					// TOOD MOVE AND IMPROVE
					if (!preg_match("/(\s)|(^$)/", $query) && $this->searchUsers) {
						if ($key == 0) {
							$this->searchUsers($splitQuery[$key], $query, $operator, $score);
						} else {
							$this->searchUsers($splitQuery[$key - 1] . ' ' . $splitQuery[$key], $query, $operator, $score);
						}
					}
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
			->where('published', '=' , 1)->whereNull('pms.deleted_at')->where('expiration_date', '<' , 'CURDATE()')->where('published', '=', 1)->get();
		} catch (Exception $e) {
			$this->error[] = $e->getMessage();
			$fullTextSearchResult = array();
		}

		foreach ($fullTextSearchResult as $key => $pm) {
			$id = $pm->id;

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
		if ($this->searchTags) {
			$this->searchTag($query, $operator, $score);
		}

		if ($this->searchRoles) {
			$this->searchRole($query, $operator, $score);
		}

		if ($this->searchText) {
			$this->searchTitle($query, $operator, $score);

			$this->searchContent($query, $operator, $score);
		}
	}

	/**
	* Searches the database for tag matches and adds pm connected to matching tags.
	*/
	private function searchTag($query, $operator, $score) {
		$tag = Tag::where('name', 'like', '%'.$query.'%')->get();
		foreach ($tag as $key => $value) {
			$tagpms = $value->pm()->where('published', '=' , 1)->whereNull('pms.deleted_at')->where('expiration_date', '<' , 'CURDATE()')->get();
			foreach ($tagpms as $key => $v) {
				$this->result = $this->updatePMScore($v, 100 * $score, $operator);
			}
		}
	}

	/**
	* Searches the database for role matches and adds pm connected to matching roles.
	*/
	private function searchRole($query, $operator, $score) {
		$role = Role::where('name', 'like', '%'.$query.'%')->get();
		foreach ($role as $key => $value) {
			$rolepms = $value->pms()->where('published', '=' , 1)->whereNull('pms.deleted_at')->where('expiration_date', '<' , 'CURDATE()')->get();
			foreach ($rolepms as $key => $v) {
				$this->result = $this->updatePMScore($v, 10 * $score, $operator);
			}
		}
	}

	/**
	* Searches the database for matches from the column title
	*/
	private function searchTitle($query, $operator, $score) {
		$titleResult = PM::where('title', 'like', '%'.$query.'%')->where('published', '=' , 1)->whereNull('pms.deleted_at')->where('expiration_date', '<' , 'CURDATE()')->get();
		foreach ($titleResult as $key => $v) {
			$this->result = $this->updatePMScore($v, 15 * $score, $operator);
		}
	}

	/**
	* Searches the database for matches from the column content
	* 
	* Is this function desireable? TODO remove maybe
	* 
	*/
	private function searchContent($query, $operator, $score) {
		$contentResult = PM::where('content', 'like', '%'.$query.'%')->where('published', '=' , 1)->whereNull('pms.deleted_at')->where('expiration_date', '<' , 'CURDATE()')->get();
		foreach ($contentResult as $key => $v) {
			$this->result = $this->updatePMScore($v, 1 * $score, $operator);
		}
	}

	private function searchUsers($qName, $qEmail, $operator, $score) {
		$users = User::where('name', 'LIKE', '%'.$qName.'%')->orWhere('email', 'LIKE', '%'.$qEmail.'%')->get();
		foreach ($users as $key => $u) {
			$pms = $u->pms;
			foreach ($pms as $key => $pm) {
				$this->result = $this->updatePMScore($pm, 10 * $score, $operator);
			}
		}

		/*
		$userResult = DB::table('users')->where(function($joinUser) use ($query){
			$joinUser->where('name', 'LIKE', '%'.$query.'%')->orWhere('email', 'LIKE', '%'.$query.'%');
		})
		->join('assignments', 'assignments.user', '=', 'users.id')->join('pms', 'assignments.pm', '=', 'pms.id')
		->whereNull('pms.deleted_at')->where('published', '=', 1)->where('expiration_date', '<' , 'CURDATE()')
		->select('pms.*', 'user', 'users.name', 'assignments.assignment')
		->get();
		foreach ($userResult as $key => $pm) {
			$pm = new PM($pm);
			$this->result = $this->updatePMScore($pm, 1 * $score, $operator);
		}
		*/
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

	public function findRoles() {
		$user = User::find(Auth::user()->id);
		if (!isset($user)) {
			return;
		}

		$roles = $user->roles;

		foreach ($roles as $key => $role) {
			$pms = $role->pms;
			foreach ($pms as $key => $pm) {
				if (isset($this->result[$pm->id])) {
					$this->result[$pm->id]['roles'][] = $role;
					$this->updatePmScore($pm, 100);
				}
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

	/**
	 * Get pms connected to the category and all child categories.
	 *
	 * @param Category $category Category to find all PMs under.
	 */
	public function categorySearch($category) {
		$childcategories = $category->getAllChildren();

		foreach (array($category) + $childcategories as $key => $cat) {
			$categoryPms = $cat->pms()->where('published', '=' , 1)->whereNull('pms.deleted_at')->where('expiration_date', '<' , 'CURDATE()')->get();
			foreach ($categoryPms as $key => $pm) {
				$this->result[$pm->id]['pm'] = $pm;
				$this->result[$pm->id]['score'] = 1;
				$this->result[$pm->id]['operator'] = self::defaultOperator; 
			}
		}
	}

	/**
	 * Get all pms sorted by revision_date
	 */
	public function latestUpdatedPMs() {
		$latestPms = PM::where('published', '=' , 1)->whereNull('pms.deleted_at')->where('expiration_date', '<' , 'CURDATE()')->orderBy('revision_date', 'DESC')->get();
		foreach ( $latestPms as $key => $pm) {
			$this->result[$pm->id]['pm'] = $pm;
			$this->result[$pm->id]['score'] = 1;
			$this->result[$pm->id]['operator'] = self::defaultOperator; 
		}
	}

	public function findAllPms() {
		$allpms = PM::where('published', '=' , 1)->whereNull('pms.deleted_at')->where('expiration_date', '<' , 'CURDATE()')->get();
		foreach ( $allpms as $key => $pm) {
			$this->result[$pm->id]['pm'] = $pm;
			$this->result[$pm->id]['score'] = 1;
			$this->result[$pm->id]['operator'] = self::defaultOperator; 
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
	if ($res1['operator'] == $res2['operator']) {
		if ($res1['pm']->revision_date == $res2['pm']->revision_date) 
		{
			return 0;
		}
		return ($res1['pm']->revision_date < $res2['pm']->revision_date) ? -1 : 1;	
	} else {
		throw new Exception('Unknown compare ' . $res1['operator'] . ' ' . $res2['operator']);
	}
}


