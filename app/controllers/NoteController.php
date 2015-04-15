<?php 

use Illuminate\Database\Eloquent\ModelNotFoundException;

class NoteController extends BaseController {

	public function getShowall() {

		$notes = Auth::user()->notes;

		return View::make('note.show')
			->with('notes', $notes);
	}

	public function getShow($token) {

		$note = Auth::user()->notes()->where('id', '=', $token)->get();

		return View::make('note.content')
			->with('note', $note[0]);
	}


	public function getEdit($token) {

		$note = Auth::user()->notes()->where('id', '=', $token)->get();

		return View::make('note.edit')
			->with('note', $note[0]);
	}
}