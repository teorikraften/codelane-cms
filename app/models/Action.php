<?php

class Action extends Eloquent {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'actions';

	public function user() 
	{
		return $this->hasOne('App\User');
	}

	public function pm()
	{
		return $this->hasOne('App\Pm');
	}

	public function oldPm() 
	{
		return $this->hasOne('App\OldPM');
	}
}