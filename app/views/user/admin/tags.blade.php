@extends('master')

@section('head-title')
    Alla taggar
@stop

@section('submenu')
	@include('includes.admin-menu')
@stop

@section('body')
    <h1>Taggar</h1>
    <table>
		<tr>
			<th></th>
			<th></th>
			<th>Tagg</th>
		</tr>
    	@foreach($tags as $tag)
    		<tr>
    			<td><a href="">Ändra</a></td>
    			<td><a href="">Ta bort</a></td>
    			<td>{{ $tag->name }}</td>
    		</tr>
    	@endforeach
    </table>
@stop