@extends('master')

@section('head-title')
    Alla kategorier
@stop

@section('submenu')
	@include('includes.admin-menu')
@stop

@section('body')
    <h1>Kategorier</h1>
    @include('includes.messages')
    <a href="{{ URL::route('admin-categories-new') }}" class="action">Lägg till ny</a>
    <div class="clear"></div>
    <table>
		<tr>
			<th></th>
			<th></th>
			<th>Kategori</th>
		</tr>
    	@foreach($categories as $category)
    		<tr>
    			<td><a href="{{ URL::route('admin-categories-edit', $category->token) }}">Ändra</a></td>
    			<td><a href="{{ URL::route('admin-categories-delete', $category->token) }}">Ta bort</a></td>
    			<td>{{ $category->name }}</td>
    		</tr>
    	@endforeach
    </table>
@stop