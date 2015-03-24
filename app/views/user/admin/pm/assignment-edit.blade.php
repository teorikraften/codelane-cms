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
	        	'prePopulate' : [
	        		@foreach($owners as $owner)
	        			{'id' : '{{ $owner->id }}', 'name' : '{{ $owner->real_name . ' (' . $owner->email . ')' }}'},
	        		@endforeach
	        	]
	        });
	        $("#authors").tokenInput("/personer", {
	        	'prePopulate' : [
	        		@foreach($authors as $author)
	        			{'id' : '{{ $author->id }}', 'name' : '{{ $author->real_name . ' (' . $author->email . ')' }}'},
	        		@endforeach
	        	]
	        });
	        $("#reviewers").tokenInput("/personer", {
	        	'prePopulate' : [
	        		@foreach($reviewers as $reviewer)
	        			{'id' : '{{ $reviewer->id }}', 'name' : '{{ $reviewer->real_name . ' (' . $reviewer->email . ')' }}'},
	        		@endforeach
	        	]
	        });
	    });
    </script>
@stop

@section('submenu')
	@include('includes.admin-menu')
@stop

@section('body')
    <h1>Ändra personer på PM</h1>
    @include('includes.messages')
    {{ Form::model($pm, array('action' => 'post-pm-edit-assignments', 'method' => 'post')) }}
    	{{ Form::hidden('id') }}
	    <div class="form">
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
				{{ Form::submit('Spara personer', array('class' => 'submit')) }}
			</div>
		</div>
    {{ Form::close() }}
@stop