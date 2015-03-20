@extends('master')

@section('head-title')
    Alla taggar
@stop

@section('head-extra')
    <script type="text/javascript">
    	window.onload = function() {
    		document.getElementById('yes-button').focus();
    	}
    </script>
@stop

@section('submenu')
	@include('includes.admin-menu')
@stop

@section('body')
    <h1>Bekräfta: ta bort tagg</h1>
    <p>Vill du verkligen ta bort taggen {{ $tag->name }}?</p>
    {{ Form::open(array('action' => 'post-admin-tags-delete', 'method' => 'post')) }}
    {{ Form::hidden('tag-token', $tag->token) }}
    <div class="form">
		<div class="submit">
			{{ Form::submit('Ja', array('name' => 'yes', 'class' => 'submit', 'id' => 'yes-button')) }}
			{{ Form::submit('Nej', array('class' => 'submit no')) }}
		</div>
	</div>
    {{ Form::close() }}
@stop