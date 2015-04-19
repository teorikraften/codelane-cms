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
		return $this->belongsToMany('PM', 'assignments', 'user', 'pm')->withPivot('assignment');
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
		return $this->hasMany('Notification', 'target_id');
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
	 *
	 */
	public function countEvents() {
		$events = DB::table('pms')->join('assignments', 'assignments.pm', '=', 'pms.id')
		->where('assignments.user', '=', $this->id)
		->whereNull('pms.deleted_at')
		//->whereNull('done_at') TODO
		->where(function($validAssignment){
			$validAssignment
			->where(function($author){
				$author->where('assignments.assignment', '=', 'author')
				->whereIn('pms.status', array('assigned', 'revision-assigned'));
			})
			->orWhere(function($settler){
				$settler->where('assignments.assignment', '=', 'settler')
				->whereIn('pms.status', array('end-reviewed', 'revision-end-reviewed'));
			})
			->orWhere(function($reviewer){
				$reviewer->where('assignments.assignment', '=', 'reviewer')
				->whereIn('pms.status', array( 'written', 'revision-written'));
			})
			->orWhere(function($end_reviewer){
				$end_reviewer->where('assignments.assignment', '=', 'end-reviewer')
				->whereIn('pms.status', array('reviewed', 'revision-reviewed'));
			})
			->orWhere(function($reminder){  // TODO maybe jämför dates $pm->expiration_date < Carbon::now() ||
				$reminder->where('assignments.assignment', '=', 'reminder')
				->whereIn('pms.status', array('revision-waiting', 'published-reminded'));
			});
		})
		->count();
		return $events;
	}

	/**
	 * Gets all events that this user has to finish.
	 *
	 * @return array of events - array({ 'verb':string, 'pm':PM })
	 */
	public function allEvents() {
		$res = DB::table('pms')->join('assignments', 'assignments.pm', '=', 'pms.id')
		->where('assignments.user', '=', $this->id)
		->whereNull('pms.deleted_at')
		//->whereNull('done_at') TODO
		->where(function($validAssignment){
			$validAssignment
			->where(function($author){
				$author->where('assignments.assignment', '=', 'author')
				->whereIn('pms.status', array('assigned', 'revision-assigned'));
			})
			->orWhere(function($settler){
				$settler->where('assignments.assignment', '=', 'settler')
				->whereIn('pms.status', array('end-reviewed', 'revision-end-reviewed'));
			})
			->orWhere(function($reviewer){
				$reviewer->where('assignments.assignment', '=', 'reviewer')
				->whereIn('pms.status', array( 'written', 'revision-written'));
			})
			->orWhere(function($end_reviewer){
				$end_reviewer->where('assignments.assignment', '=', 'end-reviewer')
				->whereIn('pms.status', array('reviewed', 'revision-reviewed'));
			})
			->orWhere(function($reminder){  // TODO maybe jämför dates $pm->expiration_date < Carbon::now() ||
				$reminder->where('assignments.assignment', '=', 'reminder')
				->whereIn('pms.status', array('revision-waiting', 'published-reminded'));
			});
		})
		->get();

		foreach ($res as $key => $value) {
			$value->assignmentString = $this->assignmentString($value->assignment);
		}

		return $res;
	}
}