<?php

use Illuminate\Database\Eloquent\ModelNotFoundException;

class TagController extends BaseController {

	/**
	 * Displays the tags for admin.	 
	 */
	public function getList() {
		return View::make('user.admin.tags.index')
			->with('tags', Tag::orderBy('name', 'ASC')->paginate(20));
	}

	public function getShow($token) {
		try {
			$tag = Tag::where('token', '=', $token)->firstOrFail();
		} catch(ModelNotFoundException $e) {
			return Redirect::route('admin-tags')->with('error', 'Kunde inte hitta taggen.');
		}
		$pms = $tag->pm;

		return View::make('user.admin.tags.show')
			->with('pms', $pms)
			->with('tag', $tag);
	}

	/**
	 * Displays a page to add tag for admin.
	 */
	public function getAdd() {
		return View::make('user.admin.tags.new');
	}

	/**
	 * Handles a post request of add tag.
	 */
	public function postAdd() {
		$name = Input::get('name', '');
		if (!(strlen($name) > 0))
			return Redirect::back()
				->withInput()
				->with('error', 'Du måste ange taggens namn.');

		if (Tag::where('name', '=', $name)->count() > 0)
			return Redirect::route('admin-tags')
				->withInput()
				->with('error', 'Taggen fanns redan och lades därför inte till.');

		$tag = new Tag;
		$tag->name = $name;
		$tag->token = $this->generateToken($name); // Move generateToken to separate class
		$tag->save();

		return Redirect::route('admin-tags')->with('success', 'Taggen skapades.'); // TODO Show
	}

	/**
	 * Displays a page to add tag for admin.
	 */
	public function getDelete($token) 
	{
		try {
			$tag = Tag::where('token', '=', $token)->firstOrFail();
		} catch(ModelNotFoundException $e) {
		    return Redirect::route('admin-tags')
		    	->with('error', 'Taggen som skulle tas bort hittades inte.');
		}
		
		return View::make('user.admin.tags.delete')->with('tag', $tag);
	}

	/**
	 * Handles a post request of delete tag.
	 */
	public function postDelete() 
	{
		// Check which button was pressed, only 'yes' should continue
		if (!Input::get('yes'))
			return Redirect::route('admin-tags')->with('warning', 'Taggen togs inte bort.');

		$token = Input::get('tag-token');
		Tag::where('token', '=', $token)->delete();
		return Redirect::route('admin-tags')->with('success', 'Taggen togs bort.');
	}

	/**
	 * Displays a page to edit tag for admin.
	 */
	public function getEdit($token) 
	{
		try {
			$tag = Tag::where('token', '=', $token)->firstOrFail();
		} catch(ModelNotFoundException $e) {
		    return Redirect::route('admin-tags')
		    	->with('error', 'Taggen som skulle ändras hittades inte.');
		}
		return View::make('user.admin.tags.edit')->with('tag', $tag);
	}

	/**
	 * Handles a post request of edit tag.
	 */
	public function postEdit() 
	{
		$token = Input::get('token');
		try {
			$tag = Tag::where('token', '=', $token)->firstOrFail();
		} catch(ModelNotFoundException $e) {
		    return Redirect::back()
		    	->withInput()
		    	->with('error', 'Taggen som skulle ändras hittades inte.');
		}

		if (!(strlen(Input::get('name', '')) > 0))
			return Redirect::back()
				->withInput()
				->with('error', 'Du måste ange taggens namn.');

		$tag->name = Input::get('name', '');
		$tag->token = $this->generateToken(Input::get('name', '')); // TODO Move function to own class
		$tag->save();

		return Redirect::route('admin-tags')->with('success', 'Taggen uppdaterades.');
	}

	/**
	 * Displays a list of all the PM for tag.
	 * @param $tag the tag
	 * @param $page the page, 1 by deafult
	 */
	public function getPMList($tag, $page = 1)
	{
		return View::make('tag.show')
			->with('tag', $tag)
			->with('page', $page);
	}

	/**
     * Generates a valid token.
     * @param name the name of the original name
     * @param delimiter the character to replace bad chars with, default is '-'
	 */
	private function generateToken($name, $delimiter = '-') {
		// TODO Move
		setlocale(LC_ALL, 'en_US.UTF8');
		$clean = iconv('UTF-8', 'ASCII//TRANSLIT', $name);
		$clean = preg_replace("/[^a-zA-Z0-9\/_|+ -]/", '', $clean);
		$clean = strtolower(trim($clean, '-'));
		$clean = preg_replace("/[\/_|+ -]+/", $delimiter, $clean);

		$n = Tag::where('token', '=', $clean)->count();
		if ($n > 0 || strlen($clean) == 0) {
			$clean = $this->generateToken($clean . '-' . rand(0, 9), $delimiter);
		}

		return $clean;
	}

	/**
	 * Returns list of tags matching the query in json.
	 */
	public function getTagsAutocomplete() {
		$searchQuery = Input::get('q');
		$tags = Tag::where('name', 'LIKE', '%' . $searchQuery . '%')->take(7)->get();
		$result = array();
		foreach($tags as $tag) {
			$obj = new stdClass();
			$obj->id = $tag->id;
			$obj->name = $tag->name;
			$result[] = $obj;
		}
		return json_encode($result);
	}

	public function postFilter() {
		$users = Tag::select('*');

		if (Input::has('filter')) {
			// Search in id and title to start with
			$users->where('name', 'LIKE', '%' . Input::get('filter') . '%');
		}
			
		$resp = $users->orderBy('name', 'ASC')->take(100)->get();

		foreach($resp as $res) {
			$res->num = count($res->pm);
		}

		return Response::json($resp);
	}
}