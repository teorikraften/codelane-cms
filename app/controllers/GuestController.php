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
			return Redirect::route('user', array(Auth::user()->id))->with('message', 'Du är inloggad!');
		}
		return Redirect::route('sign-in')->with('error', 'Fel användarnamn eller lösenord!');
	}

	/**
	 * 
	 */	
	public function signUp()
	{
		$name = Input::get('name');
		$email = Input::get('email');
		$password = Input::get('password');

		$validator = Validator::make(
			['name' => $name,
			'email' => $email,
			'password' => $password
			],
			['name' => 'required',
			'email' => 'required|email|unique:users,email',
			'password' => 'required|min:7'
			]);
		$error = array();
		if ($validator->fails())
		{
			$messages = $validator->messages();
			
			if ($messages->has('password')) 
			{
				
			}
			if ($messages->has('email')) 
			{
				$email = null;
			}
			if ($messages->has('name'))
			{
				$name = null;
			}
			// If not succes set error and ask user to change input
			return Redirect::route('sign-up')
				->with('error', $messages)
				->with('input', array( 'name' => $name , 'email' => $email));
		} else {

			// Add user to database 
			$user = User::create(['real_name' => $name, 'email' => $email, 'password' => Hash::make($password)]);

		// TODO if succes redirect to role select
			return Redirect::route('sign-in');
		}
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