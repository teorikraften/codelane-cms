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
    <h1>Skriv PM</h1>
   	<p>Här skriver du texten. Du kan när som helst spara det du skrivit genom att trycka på <i>Spara</i>. När du känner dig klar och vill att texten ska gå vidare till granskning trycker du på <i>Spara och markera som klar</i>.</p>
    @include('includes.messages')
    @if(isset($reviews) && count($reviews) > 0)
    	<div class="show-comments-box">
	    	<h2>Kommentarer på texten från granskare</h2>
	    	@foreach($reviews as $review)
	    		<p>
	    			<b class="{{ $review->accepted == 'true' ? 'accepted' : 'denied' }}">
	    				{{ $review->name }}, {{ User::assignmentString($review->assignment) }} ({{ $review->accepted == 'true' ? 'godkänt' : 'ej godkänt' }}):
	    			</b>
	    			<br />
	    			"{{ $review->content }}"
	    		</p>
	    	@endforeach
	    </div>
    @endif

    {{ Form::model($pm, array('action' => 'post-pm-edit', 'method' => 'post')) }}
    	{{ Form::hidden('id') }}
    	<div class="form">
			<div class="submit">
				{{ Form::submit('Spara', array('class' => 'submit', 'name' => 'save')) }}
				{{ Form::submit('Spara och markera som klart', array('class' => 'submit', 'name' => 'done')) }}
				<a href="{{ URL::route('admin-pm') }}">eller gå till PM-listan</a>
			</div>
			<div class="row">
				<div class="description">{{ Form::label('title', 'PM:ets rubrik') }}</div>
				<div class="input">{{ Form::text('title', NULL, array('class' => 'text')) }}</div>
			</div>
			<div class="row">
				<div class="description">{{ Form::label('draft', 'Innehåll') }}</div>
				<div class="input">{{ Form::textarea('draft', NULL, array('class' => 'textarea fullwidth')) }}</div>
			</div>
			<div class="submit">
				{{ Form::submit('Spara', array('class' => 'submit', 'name' => 'save')) }}
				{{ Form::submit('Spara och markera som klart', array('class' => 'submit', 'name' => 'done')) }}
			</div>
		</div>
    {{ Form::close() }}
@stop