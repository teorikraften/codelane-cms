<?php

class Tag extends Eloquent {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'tags';

	public function pm_tag() 
	{
		return $this->belongsToMany('App\PmTag');
	}
}
