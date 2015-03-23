<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;
use Illuminate\Database\Eloquent\SoftDeletingTrait;

class User extends Eloquent implements UserInterface, RemindableInterface {

	use UserTrait, RemindableTrait, SoftDeletingTrait;

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

	protected $dates = ['deleted_at'];

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
	 * Roles of the user.
	 */
	public function pms() 
	{
		return $this->belongsToMany('Pm', 'assignments', 'user', 'pm')->withPivot('assignment');
	}

	/**
	 * Actions made by the user.
	 */
	public function assignment() 
	{
		return $this->hasMany('Assignment', 'user');
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

	/**
	 * Returns user's privileges as a nice string word.
	 */
	public function privileges() {
		if ($this->privileges == 'admin') 
			return "systemadministatör";
		if ($this->privileges == 'pm-admin') 
			return "PM-ansvarig";
		if ($this->privileges == 'verified') 
			return "verifierad";
		return "overifierad";
	}

	/**
	 * Returns user's privileges as a nice string word.
	 */
	public static function assignmentString($assignment) {
		if ($assignment == 'author') 
			return "författare";
		if ($assignment == 'owner') 
			return "ägare";
		if ($assignment == 'reviewer') 
			return "granskare";
		return "medlem";
	}
}
