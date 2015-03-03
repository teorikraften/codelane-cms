<?php

class PmTag extends Eloquent {

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

	// TODO check if correct this->added_by
	PmTag::created(function($pmTag)
	{
		$this->added_by = Auth::$user()->id;
		return true;
	});
}