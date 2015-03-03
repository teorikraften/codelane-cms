<?php

class Favorite extends Eloquent {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'favorite';

	protected $fillable = array('user', 'pm');


	// DEFINE RELATIONSHIPS

	public function user() 
	{
		return $this->hasOne('App\User');
	}

	public function pm() 
	{
		return $this-> hasOne('App\Pm');
	}
}
