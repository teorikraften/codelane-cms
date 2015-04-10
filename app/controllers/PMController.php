<?php

include(app_path().'/classes/htmltodocx/h2d_htmlconverter.php');

use Illuminate\Database\Eloquent\ModelNotFoundException;

class PMController extends BaseController {
	// TODO Kolla igenom hela klassen och åtgärda validering och buggar och städa upp
	
	/**
	 * Displays the PM page view.
	 * @param $token the PM token
	 */
	public function getShow($token) {
		try {
			$pm = Pm::where('token', '=', $token)->firstOrFail();
		} catch(ModelNotFoundException $e) {
			return Redirect::back()
			->with('error', 'PM:et som skulle visas hittades inte.');
		}

		$user = User::find(Auth::user()->id);
		$fav = (!empty($user->favourites()->where('pm', '=', $pm->id)->first())) ? true : false;
		
		return View::make('pm.show')
		->with('pm', $pm)
		->with('assignments', $pm->users)
		->with('favourite' , $fav);
	}

	/**
	 * Displays the PM page view.
	 * @param $token the PM token
	 */
	public function getInfo($token) {
		try {
			$pm = Pm::where('token', '=', $token)->firstOrFail();
		} catch(ModelNotFoundException $e) {
			return Redirect::back()
			->with('error', 'PM:et som skulle visas hittades inte.');
		}

		$user = User::find(Auth::user()->id);
		$fav = (!empty($user->favourites()->where('pm', '=', $pm->id)->first())) ? true : false;
		
		return View::make('user.admin.pm.info')
		->with('pm', $pm)
		->with('assignments', $pm->users)
		->with('favourite' , $fav);
	}

	/**
	 * Display the user's favorite pms
	 */
	public function showFavourites() {
		$pms = Auth::user()->favourites()
			->where('published', '=' , 1)
			->whereNull('pms.deleted_at')
			->where('expiration_date', '<' , 'CURDATE()')
			->get();

		return View::make('pm.favourites')
			->with('pms', $pms);
	}

	/**
	* Change favourite status of the pm.
	*/
	public function favouritePM($token = null, $goto = null) {
		$token = Input::get('token', $token);
		$goto = Input::get('goto', $goto);
		$user = Auth::user();
		
		try {
			$pm = PM::where('token', '=', $token)->firstOrFail();
		} catch (ModelNotFoundException $e) {
			return Redirect::route('favourites-show')
				->with('error', 'Kunde inte hitta PM:et som skulle favoritmarkeras.');
		}

		if (!empty($user->favourites()->where('pm', '=', $pm->id)->first())) {
			$user->favourites()->detach($pm);
			$message = '"' . $pm->title . '" togs bort som favorit.';
		} else {
			$user->favourites()->attach($pm);
			$message = '"' . $pm->title . '" lades till som favorit.';
		}

		if ($goto == 'fav') {
			$m = $message . 
				' <a href="' . 
					URL::route('get-favourite-edit', array('goto' => 'fav', 'token' => $token)) .
				'">Ångra.</a>';

			return Redirect::route('favourites-show')
				->with('success', $m);

		} elseif (isset($_SERVER['HTTP_REFERER'])) {
			return Redirect::back()
				->with('success', $message);
		} elseif ($goto == 'pm') {
			return Redirect::route('pm-show', array('token' => $token))
				->with('success', $message);
		}

		return Redirect::route('favourites-show')
			->with('error', 'Ett fel uppstod när PM:et skulle favoritmarkeras.');
	}

