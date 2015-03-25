<?php

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

class Search {

	function basicSearch($searchQuery) {

		// TODO keep improving

		// TODO fungerar inte med ÅÄÖ


		$searchQuery = htmlspecialchars($searchQuery);

		$result = array();

		/*
			TAG ENUM
				default
				remove
				require
		*/


		// Put goodResult in result with score

		// Remove order by score
		//$goodResult = PM::whereRaw("MATCH(content, title) AGAINST(? IN BOOLEAN MODE)", array("'".$searchQuery."'"))
		//->addSelect(DB::raw("*, MATCH(content, title) AGAINST('".$searchQuery."' IN BOOLEAN MODE) AS score"))->orderBy('score', 'desc')->get();
		// LINK http://dev.mysql.com/doc/refman/5.7/en/fulltext-search.html
		// NATURAL LANGUAGE MODE vs BOOLEAN MODE

		//$goodResult = PM::selectRaw("*, MATCH(content, title) AGAINST('" . $searchQuery . "' IN BOOLEAN MODE) AS score")->get();

				if (strPos($searchQuery, '+') !== FALSE) {
					$defaultTag = 'require';
				} else {
					$defaultTag = 'default';
				}

				$goodResult = PM::whereRaw("MATCH(content, title) AGAINST(? IN BOOLEAN MODE)", array("'".$searchQuery."'"))
				->addSelect(DB::raw("*, MATCH(content, title) AGAINST('".$searchQuery."' IN BOOLEAN MODE) AS score"))->get();

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
						$tagpms = $value->pm;
						foreach ($tagpms as $key => $v) {
							$result = $this->updatePMScore($result, $v, 100 * $score, $tagD);
						}
					}

					$contentResult = Pm::where('content', 'like', '%'.$query.'%')->get();
					foreach ($contentResult as $key => $v) {
						$result = $this->updatePMScore($result, $v, 1 * $score, $tagD);
					}

					$titleResult = PM::where('title', 'like', '%'.$query.'%')->get();
					foreach ($titleResult as $key => $v) {
						$result = $this->updatePMScore($result, $v, 15 * $score, $tagD);
					}
				} 

		/* OLD
		$tag = Tag::where('name', 'like', '%'.$searchQuery.'%')->get(); // TODO look into '%' for prestanda
		foreach ($tag as $key => $value) {
			$tagpms = $value->pm;
			foreach ($tagpms as $key => $v) {
				//$result[$v['id']] = $v;
				$result = $this->updatePMScore($result, $v, 100);
			}
		}
		*/

		/* OLD
		$contentResult = Pm::where('content', 'like', '%'.$searchQuery.'%')->take(10)->get();
		foreach ($contentResult as $key => $v) {
			//$result[$v['id']] = $v;
			$result = $this->updatePMScore($result, $v, 1);
		}

		$titleResult = PM::where('title', 'like', '%'.$searchQuery.'%')->get();
		foreach ($titleResult as $key => $v) {
			//$result[$v['id']] = $v;
			$result = $this->updatePMScore($result, $v, 15);
		}
		*/


		foreach ($result as $key => $value) {
			if ($value['tag'] == 'remove') {
				unset($result[$key]);
			} else if ($value['score'] <= 0) {
				unset($result[$key]);
			}
		}

		// Sort the list
		usort($result, "cmp");

		$start = 0;
		$lenght = 10;
		$result = array_slice($result, $start, $lenght);

		return $result;
	}


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