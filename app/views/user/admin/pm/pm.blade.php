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
    <a href="{{ URL::route('pm-add-assign') }}" class="action">Tilldela ett PM</a>
    <div class="clear"></div>
    @if(Auth::user()->privileges == 'admin')
        <table>
    		<tr style="font-size: 25px">
                <th></th>
                <th></th>
                <th></th>
                <th></th>
    			<th>Rubrik</th>
                <th>Personer</th>
    		</tr>
        	@foreach($pms as $pm)
        		<tr valign="top">
                    <td><a href="{{ URL::route('pm-show', $pm->token) }}">Visa</a></td>
                    <td><a href="{{ URL::route('pm-edit', $pm->token) }}">Ändra</a></td>
                    <td><a href="{{ URL::route('pm-edit-assignments', $pm->token) }}">Ändra personer</a></td>
        			<td><a href="{{ URL::route('admin-pm-delete', $pm->token) }}">Ta bort</a></td>
                    <td>{{ $pm->title }}</td>
                    <td>
                        <a href="javascript:void()" onclick="$('#pm{{ $pm->id }}').toggle();">Visa</a>
                        <table style="display: none" id="pm{{ $pm->id }}">
                        @foreach ($pm->users as $user)
                            <tr>
                                <td>{{ $user->real_name }}</td>
                                <td>({{ $user->pivot->assignment }})</td>
                            </tr>
                        @endforeach
                        </table>
                    </td>
        		</tr>
        	@endforeach
        </table>
    @endif
    <h2>Dina PM</h2>
    <table>
        <tr>
            <th></th>
            <th></th>
            <th></th>
            <th>Status</th>
            <th>Din uppgift</th>
            <th>Rubrik</th>
        </tr>
        @foreach($userPms as $pm)
            <tr>
                <td><a href="{{ URL::route('pm-show', $pm->token) }}">Visa</a></td>
                <td>
                    @if (Auth::user()->privileges == 'admin') 
                        <a href="{{ URL::route('pm-edit-assignments', $pm->token) }}">Ändra personer</a>
                    @endif
                </td>
                <td>
                    @if ($pm->pivot->assignment == 'author') 
                        <a href="{{ URL::route('pm-edit', $pm->token) }}">Ändra</a>
                    @endif
                </td>
                <th>{{ $pm->status }}</th>
                <td>{{ ucfirst(User::assignmentString($pm->pivot->assignment)) }}</td>
                <td>{{ $pm->title }}</td>
            </tr>
        @endforeach
    </table>
@stop