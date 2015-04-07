<?php

use Illuminate\Database\Eloquent\ModelNotFoundException;

class RoleController extends BaseController {

	/**
	 * Displays a list of the roles for admin.	 
	 */
	public function showRolesListPage() {
		return View::make('user.admin.roles.index')
			->with('roles', Role::take(100)->get()); // TODO Not only 100, pagination, fix roles as well
	}

	/**
	 * Displays a page to add role for admin.
	 */
	public function showAddRolePage() {
		return View::make('user.admin.roles.new');
	}

	/**
	 * Handles a post request of add role.
	 */
	public function addRole() {
		$name = Input::get('name', '');
		if (!(strlen($name) > 0))
			return Redirect::back()
				->withInput()
				->with('error', 'Du måste ange rollens namn.');

		if (Role::where('name', '=', $name)->count() > 0)
			return Redirect::route('admin-roles')
				->withInput()
				->with('error', 'Rollen fanns redan och lades därför inte till.');
		
		$role = new Role;
		$role->name = $name;
		$role->save();
		return Redirect::route('admin-roles')->with('success', 'Rollen skapades.');
	}

	/**
	 * Displays a page to add role for admin.
	 * @param $id id of the role to delete
	 */
	public function showDeleteRolePage($id) 
	{
		try {
			$role = Role::findOrFail($id); 
		} catch(ModelNotFoundException $e) {
		    return Redirect::route('admin-roles')
		    	->with('error', 'Rollen som skulle tas bort hittades inte.');
		}

		return View::make('user.admin.roles.delete')->with('role', $role);
	}

	/**
	 * Handles a post request of delete role.
	 */
	public function deleteRole() 
	{
		// Only yes-button should make this continue
		if (!Input::get('yes'))
			return Redirect::route('admin-roles')->with('warning', 'Rollen togs inte bort.');

		$id = Input::get('role-id');

		try {
			$role = Role::findOrFail($id)->delete(); 
		} catch(ModelNotFoundException $e) {
		    return Redirect::route('admin-roles')
		    	->with('error', 'Rollen som skulle tas bort hittades inte.');
		}

		return Redirect::route('admin-roles')
			->with('success', 'Rollen togs bort.');
	}

	/**
	 * Displays a page to edit role for admin.
	 * @param $id id of the role to edit
	 */
	public function showEditRolePage($id) 
	{
		try {
			$role = Role::findOrFail($id); 
		} catch(ModelNotFoundException $e) {
		    return Redirect::route('admin-roles')
		    	->with('error', 'Rollen som skulle ändras hittades inte.');
		}

		return View::make('user.admin.roles.edit')
			->with('role', $role);
	}

	/**
	 * Handles a post request of edit role.
	 */
	public function editRole() 
	{
		$id = Input::get('id');
		try {
			$role = Role::findOrFail($id);
		} catch(ModelNotFoundException $e) {
		    return Redirect::back()
		    	->withInput()
		    	->with('error', 'Rollen som skulle ändras hittades inte.');
		}

		if (!(strlen(Input::get('name', '')) > 0))
			return Redirect::back()
				->withInput()
				->with('error', 'Du måste ange rollens namn.');

		$role->name = Input::get('name');
		$role->save();

		return Redirect::route('admin-roles')->with('success', 'Rollen uppdaterades.');
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
	
	/**
     * Generates a valid token.
	 */
	private function generateToken($name, $delimiter = '-') {
		// TODO Move
		setlocale(LC_ALL, 'en_US.UTF8');
		$clean = iconv('UTF-8', 'ASCII//TRANSLIT', $name);
		$clean = preg_replace("/[^a-zA-Z0-9\/_|+ -]/", '', $clean);
		$clean = strtolower(trim($clean, '-'));
		$clean = preg_replace("/[\/_|+ -]+/", $delimiter, $clean);

		$n = Role::where('token', '=', $clean)->count();
		if ($n > 0 || strlen($clean) == 0) {
			$clean = $this->generateToken($clean . '-' . rand(0, 9), $delimiter);
		}

		return $clean;
	}

	/**
	 * Returns list of roles matching the query in json.
	 */
	public function rolesAutocomplete() {
		$searchQuery = Input::get('q');
		$tags = Role::where('name', 'LIKE', '%' . $searchQuery . '%')->take(7)->get();
		$result = array();
		foreach($tags as $tag) {
			$obj = new stdClass();
			$obj->id = $tag->id;
			$obj->name = $tag->name;
			$result[] = $obj;
		}
		return json_encode($result);
	}
}