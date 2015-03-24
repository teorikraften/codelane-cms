@extends('master')

@section('head-title')
    Alla användare
@stop

@section('submenu')
	@include('includes.admin-menu')
@stop

@section('body')
    <h1>Ny användare</h1>
    @include('includes.messages')
    {{ Form::open(array('action' => 'post-admin-users-new', 'method' => 'post')) }}
	    <div class="form">
			<div class="row">
				<div class="description">{{ Form::label('privileges', 'Användarens behörighetsnivå') }}</div>
				<div class="input">
					{{ Form::select('privileges', array('admin' => 'Systemadministratör', 'pm-admin' => 'PM-ansvarig', 'verified' => 'Verifierad', 'unverified' => 'Overifierad'), array('class' => 'text')) }}
				</div>
			</div>
			<div class="row">
				<div class="description">{{ Form::label('real_name', 'Användarens namn') }}</div>
				<div class="input">{{ Form::text('real_name', NULL, array('class' => 'text')) }}</div>
			</div>
			<div class="row">
				<div class="description">{{ Form::label('name', 'Användarens e-postadress') }}</div>
				<div class="input">{{ Form::text('email', NULL, array('class' => 'text')) }}</div>
				<p>
					Ett e-postmeddelande kommer skickas till ovan angivna adress när du trycker på Spara användare.
				</p>
			</div>
			<div class="submit">
				{{ Form::submit('Spara användare', array('class' => 'submit')) }}
			</div>
		</div>
    {{ Form::close() }}
@stop