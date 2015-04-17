@extends('master')

@section('head-title')
    Anteckning {{ $note->title }}
@stop


@section('body')
                <a href="{{ URL::route('note-show', $note->id) }}">{{ $note->title }}</a>
                <a href="{{ URL::route('note-edit', $note->id) }}" title="Ändra">
                    {{ HTML::image('images/edit.png', 'Ändra') }}
				</a>
                <br>
                <p>{{ $note->content }}</p>
@stop