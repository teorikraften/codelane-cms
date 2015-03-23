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
	        $("#responsible").tokenInput("/personer", {
	        	'prePopulate' : [{'id' : '{{ Auth::user()->id }}', 'name' : '{{ Auth::user()->real_name . ' (' . Auth::user()->email . ')' }}'}]
	        });
	        $("#authors").tokenInput("/personer");
	        $("#reviewers").tokenInput("/personer");
	    });
    </script>
@stop

@section('submenu')
	@include('includes.admin-menu')
@stop

@section('body')
    <h1>Skapa och tilldela PM</h1>
    {{ Form::open(array('action' => 'post-pm-add-assign', 'method' => 'post')) }}
	    <div class="form">
			<div class="row">
				<div class="description">{{ Form::label('title', 'PM:ets rubrik') }}</div>
				<div class="input">{{ Form::text('title', NULL, array('class' => 'text')) }}</div>
			</div>
			<div class="row">
				<div class="description">{{ Form::label('responsible', 'Ansvarig') }}</div>
				<div class="input">{{ Form::text('responsible', Auth::user()->real_name, array('class' => 'text')) }}</div>
			</div>
			<div class="row">
				<div class="description">{{ Form::label('authors', 'Författare') }}</div>
				<div class="input">{{ Form::text('authors', NULL, array('class' => 'text')) }}</div>
			</div>
			<div class="row">
				<div class="description">{{ Form::label('reviewers', 'Granskare') }}</div>
				<div class="input">{{ Form::text('reviewers', NULL, array('class' => 'text')) }}</div>
			</div>
			<div class="submit">
				{{ Form::submit('Lägg till PM', array('class' => 'submit')) }}
			</div>
		</div>
    {{ Form::close() }}
@stop