<?php 

use Illuminate\Database\Eloquent\ModelNotFoundException;

class NotificationController extends BaseController {

	public function getShowall() {

		$notifications = Auth::user()->notifications;

		return View::make('notification.show')
			->with('notifications', $notifications);
	}

	public function getShow($token) {

		$notification = Auth::user()->notifications()->where('id', '=', $token)->first();

		return View::make('notification.content')
			->with('notification', $notification);
	}

	public function getAdd($person = '', $pm = '', $title = '') {
		return View::make('notification.add')
		->with('person', $person)
		->with('pm', $pm)
		->with('title', $title);
	}

	/*
	* Add notification with retrieved inputs.
	*/
	public function postAdd() {

		if (!(strlen(Input::get('title', '')) > 0))
			return Redirect::back()
				->withInput()
				->with('error', 'Du måste ange en rubrik.');

		$notification = new Notification;
		$notification->user_id = Auth::user()->id;
		$notification->title = Input::get('title');
		$notification->content = Input::get('content');
		try {
			$target = User::where('email', '=', Input::get('person'))->firstOrFail();
		} catch(ModelNotFoundException $e) {
			return Redirect::back()
			->withInput()
			->with('error', 'Användaren du angav hittades inte.');
		}
		// TODO: Not rely on title to create pm connection..
		try {
			$pm_id = PM::where('title', '=', Input::get('pm'))->firstOrFail()->id;
		} catch(ModelNotFoundException $e) {
			return Redirect::back()
			->withInput()
			->with('error', 'PM:et du angav hittades inte.');
		}
		$notification->target_id = $target->id;
		$notification->pm_id = $pm_id;

		$notification->save();

		return Redirect::route('notification-show-all')
		->with('success', 'Meddelandet har skickats.');
	}
}