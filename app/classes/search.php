<?php

class Search {

	function basicSearch($searchQuery) {

		// TODO keep improving

		$result = array();
		
		$tagResult = array();
		$tag = Tag::where('name', 'like', '%'.$searchQuery.'%')->get();
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
		$goodResult = PM::whereRaw("MATCH(content) AGAINST(? IN NATURAL LANGUAGE MODE)", array("'".$searchQuery."'"))
		->addSelect(DB::raw("*, MATCH(content) AGAINST('".$searchQuery."' IN NATURAL LANGUAGE MODE) AS score"))->orderBy('score', 'desc')->get();
		//return $goodResult;
		// Problem?: Not taking short words into account when searching

		// TODO look inte boolean mode (with + -) vs natural language LINK http://dev.mysql.com/doc/refman/5.7/en/fulltext-search.html

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