@extends('master')

@section('head-title')
    Alla taggar
@stop

@section('submenu')
	@include('includes.admin-menu')
@stop

@section('head-extra')
    {{ HTML::script('js/admin-filter.js') }}
    {{ HTML::script('js/sort.js') }}
    <script type="text/javascript">
        $(function() {
            $("#filter-p").show();
            $("#filter").keyup(function() { fetchData($(this).val(), "/tag-filter", 'tags'); });
        });
    </script>
@stop

@section('body')
    <h1>Taggar</h1>
    <p>Taggar är nyckelord som kan associeras med varje PM för att enklare kunna hitta det PM man söker efter. De taggar som är möjliga att tagga PM med just nu syns i listan nedan.</p>
    <a href="{{ URL::route('admin-tags-new') }}" class="action">Lägg till ny</a>
    <div class="clear"></div>
    @include('includes.messages')
    <p id="filter-p" style="display:none">Filtrera: {{ Form::text('filter', NULL, array('class' => 'text', 'id' => 'filter')) }}</p>
    <table class="list sortable">
        <thead>
    		<tr>
                <th class="sorttable_nosort action"></th>
                <th class="sorttable_nosort action"></th>
    			<th class="sorttable_nosort action"></th>
                <th>Tagg</th>
                <th>Antal PM</th>
    		</tr>
        </head>
        <tbody id="table-fill">
        	@foreach($tags as $tag)
        		<tr>
                    <td>
                        <a href="{{ URL::route('admin-tags-edit', $tag->token) }}" title="Ändra">
                            {{ HTML::image('images/edit.png', 'Ändra') }}
                        </a>
                    </td>
                    <td>
                        <a href="{{ URL::route('admin-tag-show', $tag->token) }}" title="Visa associerade PM">
                            {{ HTML::image('images/pms.png', 'Visa associerade PM') }}
                        </a>
                    </td>
        			<td>
                        <a href="{{ URL::route('admin-tags-delete', $tag->token) }}" title="Ta bort">
                            {{ HTML::image('images/delete.png', 'Ta bort') }}
                        </a>
                    </td>
                    <td>{{ $tag->name }}</td>
                    <td>{{ count($tag->pm) }}</td>
        		</tr>
        	@endforeach
        </tbody>
    </table>
    <div class="pagination">
        {{ $tags->links() }}
    </div>
@stop