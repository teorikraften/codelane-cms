<?php

class PMController extends BaseController {
	/**
	 * Displays the PM page view.
	 * @param $token the PM token
	 */
	public function showPMPage($token)
	{
		$pm = Pm::where('token', '=', $token)->firstOrFail(); // TODO Fix
		return View::make('pm.show')->with('pm', $pm);
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
		$filename = date('YmdHis') . '.pdf';
		$path = 'PM/' . Input::get('file', 'none');

		Session::put('path', $path);
		Session::put('files', scandir($path));
		
		return Redirect::route('pm-import-verify');
	}

	public function importVerify() {
		if (Input::get('title', 'fail') != 'fail') {
			$pm = new Pm;
			$pm->title = Input::get('title');
			$pm->token = urlencode(str_replace(array('å', 'ä', 'ö', ' '), array('a', 'a', 'o', '-'), (strtolower(Input::get('title')))));
			$pm->content = Input::get('contents');
			$pm->created_by = 1; // TODO FIX
			$pm->save();
		}

		$files = Session::get('files', 'none');
		$file = array_pop($files);
		Session::put('files', $files);
		if (count($files) < 1)
			return Redirect::route('index');

		if (substr($file, 0, 1) == '.') {
			return Redirect::route('pm-import-verify');
		}

		$info = PDFParser::parse(Session::get('path'), $file);
		return View::make('pm.import-verify')->with('file', $info)->with('path', Session::get('path'))->with('filename', $file);
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
