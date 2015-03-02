@extends('master')

@section('head-extra')
	
@stop

@section('head-title')

@stop

@section('body')
	<h1>Logga in</h1>
	{{ Form::model('pm', 567) }}
		<table>
			<tr>
				<td>Användarnamn</td>
				<td>{{ Form::text('title') }}</td>
			</tr>
			<tr>
				<td>Innehåll</td>
				<td>{{ Form::text('content') }}</td>
			</tr>
			<tr>
				<td>Lösenord</td>
				<td><input type="password" /></td>
			</tr>
			<tr>
				<td colspan="2"><input type="submit" value="Logga in" /></td>
			</tr>
		</table>
	{{ Form::close() }}
@stop