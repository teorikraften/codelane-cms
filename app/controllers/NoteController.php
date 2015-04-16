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

	public function postEdit() {
		try {
			$note = Note::findOrFail(Input::get('id'));
		} catch(ModelNotFoundException $e) {
			return Redirect::back()
			->with('error', 'Anteckningen som skulle visas hittades inte.');
		}

		if (!(strlen(Input::get('title', '')) > 0))
			return Redirect::back()
				->withInput()
				->with('error', 'Du måste ange en rubrik.');

		$note->title = Input::get('title');
		$note->content = Input::get('content');

		$note->save();

		if (Input::has('save'))
			return Redirect::route('note-show-all')->with('success', 'Anteckningen sparades.');
	}
}