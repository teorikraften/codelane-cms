@extends('master')

@section('head-title')
	Registrera dig
@stop

@section('body')
	<div class="first-page">
		<h1>Välkommen</h1>
	    {{ Form::open(array('url' => route('post-sign-up'), 'method' => 'post'))}}
		<div class="form login">
			<a href="{{ URL::route('index') }}" class="choose-type">Logga in</a>
			<a href="{{ URL::route('sign-up') }}" class="choose-type active">Registrera dig</a>
			<div class="clear"></div>
			<div id="sign-up">
				<div class="content">
					@include('includes.messages')
					<div class="row">
						<div class="description">{{ Form::label('name', 'Namn') }}</div>
						<div class="input">{{ Form::text('name', NULL, array('class' => 'text')) }}</div>
					</div>
					<div class="row">
						<div class="description">{{ Form::label('email', 'E-postadress') }}</div>
						<div class="input">{{ Form::text('email', NULL, array('class' => 'text')) }}</div>
					</div>
					<div class="row">
						<div class="description">{{ Form::label('password', 'Lösenord') }}</div>
						<div class="input">{{ Form::password('password', array('class' => 'text')) }}</div>
					</div>
					<div class="row">
						<div class="description">{{ Form::label('password_confirmation', 'Upprepa lösenord') }}</div>
						<div class="input">{{ Form::password('password_confirmation', array('class' => 'text')) }}</div>
					</div>
					<div class="submit">
						{{ Form::submit('Registrera', array('class' => 'submit')) }}
					</div>
				</div>
			</div>
		</div>
		{{ Form::close() }}
	</div>
@stop