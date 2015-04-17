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

	/*
	* Edit a note with values given by user.
	*/
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

	public function getAdd() {
		return View::make('note.add');
	}

	/*
	* Add note with retrieved inputs.
	*/
	public function postAdd() {

		if (!(strlen(Input::get('title', '')) > 0))
			return Redirect::back()
				->withInput()
				->with('error', 'Du måste ange en rubrik.');

		$note = new Note;
		$note->user_id = Auth::user()->id;
		$note->title = Input::get('title');
		$note->content = Input::get('content');

		$note->save();

		return Redirect::route('note-show-all')->with('success', 'Anteckningen sparades.');
	}

	public function getDelete($token) 
	{
		try {
			$note = Note::where('id', '=', $token)->firstOrFail(); 
			$note->delete();
		} catch(ModelNotFoundException $e) {
			return Redirect::route('note-show-all')
			->with('error', 'Anteckningen som skulle tas bort hittades inte.');
		}

		return Redirect::route('note-show-all')
		->with('success', 'Anteckningen togs bort.');
	}
}