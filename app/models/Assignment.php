<?php

class Assignment extends Eloquent {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'assignments';

	protected $fillable = array('user', 'pm', 'assignment');

	/**
	 * The PM the assignment affects.
	 */
	public function pm() 
	{
		return $this->hasOne('App\Pm');
	}

	/**
	 * The user the assignment affects.
	 */
	public function user() 
	{
		return $this->hasOne('App\User');
	}
}
