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
    <a href="{{ URL::route('admin-tags-new') }}" class="action">Skapa nytt</a>
    <div class="clear"></div>
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
@stop