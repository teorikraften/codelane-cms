<?php

use Illuminate\Database\Eloquent\ModelNotFoundException;

class UserController extends BaseController {

	/**
	 * Displays the profile page for the user.
	 *
	 * @return Response
	 */
	public function getProfile() {
		return View::make('user.profile.profile');
	}

	/**
	 * Displays the edit profile page view for the user.
	 *
	 * @return Response
	 */ 
	public function getEditProfile() {
		return View::make('user.profile.edit-profile')
			->with('userRoles', Auth::user()->roles)
			->with('error', Session::get('error'))
			->with('success', Session::get('success'));
	}

	/**
	 * Changes the password and redirects to profile edit page.
	 *
	 * @return Response
	 */ 
	public function postChangePassword() {
		$old_password = Input::get('old_password');
		$new_password = Input::get('new_password');
		$new_password_again = Input::get('new_password_again'); // Look in postCreatePassword function

		// TODO Move to class
		$validator = Validator::make(
		[
			'new_password' => $new_password,
			'new_password_again' => $new_password_again,
		],
		[
			'new_password' => 'required|min:7',
			'new_password_again' => 'required',
		],
		[
    		'new_password.required' => 'Fyll i ditt nya lösenord',
    		'new_password_again.required' => 'Du måste skriva ditt lösenord två gånger så att vi vet att du skrev rätt',
    		'new_password.min' => 'Det önskade lösenordet är för kort, lösenordet måste vara större än eller lika med 7 tecken långt.',
		]);

		$error = array();
		if ($new_password != $new_password_again)
			$error[] = 'Lösenorden stämmer inte överens';
		if (!Hash::check($old_password, Auth::user()->password))
			$error[] = 'Du skrev fel gammalt lösenord';

		if ($validator->fails() || count($error) != 0) {
			$messages = $validator->messages();
			// If not succes set error and ask user to change input
			return Redirect::route('user-edit')
				->with('errorType', 'password')
				->with('error', array_merge($messages->all(), $error))
				->withInput();
		} 

		// Edit user in database 
		$user = User::find(Auth::user()->id);
		$user->password = Hash::make($new_password);
		$user->save();

		return Redirect::route('user-edit')
			->with('success', 'Lösenordet ändrades!');
	}

	/**
	 * Changes the information of the user and redirects to profile edit page.
	 *
	 * @return Response
	 */ 
	public function postEditProfile() {
		$name = Input::get('name');
		$email = Input::get('email');
		$roles = Input::get('roles_'); // TODO Do nicer
		$roles = explode(",", $roles);

		// TODO Move to class
		$validator = Validator::make(
		[
			'name' => $name,
			'email' => $email,
		],
		[
			'name' => 'required',
			'email' => 'required|email|unique:users,email,'.Auth::user()->id,
		],
		[
    		'name.required' => 'Fyll i ditt namn',
    		'email.required' => 'Fyll i din e-postadress',
    		'email.email' => 'Fyll i en korrekt e-postadress',
    		'email.unique' => 'E-postadressen används redan',
		]);

		$error = array();
		if ($validator->fails()) {
			$messages = $validator->messages();
			// If not succes set error and ask user to change input
			return Redirect::route('user-edit')
				->with('errorType', 'profile')
				->with('error', $messages->all())
				->withInput();
		} 

		// Edit user in database 
		$user = User::find(Auth::user()->id);
		$user->name = $name;
		$user->email = $email;
		$user->save();
		$user->roles()->detach();
		
		foreach ($roles as $role) {
			// TODO WHAT IF FAIL???
			if (intval($role) > 0)
				Role::findOrFail($role)->users()->attach($user->id);
		}

		return Redirect::route('user-edit')
			->with('success', 'Informationen uppdaterades!');
	}

	/**
	 * Gets all persons matching Input::get('q') on email, name or other.
	 *
	 * @return Response as json
	 */
	public function getPersonsAutocomplete() {
		$users = User::where('name', 'LIKE', '%' . Input::get('q') . '%')
				->orWhere('email', 'LIKE', '%' . Input::get('q') . '%')
				->where('deleted_at', '=', 'NULL')
				->take(10)
				->get();

		$userNames = array();
		foreach ($users as $user) {
			$var = new stdClass();
			$var->id = $user->id;
			$var->name = $user->name . ' (' . $user->email . ')';
			$userNames[] = $var;
		}

		return json_encode($userNames);
	}

	/**
	 * Shows the create new password page.
	 *
	 * @return Response
	 */
	public function getCreatePassword($token) {
		return View::make('user.create-password')
			->with('id', $token);
	}

	/**
	 * Handles post request of create password.
	 *
	 * @return Response
	 */
	public function postCreatePassword() {
		$credentials = Input::only(
			'email', 'password', 'password_confirmation', 'id'
		);

		try {
		    $user = User::findOrFail($credentials['id']);
		} catch(ModelNotFoundException $e) {
		    return Redirect::back()
		    	->with('error', 'Ett fel uppstod. Vi vet inte vilken användare du vill skapa ett lösenord för.');
		}

		$error = array();
		if ($credentials['email'] != $user->email) 
			$error[] = 'E-postadressen är felaktig';
		if ($credentials['password'] != $credentials['password_confirmation']) 
			$error[] = 'Lösenorden stämmer inte överens';
		if (strlen($credentials['password']) < 7) 
			$error[] = 'Lösenordet måste vara minst 7 tecken långt';

		if (count($error) != 0) {
			// If not succes set error and ask user to change input
			return Redirect::back()
				->with('error', $error)
				->withInput();
		} 
		
		$user->password = Hash::make($credentials['password']);
		$user->save();

		return Redirect::route('index')->with('success', 'Ditt lösenord har skapats. Testa att logga in!');
	}

	/**
	 * Displays the todo view.
	 *
	 * @return Response as json
	 */
	public function getTodo() {
		return View::make('user.profile.todo')
			->with('events', Auth::user()->allEvents());
	}
}
