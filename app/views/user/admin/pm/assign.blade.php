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
	        	'prePopulate' : [{'id' : {{ Auth::user()->id }}, 'name' : '{{ Auth::user()->name . ' (' . Auth::user()->email . ')' }}'}]
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
    <p>På den här sidan fyller du i information om det PM som ska skapas. Du anger rubriken och vilka personer som ska göra vad. När du sparar kommer samtliga personer få ett e-postmeddelande som berättar de tilldelats en uppgift på detta PM och de kan se det på sin egen sida.</p>
    @include('includes.messages')
    {{ Form::open(array('action' => 'post-pm-add-assign', 'method' => 'post')) }}
	    <div class="form wide">
			<div class="row">
				<div class="description">{{ Form::label('title', 'PM:ets rubrik') }}</div>
				<div class="input">{{ Form::text('title', NULL, array('class' => 'text')) }}</div>
			</div>
			<div class="row">
				<div class="description">{{ Form::label('creator', 'Upprättare') }}</div>
				<div class="input">
					{{ Form::text('creator', Auth::user()->name, array('class' => 'text')) }}
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