@extends('master')

@section('head-title')
    Alla PM
@stop

@section('submenu')
	@include('includes.admin-menu')
@stop

@section('body')
    <h1>PM</h1>
    @include('includes.messages')
    <a href="{{ URL::route('pm-add') }}" class="action">Skapa nytt</a>
    <a href="{{ URL::route('pm-add-assign') }}" class="action">Låt någon annan skriva ett PM</a>
    <div class="clear"></div>
    @if(Auth::user()->privileges == 'admin')
        <table>
    		<tr>
                <th></th>
                <th></th>
    			<th></th>
    			<th>Rubrik</th>
    		</tr>
        	@foreach($pms as $pm)
        		<tr>
                    <td><a href="{{ URL::route('pm-show', $pm->token) }}">Visa</a></td>
                    <td><a href="{{ URL::route('pm-edit', $pm->token) }}">Ändra</a></td>
        			<td><a href="{{ URL::route('admin-pm-delete', $pm->token) }}">Ta bort</a></td>
        			<td>{{ $pm->title }}</td>
        		</tr>
        	@endforeach
        </table>
    @endif
    <h2>Dina PM</h2>
    <table>
        <tr>
            <th></th>
            <th></th>
            <th>Din uppgift</th>
            <th>Rubrik</th>
        </tr>
        @foreach($userPms as $pm)
            <tr>
                <td><a href="{{ URL::route('pm-show', $pm->token) }}">Visa</a></td>
                <td><a href="{{ URL::route('pm-edit', $pm->token) }}">Ändra</a></td>
                <td>{{ ucfirst(User::assignmentString($pm->pivot->assignment)) }}</td>
                <td>{{ $pm->title }}</td>
            </tr>
        @endforeach
    </table>
@stop