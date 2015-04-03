@extends('master')

@section('head-title')
    
@stop

@section('body')
    <h1>404 - Sidan kunde inte hittas</h1>
    <p>Vad vill du göra?</p>
    <ul>
    	<li><a href="{{ URL::route('index') }}">Klicka här för att gå till hem.</a></li>
      	<li><a href="{{ URL::route('help-index') }}">Klicka här för att gå till hjälp.</a></li>
    </ul>
@stop