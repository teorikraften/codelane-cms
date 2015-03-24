<?php

class PMController extends BaseController {
	/**
	 * Displays the PM page view.
	 * @param $token the PM token
	 */
	public function showPMPage($token)
	{
		$pm = Pm::where('token', '=', $token)->firstOrFail(); // TODO Fix
		return View::make('pm.show')
			->with('pm', $pm)
			->with('assignments', $pm->users);
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
		return View::make('pm.edit')->with('pm', PM::where('token', '=', $token)->first());
	}

	public function editPM()
	{
		$pm = PM::findOrFail(Input::get('id'));
		$pm->title = Input::get('title');
		$pm->content = Input::get('content');
		$pm->save();
		return Redirect::route('pm-edit', $pm->token);
	}

	/**
	 * Displays the PM edit page view.
	 * @param $token the PM token
	 */
	public function showEditPMAssignmentsPage($token)
	{
		$pm = PM::where('token', '=', $token)->firstOrFail();
		$owners = array(); 
		$reviewers = array(); 
		$authors = array(); 
		$members = array();

		foreach($pm->users as $user) {
			if ($user->pivot->assignment == 'author')
				$authors[] = $user;
			elseif ($user->pivot->assignment == 'reviewer')
				$reviewers[] = $user;
			elseif ($user->pivot->assignment == 'owner')
				$owners[] = $user;
			elseif ($user->pivot->assignment == 'member')
				$members[] = $user;
		}
		return View::make('user.admin.edit-assignments')
			->with('pm', $pm)
			->with('owners', $owners)
			->with('reviewers', $reviewers)
			->with('members', $members)
			->with('authors', $authors);
	}

	public function editPMAssignments()
	{
		// TODO Validering
		$owner = explode(',', Input::get('responsible'));
		$owner = $owner[0];
		$authors = explode(',', Input::get('authors'));
		$reviewers = explode(',', Input::get('reviewers'));

		$user = Auth::user();

		$pm = PM::findOrFail(Input::get('id'));
		$pm->users()->detach();

		foreach ($authors as $author) {
			User::findOrFail($author)->pms()->attach([$pm->id => ['assignment' => 'author']]);
		}
		foreach ($reviewers as $reviewer) {
			User::findOrFail($reviewer)->pms()->attach([$pm->id => ['assignment' => 'reviewer']]);
		}
		User::findOrFail($owner)->pms()->attach([$pm->id => ['assignment' => 'owner']]);
		$user->save();
		
		return Redirect::route('admin-pm');
	}

	public function showImportPage()
	{
		return View::make('user.import.import');
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
		return View::make('user.import.import-verify')->with('file', $info)->with('path', Session::get('path'))->with('filename', $file);
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

	public function showPMListPage() {
		$userPms = Auth::user()->pms;
		foreach ($userPms as $pm) {
			if (strtotime($pm->expiration_date) < time() && $pm->verified) {
				$pm->status = 'utgånget';
			} elseif (strtotime($pm->first_published_date) < time() && $pm->verified) {
				$pm->status = 'publicerat';
			} else {
				$pm->status = 'ej veriferat';
			}
		}
		return View::make('user.admin.pm')
			->with('pms', PM::orderBy('title', 'ASC')->take(200)->get())
			->with('userPms', $userPms); // TODO Pagination
	}

	public function showAssignPMPage() {
		return View::make('user.admin.pm-assign');
	}

	public function assignPM() {
		// TODO Validering
		$owner = explode(',', Input::get('responsible'));
		$owner = $owner[0];
		$authors = explode(',', Input::get('authors'));
		$reviewers = explode(',', Input::get('reviewers'));

		$user = Auth::user();

		$pm = new PM;
		$pm->title = Input::get('title');
		$pm->created_by = $user->id;
		$pm->token = $this->generateToken('pm-' . $pm->title);
		$pm->save();

		foreach ($authors as $author) {
			User::findOrFail($author)->pms()->attach([$pm->id => ['assignment' => 'author']]);
		}
		foreach ($reviewers as $reviewer) {
			User::findOrFail($reviewer)->pms()->attach([$pm->id => ['assignment' => 'reviewer']]);
		}
		User::findOrFail($owner)->pms()->attach([$pm->id => ['assignment' => 'owner']]);
		$user->save();
		
		return Redirect::route('admin-pm');
	}

	/**
     * Generates a valid token.
	 */
	private function generateToken($name, $delimiter = '-') {
		setlocale(LC_ALL, 'en_US.UTF8');
		$clean = iconv('UTF-8', 'ASCII//TRANSLIT', $name);
		$clean = preg_replace("/[^a-zA-Z0-9\/_|+ -]/", '', $clean);
		$clean = strtolower(trim($clean, '-'));
		$clean = preg_replace("/[\/_|+ -]+/", $delimiter, $clean);

		$n = Tag::where('token', '=', $clean)->count();
		if ($n > 0) {
			$clean = $this->generateToken($clean . '-' . rand(0, 9), $delimiter);
		}

		return $clean;
	}
}
