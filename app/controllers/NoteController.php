<?php 

use Illuminate\Database\Eloquent\ModelNotFoundException;

class NoteController extends BaseController {

	public function getShowall() {

		$notes = Auth::user()->notes;

		return View::make('note.show')
			->with('notes', $notes);
	}

	public function getShow($token) {

		$notes = Auth::user()->notes()->where('id', '=', $token)->get();

		return View::make('note.show')
			->with('notes', $notes);
	}

	
}