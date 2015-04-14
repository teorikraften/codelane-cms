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
	        $("#tags").tokenInput("/taggar", {
	        	'prePopulate' : [
	        		@foreach($tags as $tag)
	        			{'id' : {{ $tag->id }}, 'name' : '{{ $tag->name }}'},
	        		@endforeach
	        	]
	        });
	    });
	    $(document).ready(function() {
	        $("#roles").tokenInput("/roller", {
	        	'prePopulate' : [
	        		@foreach($roles as $role)
	        			{'id' : {{ $role->id }}, 'name' : '{{ $role->name }}'},
	        		@endforeach
	        	]
	        });
	    });

	  	$(function() {
	    	$("#validityYear").datepicker({
		        showOtherMonths: true,
		        dayNamesMin: ['Sön', 'Mån', 'Tis', 'Ons', 'Tor', 'Fre', 'Lör'],
		        monthNames: [ "Januari", "Februari", "Mars", "April",
                   "Maj", "Juni", "Juli", "Augusti", "September",
                   "Oktober", "November", "December" ],
		        firstDay: 1,
		        nextText: 'Nästa',
		        prevText: 'Föreg.',
		        dateFormat: 'yy-mm-dd',
		        onSelect: function() {
		        	$("#validityTypeDate").prop('checked', true);
		        },
		        minDate: 0,
		        maxDate: "+5y",
	    	});
	    	$("#validityTime").change(function() {
	        	$("#validityTypeTime").prop('checked', true);
	        });
	  	});
  </script>
@stop

@section('submenu')
	@include('includes.admin-menu')
@stop

@section('body')
    <h1>Tagga och tilldela roller</h1>
    <p>På den här sidan bestämmer du vilka taggar och roller som ska associeras med PM:et "{{ $pm->title }}".</p>
    @include('includes.messages')
    {{ Form::open(array('action' => 'post-tag', 'method' => 'post')) }}
    	{{ Form::hidden('id', $pm->id) }}
	    <div class="form wide">
			<div class="row">
				<div class="description">{{ Form::label('tags', 'Taggar') }}</div>
				<div class="input">
					{{ Form::text('tags', NULL, array('class' => 'text')) }}
				</div>
			</div>
			<div class="row">
				<div class="description">{{ Form::label('roles', 'Roller') }}</div>
				<div class="input">
					{{ Form::text('roles', NULL, array('class' => 'text')) }}
				</div>
			</div>
			<div class="submit">
				{{ Form::submit('Spara', array('class' => 'submit')) }}
			</div>
		</div>
    {{ Form::close() }}
@stop