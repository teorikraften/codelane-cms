<?php

use Illuminate\Database\Eloquent\SoftDeletingTrait;

class Tag extends Eloquent {

	use SoftDeletingTrait;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'tags';

	protected $fillable = array('name', 'token');

	protected $dates = ['deleted_at'];

	/**
	 * All pms with the tag.
	 */
	public function pm() 
	{
		return $this->belongsToMany('Pm', 'pm_tags', 'tag', 'pm');
	}
}
