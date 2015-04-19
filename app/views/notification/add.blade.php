@extends('master')

@section('head-title')
    Nytt meddelande
@stop

@section('body')
<h1>Nytt meddelande</h1>
@include('includes.messages')
{{ Form::open(array('action' => 'post-notification-add', 'method' => 'post')) }}
    	<div class="form">
			<div class="row">
				<div class="description">{{ Form::label('title', 'Titel') }}</div>
				<div class="input-note-title">{{ Form::text('title', NULL, array('class' => 'text')) }}</div>
			</div>
			 <div class="row">
                <div class="description">{{ Form::label('pm', 'Associera med PM') }}</div>
                <div class="input-note-title">{{ Form::text('pm', NULL, array('class' => 'text')) }}</div>
            </div>
            <div class="row">
                <div class="description">{{ Form::label('person', 'Till') }}</div>
                <div class="input-note-title">{{ Form::text('person', $person, array('class' => 'text')) }}</div>
            </div>
            <div class="row">
                <div class="description">{{ Form::label('content', 'Innehåll') }}</div>
                <div class="input-note-content">{{ Form::textarea('content', NULL, array('class' => 'note-textarea')) }}</div>
            </div>
			<div class="submit">
				{{ Form::submit('Skicka', array('class' => 'submit', 'name' => 'save')) }}
			</div>
		</div>
{{ Form::close() }}
@stop