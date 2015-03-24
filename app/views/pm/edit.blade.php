@extends('master')

@section('head-title')
    Ändra PM: {{ $pm->title }}
@stop

@section('head-extra')
	<script type="text/javascript" src="/js/tinymce/tinymce.min.js"></script>
    <script type="text/javascript">
		tinymce.init({
	        selector: "textarea",
	        content_css: "/styles/tinymce_window.css"
		});
	</script>
	<style type="text/css">
		div.form {
			max-width: 100%;
		}
	</style>
	<?php // TODO Inline - go away! ?>

	<script type="text/javascript" src="/js/jquery.tokeninput.js"></script>

    <link rel="stylesheet" href="/styles/token-input.css" type="text/css" />
    <link rel="stylesheet" href="/styles/token-input-facebook.css" type="text/css" />

    <script type="text/javascript">
	    $(document).ready(function() {
	        $("#tags").tokenInput("/taggar", {
	        	'prePopulate' : [
	        		@foreach($pm->tags as $tag)
	        		{'id' : '{{ $tag->id }}', 'name' : '{{ $tag->name }}'},
	        		@endforeach
	        	]
	        });
	    });
    </script>
@stop

@section('body')
    <h1>Ändra PM</h1>
    {{ Form::model($pm, array('action' => 'post-pm-edit', 'method' => 'post')) }}
    	{{ Form::hidden('id') }}
    	<div class="form">
			<div class="submit">
				{{ Form::submit('Spara PM', array('class' => 'submit')) }}
			</div>
			<div class="row">
				<div class="description">{{ Form::label('title', 'PM:ets rubrik') }}</div>
				<div class="input">{{ Form::text('title', NULL, array('class' => 'text')) }}</div>
			</div>
			<div class="row">
				<div class="description">{{ Form::label('content', 'Innehåll') }}</div>
				<div class="input">{{ Form::textarea('content', NULL, array('class' => 'textarea fullwidth')) }}</div>
			</div>
			<div class="row">
				<div class="description">{{ Form::label('tags', 'Taggar') }}</div>
				<div class="input">{{ Form::text('tags', NULL, array('class' => 'text')) }}</div>
			</div>
			<div class="submit">
				{{ Form::submit('Spara PM', array('class' => 'submit')) }}
			</div>
		</div>
    {{ Form::close() }}
@stop