<?php

class PMController extends BaseController {
	/**
	 * Displays the PM page view.
	 * @param $token the PM token
	 */
	public function showPMPage($token)
	{
		return View::make('pm.show')->with('token', $token);
	}

	/**
	 * Displays the PM download page view.
	 * @param $token the PM token
	 */
	public function showDownloadPage($token)
	{
		return View::make('pm.download')->with('token', $token);
	}

	/**
	 * Displays the PM edit page view.
	 * @param $token the PM token
	 */
	public function showEditPMPage($token)
	{
		return View::make('pm.edit')->with('token', $token);
	}

	public function showImportPage()
	{
		return View::make('pm.import');
	}

	public function import()
	{
		return View::make('pm.import-verify');
	}

	/**
	 * Displays the PM verify page view.
	 * @param $token the PM token
	 */
	public function showAddPMPage()
	{
		return View::make('pm.add');
	}

	/**
	 * Displays the PM add tag page view.
	 * @param $token the PM token
	 */
	public function showAddTagPage($token)
	{
		return View::make('pm.add-tag')->with('token', $token);
	}

	/**
	 * Displays the PM verify page view.
	 * @param $token the PM token
	 */
	public function showVerifyPage($token)
	{
		return View::make('pm.verify')->with('token', $token);
	}
}
