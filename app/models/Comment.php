<?php

use Illuminate\Database\Eloquent\SoftDeletingTrait;

class Comment extends Eloquent {

	use SoftDeletingTrait;

	/**
	 * The database table used by the comment model.
	 *
	 * @var string
	 */
	protected $table = 'comments';

	/**
	 * The mass assignable fields for comment.
	 * 
	 * @var array(string)
	 */
	protected $fillable = ['user', 'parent_comment', 'content', 'position_start', 'position_end'];

	/**
	 * The deleted_at is protected.
	 *
	 * @var array(string)
	 */
	protected $dates = ['deleted_at'];


	

	/**
	 * Defines relation to all children comments.
	 *
	 * @return Relation
	 */
	public function childComments() {
		return $this->hasMany('Comment', 'parent', 'id');
	}

	/**
	 * Defines relation to the parent comment.
	 *
	 * @return Relation
	 */
	public function parentComments() {
		return $this->belongsTo('Comment', 'id', 'parent');
	}

	/**
	 * Defines relation to the author user.
	 *
	 * @return Relation
	 */
	public function user() {
		return $this->belongsTo('User', 'id', 'user');
	}

	/**
	 * Defines relation to the actual PM.
	 *
	 * @return Relation
	 */
	public function pm() {
		return $this->belongsTo('PM', 'id', 'pm');
	}
}
