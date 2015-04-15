@extends('master')

@section('head-title')
    Anteckning {{ $note->title }}
@stop


@section('body')
                <a href="{{ URL::route('note-show', $note->id) }}">{{ $note->title }}</a><br>
                <p>{{ $note->content }}</p>
@stop