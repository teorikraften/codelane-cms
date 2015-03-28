@extends('master')

@section('head-title')
    Återställ lösenord
@stop

@section('body') 
    <h1>Återställ ditt lösenord</h1>
    @include('includes.messages')
    {{ Form::open(array('action' => 'post-recover-password', 'method' => 'post')) }}
	    <div class="form">
			<div class="row">
				<div class="description">{{ Form::label('email', 'E-postadress') }}</div>
				<div class="input">{{ Form::email('email', NULL, array('class' => 'text')) }}</div>
			</div>
			<div class="submit">
				{{ Form::submit('Skicka påminnelse', array('class' => 'submit')) }}
			</div>
		</div>
    {{ Form::close() }}
@stop