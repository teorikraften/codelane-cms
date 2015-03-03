<?php

class Pm extends Eloquent {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'pms';

	protected $fillabel = array('title', 'content', 'original_filetype');

	// DEFINE RELATIONSHIPS

	/**
	 * Old versions of the PM.
	 */
	public function OldPM() 
	{
		
	}

	/**
	 * Tags connected to the PM.
	 */
	public function tags() 
	{
		return $this->belongsToMany('App\Tag', 'pm_tags', 'pm', 'tag');
	}

	/**
	 * Roles conntected to the PM.
	 */
	public function roles() 
	{
		return $this->belongsToMany('App\Role', 'pm_roles', 'pm', 'role');
	}

	
}