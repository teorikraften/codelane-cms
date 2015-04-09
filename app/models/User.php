<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;
use Illuminate\Database\Eloquent\SoftDeletingTrait;

class User extends Eloquent implements UserInterface, RemindableInterface {

	use UserTrait, RemindableTrait, SoftDeletingTrait;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'users';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = array('password', 'remember_token');

	/**
	 * The mass assignable fields for the model.
	 *
	 * @var array(string)
	 */
	protected $fillable = ['email', 'password', 'name', 'privileges', 'remember_token'];

	/**
	 * The deleted_at is protected.
	 *
	 * @var array(string)
	 */
	protected $dates = ['deleted_at'];





	/**
	 * Defines relation to all the PM the user has favourited.
	 *
	 * @return Relation
	 */
	public function favourites() {
		return $this->belongsToMany('PM', 'favourites', 'user', 'pm');
	}

	/**
	 * Defines relation to all roles the user has.
	 *
	 * @return Relation
	 */
	public function roles() {
		return $this->belongsToMany('Role', 'user_roles', 'user', 'role');
	}

	/**
	 * Defines relation to all the PM:s (via assignment) the user is working with.
	 *
	 * @return Relation
	 */
	public function pms() {
		return $this->belongsToMany('Pm', 'assignments', 'user', 'pm')->withPivot('assignment');
	}

	/**
	 * Defines relation to all the assignment the user has.
	 *
	 * @return Relation
	 */
	public function assignment() {
		return $this->hasMany('Assignment', 'user');
	}






	/**
	 * Get a nice, Swedish, string of user privilege.
	 *
	 * @return string
	 */
	public function privilegesString() {
		if ($this->privileges == 'admin') 
			return "systemadministatör";
		if ($this->privileges == 'pm-admin') 
			return "PM-ansvarig";
		if ($this->privileges == 'verified') 
			return "verifierad";
		return "overifierad";
	}

	/**
	 * Get user's privileges as an integer.
	 *
	 * @return 10 (admin), 8 (pm-admin), 2 (verifierad), 0 (overifierad)
	 */
	public function privilegesNum() {
		if ($this->privileges == 'admin') 
			return 10;
		if ($this->privileges == 'pm-admin') 
			return 8;
		if ($this->privileges == 'verified') 
			return 2;
		return 0;
	}

	/**
	 * Get a nice, Swedish, string of user assignment.
	 *
	 * @return string
	 */
	public static function assignmentString($assignment) {
		if ($assignment == 'creator') 
			return "upprättare";
		if ($assignment == 'author') 
			return "inläggare";
		if ($assignment == 'settler') 
			return "fastställare";
		if ($assignment == 'reviewer') 
			return "granskare";
		if ($assignment == 'end-reviewer') 
			return "slutgranskare";
		if ($assignment == 'reminder') 
			return "påminnare";
		return "medlem";
	}

	/**
	 * Gets all events that this user has to finish.
	 *
	 * @return array of events - array({ 'verb':string, 'pm':PM })
	 */
	public function allEvents() {
		$res = array();
		
		// 'creator'
		$creatorAss = $this->assignment()->where('assignment', '=', 'creator')->whereNull('done_at')->get();
		foreach ($creatorAss as $key => $ass) {
			$pm = $ass->pm;
			if ($pm->status == 'assigned' || $pm->status == 'revision-assigned' || $pm->status == 'written' || $pm->status == 'revision-written') {
				$res['verb'] = $this->assignmentString($ass->assignment);
				$res['pm'] = $pm;
			}
		}

		// 'author'
		$writeAss = $this->assignment()->where('assignment', '=', 'author')->whereNull('done_at')->get();
		foreach ($writeAss as $key => $ass) {
			$pm = $ass->pm;
			if ($pm->status == 'assigned' || $pm->status == 'revision-assigned' || $pm->status == 'written' || $pm->status == 'revision-written')
				$res['verb'] = $this->assignmentString($ass->assignment);
			$res['pm'] = $pm;
		}

		// 'settler'
		$settlerAss = $this->assignment()->where('assignment', '=', 'settler')->whereNull('done_at')->get();
		foreach ($settlerAss as $key => $ass) {
			$pm = $ass->pm;
			if ($pm->status == 'end-reviewed' || $pm->status == 'revision-end-reviewed') {
			$res['verb'] = $this->assignmentString($ass->assignment);
			$res['pm'] = $pm;
			}
		}

		// 'reviewer'
		$reviewAss = $this->assignment()->where('assignment', '=', 'reviewer')->whereNull('done_at')->get();
		foreach ($reviewAss as $key => $ass) {
			$pm = $ass->pm;
			if ($pm->status == 'assigned' || $pm->status == 'revision-assigned' || $pm->status == 'written' || $pm->status == 'revision-written') {
				$res['verb'] = $this->assignmentString($ass->assignment);
				$res['pm'] = $pm;
			}
		}

		// 'end-reviewer'
		$LastReviewAss = $this->assignment()->where('assignment', '=', 'end-reviewer')->whereNull('done_at')->get();
		foreach ($LastReviewAss as $key => $ass) {
			$pm = $ass->pm;
			if ($pm->status == 'reviewed' || $pm->status == 'revision-reviewed'	|| $pm->status == 'written' || $pm->status == 'revision-written' || $pm->status == 'reviewed' || $pm->status == 'revision-reviewed') {
				$res['verb'] = $this->assignmentString($ass->assignment);
				$res['pm'] = $pm;
			}
		}

		// 'reminder'
		$RevidAss = $this->assignment()->where('assignment', '=', 'reminder')->whereNull('done_at')->get();
		foreach ($RevidAss as $key => $ass) {
			$pm = $ass->pm;
			if ( $pm->status == 'revision-waiting' || $pm->status == 'published-reminded') { // TODO jämför dates $pm->expiration_date < Carbon::now() ||
				$res['verb'] = $this->assignmentString($ass->assignment);
				$res['pm'] = $pm;
			}
		}

		return $res;
	}
}

/*
'assigned','written','reviewed','end-reviewed','published','published-reminded'
,'revision-waiting','revision-assigned','revision-reviewed','revision-end-reviewed','revision-written'
*/