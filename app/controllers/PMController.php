<?php

use Illuminate\Database\Eloquent\ModelNotFoundException;

class PMController extends BaseController {
	// TODO Kolla igenom hela klassen och åtgärda validering och buggar och städa upp
	/**
	 * Displays the PM page view.
	 * @param $token the PM token
	 */
	public function showPMPage($token) {
		try {
		    $pm = Pm::where('token', '=', $token)->firstOrFail();
		} catch(ModelNotFoundException $e) {
		    return Redirect::back()
		    	->with('error', 'PM:et som skulle visas hittades inte.');
		}
		
		return View::make('pm.show')
			->with('pm', $pm)
			->with('assignments', $pm->users);
	}

	/**
	 * Displays the PM download page view.
	 * @param $token the PM token
	 */
	public function showDownloadPage($token) {
		// TODO
		return View::make('pm.download')
			->with('token', $token);
	}

	/**
	 * Displays the PM edit page view.
	 * @param $token the PM token
	 */
	public function showEditPMPage($token) {
		try {
		    $pm = Pm::where('token', '=', $token)->firstOrFail();
		} catch(ModelNotFoundException $e) {
		    return Redirect::back()
		    	->with('error', 'PM:et som skulle visas hittades inte.');
		}
		
		return View::make('pm.edit')
			->with('pm', $pm);
	}

	/**
	 * Handles post request to edit PM.
	 */
	public function editPM() {
		// TODO Hela funktionen

		try {
			$pm = PM::findOrFail(Input::get('id'));
		} catch(ModelNotFoundException $e) {
		    return Redirect::back()
		    	->with('error', 'PM:et som skulle visas hittades inte.');
		}

		if (!(strlen(Input::get('title', '')) > 0))
			return Redirect::back()
				->withInput()
				->with('error', 'Du måste ange PM:ets rubrik.');

		$tags = explode(",", Input::get('tags'));
		// TODO Verifiera taggarna

		if (count($tags) > 0) {
			$pm->tags()->detach();
			foreach ($tags as $tag) {
				if (!is_null(Tag::where('id', '=', $tag)->first()))
					$pm->tags()->attach([$tag => ['added_by' => Auth::user()->id]]);
			}
		}
		$pm->title = Input::get('title');
		$pm->content = Input::get('content');
		$pm->save();

		return Redirect::route('pm-edit', $pm->token);
	}

	/**
	 * Displays the PM edit page view.
	 * @param $token the PM token
	 */
	public function showReviewPMPage($token) {
		try {
		    $pm = Pm::where('token', '=', $token)->firstOrFail();
		} catch(ModelNotFoundException $e) {
		    return Redirect::back()
		    	->with('error', 'PM:et som skulle granskas hittades inte.');
		}

		$comments = Comment::where('pm', '=', $pm->id)
			->select('comments.id as id', 'content', 'users.real_name', 'pm')
			->join('users', 'users.id', '=', 'comments.user')
			->get();

		$authors = array();
		foreach($pm->users as $assignment) {
			if ($assignment->pivot->assignment == 'author')
				$authors[] = $assignment;
		}

		try {
			$review = Review::where('pm', '=', $pm->id)->where('user', '=', Auth::user()->id)->firstOrFail();
			$accepted = $review->accepted == 1;
			$comment = Comment::findOrFail($review->comment);
			$commentC = $comment->content;
		} catch(ModelNotFoundException $e) {
			$accepted = false;
			$commentC = '';
		}

		return View::make('pm.review')
			->with('pm', $pm)
			->with('assignments', $pm->users)
			->with('authors', $authors)
			->with('reviews', $comments)
			->with('accepted', $accepted)
			->with('comment', $commentC);
	}

