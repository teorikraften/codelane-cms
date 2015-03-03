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
		return View::make('sign-in.sign-up');
	}

	/**
	 * Displays the reset password view.
	 */
	public function showResetPasswordPage() 
	{
		return View::make('sign-in.reset-password');
	}
}