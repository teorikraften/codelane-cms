<?php

class Tag extends Eloquent {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'tags';

	protected $fillable = array('name', 'token');

	/**
	 * All pms with the tag.
	 */
	public function pm() 
	{
		return $this->belongsToMany('App\Pm', 'pm_tags', 'tag', 'pm');
	}
}
