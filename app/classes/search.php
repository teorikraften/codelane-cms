<?php

function cmp($res1, $res2) 
{
	if ($res1['score'] == $res2['score']) 
	{
		return 0;
	}

	return ($res1['score'] > $res2['score']) ? -1 : 1;
}

class Search {

	function basicSearch($searchQuery) {

		// TODO keep improving
		$searchQuery = htmlspecialchars($searchQuery);

		$result = array();

		// Put goodResult in result with score
		
		// Remove order by score
		//$goodResult = PM::whereRaw("MATCH(content, title) AGAINST(? IN BOOLEAN MODE)", array("'".$searchQuery."'"))
		//->addSelect(DB::raw("*, MATCH(content, title) AGAINST('".$searchQuery."' IN BOOLEAN MODE) AS score"))->orderBy('score', 'desc')->get();
		// LINK http://dev.mysql.com/doc/refman/5.7/en/fulltext-search.html
		// NATURAL LANGUAGE MODE vs BOOLEAN MODE
		
		$goodResult = PM::selectRaw("*, MATCH(content, title) AGAINST('" . $searchQuery . "' IN BOOLEAN MODE) AS score")->get();

		foreach ($goodResult as $key => $pm) {
			$id = $pm['id'];

			$result[$id]['pm'] = $pm;
			$result[$id]['score'] = $pm->score;
		}

		$splitQuery = explode(' ', $searchQuery);
		foreach ($splitQuery as $key => $query) {
			$tag = Tag::where('name', 'like', '%'.$query.'%')->get(); // TODO look into '%' for prestanda
			foreach ($tag as $key => $value) {
				$tagpms = $value->pm;
				foreach ($tagpms as $key => $v) {
					$result = $this->updatePMScore($result, $v, 100);
				}
			}
		} 

		$tag = Tag::where('name', 'like', '%'.$searchQuery.'%')->get(); // TODO look into '%' for prestanda
		foreach ($tag as $key => $value) {
			$tagpms = $value->pm;
			foreach ($tagpms as $key => $v) {
				//$result[$v['id']] = $v;
				$result = $this->updatePMScore($result, $v, 100);
			}
		}

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


		// Sort the list
		usort($result, "cmp");

		$start = 0;
		$lenght = 10;
		$result = array_slice($result, $start, $lenght);

		return $result;
	}


	private function updatePMScore($list, $pm, $score) {
		$id = $pm['id'];
		if (!isset($list[$id]['pm'])) {
			$list[$id]['pm'] = $pm;
			$list[$id]['score'] = $score;
		} else {
			$list[$id]['score'] += $score;
		}
		return $list;
	}




}