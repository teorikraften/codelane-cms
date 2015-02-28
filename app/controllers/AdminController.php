<?php

class AdminController extends BaseController {
	/**
	 * Displays a list of all registered persons.
	 * @param $userId the user id of the admin
	 */
	public function showPersonListPage($userId)
	{
		return View::make('user.admin.persons')->with('user_id', $userId);
	}

	/**
	 * Displays a list of PM for admin.
	 * @param $userId the user id of the admin
	 */ 
	public function showPMListPage($userId) 
	{
		return View::make('user.admin.pms')->with('user_id', $userId);
	}

	/**
	 * Displays the roles for admin.	 
	 * @param $userId the user id of the admin
	 */
	public function showRolesListPage($userId) 
	{
		return View::make('user.admin.roles')->with('user_id', $userId);
	}

	/**
	 * Displays the tags for admin.	 
	 * @param $userId the user id of the admin
	 */
	public function showTagsListPage($userId) 
	{
		return View::make('user.admin.tags')->with('user_id', $userId);
	}
}
