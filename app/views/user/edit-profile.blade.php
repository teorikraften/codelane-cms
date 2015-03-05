@extends('master')

@section('head-title')
    Ändra användare: {{ Auth::user()->real_name }}
@stop

@section('body') 
    <h1>Ändra information</h1>
    
    @if(Session::get('errorType') == 'profile')
		@include("includes.error")
	@endif
	@include("includes.success")
	@include("includes.message")

    {{ Form::model(Auth::user(), array('action' => array('UserController@editProfile', Auth::user()->id))) }}
    <div class="form">
		<div class="row">
			<div class="description">{{ Form::label('real_name', 'Namn') }}</div>
			<div class="input">{{ Form::text('real_name', NULL, array('class' => 'text')) }}</div>
		</div>
		<div class="row">
			<div class="description">{{ Form::label('email', 'E-postadress') }}</div>
			<div class="input">{{ Form::text('email', NULL, array('class' => 'text')) }}</div>
		</div>
		<div class="submit">
			{{ Form::submit('Spara', array('class' => 'submit')) }}
		</div>
	</div>
	{{ Form::close() }}
	<div class="clear"></div>

	<h2>Byt lösenord</h2>
    @if(Session::get('errorType') == 'password')
		@include("includes.error")
	@endif
    {{ Form::open(array('action' => array('UserController@changePassword', Auth::user()->id))) }}
    <div class="form">
		<div class="row">
			<div class="description">{{ Form::label('old_password', 'Gammalt lösenord') }}</div>
			<div class="input">{{ Form::password('old_password', array('class' => 'text')) }}</div>
		</div>
		<div class="row">
			<div class="description">{{ Form::label('new_password', 'Nytt lösenord') }}</div>
			<div class="input">{{ Form::password('new_password', array('class' => 'text')) }}</div>
		</div>
		<div class="row">
			<div class="description">{{ Form::label('new_password_again', 'Upprepa nytt lösenord') }}</div>
			<div class="input">{{ Form::password('new_password_again', array('class' => 'text')) }}</div>
		</div>
		<div class="submit">
			{{ Form::submit('Byt lösenord', array('class' => 'submit')) }}
		</div>
	</div>
	{{ Form::close() }}
@stop