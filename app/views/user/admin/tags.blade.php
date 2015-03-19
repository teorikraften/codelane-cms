@extends('master')

@section('head-title')
    Alla taggar
@stop

@section('submenu')
	@include('includes.admin-menu')
@stop

@section('body')
    <h1>Taggar</h1>
    <a href="{{ URL::route('admin-tags-new') }}" class="action">Lägg till ny</a>
    <div class="clear"></div>
    <table>
		<tr>
			<th></th>
			<th></th>
			<th>Tagg</th>
		</tr>
    	@foreach($tags as $tag)
    		<tr>
    			<td><a href="">Ändra</a></td>
    			<td><a href="{{ URL::route('admin-tags-delete', $tag->token) }}">Ta bort</a></td>
    			<td>{{ $tag->name }}</td>
    		</tr>
    	@endforeach
    </table>
@stop