<?php

class UserController extends BaseController {
	/**
	 * Displays the profile page for the user.
	 * @param $userId the user id for the user to be displayed
	 */
	public function showProfilePage()
	{
		return View::make('user.profile');
	}

	/**
	 * Displays the edit profile page view for the user.
	 * @param $userId the user id for the user to be displayed
	 */ 
	public function showEditProfilePage() 
	{
		return View::make('user.edit-profile')
			->with('error', Session::get('error'))
			->with('success', Session::get('success'));
	}

	/**
	 * Changes the password and redirects to profile edit page.
	 */ 
	public function changePassword() 
	{
		// TODO Göra "upprepa lösenord"
		$old_password = Input::get('old_password');
		$new_password = Input::get('new_password');
		$new_password_again = Input::get('new_password_again');

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

		if ($validator->fails() || count($error) != 0)
		{
			$messages = $validator->messages();
			// If not succes set error and ask user to change input
			return Redirect::route('user-edit')
				->with('errorType', 'profile')
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
	 * @param $userId the user id for the user to be displayed
	 */ 
	public function editProfile() 
	{
		// TODO Göra "upprepa lösenord"
		$name = Input::get('real_name');
		$email = Input::get('email');

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
		if ($validator->fails())
		{
			$messages = $validator->messages();
			// If not succes set error and ask user to change input
			return Redirect::route('user-edit')
				->with('errorType', 'profile')
				->with('error', $messages->all())
				->withInput();
		} 

		// Edit user in database 
		$user = User::find(Auth::user()->id);
		$user->real_name = $name;
		$user->email = $email;
		$user->save();

		return Redirect::route('user-edit')
			->with('success', 'Informationen uppdaterades!');
	}

	/**
	 * Displays the user's favourites.	 
	 * @param $userId the user id for the user to be displayed
	 */
	public function showFavouritesPage() 
	{
		$hej = array('Patric är korv', 'Jacobi och hans ilska');
		return View::make('user.favourites')
			->with('favoriter', $hej);
	}

	public function personsAutocomplete() {
		$users = User::where('real_name', 'LIKE', '%' . Input::get('q') . '%')
				->orWhere('email', 'LIKE', '%' . Input::get('q') . '%')
				->where('deleted_at', '=', 'NULL')
				->take(10)
				->get();
		$userNames = array();
		foreach ($users as $user) {
			$var = new stdClass();
			$var->id = $user->id;
			$var->name = $user->real_name . ' (' . $user->email . ')';
			$userNames[] = $var;
		}
		return json_encode($userNames
			);
	}
}
