<?php

class Tag extends Eloquent {

	// OBS syntax
 	public $primarykey = {'pm', 'tag'};


	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'tags';

	public function pm_tag() 
	{
		return $this->belongsToMany('App\Pm_tag');
	}
}
