<?php

class Tag extends Eloquent {

	use;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'tags';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = array();

	public function pm_tag() 
	{
		return $this->belongsToMany('App\Pm_tag');
	}

	

}
