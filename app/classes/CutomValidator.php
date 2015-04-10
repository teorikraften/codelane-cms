<?php

class CustomValidator 
/* extends Illuminate\Validation\Validator */ {

	// http://culttt.com/2014/01/20/extending-laravel-4-validator/

	$messages = array();

	public function validatechangePassword($new_password, $new_password_again)
	{
		Validator::extend('goodpassword', function($attribute, $value, $parameters){
			if (preg_match("(password)", $value)) {
				return true;
			}
			return false;
		});


		$validator = Validator::make(
			[
			'new_password' => $new_password,
			'new_password_again' => $new_password_again,
			],
			[
			'new_password' => 'required|min:7|regex:.*[0-9].*|regex:.*[A-Z].*|regex:.*[a-z].*',
			'new_password_again' => 'required',
			],
			[
			'new_password.required' => 'Fyll i ditt nya lösenord',
			'new_password_again.required' => 'Du måste skriva ditt lösenord två gånger så att vi vet att du skrev rätt',
			'new_password.min' => 'Det önskade lösenordet är för kort, lösenordet måste vara större än eller lika med 7 tecken långt.',
			]);


		if ($new_password != $new_password_again)
			$this->error[] = 'Lösenorden stämmer inte överens';
		if (!Hash::check($old_password, Auth::user()->password))
			$this->error[] = 'Du skrev fel gammalt lösenord';

		if ($validator->fails() || count($error) != 0) {
			$this->messages = $validator->messages();
			array_merge($this->messages->all(), $error)
			// If not succes set error and ask user to change input
			return false;
		} 
		return true;
	}


	public function validateProfileInfo($name, $email) {
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

		if ($validator->fails()) {
			$messages = $validator->messages();
			// If not succes set error and ask user to change input
			$this->error = $messages->all();
			return false;
		} 
	}

	public function validateProfileInfoWithPrivileges($name, $email, $privileges) 
	{
		$validator = Validator::make(
		[
			'name' => $name,
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

			$error = $messages->all();
			return false;
		} 
		return true;
	}

	public function validateResetPassword() {
		$credentials = Input::only(
			'email', 'password', 'password_confirmation', 'token'
		);

		Password::validator(function($credentials)
		{
		    return strlen($credentials['password']) >= 7;
		});

		$response = Password::reset($credentials, function($user, $password)
		{
			$user->password = Hash::make($password);
			$user->save();
		});

		switch ($response)
		{
			case Password::INVALID_PASSWORD:
				return Redirect::back()->with('error', 'Lösenordet måste vara minst 7 tecken långt.');

			case Password::INVALID_TOKEN:
			case Password::INVALID_USER:
				return Redirect::back()->with('error', 'Felaktig e-postadress.');

			case Password::PASSWORD_RESET:
				return Redirect::route('index')->with('success', 'Ditt lösenord har ändrats. Testa att logga in!');;
		}
	}
	}


}