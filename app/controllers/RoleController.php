<?php

class RoleController extends BaseController {

	/**
	 * Displays the roles for admin.	 
	 * @param $userId the user id of the admin
	 */
	public function showRolesListPage() 
	{
		return View::make('user.admin.roles')->with('roles', Role::take(100)->get()); // TODO Not only 100, pagination, fix roles as well
	}

	/**
	 * Displays a page to add role for admin.
	 */
	public function showAddRolePage() 
	{
		return View::make('user.admin.roles-new');
	}

	/**
	 * Handles a post request of add role.
	 */
	public function addRole() 
	{
		// TODO Better
		$name = Input::get('name');
		$role = new Role;
		$role->name = $name;
		$role->save();
		return Redirect::route('admin-roles')->with('success', 'Rollen skapades.'); // TODO Show
	}

	/**
	 * Displays a page to add role for admin.
	 */
	public function showDeleteRolePage($id) 
	{
		$role = Role::findOrFail($id); // TODO Make sure no fail...
		return View::make('user.admin.roles-delete')->with('role', $role);
	}

	/**
	 * Handles a post request of delete role.
	 */
	public function deleteRole() 
	{
		// TODO Better
		if (!Input::get('yes'))
			return Redirect::route('admin-roles')->with('warning', 'Rollen togs inte bort.'); // TODO show


		$id = Input::get('role-id');
		Role::findOrFail($id)->delete();
		return Redirect::route('admin-roles')->with('success', 'Rollen togs bort.'); // TODO Show
	}

	/**
	 * Displays a page to edit role for admin.
	 */
	public function showEditRolePage($id) 
	{
		$role = Role::findOrFail($id); // TODO Make sure no fail...
		return View::make('user.admin.roles-edit')->with('role', $role)->with('success', 'Rollen togs bort.');
	}

	/**
	 * Handles a post request of edit role.
	 */
	public function editRole() 
	{
		// TODO Better
		$id = Input::get('id');
		$role = Role::findOrFail($id);
		$role->name = Input::get('name');
		$role->save();
		return Redirect::route('admin-roles')->with('success', 'Rollen uppdaterades.'); // TODO Show
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

		$n = Role::where('token', '=', $clean)->count();
		if ($n > 0) {
			$clean = $this->generateToken($clean . '-' . rand(0, 9), $delimiter);
		}

		return $clean;
	}

	
	/**
	 * Displays a list of all the PM for role.
	 * @param $role the role
	 * @param $page the page, 1 by deafult
	 */
	public function showRolePMListPage($role, $page = 1)
	{
		return View::make('role.show')->with('role', $role)->with('page', $page);
	}
}