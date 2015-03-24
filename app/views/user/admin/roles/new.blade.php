@extends('master')

@section('head-title')
    Alla taggar
@stop

@section('submenu')
	@include('includes.admin-menu')
@stop

@section('body')
    <h1>Ny roll</h1>
    @include('includes.messages')
    {{ Form::open(array('action' => 'post-admin-roles-new', 'method' => 'post')) }}
    <div class="form">
		<div class="row">
			<div class="description">{{ Form::label('name', 'Rollens namn') }}</div>
			<div class="input">{{ Form::text('name', NULL, array('class' => 'text', 'placeholder' => '')) }}</div>
		</div>
		<div class="submit">
			{{ Form::submit('Spara roll', array('class' => 'submit')) }}
		</div>
	</div>
    {{ Form::close() }}
@stop