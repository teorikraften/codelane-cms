<?php

class Review extends Eloquent {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'reviews';

	protected $fillable = array('pm', 'user', 'accepted', 'comment');

	/**
	 * The reviewed Pm.
	 */
	public function pm() 
	{
		return $this->hasOne('Pm', 'id', 'pm');
	}

	/**
	 * The reviewing user.
	 */
	public function user() 
	{
		return $this->hasOne('User', 'id' ,'user');
	}

	public function comment() 
	{
		return $this->hasOne('Comment', 'id', 'comment');
	}
}
