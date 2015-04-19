@extends('master')

@section('head-title')
    Visa meddelande "{{ $notification->title }}"
@stop


@section('body')
                <h1>{{ ucfirst($notification->title) }}
                </h1>
                <p>{{ $notification->content }}</p>
@stop