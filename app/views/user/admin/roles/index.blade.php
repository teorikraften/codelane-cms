@extends('master')

@section('head-title')
    Alla roller
@stop

@section('submenu')
	@include('includes.admin-menu')
@stop

@section('body')
    <h1>Roller</h1>
    @include('includes.messages')
    <a href="{{ URL::route('admin-roles-new') }}" class="action">Lägg till ny</a>
    <div class="clear"></div>
    <table>
		<tr>
			<th></th>
			<th></th>
			<th>Roll</th>
		</tr>
    	@foreach($roles as $role)
    		<tr>
    			<td><a href="{{ URL::route('admin-roles-edit', $role->id) }}">Ändra</a></td>
    			<td><a href="{{ URL::route('admin-roles-delete', $role->id) }}">Ta bort</a></td>
    			<td>{{ $role->name }}</td>
    		</tr>
    	@endforeach
    </table>
@stop