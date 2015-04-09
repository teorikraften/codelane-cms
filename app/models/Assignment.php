<?php

class Assignment extends Eloquent {

	/**
	 * The database table used by the assignment model.
	 *
	 * @var string
	 */
	protected $table = 'assignments';

	/**
	 * The fillable fields in the database.
	 * 
	 * @var array(string)
	 */
	protected $fillable = array('user', 'pm', 'assignment', 'accepted', 'content');

	/**
	 * The PM the assignment affects.
	 * 
	 * @return Relation
	 */
	public function assignedPm() {
		return $this->hasOne('Pm', 'id', 'pm');
	}

	/**
	 * The user the assignment affects.
	 * 
	 * @return Relation
	 */
	public function assignedUser() {
		return $this->hasOne('User', 'id', 'pm');
	}
}
