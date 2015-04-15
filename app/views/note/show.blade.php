@extends('master')

@section('head-title')
    Anteckningar
@stop


@section('body')
    @foreach($notes as $note)
                <a href="{{ URL::route('note-show', $note->id) }}">{{ $note->title }}</a><br>
    @endforeach
@stop