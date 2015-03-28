@extends('master')

@section('head-title')
    Ta bort användare
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
    <h1>Bekräfta: ta bort användare</h1>
    <p>Vill du verkligen ta bort användaren {{ $user->real_name }} ({{ $user->email }})?</p>
    @include('includes.messages')
    {{ Form::open(array('action' => 'post-admin-users-delete', 'method' => 'post')) }}
    {{ Form::hidden('user-id', $user->id) }}
    <div class="form">
		<div class="submit">
			{{ Form::submit('Ja', array('name' => 'yes', 'class' => 'submit', 'id' => 'yes-button')) }}
			{{ Form::submit('Nej', array('class' => 'submit no')) }}
		</div>
	</div>
    {{ Form::close() }}
@stop