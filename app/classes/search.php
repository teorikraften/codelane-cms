<?php

class Search {

	function basicSearch($searchQuery) {

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

		return $result;
	}

}