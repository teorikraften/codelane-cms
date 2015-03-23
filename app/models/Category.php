<?php

use Illuminate\Database\Eloquent\SoftDeletingTrait;

class Category extends Eloquent {

	use SoftDeletingTrait;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'categories';

	protected $fillable = array('name', 'token', 'parent');

	protected $dates = ['deleted_at'];

	/**
	 * All pms with the tag.
	 */
	public function pm() 
	{
		return $this->belongsToMany('Pm', 'pm_categories', 'category', 'pm');
	}
}