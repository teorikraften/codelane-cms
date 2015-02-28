<?php

class MainController extends BaseController {
	/*
	 * Displays the index page view.
	 */
	public function showIndex()
	{
		return View::make('index');
	}
}
