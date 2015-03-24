@extends('master')

@section('head-title')
    Verifiera användare
@stop

@section('submenu')
	@include('includes.admin-menu')
@stop

@section('body')
    <h1>Verifiera användare</h1>
    <p>Vill du verkligen verifiera användaren {{ $user->real_name }} ({{ $user->email }})?</p>
    
    <table>
		<tr>
			<td>Namn</td>
			<td>{{ $user->real_name }}</td>
		</tr>
		<tr>
			<td>E-postadress</td>
			<td>{{ $user->email }}</td>
		</tr>
    </table>

    {{ Form::open(array('action' => 'post-admin-users-verify', 'method' => 'post')) }}
    {{ Form::hidden('user-id', $user->id) }}
    <div class="form">
		<div class="submit">
			{{ Form::submit('Ja, den här personen kan vi lita på', array('class' => 'submit', 'id' => 'yes-button')) }}
			{{ Form::submit('Nej', array('class' => 'submit no')) }}
		</div>
	</div>
    {{ Form::close() }}
@stop