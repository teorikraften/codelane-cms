<?php

class TagContoller extends BaseController {
	
	/**
	 * Displays a list of all the PM for tag.
	 * @param $tag the tag
	 * @param $page the page, 1 by deafult
	 */
	public function showTagPMListPage($tag, $page = 1)
	{
		return View::make('tag.show')->with('tag', $tag)->with('page', $page);
	}
}
