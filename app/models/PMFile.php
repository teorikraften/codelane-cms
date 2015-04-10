<?php

class PMFile extends Eloquent {

	/**
	 * The database table used by the comment model.
	 *
	 * @var string
	 */
	protected $table = 'files';

	/**
	 * The mass assignable fields for comment.
	 * 
	 * @var array(string)
	 */
	protected $fillable = ['name', 'type', 'pm'];



	/**
	 * Defines relation to the actual PM.
	 *
	 * @return Relation
	 */
	public function pm() {
		return $this->belongsTo('PM', 'id', 'pm');
	}
}
