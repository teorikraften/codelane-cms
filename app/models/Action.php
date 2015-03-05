<?php

class Action extends Eloquent {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'actions';

	protected $fillable = array('user', 'pm', 'actiontype');


	// DEFINE RELATIONSHIPS

	/**
	 * User who made the action.
	 */
	public function user() 
	{
		return $this->hasOne('App\User');
	}

	/**
	 * Pm modified by the action.
	 */
	public function pm()
	{
		return $this->hasOne('App\Pm');
	}

	/**
	 * Old version of the modified PM.
	 */
	public function oldPm() 
	{
		return $this->hasOne('App\OldPM');
	}
}