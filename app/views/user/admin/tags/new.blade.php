@extends('master')

@section('head-title')
    Alla taggar
@stop

@section('submenu')
	@include('includes.admin-menu')
@stop

@section('body')
    <h1>Ny tagg</h1>
    @include('includes.messages')
    {{ Form::open(array('action' => 'post-admin-tags-new', 'method' => 'post')) }}
    <div class="form">
		<div class="row">
			<div class="description">{{ Form::label('name', 'Taggens namn') }}</div>
			<div class="input">{{ Form::text('name', NULL, array('class' => 'text', 'placeholder' => '')) }}</div>
		</div>
		<div class="submit">
			{{ Form::submit('Spara tagg', array('class' => 'submit')) }}
		</div>
	</div>
    {{ Form::close() }}
@stop