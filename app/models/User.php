<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class User extends Eloquent implements UserInterface, RemindableInterface {

	use UserTrait, RemindableTrait;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'users';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = array('password', 'remember_token');

	protected $fillable = array('email', 'password', 'real_name', 'priveleges','remember_token');

	// DEFINE RELATIONSHIPS

	/**
	 * favourite pms of the user.
	 */
	public function favorites() 
	{
		return $this->belongsToMany('Pm', 'favorites', 'user', 'pm');
	}

	/**
	 * Roles of the user.
	 */
	public function roles() 
	{
		return $this->belongsToMany('Role', 'user_roles', 'user', 'role');
	}

	/**
	 * Actions made by the user.
	 */
	public function assignment() 
	{
		return $this->hasMany('Assignemnt');
	}

	/**
	 * The users last read pms
	 */
	public function lastReadPms() 
	{
		return $this->belongsToMany('Pm', 'last_read', 'user', 'pm');
	}

	/**
	 * Tags created by the user 
	 */
	public function createdTags() 
	{
		// TODO thinking if needed and 
			//how to implement since I atm didn´t created a model for pm_tags
	}

}
