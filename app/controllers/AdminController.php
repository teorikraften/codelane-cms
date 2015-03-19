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
}
