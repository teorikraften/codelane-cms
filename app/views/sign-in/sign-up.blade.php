@extends('master')

@section('head-title')
	Registrera dig
@stop

@section('body')
	<h1>Registrera</h1>
	{{ Form::open(array('url' => route('post-sign-up'), 'method' => 'post'))}}
	@include("includes.error")
	<div class="form">
		<div class="row">
			<div class="description">{{ Form::label('name', 'Namn') }}</div>
			<div class="input">{{ Form::text('name', NULL, array('class' => 'text')) }}</div>
		</div>
		<div class="row">
			<div class="description">{{ Form::label('email', 'E-postadress') }}</div>
			<div class="input">{{ Form::text('email', NULL, array('class' => 'text')) }}</div>
		</div>
		<div class="row">
			<div class="description">{{ Form::label('password', 'Lösenord') }}</div>
			<div class="input">{{ Form::password('password', array('class' => 'text')) }}</div>
		</div>
		<div class="submit">
			{{ Form::submit('Registrera', array('class' => 'submit')) }}
		</div>
	</div>
	{{ Form::close()}}
@stop