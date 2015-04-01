<?php

class GuestController extends BaseController {

	/**
	 * Handles user sign in post request.
	 */
	public function postSignIn() {	
		if (Auth::attempt(array('email' => Input::get('email'), 'password' => Input::get('password')))) {
			// Here we must check if user is verified, or deny
			if (Auth::user()->privileges == 'unverified') {
				
				// Not enough permissions, log out
				Auth::logout();

				return Redirect::route('index')
					->withInput()
					->with('error', 'Ditt konto har inte godkänts av en administratör ännu och du kan därför inte logga in.');
			}

			// Everything seems fine
			return Redirect::intended()
				->with('message', 'Du loggades in.');
		}

		// Return and display error messages
		return Redirect::route('index')
			->withInput()
			->with('error', 'Fel användarnamn eller lösenord.');
	}

	/**
	 * Handles user sign up post request
	 */	
	public function postSignUp() {
		$data = Input::only(array('name', 'email', 'password', 'password_confirmation'));

		$validator = Validator::make($data,
		[
			'name' => 'required',
			'email' => 'required|email|unique:users,email',
			'password' => 'required|min:7|confirmed',
		],
		[
    		'name.required' => 'Fyll i ditt namn',
    		'email.required' => 'Fyll i din e-postadress',
    		'email.email' => 'Fyll i en korrekt e-postadress',
    		'email.unique' => 'E-postadressen används redan, testa att logga in istället',
    		'password.required' => 'Fyll i ditt önskade lösenord',
    		'password.min' => 'Ditt lösenord är för kort, det måste vara minst 7 tecken',
    		'password.confirmed' => 'Dina lösenord stämmer inte överens',
		]);

		// Now do the actual validation
		if ($validator->fails()) {
			$messages = $validator->messages();

			// If not successful, set error and ask user to change input
			return Redirect::route('sign-up')
				->with('error', $messages->all())
				->withInput();
		} 

		// Add user to database 
		$user = User::create([
			'real_name' => $data['name'], 
			'email' => $data['email'], 
			'password' => Hash::make($data['password']), 
			'privileges' => 'unverified'
		]);

		// Send mail to inform user that the account has been created and waiting for verification
		Mail::send('emails.welcome-unverified', array('name' => $data['name']), function($message) use($data) {
		    $message
		    	->to($data['email'], $data['name'])
		    	->from('no-reply@ds.se', 'Danderyds Sjukhus')
		    	->subject('Välkommen!');
		});

		return Redirect::route('sign-up')->with('success', 'Ditt konto har skapats. Du kommer få ett mejl när ditt konto godkänts av en administratör.');
	}


	/**
	 * Signs out user.
	 */
	public function getSignOut() {
		Auth::logout();
		return Redirect::route('index')
			->with('message', 'Du loggades ut.');
	}

	/**
	 * Displays sign up form view.
	 */ 
	public function getSignUp() {	
		return View::make('sign-in.sign-up')
			->with('error', Session::get('error'))
			->with('input', Session::get('input'));
	}
	
}