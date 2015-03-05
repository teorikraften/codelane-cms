<?php

class UserRoles extends Eloquent {

	// NOTE REMOVE

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'user_roles';

	protected $fillable('user', 'role');

	// DEFINE RELATIONSHIPS

	public function user() {
		return $this->hasOne('App/User');
	}

	public function role() {
		return $this->hasOne('App/Role');
	}
}