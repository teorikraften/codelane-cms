<?php

class UserAdminController extends BaseController {

	/**
	 * Displays the users for admin.	 
	 * @param $userId the user id of the admin
	 */
	public function showUsersListPage() 
	{
		return View::make('user.admin.users')->with('users', User::orderBy('privileges', 'DESC')->orderBy('real_name', 'ASC')->take(100)->get()); // TODO Not only 100, pagination, fix users as well
	}

	/**
	 * Displays the users for admin.	 
	 * @param $userId the user id of the admin
	 */
	public function showVerifyUserPage($id) 
	{
		$user = User::findOrFail($id); // TODO Fix
		return View::make('user.admin.users-verify')->with('user', $user);
	}

	/**
	 * Handles a post request of verify user.
	 */
	public function verifyUser() 
	{
		// TODO Better
		$id = Input::get('user-id');
		$user = User::findOrFail($id); // TODO Fix
		$user->privileges = 'verified';
		$user->save();
		return Redirect::route('admin-users')->with('success', 'Användaren uppdaterades.'); // TODO Show
	}

	/**
	 * Displays a page to add user for admin.
	 */
	public function showAddUserPage() 
	{
		return View::make('user.admin.users-new');
	}

	/**
	 * Handles a post request of add user.
	 */
	public function addUser() 
	{
		// TODO Better
		$name = Input::get('name');
		$user = new User;
		$user->name = $name;
		$user->save();
		return Redirect::route('admin-users')->with('success', 'Användaren skapades.'); // TODO Show
	}

	/**
	 * Displays a page to add user for admin.
	 */
	public function showDeleteUserPage($id) 
	{
		$user = User::findOrFail($id); // TODO Make sure no fail...
		return View::make('user.admin.users-delete')->with('user', $user);
	}

	/**
	 * Handles a post request of delete user.
	 */
	public function deleteUser() 
	{
		// TODO Better
		if (!Input::get('yes'))
			return Redirect::route('admin-users')->with('warning', 'Användaren togs inte bort.'); // TODO show

		$id = Input::get('user-id');
		User::findOrFail($id)->delete();
		return Redirect::route('admin-users')->with('success', 'Användaren togs bort.'); // TODO Show
	}

	/**
	 * Displays a page to edit user for admin.
	 */
	public function showEditUserPage($id) 
	{
		$user = User::findOrFail($id); // TODO Make sure no fail...
		return View::make('user.admin.users-edit')->with('user', $user)->with('success', 'Användaren ändrades.');
	}

	/**
	 * Handles a post request of edit user.
	 */
	public function editUser() 
	{
		// TODO Better
		$id = Input::get('id');
		$user = User::findOrFail($id);
		$user->real_name = Input::get('real_name');
		$user->email = Input::get('email');
		// TODO Send mail to user
		$user->save();
		return Redirect::route('admin-users')->with('success', 'Användaren uppdaterades.'); // TODO Show
	}
}