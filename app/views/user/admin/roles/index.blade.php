@extends('master')

@section('head-title')
    Alla roller
@stop

@section('submenu')
	@include('includes.admin-menu')
@stop

@section('head-extra')
    {{ HTML::script('js/sort.js') }}
@stop

@section('body')
    <h1>Roller</h1>
    @include('includes.messages')
    <a href="{{ URL::route('admin-roles-new') }}" class="action">Lägg till ny</a>
    <div class="clear"></div>
    <table class="list sortable">
		<tr>
			<th class="action sorttable_nosort"></th>
			<th class="action sorttable_nosort"></th>
			<th>Roll</th>
		</tr>
    	@foreach($roles as $role)
    		<tr>
    			<td>
                    <a href="{{ URL::route('admin-roles-edit', $role->id) }}" title="Ändra">
                        {{ HTML::image('images/edit.png', 'Ändra') }}
                    </a>
                </td>
    			<td>
                    <a href="{{ URL::route('admin-roles-delete', $role->id) }}" title="Ta bort">
                        {{ HTML::image('images/delete.png', 'Ta bort') }}
                    </a>
                </td>
    			<td>{{ $role->name }}</td>
    		</tr>
    	@endforeach
    </table>
@stop