	/**
	 * Displays the PM download page view.
	 * @param $token the PM token
	 */
	public function getDownload($token) {
		try {
			$pm = PM::where('token', '=', $token)->firstOrFail();
		} catch(ModelNotFoundException $e) {
			return Redirect::back()->with('error', 'PM:et hittades inte.');
		}

		$assignments = $pm->users;

		$resp = "";
		foreach($assignments as $assignment) {
			if ($assignment->pivot->assignment == 'owner') {
				$resp .= $assignment->name . " ";
			}
		}

		$auth = "";
		foreach($assignments as $assignment) {
			if ($assignment->pivot->assignment == 'author') {
				$auth .= $assignment->name . " ";
			}
		}

		$rev = "";
		foreach($assignments as $assignment) {
			if ($assignment->pivot->assignment == 'reviewer') {
				$rev .= $assignment->name . " ";
			}
		}

		// New Word Document:
		$phpword_object = new \PhpOffice\PhpWord\PhpWord();
		$section = $phpword_object->createSection();

		/**

		*/
		// Add first page header
		$header = $section->addHeader();
		$header->firstPage();

		$table = $header->addTable();

		$table->addRow();
		$cell = $table->addCell();
		$textrun = $cell->addTextRun();
		$textrun->addText(htmlspecialchars('Ansvarig: '));
		$cell = $table->addCell(4000);
		$textrun = $cell->addTextRun();
		$textrun->addText(htmlspecialchars($resp));


		$table->addRow();
		$cell = $table->addCell();
		$textrun = $cell->addTextRun();
		$textrun->addText(htmlspecialchars('Författare: '));
		$cell = $table->addCell(4000);
		$textrun = $cell->addTextRun();
		$textrun->addText(htmlspecialchars($auth));
		

		$table->addRow();
		$cell = $table->addCell();
		$textrun = $cell->addTextRun();
		$textrun->addText(htmlspecialchars('Granskare: '));
		$cell = $table->addCell(4000);
		$textrun = $cell->addTextRun();
		$textrun->addText(htmlspecialchars($rev));

		// Add header for all other pages
		$subsequent = $section->addHeader();
		$subsequent->addText(htmlspecialchars($pm->title));

		/**

		*/

		// HTML Dom object:
		$html_dom = new simple_html_dom();
		$html_dom->load('<html><body><h1>' . $pm->title . '</h1>' 
			. $pm->content . '</body></html>');

		// Create the dom array of elements which we are going to work on:
		$html_dom_array = $html_dom->find('html',0)->children();

		// Provide some initial settings:
		$initial_state = array(
  			// Required parameters:
  			'phpword_object' => &$phpword_object, // Must be passed by reference.
  			'base_root' => 'http://cms.local', // Required for link elements - change it to your domain.
  			'base_path' => '/', // Path from base_root to whatever url your links are relative to.
  			// Optional parameters - showing the defaults if you don't set anything:
  			'current_style' => array('size' => '11'), // The PHPWord style on the top element - may be inherited by descendent elements.
  			'parents' => array(0 => 'body'), // Our parent is body.
  			'list_depth' => 0, // This is the current depth of any current list.
  			'context' => 'section', // Possible values - section, footer or header.
  			'pseudo_list' => TRUE, // NOTE: Word lists not yet supported (TRUE is the only option at present).
  			'pseudo_list_indicator_font_name' => 'Wingdings', // Bullet indicator font.
  			'pseudo_list_indicator_font_size' => '7', // Bullet indicator size.
  			'pseudo_list_indicator_character' => 'l ', // Gives a circle bullet point with wingdings.
  			'table_allowed' => TRUE, // Not in table, cannot be nested
  			'treat_div_as_paragraph' => TRUE, // If set to TRUE, each new div will trigger a new line in the Word document.
   			'style_sheet' => htmltodocx_docs_style(), // This is an array (the "style sheet") - returned by htmltodocx_styles_example() here (in styles.inc) - see this function for an example of how to construct this array.
   			); 

			// Convert the HTML and put it into the PHPWord object
		htmltodocx_insert_html($section, $html_dom_array[0]->nodes, $initial_state);

				// Clear the HTML dom object:
		$html_dom->clear(); 
		unset($html_dom);

				// Save File
		$h2d_file_uri = tempnam('', 'htd') . '.docx';
		$objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpword_object, 'Word2007');
		$objWriter->save($h2d_file_uri);

