@extends('master')

@section('head-title')
    Alla användare
@stop

@section('submenu')
	@include('includes.admin-menu')
@stop

@section('body')
    <h1>Ny användare</h1>
    {{ Form::open(array('action' => 'post-admin-users-new', 'method' => 'post')) }}
	    <div class="form">
			<div class="row">
				<div class="description">{{ Form::label('name', 'Användarens namn') }}</div>
				<div class="input">{{ Form::text('name', NULL, array('class' => 'text', 'placeholder' => '')) }}</div>
			</div>
			<div class="submit">
				{{ Form::submit('Spara användare', array('class' => 'submit')) }}
			</div>
		</div>
    {{ Form::close() }}
@stop