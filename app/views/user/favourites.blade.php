@extends('master')

@section('head-extra')
    
@stop

@section('body')
    <h1>Dina favoriter, {{ $user_id }}</h1>
    <ul>
    @foreach($favoriter as $favorit)
    	<li>{{ $favorit }}</li>
    @endforeach
    </ul>
@stop