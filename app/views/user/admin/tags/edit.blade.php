@extends('master')

@section('head-title')
    Alla taggar
@stop

@section('head-extra')
    <script type="text/javascript">
    	window.onload = function() {
    		document.getElementById('name').focus();
    	}
    </script>
@stop

@section('submenu')
	@include('includes.admin-menu')
@stop

@section('body')
    <h1>Ändra tagg</h1>
    @include('includes.messages')
    <p>Du håller på att ändra taggen {{ $tag->name }}.</p>
    {{ Form::model($tag, array('action' => 'post-admin-tags-edit', 'method' => 'post')) }}
    {{ Form::hidden('token') }}
    <div class="form">
		<div class="row">
            <div class="description">{{ Form::label('name', 'Taggens nya namn') }}</div>
            <div class="input">{{ Form::text('name', NULL, array('class' => 'text')) }}</div>
        </div>
        <div class="submit">
			{{ Form::submit('Spara', array('class' => 'submit')) }}
		</div>
	</div>
    {{ Form::close() }}
@stop