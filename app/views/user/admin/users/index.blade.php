@extends('master')

@section('head-title')
    Alla användare
@stop

@section('submenu')
	@include('includes.admin-menu')
@stop

@section('body')
    <h1>Användare</h1>
    @include('includes.messages')
    <a href="{{ URL::route('admin-users-new') }}" class="action">Lägg till ny</a>
    <div class="clear"></div>
    <table>
		<tr>
			<th></th>
            <th></th>
            <th></th>
            <th>Behörighet</th>
            <th>Namn</th>
            <th>E-postadress</th>
		</tr>
    	@foreach($users as $user)
    		<tr>
    			<td><a href="{{ URL::route('admin-users-edit', $user->id) }}">Ändra</a></td>
                <td><a href="{{ URL::route('admin-users-delete', $user->id) }}">Ta bort</a></td>
                <td>
                    @if($user->privileges == 'unverified')
                        <a href="{{ URL::route('admin-users-verify', $user->id) }}">Verifiera</a></td>
                    @endif
                <td>{{ ucfirst($user->privileges()) }}</td>
                <td>{{ $user->real_name }}</td>
                <td>{{ $user->email }}</td>
    		</tr>
    	@endforeach
    </table>
@stop