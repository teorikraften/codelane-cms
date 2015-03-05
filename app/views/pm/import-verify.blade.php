@extends('master')

@section('head-title')
    Importera PM
@stop

@section('head-extra')
    
@stop

@section('body')
    <h1>Importera PM</h1>
    {{ Form::open(array('files' => true)) }}
    <div class="form" style="max-width: 100%">
		<div class="row">
			<div class="description">{{ Form::label('title', 'Rubrik') }}</div>
			<div class="input">{{ Form::text('title', $file['title'], array('class' => 'text')) }}</div>
		</div>
		<div class="row">
			<div class="description">{{ Form::label('contents', 'Innehåll') }}</div>
			<div class="input">{{ Form::textarea('contents', $file['content'], array('class' => 'textarea')) }}</div>
		</div>
		<div class="row">
			<div class="description">{{ Form::label('dnr_ds', 'Dnr DS') }}</div>
			<div class="input">{{ Form::text('dnr_ds', $file['dnr_ds'], array('class' => 'text')) }}</div>
		</div>
		<div class="row">
			<div class="description">{{ Form::label('enhet', 'Enhet') }}</div>
			<div class="input">{{ Form::text('enhet', $file['enhet'], array('class' => 'text')) }}</div>
		</div>
		<div class="row">
			<div class="description">{{ Form::label('first_version', 'Ursprungsversion') }}</div>
			<div class="input">{{ Form::text('first_version', $file['first_version'], array('class' => 'text')) }}</div>
		</div>
		<div class="row">
			<div class="description">{{ Form::label('faststalld_datum', 'Fastställd datum') }}</div>
			<div class="input">{{ Form::text('faststalld_datum', $file['faststalld']['datum'], array('class' => 'text')) }}</div>
		</div>
		<div class="row">
			<div class="description">{{ Form::label('faststalld_av', 'Fastställd av') }}</div>
			<div class="input">{{ Form::text('faststalld_av', $file['faststalld']['av'], array('class' => 'text')) }}</div>
		</div>
		<div class="row">
			<div class="description">{{ Form::label('oversyn_datum', 'Översyn datum') }}</div>
			<div class="input">{{ Form::text('oversyn_datum', $file['oversyn']['datum'], array('class' => 'text')) }}</div>
		</div>
		<div class="row">
			<div class="description">{{ Form::label('oversyn_av', 'Översyn av') }}</div>
			<div class="input">{{ Form::text('oversyn_av', implode(',', $file['oversyn']['ansvarig']), array('class' => 'text')) }}</div>
		</div>
		<div class="submit">
			{{ Form::submit('Importera', array('class' => 'submit')) }}
		</div>
	</div>
    {{ Form::close() }}
@stop