<?php

class GuestController extends BaseController {
	/**
	 * Displays the sign in view.
	 */
	public function showSignInPage()
	{
		return View::make('sign-in.sign-in')->with('error', Session::get('error'));
	}

	/**
	 * Handles user sign in.
	 */
	public function signIn()
	{
		if (Auth::attempt(array('email' => Input::get('email'), 'password' => Input::get('password'))))
		{
			return Redirect::intended()->with('message', 'Du loggades in.');
		}
		return Redirect::route('index')->withInput()->with('error', array('Fel användarnamn eller lösenord.'));
	}

	/**
	 * 
	 */	
	public function signUp()
	{
		// TODO Göra "upprepa lösenord"
		$name = Input::get('name');
		$email = Input::get('email');
		$password = Input::get('password');

		$validator = Validator::make(
		[
			'name' => $name,
			'email' => $email,
			'password' => $password,
		],
		[
			'name' => 'required',
			'email' => 'required|email|unique:users,email',
			'password' => 'required|min:7', 
		],
		[
    		'name.required' => 'Fyll i ditt namn',
    		'email.required' => 'Fyll i din e-postadress',
    		'email.email' => 'Fyll i en korrekt e-postadress',
    		'email.unique' => 'E-postadressen används redan, testa att logga in istället',
    		'password.required' => 'Fyll i ditt önskade lösenord',
    		'password.min' => 'Ditt lösenord är för kort, det måste vara minst 7 tecken',
		]);

		$error = array();
		if ($validator->fails())
		{
			$messages = $validator->messages();
			// If not succes set error and ask user to change input
			return Redirect::route('sign-up')
				->with('error', $messages->all())
				->withInput();
		} 

		// Add user to database 
		$user = User::create(['real_name' => $name, 'email' => $email, 'password' => Hash::make($password)]);

		// Authenticate user
		Auth::login($user);

		// TODO if succes redirect to role select
		return Redirect::route('user', array(Auth::user()->id));
	}


	/**
	 * Displays the sign in view.
	 */
	public function showSignOutPage()
	{
		Auth::logout();
		return Redirect::route('index');
	}

	/**
	 * Displays sign up form view.
	 */ 
	public function showSignUpPage() 
	{
		return View::make('sign-in.sign-up')->with('error', Session::get('error'))->with('input', Session::get('input'));
	}

	/**
	 * Displays the reset password view.
	 */
	public function showResetPasswordPage() 
	{
		return View::make('sign-in.reset-password');
	}
}