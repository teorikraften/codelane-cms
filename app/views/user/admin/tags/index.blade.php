@extends('master')

@section('head-title')
    Alla taggar
@stop

@section('submenu')
	@include('includes.admin-menu')
@stop

@section('head-extra')
    {{ HTML::script('js/sort.js') }}
@stop

@section('body')
    <h1>Taggar</h1>
    @include('includes.messages')
    <a href="{{ URL::route('admin-tags-new') }}" class="action">Lägg till ny</a>
    <div class="clear"></div>
    <table class="list sortable">
		<tr>
			<th class="sorttable_nosort action"></th>
			<th class="sorttable_nosort action"></th>
			<th>Tagg</th>
		</tr>
    	@foreach($tags as $tag)
    		<tr>
    			<td>
                    <a href="{{ URL::route('admin-tags-edit', $tag->token) }}" title="Ändra">
                        {{ HTML::image('images/edit.png', 'Ändra') }}
                    </a>
                </td>
    			<td>
                    <a href="{{ URL::route('admin-tags-delete', $tag->token) }}" title="Ta bort">
                        {{ HTML::image('images/delete.png', 'Ta bort') }}
                    </a>
                </td>
    			<td>{{ $tag->name }}</td>
    		</tr>
    	@endforeach
    </table>
@stop