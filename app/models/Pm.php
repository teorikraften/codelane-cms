<?php

use Illuminate\Database\Eloquent\SoftDeletingTrait;

class Pm extends Eloquent {

	use SoftDeletingTrait;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'pms';

	protected $fillable = array('title', 'content', 'original_filetype');

	protected $dates = ['deleted_at'];

	// DEFINE RELATIONSHIPS

	/**
	 * Old versions of the PM.
	 */
	public function OldPM() 
	{
		
	}

	/**
	 * Tags connected to the PM.
	 */
	public function tags() 
	{
		return $this->belongsToMany('Tag', 'pm_tags', 'pm', 'tag');
	}

	/**
	 *
	 */
	public function categories() 
	{
		return $this->belongsToMany('Category', 'pm_categories', 'pm', 'category');
	}

	/**
	 * Roles conntected to the PM.
	 */
	public function roles() 
	{
		return $this->belongsToMany('Role', 'pm_roles', 'pm', 'role');
	}

	/**
	 * Reviews conntected to the PM.
	 */
	public function reviews() 
	{
		return $this->belongsToMany('Review', 'id', 'review');
	}

	public function assignments() 
	{
		return $this->hasMany('Assignment', 'pm');
	}

	public function users() 
	{
		return $this->belongsToMany('User', 'assignments', 'pm', 'user')->withPivot('assignment');
	}

	public function favouriteUsers() 
	{
		return $this->belongsToMany('User', 'favourites', 'pm', 'user');
	}

	public function favouriteByUser() {
		if (Auth::guest())
			return false;

		return count($this->favouriteUsers()->where('user', '=', Auth::user()->id)->get()) > 0;
	}
}