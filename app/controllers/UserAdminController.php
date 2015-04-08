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
				->paginate(20)
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
		    return Redirect::route('admin-users')
		    	->with('error', 'Användaren som skulle verifieras hittades inte.');
		}

		return View::make('user.admin.users.verify')
			->with('user', $user);
	}

	/**
	 * Handles a post request of verify user. Called when admin has verified a user.
	 */
	public function verifyUser() {
		// If the admin did not click 'yes', we should not verify
		if (!Input::get('yes'))
			return Redirect::route('admin-users')
				->with('warning', 'Användaren verifierades inte.');

		// Now find user and edit the database table column, or show error if couldn't find.
		try {
			$user = User::findOrFail(Input::get('user-id'));
		} catch(ModelNotFoundException $e) {
		    return Redirect::route('admin-users')
		    	->with('error', 'Användaren som skulle verifieras hittades inte.');
		}
		
		$user->privileges = 'verified';
		$user->save();

		// Send mail to inform user that the account has been created and waiting for verification
		Mail::send('emails.welcome-verified', array('name' => $user->real_name, 'email' => $user->email), function($message) use($user) {
		    $message
		    	->to($user->email, $user->real_name)
		    	->from('no-reply@ds.se', 'Danderyds Sjukhus')
		    	->subject('Du är nu godkänd!');
		});

		return Redirect::route('admin-users')
			->with('success', 'Användaren verifierades.');
	}

	/**
	 * Displays a page to add a user for admin.
	 */
	public function showAddUserPage() {
		return View::make('user.admin.users.new');
	}

	/**
	 * Handles a post request of adding a user.
	 */
	public function addUser() {
		$real_name = Input::get('real_name');
		$email = Input::get('email');
		$privileges = Input::get('privileges');
		$password = "NULL";

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
			return Redirect::back()
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
		Mail::send('emails.welcome', array('user' => $user), function($message) use($real_name, $email) {
		    $message
		    	->to($email, $real_name)
		    	->from('no-reply@ds.se', 'Danderyds Sjukhus')
		    	->subject('Välkommen - välj lösenord!');
		});

		return Redirect::route('admin-users')
			->with('success', 'Användaren skapades och ett mejl har skickats med en länk till att skapa lösenord.');
	}

	/**
	 * Displays a page to add user for admin.
	 */
	public function showDeleteUserPage($id) 
	{
		try {
			$user = User::findOrFail($id);
		} catch(ModelNotFoundException $e) {
		    return Redirect::route('admin-users')
		    	->with('error', 'Användaren som skulle tas bort hittades inte.');
		}

		return View::make('user.admin.users.delete')->with('user', $user);
	}

	/**
	 * Handles a post request of delete user.
	 */
	public function deleteUser() 
	{
		// Only 'yes' should make us continue
		if (!Input::get('yes'))
			return Redirect::route('admin-users')
				->with('warning', 'Användaren togs inte bort.');

		$id = Input::get('user-id');
		
		try {
			$user = User::findOrFail($id)->delete();
		} catch(ModelNotFoundException $e) {
		    return Redirect::route('admin-users')
		    	->with('error', 'Användaren som skulle tas bort hittades inte.');
		}

		return Redirect::route('admin-users')
			->with('success', 'Användaren togs bort.');
	}

	/**
	 * Displays a page to edit user for admin.
	 */
	public function showEditUserPage($id) 
	{
		try {
			$user = User::findOrFail($id);
		} catch(ModelNotFoundException $e) {
		    return Redirect::route('admin-users')
		    	->with('error', 'Användaren som skulle ändras hittades inte.');
		}

		return View::make('user.admin.users.edit')
			->with('user', $user);
	}

	/**
	 * Handles a post request of edit user.
	 */
	public function editUser() 
	{
		// TODO Better
		// TODO Is this really going to work this way? Waiting to implement it until that time
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