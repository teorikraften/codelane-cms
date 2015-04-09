<?php

use Illuminate\Database\Eloquent\SoftDeletingTrait;

class Role extends Eloquent {

	use SoftDeletingTrait;
	
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'roles';

	/**
	 * The mass assignable fields for the model.
	 *
	 * @var array(string)
	 */
	protected $fillable = array('name', 'role_type', 'department_code', 'department_parent');

	/**
	 * The deleted_at is protected.
	 *
	 * @var array(string)
	 */
	protected $dates = ['deleted_at'];



	/**
	 * Defines relation to user, ie all users that has the role.
	 *
	 * @return Relation
	 */
	public function users() {
		return $this->belongsToMany('User', 'user_roles', 'role', 'user');
	}

	/**
	 * Defines relation to PM, ie all PM:s that has the role.
	 *
	 * @return Relation
	 */
	public function pms() {
		return $this->belongsToMany('PM', 'pm_roles', 'role', 'pm');
	}
}