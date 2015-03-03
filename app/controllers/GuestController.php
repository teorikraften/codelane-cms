<?php

class GuestController extends BaseController {
	/**
	 * Displays the sign in view.
	 */
	public function showSignInPage()
	{
		return View::make('sign-in.sign-in')->with('namn');
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