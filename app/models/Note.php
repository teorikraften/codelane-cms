<?php

class Note extends Eloquent {

	public $timestamps = false;

	/**
	 * The fillable fields in the database.
	 * 
	 * @var array(string)
	 */
	protected $fillable = array('title', 'content');

	/**
	 * The user connected to a specific note.
	 * 
	 * @return Relation
	 */
	public function user() {
		return $this->belongsTo('User');
	}
}
