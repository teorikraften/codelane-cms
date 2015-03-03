<?php

class PmTag extends Eloquent {

	// NOTE REMOVE

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'pm_tags';

	protected $fillable = array('pm', 'tag'); // TODO 'added_by' maybe automatic to current user


	// DEFINE RELATIONSHIPS

	public function tag() 
	{
		return $this->hasOne('App\Tag');
	}

	public function pm()
	{
		return $this->hasOne('App\Pm');
	}

	public function addedBy() 
	{
		return $this->hasOne('App\User');
	}



	// TODO check if correct this->added_by
	PmTag::created(function($pmTag)
	{
		$this->added_by = Auth::$user()->id;
		return true;
	});
}