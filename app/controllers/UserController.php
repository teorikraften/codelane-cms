<?php

class UserController extends BaseController {
	/**
	 * Displays the profile page for the user.
	 * @param $userId the user id for the user to be displayed
	 */
	public function showProfilePage($userId)
	{
		return View::make('user.profile')->with('user_id', $userId);
	}

	/**
	 * Displays the edit profile page view for the user.
	 * @param $userId the user id for the user to be displayed
	 */ 
	public function showEditProfilePage($userId) 
	{
		return View::make('user.edit-profile')->with('user_id', $userId);
	}

	/**
	 * Displays the user's favourites.	 
	 * @param $userId the user id for the user to be displayed
	 */
	public function showFavouritesPage($userId) 
	{
		$hej = array('Patric är korv', 'Jacobi och hans ilska');
		return View::make('user.favourites')->with('user_id', $userId)->with('favoriter', $hej);
	}
}
