<?php

class TagController extends BaseController {

	/**
	 * Displays the tags for admin.	 
	 * @param $userId the user id of the admin
	 */
	public function showTagsListPage() 
	{
		return View::make('user.admin.tags')->with('tags', Tag::take(100)->get());
	}

	/**
	 * Displays a page to add tag for admin.
	 */
	public function showAddTagPage() 
	{
		return View::make('user.admin.tags-new');
	}

	/**
	 * Handles a post request of add tag.
	 */
	public function addTag() 
	{
		// TODO Better
		$name = Input::get('name');
		$tag = new Tag;
		$tag->name = $name;
		$tag->token = $this->generateToken($name);
		$tag->save();
		return Redirect::route('admin-tags')->with('success', 'Taggen skapades.'); // TODO Show
	}

	/**
	 * Displays a page to add tag for admin.
	 */
	public function showDeleteTagPage($token) 
	{
		$tag = Tag::where('token', '=', $token)->firstOrFail(); // TODO Make sure no fail...
		return View::make('user.admin.tags-delete')->with('tag', $tag);
	}

	/**
	 * Handles a post request of delete tag.
	 */
	public function deleteTag() 
	{
		// TODO Better
		if (!Input::get('yes'))
			return Redirect::route('admin-tags')->with('warning', 'Taggen togs inte bort.'); // TODO show

		$token = Input::get('tag-token');
		Tag::where('token', '=', $token)->delete();
		return Redirect::route('admin-tags')->with('success', 'Taggen togs bort.'); // TODO Show
	}

	/**
	 * Displays a page to edit tag for admin.
	 */
	public function showEditTagPage($token) 
	{
		$tag = Tag::where('token', '=', $token)->firstOrFail(); // TODO Make sure no fail...
		return View::make('user.admin.tags-edit')->with('tag', $tag)->with('success', 'Taggen togs bort.');
	}

	/**
	 * Handles a post request of edit tag.
	 */
	public function editTag() 
	{
		// TODO Better
		$token = Input::get('token');
		$tag = Tag::where('token', '=', $token)->firstOrFail();
		$tag->name = Input::get('name');
		$tag->save();
		return Redirect::route('admin-tags')->with('success', 'Taggen uppdaterades.'); // TODO Show
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
	 * Displays a list of all the PM for tag.
	 * @param $tag the tag
	 * @param $page the page, 1 by deafult
	 */
	public function showTagPMListPage($tag, $page = 1)
	{
		return View::make('tag.show')->with('tag', $tag)->with('page', $page);
	}
}