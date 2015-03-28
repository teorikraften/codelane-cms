<?php

class Comment extends Eloquent {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'comments';

	protected $fillable = array('user', 'parent_comment', 'content');

	public function childComments() {
		return $this->hasMany('Comment');
	}
}
