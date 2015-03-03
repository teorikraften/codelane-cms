<?php

class UserRoles extends Eloquent {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'user_roles';

	public function user() {
		return $this->hasOne('App/User');
	}

	public function role() {
		return $this->hasOne('App/Role');
	}
}