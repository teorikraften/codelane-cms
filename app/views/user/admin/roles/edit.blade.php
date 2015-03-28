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
    <h1>Ändra roll</h1>
    <p>Du håller på att ändra rollen {{ $role->name }}.</p>
    @include('includes.messages')
    {{ Form::model($role, array('action' => 'post-admin-roles-edit', 'method' => 'post')) }}
    {{ Form::hidden('id') }}
    <div class="form">
		<div class="row">
            <div class="description">{{ Form::label('name', 'Rollens nya benämning') }}</div>
            <div class="input">{{ Form::text('name', NULL, array('class' => 'text')) }}</div>
        </div>
        <div class="submit">
			{{ Form::submit('Spara', array('class' => 'submit')) }}
		</div>
	</div>
    {{ Form::close() }}
@stop