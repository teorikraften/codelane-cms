@extends('master')

@section('head-title')
    Alla kategorier
@stop

@section('submenu')
	@include('includes.admin-menu')
@stop

@section('head-extra')
    {{ HTML::script('js/sort.js') }}
@stop

@section('body')
    <h1>Kategorier</h1>
    @include('includes.messages')
    <a href="{{ URL::route('admin-categories-new') }}" class="action">Lägg till ny</a>
    <div class="clear"></div>
    <div id="redips-drag">
        <table class="list">
    		<tr>
                <th class="sorttable_nosort action"></th>
    			<th class="sorttable_nosort action"></th>
    			<th>Kategori</th>
    		</tr>
        	@foreach($categories as $category)
        		<tr>
                    <td>
                        <a href="{{ URL::route('admin-categories-edit', $category->token) }}" title="Ändra">
                            {{ HTML::image('images/edit.png', 'Ändra') }}
                        </a>
                    </td>
                    <td>
                        <a href="{{ URL::route('admin-categories-delete', $category->token) }}" title="Ta bort">
                            {{ HTML::image('images/delete.png', 'Ta bort') }}
                        </a>
                    </td>
        			<td><span class="prefix">{{ $category->prefix }}</span> {{ $category->name }}</td>
        		</tr>
        	@endforeach
        </table>
    </div>
@stop