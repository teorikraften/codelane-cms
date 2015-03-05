@extends('master')

@section('head-extra')
	
@stop

@section('head-title')

@stop

@section('body')
	<h1>Logga in</h1>
	{{ Form::open(array('url' => route('post-sign-in'), 'method' => 'post')) }}
	@if (count($error) > 0)
		<ul class="error">
			@foreach ($error as $e)
				<li>{{ $e }}</li>
			@endforeach
		</ul>
	@endif
	<div class="form">
		<div class="row">
			<div class="description">E-postadress:</div>
			<div class="input">{{ Form::text('email') }}</div>
		</div>
		<div class="row">
			<div class="description">Lösenord:</div>
			<div class="input">{{ Form::text('password') }}</div>
		</div>
		<div class="submit">
			{{ Form::submit('Logga in') }}
		</div>
	</div>
	{{ Form::close() }}
@stop