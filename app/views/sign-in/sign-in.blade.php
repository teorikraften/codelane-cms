@extends('master')

@section('head-extra')
	
@stop

@section('head-title')

@stop

@section('body')
	<br><br><br><br><br>
	<h1>Logga in</h1>
	{{ Form::open(array('url' => route('post-sign-in'), 'method' => 'post')) }}
	{{ $error or 'Inget fel' }}
	<table>
		<tr>
			<td>Användarnamn:</td>
			<td>{{ Form::text('email') }}</td>
		</tr>
		<tr>
			<td>Lösenord:</td>
			<td>{{ Form::password('password') }}</td>
		</tr>
		<tr>
			<td colspan="2">{{ Form::submit('Logga in') }}</td>
		</tr>
	</table>
	{{ Form::close() }}
@stop