@extends('master')

@section('head-title')
    Anteckning {{ $note->title }}
@stop


@section('body')
    {{ Form::model($note, array('action' => 'post-note-edit', 'method' => 'post')) }}
    	<div class="form">
			<div class="row">
				<div class="description">{{ Form::label('title', 'Titel') }}</div>
				<div class="input">{{ Form::text('title', NULL, array('class' => 'text')) }}</div>
			</div>
            <div class="row">
                <div class="description">{{ Form::label('note', 'Innehåll') }}</div>
                <div class="input-note">{{ Form::textarea('content', $note->content, array('class' => 'note-textarea')) }}</div>
            </div>
			<div class="submit">
				{{ Form::submit('Spara', array('class' => 'submit', 'name' => 'save')) }}
			</div>
		</div>
    {{ Form::close() }}
@stop