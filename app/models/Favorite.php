<?php

class Favorite extends Eloquent {

	// OBS syntax
 	public $primarykey = {'user', 'pm'};


	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'favorite';

	public function user() 
	{
		return $this->hasOne('App\User');
	}

	public function pm() 
	{
		return $this-> hasOne('App\Pm');
	}
}
