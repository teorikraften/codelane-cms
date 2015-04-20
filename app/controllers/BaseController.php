<?php

class BaseController extends Controller {

	/**
	 * Setup the layout used by the controller.
	 *
	 * @return void
	 */
	protected function setupLayout() {
		if ( ! is_null($this->layout)) {
			$this->layout = View::make($this->layout);
		}
	}

	/**
	 * Displays the index page view.
	 * 
	 * @return Response
	 */
	public function getIndex() {
		if(Auth::check()) {
			$pms = Auth::user()->favourites()
				->where('published', '=' , 1)
				->whereNull('pms.deleted_at')
				->where('expiration_date', '<' , 'CURDATE()')
				->get();

			$notes = Auth::user()->notes()->take(5)->get();
		} else {
			$pms = NULL;
			$notes = NULL;
		}

		return View::make('index')
			->withInput(Input::all())
			->with('pms', $pms)
			->with('notes', $notes);
	}
}
