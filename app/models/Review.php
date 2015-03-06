<?php

class Review extends Eloquent {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'rewiews';

	protected $fillable = array('pm', 'user', 'accepted', 'comment');

	/**
	 * The reviewed Pm.
	 */
	public function pm() 
	{
		return $this->hasOne('App\Pm', 'id', 'pm');
	}

	/**
	 * The reviewing user.
	 */
	public function user() 
	{
		return $this->hasOne('App\User', 'id' ,'user');
	}

	public function comment() 
	{
		return $this->hasOne('App\Comment', 'id', 'comment');
	}
}
