<?php

class Notification extends Eloquent {


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

	/**
	 * The pm connected to a specific note.
	 * 
	 * @return Relation
	 */
	public function pm() {
		return $this->belongsTo('PM');
	}

	/**
	* Check if notification has been read.
	*/
	public function scopeUnread($query)
	{
	    return $query->where('is_read', '=', 0);
	}
}
