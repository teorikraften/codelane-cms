@extends('master')

@section('head-title')
    Importera PM
@stop

@section('head-extra')
    
@stop

@section('body')
    <h1>Importera PM</h1>
    {{ Form::open(array('files' => true)) }}
    <div class="form">
		<div class="row">
			<div class="description">{{ Form::label('file', 'Välj fil') }}</div>
			<div class="input">{{ Form::file('file') }}</div>
		</div>
		<div class="submit">
			{{ Form::submit('Importera', array('class' => 'submit')) }}
		</div>
	</div>
    {{ Form::close() }}
@stop