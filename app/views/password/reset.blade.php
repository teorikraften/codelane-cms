@extends('master')

@section('head-title')
    Återställ lösenord
@stop

@section('body') 
    <h1>Återställ ditt lösenord</h1>
    <p>Ditt nya lösenord måste vara minst 7 tecken långt.</p>
    @include('includes.messages')
    {{ Form::open(array('action' => 'post-reset-password', 'method' => 'post')) }}
    	{{ Form::hidden('token', $token) }}
	    <div class="form">
			<div class="row">
				<div class="description">{{ Form::label('email', 'E-postadress') }}</div>
				<div class="input">{{ Form::email('email', NULL, array('class' => 'text')) }}</div>
			</div>
			<div class="row">
				<div class="description">{{ Form::label('password', 'Nytt lösenord') }}</div>
				<div class="input">{{ Form::password('password', array('class' => 'text')) }}</div>
			</div>
			<div class="row">
				<div class="description">{{ Form::label('password_confirmation', 'Upprepa nytt lösenord') }}</div>
				<div class="input">{{ Form::password('password_confirmation', array('class' => 'text')) }}</div>
			</div>
			<div class="submit">
				{{ Form::submit('Återställ lösenord', array('class' => 'submit')) }}
			</div>
		</div>
    {{ Form::close() }}
@stop