		return Response::download($h2d_file_uri);
	}

	/**
	 * Displays the PM edit page view.
	 * @param $token the PM token
	 */
	public function getEdit($token) {
		try {
			$pm = Pm::where('token', '=', $token)->firstOrFail();
		} catch(ModelNotFoundException $e) {
			return Redirect::back()
			->with('error', 'PM:et som skulle visas hittades inte.');
		}

		return View::make('pm.edit')
		->with('categorySelect', $this->getChildrenList(0, NULL))
		->with('pm', $pm);
	}

	/**
	 * Handles post request to edit PM.
	 */
	public function postEdit() {
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

		$pm->title = Input::get('title');
		$pm->draft = Input::get('draft');

		if (Input::has('done')) {
			if (substr($pm->status, 0, 8) == 'revision') {
				$pm->status = 'revision-written';
			} else {
				$pm->status = 'written';
			}
		}
		$pm->save();

		if (Input::has('done'))
			return Redirect::route('admin-pm')->with('success', 'Texten sparades och PM:et markerades som klart.');

		return Redirect::route('pm-edit', $pm->token)->with('warning', 'Texten sparades men PM:et måste fortfarande markeras som klart.');
	}

	/**
	 * Displays the PM edit page view.
	 * @param $token the PM token
	 */
	public function getReview($token) {
		try {
			$pm = PM::where('token', '=', $token)->firstOrFail();
		} catch(ModelNotFoundException $e) {
			return Redirect::back()
				->with('error', 'PM:et som skulle granskas hittades inte.');
		}

		if (substr($pm->status, -7) != "written") {
			return Redirect::route('admin-pm')
				->with('error', 'PM:et är inte färdigt för granskning än.');
		}

		try {
			$assignment = Assignment::where('user', '=', Auth::user()->id)
				->where('pm', '=', $pm->id)
				->where(function($query) {
					$query->where('assignment', '=', 'revision-reviewer')
						->orWhere('assignment', '=', 'reviewer');
				})
				->firstOrFail();
		} catch(ModelNotFoundException $e) {
			return Redirect::route('admin-pm')
				->with('error', 'Det verkar inte som du har behörighet att granska detta PM.');
		}

		$comments = $pm->comments;
		$authors = $pm->users; // TODO Not all users
		$assignments = $pm->users; 

		return View::make('pm.review')
			->with('assignment', $assignment)
			->with('assignments', $assignments)
			->with('authors', $authors)
			->with('comments', $comments)
			->with('pm', $pm);
	}

	public function postSaveComment() {
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
	public function postReview() {
		$content = Input::get('comment');
		$accepted = Input::get('accept', 'no');

		try {
			$pm = PM::findOrFail(Input::get('pm-id'));
		} catch(ModelNotFoundException $e) {
			return Redirect::back()
			->with('error', 'PM:et som skulle granskas hittades inte.');
		}

		if (substr($pm->status, -7) != "written") {
			return Redirect::route('admin-pm')
				->with('error', 'PM:et är inte färdigt för granskning än.');
		}

		try {
			$assignment = Assignment::where('user', '=', Auth::user()->id)
				->where('pm', '=', $pm->id)
				->where(function($query) {
					$query->where('assignment', '=', 'revision-reviewer')
						->orWhere('assignment', '=', 'reviewer');
				})
				->firstOrFail();
		} catch(ModelNotFoundException $e) {
			return Redirect::route('admin-pm')
				->with('error', 'Det verkar inte som du har behörighet att granska detta PM.');
		}

		$assignment->accepted = $accepted == 'yes' ? 1 : 0;
		$assignment->content = $content;
		$assignment->save();
		
		$allAss = Assignment::where('pm', '=', $pm->id)
			->where('assignment', '=', $assignment->assignment)
			->get();

		$accepted = true;
		foreach($allAss as $ass) {
			if ($ass->accepted == 0) {
				$accepted = false;
				break;
			}
		}

		if ($accepted) {
			if (substr($pm->status, 0, 8) == 'revision') {
				$pm->status = 'revision-reviewed';
			} else {
				$pm->status = 'reviewed';
			}
			$pm->save();
			return Redirect::route('admin-pm')
				->with('success', 'Kommentaren sparades och PM:et är nu godkänt av alla!');
		}

		// TODO Check if last to accept, then change PM status

		return Redirect::route('pm-review', $pm->token)
			->with('success', 'Kommentaren sparades!');
	}

	/**
	 * Displays the PM edit page view.
	 * @param $token the PM token
	 */
	public function getEndReview($token) {
		try {
			$pm = PM::where('token', '=', $token)->firstOrFail();
		} catch(ModelNotFoundException $e) {
			return Redirect::back()
				->with('error', 'PM:et som skulle granskas hittades inte.');
		}

		if ($pm->status != "reviewed" && $pm->status != "revision-reviewed") {
			return Redirect::route('admin-pm')
				->with('error', 'PM:et är inte färdigt för slutgranskning än.');
		}

		try {
			$assignment = Assignment::where('user', '=', Auth::user()->id)
				->where('pm', '=', $pm->id)
				->where(function($query) {
					$query->where('assignment', '=', 'revision-end-reviewer')
						->orWhere('assignment', '=', 'end-reviewer');
				})
				->firstOrFail();
		} catch(ModelNotFoundException $e) {
			return Redirect::route('admin-pm')
				->with('error', 'Det verkar inte som du har behörighet att slutgranska detta PM.');
		}

		$comments = $pm->comments;
		$authors = $pm->users; // TODO Not all users
		$assignments = $pm->users; 

		return View::make('pm.end-review')
			->with('assignment', $assignment)
			->with('assignments', $assignments)
			->with('authors', $authors)
			->with('comments', $comments)
			->with('pm', $pm);
	}

	/**
	 * Handles post request to edit PM.
	 */
	public function postEndReview() {
		$content = Input::get('comment');
		$accepted = Input::get('accept', 'no');

		try {
			$pm = PM::findOrFail(Input::get('pm-id'));
		} catch(ModelNotFoundException $e) {
			return Redirect::back()
			->with('error', 'PM:et som skulle slutgranskas hittades inte.');
		}

		if ($pm->status != "reviewed" && $pm->status != "revision-reviewed") {
			return Redirect::route('admin-pm')
				->with('error', 'PM:et är inte färdigt för slutgranskning än.');
		}

		try {
			$assignment = Assignment::where('user', '=', Auth::user()->id)
				->where('pm', '=', $pm->id)
				->where(function($query) {
					$query->where('assignment', '=', 'revision-end-reviewer')
						->orWhere('assignment', '=', 'end-reviewer');
				})
				->firstOrFail();
		} catch(ModelNotFoundException $e) {
			return Redirect::route('admin-pm')
				->with('error', 'Det verkar inte som du har behörighet att slutgranska detta PM.');
		}

		$assignment->accepted = $accepted == 'yes' ? 1 : 0;
		$assignment->content = $content;
		$assignment->save();
		
		$allAss = Assignment::where('pm', '=', $pm->id)
			->where('assignment', '=', $assignment->assignment)
			->get();

		$accepted = true;
		foreach($allAss as $ass) {
			if ($ass->accepted == 0) {
				$accepted = false;
				break;
			}
		}

		if ($accepted) {
			if (substr($pm->status, 0, 8) == 'revision') {
				$pm->status = 'revision-end-reviewed';
			} else {
				$pm->status = 'end-reviewed';
			}
			$pm->save();
			return Redirect::route('admin-pm')
				->with('success', 'Kommentaren sparades och PM:et är nu helt färdiggranskat!');
		}

		return Redirect::route('pm-end-review', $pm->token)
			->with('success', 'Kommentaren sparades!');
	}

	/**
	 * Displays the PM edit assignments page view.
	 * @param $token the PM token
	 */
	public function getEditAssignments($token) {
		try {
			$pm = Pm::where('token', '=', $token)->firstOrFail();
		} catch(ModelNotFoundException $e) {
			return Redirect::route('index')
			->with('error', 'PM:et som skulle ändras hittades inte.');
		}

		$creators = $authors = $settlers = $reviewers = $endReviewers = $reminders = array();

		foreach($pm->users as $user) {
			if ($user->pivot->assignment == 'creator')
				$creators[] = $user;
			elseif ($user->pivot->assignment == 'author')
				$authors[] = $user;
			elseif ($user->pivot->assignment == 'settler')
				$settlers[] = $user;
			elseif ($user->pivot->assignment == 'reviewer')
				$reviewers[] = $user;
			elseif ($user->pivot->assignment == 'end-reviewer')
				$endReviewers[] = $user;
			elseif ($user->pivot->assignment == 'reminder')
				$reminders[] = $user;
		}

		return View::make('user.admin.pm.assignment-edit')
		->with('pm', $pm)
		->with('creators', $creators)
		->with('authors', $authors)
		->with('settlers', $settlers)
		->with('reviewers', $reviewers)
		->with('endReviewers', $endReviewers)
		->with('reminders', $reminders);
	}

	public function postEditAssignments() {		
		try {
			$pm = PM::findOrFail(Input::get('id'));
		} catch (ModelNotFoundException $e) {
			return Redirect::route('admin-pm')
				->with('error', 'PM:et som skulle redigeras hittades inte.');
		}

		// TODO Samma som i postAssign
		$creators = $this->userify(Input::get('creator'));
		$authors = $this->userify(Input::get('authors'));
		$settlers = $this->userify(Input::get('settler'));
		$reviewers = $this->userify(Input::get('reviewers'));	
		$endReviewers = $this->userify(Input::get('end-reviewer'));
		$reminders = $this->userify(Input::get('reminder'));	

		$user = Auth::user();
		$pm->users()->detach();
		// TODO Fix! This is bad. Bättre att loopa igenom alla och ändra de som ska ändras istället. Då kan man köra soft deletes.

		foreach ($creators as $creator) {
			$creator->pms()->attach([$pm->id => ['assignment' => 'creator']]);
		}
		foreach ($authors as $author) {
			$author->pms()->attach([$pm->id => ['assignment' => 'author']]);
		}
		foreach ($settlers as $settler) {
			$settler->pms()->attach([$pm->id => ['assignment' => 'settler']]);
		}
		foreach ($reviewers as $reviewer) {
			$reviewer->pms()->attach([$pm->id => ['assignment' => 'reviewer']]);
		}
		foreach ($endReviewers as $endReviewer) {
			$endReviewer->pms()->attach([$pm->id => ['assignment' => 'end-reviewer']]);
		}
		foreach ($reminders as $reminder) {
			$reminder->pms()->attach([$pm->id => ['assignment' => 'reminder']]);
		}

		$pm->save();

		return Redirect::route('admin-pm')->with('success', 'Tilldelningen ändrades!');
	}

	public function getImport()
	{
		return View::make('user.import.import');
	}

	public function postImport()
	{
		$filename = date('YmdHis') . '.pdf';
		$path = 'PM/' . Input::get('file', 'none');

		Session::put('path', $path);
		Session::put('files', scandir($path));
		
		return Redirect::route('pm-import-verify');
	}

	public function getImportVerify() {
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
	public function getAdd()
	{
		return View::make('pm.add');
	}

	/**
	 * Displays the PM add tag page view.
	 * @param $token the PM token
	 */
	public function getAddTag($token)
	{
		return View::make('pm.add-tag')->with('token', $token);
	}

	/**
	 * Displays the PM verify page view.
	 * @param $token the PM token
	 */
	public function getVerify($token)
	{
		return View::make('pm.verify')->with('token', $token);
	}

	public function getList() {
		$userAssignments = Auth::user()->pms;

		$userPms = $assignments = array();
		foreach($userAssignments as $ua) {
			if (!array_key_exists($ua->id, $userPms)) {
				$userPms[$ua->id] = $ua;
			}
			$assignments[$ua->id][] = $ua->pivot->assignment;
		}

		return View::make('user.admin.pm.index')
		->with('pms', PM::orderBy('id', 'ASC')->paginate(15))
		->with('userAssignments', $assignments)
			->with('userPms', $userPms); // TODO Pagination
		}

	public function getAssign() {
		return View::make('user.admin.pm.assign');
	}

	/**
	 * Returns an array of users from the comma-separated $string of user ids
	 */
	private function userify($string) {
		$userIds = array_filter(explode(',', $string));
		$res = array();
		foreach($userIds as $userId) {
			if (($user = User::find(intval(trim($userId)))) != NULL)
				$res[] = $user;
		}
		return $res;
	}

	private function validateDate($date) {
	    $d = DateTime::createFromFormat('Y-m-d', $date);
	    return $d && $d->format('Y-m-d') == $date;
	}

	/**
	 * Valid are '(\d+y)?(\d+m)?'.
	 */
	private function getPeriod($period) {
	    if (preg_match('/^(\d+y)?(\d+m)?$/', $period, $matches)) {
	    	unset($matches[0]);
	    	print_r($matches);
	    }
	    
	    return implode('', $matches);
	}

	public function postAssign() {
		// TODO Validering & en eller flera personer på vad?
		$creators = $this->userify(Input::get('creator'));
		$authors = $this->userify(Input::get('authors'));
		$settlers = $this->userify(Input::get('settler'));
		$reviewers = $this->userify(Input::get('reviewers'));	
		$endReviewers = $this->userify(Input::get('end-reviewer'));
		$reminders = $this->userify(Input::get('reminder'));	

		$user = Auth::user();
		$pm = new PM;
		$pm->title = Input::get('title');
		$pm->created_by = $user->id;
		$pm->token = $this->generateToken($pm->title);
		if (Input::get('validityType', 'time') == 'date') {
			if (!$this->validateDate(Input::get('validityDate'))) {
				return Redirect::route('pm-assign')
					->with('error', 'Datumet du angav är felaktigt.')
					->withInput();
			}
			$pm->validity_date = Input::get('validityDate');
		} else {
			$period = $this->checkPeriod(Input::get('validityTime'));
			$pm->validity_period = $period;
		}
		$pm->save();

		foreach ($creators as $creator) {
			$creator->pms()->attach([$pm->id => ['assignment' => 'creator']]);
		}
		foreach ($authors as $author) {
			$author->pms()->attach([$pm->id => ['assignment' => 'author']]);
		}
		foreach ($settlers as $settler) {
			$settler->pms()->attach([$pm->id => ['assignment' => 'settler']]);
		}
		foreach ($reviewers as $reviewer) {
			$reviewer->pms()->attach([$pm->id => ['assignment' => 'reviewer']]);
		}
		foreach ($endReviewers as $endReviewer) {
			$endReviewer->pms()->attach([$pm->id => ['assignment' => 'end-reviewer']]);
		}
		foreach ($reminders as $reminder) {
			$reminder->pms()->attach([$pm->id => ['assignment' => 'reminder']]);
		}

		return Redirect::route('admin-pm')->with('success', 'PM:et lades till och personerna sparades!');
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

		$n = PM::where('token', '=', $clean)->count();
		if ($n > 0 || strlen($clean) == 0) {
			$clean = $this->generateToken($clean . '-' . rand(0, 9), $delimiter);
		}

		return $clean;
	}

	/**
	 * Displays a page to add role for admin.
	 * @param $id id of the role to delete
	 */
	public function getDelete($token) 
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
	public function postDelete() 
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

	/**
	 * Displays a page to add role for admin.
	 * @param $id id of the role to delete
	 */
	public function getSettle($token) {
		try {
			$pm = PM::where('token', '=', $token)->firstOrFail(); 
		} catch(ModelNotFoundException $e) {
			return Redirect::route('admin-pm')
			->with('error', 'PM:et som skulle fastställas hittades inte.');
		}

		return View::make('user.admin.pm.settle')
			->with('pm', $pm);
	}

	/**
	 * Handles a post request of delete role.
	 */
	public function postSettle() 
	{
		// TODO Fix whole function, should add to oldPMs and so
		// Only yes-button should make this continue
		if (!Input::get('yes'))
			return Redirect::route('admin-pm')->with('warning', 'PM:et fastställdes inte.');

		$id = Input::get('pm-id');

		try {
			$pm = PM::findOrFail($id);
		} catch(ModelNotFoundException $e) {
			return Redirect::route('admin-pm')
			->with('error', 'PM:et som skulle fastställas hittades inte.');
		}

		$pm->content = $pm->draft;
		$pm->draft = NULL;
		$pm->status = 'published';
		if ($pm->validity_date != NULL) {
			$pm->expiration_date = $pm->validity_date;
		} elseif ($pm->validity_period != NULL) {
			// TODO Verify validity date
			if (preg_match('/^(\d+y)?(\d+m)?$/', $pm->validity_period, $matches)) {
		    	unset($matches[0]);
		    	print_r($matches);
		    }

		    $date = new DateTime();
		    foreach($matches as $match) {
		    	if (substr($match, -1) == 'y') {
					$date->add(new DateInterval('P' . intval(substr($match, 0, -1)) . 'Y'));
		    	} else if (substr($match, -1) == 'm') {
					$date->add(new DateInterval('P' . intval(substr($match, 0, -1)) . 'M'));
		    	}
		    }
			$pm->expiration_date = $date->format('Y-m-d');
		}
		$pm->published = 1;
		$pm->save();

		// Reset all assignments comments
		$assignments = Assignment::where('pm', '=', $pm->id)->get();
		foreach ($assignments as $ass) {
			$ass->content = '';
			$ass->accepted = 0;
			$ass->save();
		}

		// Delete all comments
		$comments = Comment::where('pm', '=', $pm->id)->get();
		foreach ($comments as $comment) {
			$comment->delete();
		}

		return Redirect::route('admin-pm')
			->with('success', 'PM:et fastställdes.');
	}

	/**
	 * Displays a page to add role for admin.
	 * @param $id id of the role to delete
	 */
	public function getRevise($token) {
		try {
			$pm = PM::where('token', '=', $token)->firstOrFail(); 
		} catch(ModelNotFoundException $e) {
			return Redirect::route('admin-pm')
			->with('error', 'PM:et som skulle revideras hittades inte.');
		}

		return View::make('user.admin.pm.revise')
			->with('pm', $pm);
	}

	/**
	 * Handles a post request of delete role.
	 */
	public function postRevise() {
		// Only yes-button should make this continue
		if (!Input::get('yes'))
			return Redirect::route('admin-pm')->with('warning', 'PM:et revideras inte.');

		try {
			$pm = PM::findOrFail(Input::get('pm-id'));
		} catch(ModelNotFoundException $e) {
			return Redirect::route('admin-pm')
			->with('error', 'PM:et som skulle revideras hittades inte.');
		}

		$pm->draft = $pm->content;
		$pm->published = Input::get('published', 'no') == 'yes' ? 1 : 0;
		$pm->status = 'revision-assigned';
		$pm->save();

		return Redirect::route('admin-pm')
			->with('success', 'Revision av PM:et har inletts. PM:et visas fortfarande tills dess att revisionsdatumet passerats.');
	}

	public function postFilter() {
		$pms = PM::select('*');

		if (Input::has('filter')) {
			// Search in id and title to start with
			$pms->where('id', 'LIKE', '%' . Input::get('filter') . '%')
			->orWhere('title', 'LIKE', '%' . Input::get('filter') . '%');
		}

		$resp = $pms->orderBy('id', 'ASC')
		->take(100)
		->get();

		if ($resp->count() == 0 && Input::has('filter')) {
			// Search on content if there was no match in title or id
			$resp = PM::where('content', 'LIKE', '%' . Input::get('filter') . '%')
			->orderBy('id', 'ASC')
			->take(100)
			->get();
		}

		foreach($resp as $res) {
			$res->persons = $res->users;
		}

		return Response::json($resp);
	}

	private function getChildrenList($parent, $not = 0, $prefix = '___') {
		// TODO Do in mysql rather than many requests
		$children = Category::where('parent', '=', $parent)->get();
		$res = array();
		foreach ($children as $child) {
			if ($child->id != $not) {
				$res[$child->id] = $prefix . $child->name;
				$res += $this->getChildrenList($child->id, $not, '___' . $prefix);
			}
		}
		return $res;
	}
}
