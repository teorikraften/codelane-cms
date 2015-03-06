<?php

class Role extends Eloquent {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'roles';

	protected $fillable = array('name', 'role_type');

	/**
	 * All users with the role
 	 */
	public function users() {
		return $this->belongsToMany('App\User', 'user_roles', 'role', 'user');
	}

	/**
	 * All pms with the role.
	 */
	public function pms() 
	{
		return $this->belongsToMany('App\PM', 'pm_roles', 'role', 'pm');
	}
}