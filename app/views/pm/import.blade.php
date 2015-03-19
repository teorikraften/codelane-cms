@extends('master')

@section('head-title')
    Importera PM
@stop

@section('head-extra')
    
@stop

@section('submenu')
	@include('includes.admin-menu')
@stop

@section('body')
    <h1>Importera PM</h1>
    {{ Form::open(array('files' => true)) }}
    <div class="form">
		<div class="row">
			<div class="description">{{ Form::label('file', 'Välj mapp från public/PM/...') }}</div>
			<div class="input">{{ Form::text('file', 'Akutmottagningen/Administrativa riktlinjer/Gemensamma PM akutmottagningen', array('class' => 'text')) }}</div>
		</div>
		<div class="submit">
			{{ Form::submit('Importera', array('class' => 'submit')) }}
		</div>
	</div>
    {{ Form::close() }}
@stop