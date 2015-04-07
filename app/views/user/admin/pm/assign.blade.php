@extends('master')

@section('head-title')
    Alla användare
@stop

@section('head-extra')
	<script type="text/javascript" src="/js/jquery.tokeninput.js"></script>

    <link rel="stylesheet" href="/styles/token-input.css" type="text/css" />
    <link rel="stylesheet" href="/styles/token-input-facebook.css" type="text/css" />

    <script type="text/javascript">
	    $(document).ready(function() {
	        $("#creator").tokenInput("/personer", {
	        	'prePopulate' : [{'id' : '{{ Auth::user()->id }}', 'name' : '{{ Auth::user()->real_name . ' (' . Auth::user()->email . ')' }}'}]
	        });
	        $("#authors").tokenInput("/personer");
	        $("#settler").tokenInput("/personer");
	        $("#reviewers").tokenInput("/personer");
	        $("#end-reviewer").tokenInput("/personer");
	        $("#reminder").tokenInput("/personer");
	    });
    </script>
@stop

@section('submenu')
	@include('includes.admin-menu')
@stop

@section('body')
    <h1>Skapa och tilldela PM</h1>
    @include('includes.messages')
    {{ Form::open(array('action' => 'post-pm-add-assign', 'method' => 'post')) }}
	    <div class="form">
			<div class="row">
				<div class="description">{{ Form::label('title', 'PM:ets rubrik') }}</div>
				<div class="input">{{ Form::text('title', NULL, array('class' => 'text')) }}</div>
			</div>
			<div class="row">
				<div class="description">{{ Form::label('creator', 'Upprättare') }}</div>
				<div class="input">
					{{ Form::text('creator', Auth::user()->real_name, array('class' => 'text')) }}
				</div>
			</div>
			<div class="row">
				<div class="description">{{ Form::label('authors', 'Inläggare') }}</div>
				<div class="input">
					{{ Form::text('authors', NULL, array('class' => 'text')) }}
				</div>
			</div>
			<div class="row">
				<div class="description">{{ Form::label('settler', 'Fastställare') }}</div>
				<div class="input">
					{{ Form::text('settler', NULL, array('class' => 'text')) }}
				</div>
			</div>
			<div class="row">
				<div class="description">{{ Form::label('reviewers', 'Granskare') }}</div>
				<div class="input">{{ Form::text('reviewers', NULL, array('class' => 'text')) }}</div>
			</div>
			<div class="row">
				<div class="description">{{ Form::label('end-reviewer', 'Slutgranskare') }}</div>
				<div class="input">{{ Form::text('end-reviewer', NULL, array('class' => 'text')) }}</div>
			</div>
			<div class="row">
				<div class="description">{{ Form::label('reminder', 'Påminnare') }}</div>
				<div class="input">{{ Form::text('reminder', NULL, array('class' => 'text')) }}</div>
			</div>
			<div class="submit">
				{{ Form::submit('Lägg till PM', array('class' => 'submit')) }}
			</div>
		</div>
    {{ Form::close() }}
@stop