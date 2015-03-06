<?php

class Comment extends Eloquent {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'comments';

	protected $fillable = array('user', 'parent_comment', 'content');

	/**
	 * Parent review.
	 */
	public function pm() 
	{
		return $this->belongsTo('Review');
	}

	public function childComments() 
	{
		return $this->hasMany('Comment');
	}


}
