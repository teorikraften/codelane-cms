<?php

class Pm_tag extends Eloquent {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'pm_tags';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = array();

	public function tag() 
	{
		return $this->hasOne('App\Tag');
	}

	public function pm()
	{
		return $this->hasOne('App\Pm');
	}

	Pm_tag:created(function($pm_tag, $user)
	{
		// TODO this->added_by = $user->id
		return true;
	});
}