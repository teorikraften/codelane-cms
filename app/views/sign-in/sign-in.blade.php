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
			<div class="description">{{ Form::label('email', 'E-postadress') }}</div>
			<div class="input">{{ Form::text('email', NULL, array('class' => 'text')) }}</div>
		</div>
		<div class="row">
			<div class="description">{{ Form::label('password', 'Lösenord') }}</div>
			<div class="input">{{ Form::password('password', array('class' => 'text')) }}</div>
		</div>
		<div class="row same">
			<div class="input">{{ Form::checkbox('remember', 'yes', false, array('class' => 'checkbox', 'id' => 'remember')) }}</div>
			<div class="description">{{ Form::label('remember', 'Kom ihåg mig') }}</div>
			<div class="clear"></div>
		</div>
		<div class="submit">
			{{ Form::submit('Logga in', array('class' => 'submit')) }}
		</div>
	</div>
	{{ Form::close() }}
@stop