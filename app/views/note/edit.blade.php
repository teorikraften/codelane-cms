@extends('master')

@section('head-title')
    Anteckning {{ $note->title }}
@stop

@section('body')
@include('includes.messages')
    {{ Form::model($note, array('action' => 'post-note-edit', 'method' => 'post')) }}
    	{{ Form::hidden('id') }}
    	<div class="form">
			<div class="row">
				<div class="description">{{ Form::label('title', 'Titel') }}</div>
				<div class="input">{{ Form::text('title', NULL, array('class' => 'text')) }}</div>
			</div>
            <div class="row">
                <div class="description">{{ Form::label('content', 'Innehåll') }}</div>
                <div class="input-note">{{ Form::textarea('content', NULL, array('class' => 'note-textarea')) }}</div>
            </div>
			<div class="submit">
				{{ Form::submit('Spara ändringar', array('class' => 'submit', 'name' => 'save')) }}
			</div>
		</div>
    {{ Form::close() }}
@stop