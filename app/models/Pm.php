<?php

use Illuminate\Database\Eloquent\SoftDeletingTrait;

class PM extends Eloquent {

	use SoftDeletingTrait;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'pms';

	/**
	 * The mass assignable fields for pm.
	 * 
	 * @var array(string)
	 */
	protected $fillable = array('title', 'content');

	/**
	 * The deleted_at is protected.
	 *
	 * @var array(string)
	 */
	protected $dates = ['deleted_at'];




	/**
	 * Defines relation to all tags connected to the PM.
	 *
	 * @return Relation
	 */
	public function tags() {
		return $this->belongsToMany('Tag', 'pm_tags', 'pm', 'tag');
	}

	/**
	 * Defines relation to all real files connected to PM.
	 *
	 * @return Relation
	 */
	public function files() {
		return $this->hasMany('PMFile', 'pm', 'id');
	}

	/**
	 * Defines relation to all categories connected to the PM.
	 *
	 * @return Relation
	 */
	public function categories() {
		return $this->belongsToMany('Category', 'pm_categories', 'pm', 'category');
	}

	/**
	 * Defines relation to all roles connected to the PM.
	 *
	 * @return Relation
	 */
	public function roles() {
		return $this->belongsToMany('Role', 'pm_roles', 'pm', 'role');
	}

	/**
	 * Defines relation to all comments connected to the PM.
	 *
	 * @return Relation
	 */
	public function comments() {
		return $this->hasMany('Comment', 'pm', 'id');
	}

	/**
	 * Defines relation to all assignments connected to the PM.
	 *
	 * @return Relation
	 */
	public function assignments() {
		return $this->hasMany('Assignment', 'pm', 'id');
	}

	/**
	 * Defines relation to all user, that via assignments, are connected to the PM.
	 *
	 * @return Relation
	 */
	public function users() {
		return $this->belongsToMany('User', 'assignments', 'pm', 'user')
			->withPivot('assignment', 'done_at');
	}

	/**
	 * Defines relation to all users, that via favourites, are connected to the PM.
	 *
	 * @return Relation
	 */
	public function favouriteUsers() {
		return $this->belongsToMany('User', 'favourites', 'pm', 'user');
	}

	/**
	 * Defines relation to all the personal notes.
	 *
	 * @return Relation
	 */
	public function notes() {
		return $this->hasMany('Note');
	}

	/**
	 * Defines relation to all the notifications.
	 *
	 * @return Relation
	 */
	public function notifications() {
		return $this->hasMany('Notification');
	}

	/**
	 * Checks if actual user has favourited this PM.
	 *
	 * @return false if user if logged out or if user hasn't favourited this PM, true otherwise
	 */
	public function favouriteByUser() {
		if (Auth::guest())
			return false;

		return count($this->favouriteUsers()->where('user', '=', Auth::user()->id)->get()) > 0;
	}

	public function statusString() {
		if ($this->status == 'published')
			return 'publicerad';
		if ($this->status == 'assigned')
			return 'roller tilldelade';
		if ($this->status == 'written')
			return 'författad';
		if ($this->status == 'reviewed')
			return 'granskad';
		if ($this->status == 'end-reviewed')
			return 'slutgranskad';
		if ($this->status == 'revision-assigned')
			return 'revision inledd';
		if ($this->status == 'revision-written')
			return 'ändrad i revidering';
		if ($this->status == 'revision-reviewed')
			return 'granskad i revidering';
		if ($this->status == 'revision-end-reviewed')
			return 'slutgranskad i revision';
		return 'existerar';
	}
}