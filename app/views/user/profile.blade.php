@extends('master')

@section('head-title')
    Användare: {{ $user_id }}
@stop

@section('body') 
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    {{ Auth::user()->real_name }}
    {{ Auth::user()->email }}
@stop