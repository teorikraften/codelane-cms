@extends('master')

@section('head-title')
    Visa anteckning "{{ $note->title }}"
@stop


@section('body')
                <h1>{{ ucfirst($note->title) }}
				<a href="{{ URL::route('note-edit', $note->id) }}" title="Ändra">
                    {{ HTML::image('images/edit.png', 'Ändra') }}
				</a>
                </h1>
                <p>{{ $note->content }}</p>
@stop