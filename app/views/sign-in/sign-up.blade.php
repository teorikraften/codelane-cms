@extends('master')

@section('head-title')
Registrera dig
@stop

@section('body')
<br><br><br><br><br><br><br>
<h1>Registrera</h1>
{{ Form::open(array('url' => route('post-sign-up'), 'method' => 'post'))}}
{{ $error or 'Inget fel'}}
<table>
	<tr>
		<td>Namn</td>
		<td> {{ Form::text('name', $input['name'])}}</td>
	</tr>
	<tr>
		<td>Email</td>
		<td>{{ Form::email('email', $input['email']) }}</td>
	</tr>
	<tr>
		<td>Password</td>
		<td>{{ Form::password('password') }}</td>
	</tr>
	<tr>
		<td> {{ Form::submit('Registrera dig') }}</td>
	</tr>
</table>
 {{ Form::close()}}
@stop