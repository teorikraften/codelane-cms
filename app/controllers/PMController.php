<?php

include(app_path().'/classes/htmltodocx/h2d_htmlconverter.php');

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

		$user = User::find(Auth::user()->id);
		$fav = (!empty($user->favourites()->where('pm', '=', $pm->id)->first())) ? true : false;
		
		return View::make('pm.show')
		->with('pm', $pm)
		->with('assignments', $pm->users)
		->with('favourite' , $fav);
	}

	/**
	 * Display the user's favorite pms
	 */
	public function showFavourites() {
		$pms = Auth::user()->favourites()
			->where('verified', '=' , 1)
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
			$message = "Favorit borttagen: " . $pm->title;
		} else {
			$user->favourites()->attach($pm);
			$message = "Favorit tillagd: " . $pm->title;
		}

		if ($goto == 'fav') {
			$m = $message . 
				' <a href="' . 
					URL::route('get-favourite-edit', array('goto' => 'fav', 'token' => $token)) .
				'">Undo</a>';

			return Redirect::route('favourites-show')
				->with('success', $m);
				
		} else if ($goto == 'pm') {
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
	public function download($token) {
		try {
			$pm = PM::where('token', '=', $token)->firstOrFail();
		} catch(ModelNotFoundException $e) {
			return Redirect::back()->with('error', 'PM:et hittades inte.');
		}

		$assignments = $pm->users;

		$resp = "";
		foreach($assignments as $assignment) {
			if ($assignment->pivot->assignment == 'owner') {
				$resp .= $assignment->real_name . " ";
			}
		}

		$auth = "";
		foreach($assignments as $assignment) {
			if ($assignment->pivot->assignment == 'author') {
				$auth .= $assignment->real_name . " ";
			}
		}

		$rev = "";
		foreach($assignments as $assignment) {
			if ($assignment->pivot->assignment == 'reviewer') {
				$rev .= $assignment->real_name . " ";
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
	public function showEditPMPage($token) {
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
		$pm->categories()->detach();
		$pm->categories()->attach([Input::get('category') => ['added_by' => Auth::user()->id]]);
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

		public function showAssignPMPage() {
			return View::make('user.admin.pm.assign');
		}

		public function assignPM() {
		// TODO Validering
		// TODO kolla att användarna verkligen finns
		// TODO Try-catch på findorfail
			$creator = intval(Input::get('creator'));
			$authors = explode(',', Input::get('authors'));
			$reviewers = explode(',', Input::get('reviewers'));	
			$endReviewer = Input::get('end-reviewer');		
			$reminder = Input::get('reminder');	

			$user = Auth::user();
			$pm = new PM;
			$pm->title = Input::get('title');
			$pm->created_by = $user->id;
			$pm->token = $this->generateToken($pm->title);
			$pm->save();

			foreach ($authors as $author) {
				User::findOrFail($author)->pms()->attach([$pm->id => ['assignment' => 'author']]);
			}
			foreach ($reviewers as $reviewer) {
				User::findOrFail($reviewer)->pms()->attach([$pm->id => ['assignment' => 'reviewer']]);
			}
			User::findOrFail($creator)->pms()->attach([$pm->id => ['assignment' => 'creator']]);
			User::findOrFail($endReviewer)->pms()->attach([$pm->id => ['assignment' => 'end-reviewer']]);
			User::findOrFail($reminder)->pms()->attach([$pm->id => ['assignment' => 'reminder']]);
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
