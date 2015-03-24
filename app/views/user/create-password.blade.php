@extends('master')

@section('head-title')
    Skapa lösenord
@stop

@section('body') 
    <h1>Skapa ett lösenord</h1>
    <p>Ditt nya lösenord måste vara minst 7 tecken långt.</p>
    @include('includes.messages')
    {{ Form::open(array('action' => 'post-create-password', 'method' => 'post')) }}
    	{{ Form::hidden('id', $id) }}
	    <div class="form">
			<div class="row">
				<div class="description">{{ Form::label('email', 'E-postadress') }}</div>
				<div class="input">{{ Form::email('email', NULL, array('class' => 'text')) }}</div>
			</div>
			<div class="row">
				<div class="description">{{ Form::label('password', 'Ditt nya lösenord') }}</div>
				<div class="input">{{ Form::password('password', array('class' => 'text')) }}</div>
			</div>
			<div class="row">
				<div class="description">{{ Form::label('password_confirmation', 'Upprepa nytt lösenord') }}</div>
				<div class="input">{{ Form::password('password_confirmation', array('class' => 'text')) }}</div>
			</div>
			<div class="submit">
				{{ Form::submit('Skapa lösenord', array('class' => 'submit')) }}
			</div>
		</div>
    {{ Form::close() }}
@stop