	public function saveComment() {
		try {
			$pm = PM::findOrFail(Input::get('pm'));
		} catch(ModelNotFoundException $e) {
			return Response::json(null);
		}

		try {
			$comment = Comment::findOrFail(Input::get('id'));
		} catch(ModelNotFoundException $e) {
			if (Input::get('id') == 'none') {
				$comment = new Comment;
				$comment->user = Auth::user()->id;
				$comment->parent_comment = 0;
				$comment->pm = $pm->id;
			} else {
				return Response::json(null);
			}
		}

		$comment->content = Input::get('content');
		$comment->save();

		$pm->content = str_replace('id="none"', 'id="'.intval($comment->id).'"', Input::get('pmc'));
		$pm->save();

		return Response::json($comment->id);

	}

	/**
	 * Handles post request to edit PM.
	 */
	public function reviewPM() {
		// TODO Hela funktionen
		$commentContent = Input::get('comment');
		$accepted = Input::get('accept', 'no');

		try {
			$pm = PM::findOrFail(Input::get('pm-id'));
		} catch(ModelNotFoundException $e) {
		    return Redirect::back()
		    	->with('error', 'PM:et som skulle granskas hittades inte.');
		}

		try {
			$review = Review::where('pm', '=', $pm->id)->where('user', '=', Auth::user()->id)->firstOrFail();
			$comment = Comment::findOrFail($review->comment);
		} catch(ModelNotFoundException $e) {
			$comment = new Comment;
			$comment->user = Auth::user()->id;
			$comment->parent_comment = 0; 
			$comment->pm = $pm->id;
			$comment->save();

			$review = new Review;
			$review->user = Auth::user()->id;
			$review->pm = $pm->id;
			$review->accepted = 0;
			$review->comment = $comment->id;
		}

		$review->accepted = $accepted == 'yes' ? 1 : 0;
		$review->save();
		$comment->content = $commentContent;
		$comment->save();

		return Redirect::route('pm-review', $pm->token)->with('success', 'Kommentaren sparades!');
	}

	/**
	 * Displays the PM edit assignments page view.
	 * @param $token the PM token
	 */
	public function showEditPMAssignmentsPage($token) {
		try {
		    $pm = Pm::where('token', '=', $token)->firstOrFail();
		} catch(ModelNotFoundException $e) {
		    return Redirect::route('index')
		    	->with('error', 'PM:et som skulle ändras hittades inte.');
		}

		$owners = $reviewers = $authors = $members = array();

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

		return View::make('user.admin.pm.assignment-edit')
			->with('pm', $pm)
			->with('owners', $owners)
			->with('reviewers', $reviewers)
			->with('members', $members)
			->with('authors', $authors);
	}

	public function editPMAssignments() {
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
		return View::make('user.admin.pm.index')
			->with('pms', PM::orderBy('title', 'ASC')->take(200)->get())
			->with('userPms', $userPms); // TODO Pagination
	}

	public function showAssignPMPage() {
		return View::make('user.admin.pm.assign');
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

	/**
	 * Displays a page to add role for admin.
	 * @param $id id of the role to delete
	 */
	public function showDeletePMPage($token) 
	{
		try {
			$pm = PM::where('token', '=', $token)->firstOrFail(); 
		} catch(ModelNotFoundException $e) {
		    return Redirect::route('admin-pm')
		    	->with('error', 'PM:et som skulle tas bort hittades inte.');
		}

		return View::make('user.admin.pm.delete')->with('pm', $pm);
	}

	/**
	 * Handles a post request of delete role.
	 */
	public function deletePM() 
	{
		// TODO Fix whole function, should add to oldPMs and so
		// Only yes-button should make this continue
		if (!Input::get('yes'))
			return Redirect::route('admin-pm')->with('warning', 'PM:et togs inte bort.');

		$id = Input::get('pm-id');

		try {
			$role = PM::findOrFail($id)->delete(); 
		} catch(ModelNotFoundException $e) {
		    return Redirect::route('admin-pm')
		    	->with('error', 'PM:et som skulle tas bort hittades inte.');
		}

		return Redirect::route('admin-pm')
			->with('success', 'PM:et togs bort.');
	}
}
