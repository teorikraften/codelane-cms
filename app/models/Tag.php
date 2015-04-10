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

	/**
	 * The mass assignable fields for the model.
	 *
	 * @var array(string)
	 */
	protected $fillable = ['name', 'token'];

	/**
	 * The deleted_at is protected.
	 *
	 * @var array(string)
	 */
	protected $dates = ['deleted_at'];




	/**
	 * Defines relation to PM, ie all pm that has the tag.
	 *
	 * @return Relation
	 */
	public function pm() {
		return $this->belongsToMany('Pm', 'pm_tags', 'tag', 'pm');
	}
}
