<?php

use Illuminate\Database\Eloquent\ModelNotFoundException;

class UserAdminController extends BaseController {
	
	/**
	 * Displays a list of all the users for admin.
	 */
	public function showUsersListPage() {
		return View::make('user.admin.users.index')
			->with('users', 
				User::orderBy('privileges', 'DESC')
				->orderBy('real_name', 'ASC')
				->take(100)
				->get()
			); 
			// TODO Not only 100, pagination, fix users as well
	}

	/**
	 * Displays the dialog page where admin can verify a user.	 
	 * @param $id the id of the user to verify
	 */
	public function showVerifyUserPage($id) {
		try {
		    $user = User::findOrFail($id);
		} catch(ModelNotFoundException $e) {
		    return View::make('user.admin.users.index')
		    	->with('error', 'Ett fel uppstod. Kontakta systemadministratören om det kvarstår, med felkod 1001.');
		}

		return View::make('user.admin.users-verify')
			->with('user', $user);
	}

	/**
	 * Handles a post request of verify user. Called when admin has verified a user.
	 */
	public function verifyUser() {
		// If the admin did not click 'yes', we should not verify
		if (!Input::get('yes'))
			return Redirect::route('admin-users')
				->with('warning', 'Användaren togs inte bort.');

		// Now find user and edit the database table column, or show error if couldn't find.
		try {
			$user = User::findOrFail(Input::get('user-id'));
		} catch(ModelNotFoundException $e) {
		    return View::make('user.admin.users.index')
		    	->with('error', 'Ett fel uppstod. Kontakta systemadministratören om det kvarstår, med felkod 1002.');
		}
		
		$user->privileges = 'verified';
		$user->save();

		return Redirect::route('admin-users')
			->with('success', 'Användaren uppdaterades.');
	}

	/**
	 * Displays a page to add a user for admin.
	 */
	public function showAddUserPage() {
		return View::make('user.admin.users.new');
	}

	/**
	 * Generates a random string with length size.
	 * @param length (8 if not given) - the size of the string
	 * @return the generated string, that passes the regex [0-9a-zA-Z]{$length}
	 */
	private function generateRandomString($length = 8) {
	    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
	    $charactersLength = strlen($characters);
	    $randomString = '';
	    for ($i = 0; $i < $length; $i++) {
	        $randomString .= $characters[rand(0, $charactersLength - 1)];
	    }
	    return $randomString;
	}

	/**
	 * Handles a post request of adding a user.
	 */
	public function addUser() {
		$real_name = Input::get('real_name');
		$email = Input::get('email');
		$privileges = Input::get('privileges');
		$password = Hash::make($this->generateRandomString());

		// Check if input is OK
		$validator = Validator::make(
		[
			'name' => $real_name,
			'email' => $email,
			'privileges' => $privileges,
		],
		[
			'name' => 'required',
			'email' => 'required|email|unique:users',
			'privileges' => 'required|in:admin,pm-admin,verified,unverified'
		],
		[
    		'name.required' => 'Fyll i ett namn',
    		'email.required' => 'Fyll i en e-postadress',
    		'email.email' => 'Fyll i en korrekt e-postadress',
    		'email.unique' => 'E-postadressen används redan i systemet',
    		'privileges.required' => 'Du måste välja en behörighetsnivå',
    		'privileges.in' => 'Den behörighetsnivå du har valt finns inte, var god välj en annan',
		]);

		// Now, let's check the result of the check. If bad, redirect to relevant page with error message
		if ($validator->fails()) {
			$messages = $validator->messages();
			return Redirect::route('admin-users-new')
				->with('error', $messages->all())
				->withInput();
		} 

		// Create a user, set all attributes, and save
		$user = new User;
		$user->real_name = $real_name;
		$user->email = $email;
		$user->privileges = $privileges;
		$user->password = $password;
		$user->save();

		// Email the password to the user
		Mail::send('emails.welcome', array('user' => $user), function($message) {
		    $message
		    	->to($user->email, $user->real_name)
		    	->subject('Välkommen - välj lösenord!');
		});

		return Redirect::route('admin-users')
			->with('success', 'Användaren skapades och ett mejl har skickats.');
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
		$user->privileges = Input::get('privileges');
		// TODO Send mail to user
		$user->save();
		return Redirect::route('admin-users')->with('success', 'Användaren uppdaterades.'); // TODO Show
	}
}