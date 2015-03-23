<?php

class Search {

	function basicSearch($searchQuery) {

		// TODO keep improving
		$searchQuery = htmlspecialchars($searchQuery);

		$result = array();
		
		$tagResult = array();
		$tag = Tag::where('name', 'like', '%'.$searchQuery.'%')->get(); // TODO look into '%' for prestanda
		foreach ($tag as $key => $value) {
			$tagpms = $value->pm;
			foreach ($tagpms as $key => $v) {
				$result[$v['id']] = $v;
				
			}
		}

		$contentResult = Pm::where('content', 'like', '%'.$searchQuery.'%')->take(10)->get();
		foreach ($contentResult as $key => $v) {
			$result[$v['id']] = $v;
		}

		$titleResult = PM::where('title', 'like', '%'.$searchQuery.'%')->get();
		foreach ($titleResult as $key => $v) {
			$result[$v['id']] = $v;
		}

		// TODO Requires Full text index on content 
		$goodResult = PM::whereRaw("MATCH(content) AGAINST(? IN BOOLEAN MODE)", array("'".$searchQuery."'"))
		->addSelect(DB::raw("*, MATCH(content) AGAINST('".$searchQuery."' IN BOOLEAN MODE) AS score"))->orderBy('score', 'desc')->get();
		//return $goodResult;
		// Problem?: Not taking short words into account when searching

		// TODO look into boolean mode (with + -) vs natural language LINK http://dev.mysql.com/doc/refman/5.7/en/fulltext-search.html

		// NATURAL LANGUAGE MODE vs BOOLEAN MODE

		/*
		mysql> SELECT id, body, MATCH (title,body) AGAINST (?) AS score
    	FROM articles WHERE MATCH (title,body) AGAINST (?);
		*/

		// Returns content search and only returns tags, title search if content search is empty
    	if (sizeof($goodResult) == 0) {
    		return $result;
    	}
    	return $goodResult;
    }

}