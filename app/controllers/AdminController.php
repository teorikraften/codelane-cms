<?php

class AdminController extends BaseController {
	/**
	 * Displays a list of all registered persons.
	 * @param $userId the user id of the admin
	 */
	public function showPersonListPage()
	{
		return View::make('user.admin.persons');
	}

	/**
	 * Displays a list of PM for admin.
	 * @param $userId the user id of the admin
	 */ 
	public function showPMListPage() 
	{
		return View::make('user.admin.pms');
	}

	/**
	 * Displays the roles for admin.	 
	 * @param $userId the user id of the admin
	 */
	public function showRolesListPage() 
	{
		return View::make('user.admin.roles');
	}

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
		$token = Input::get('tag-token');
		Tag::where('token', '=', $token)->delete();
		return Redirect::route('admin-tags')->with('success', 'Taggen skapades.'); // TODO Show
	}
}
