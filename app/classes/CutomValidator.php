<?php

class CustomValidator 
/* extends Illuminate\Validation\Validator */ {

	// http://culttt.com/2014/01/20/extending-laravel-4-validator/

	// http://regexlib.com/Search.aspx?k=strong%20password&AspxAutoDetectCookieSupport=1 
	$messages = array();

	public function validatechangePassword($new_password, $new_password_again)
	{
		Validator::extend('goodpassword', function($attribute, $value, $parameters){
			if (preg_match(".*[0-9].*", $value)) {
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
			$this->messages[] = 'Lösenorden stämmer inte överens';
		if (!Hash::check($old_password, Auth::user()->password))
			$this->messages[] = 'Du skrev fel gammalt lösenord';

		if ($validator->fails() || count($error) != 0) {
			$this->messages = array_merge($this->messages, $validator->messages()->all();
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
				$this->error[] = 'Lösenordet måste vara minst 7 tecken långt.';
				return false;
			case Password::INVALID_TOKEN:
			case Password::INVALID_USER:
				$this->error[] = 'Felaktig e-postadress.';
				return false;

			case Password::PASSWORD_RESET:
				// 'success', 'Ditt lösenord har ändrats. Testa att logga in!';
				return true;
		}
	}
	}


}