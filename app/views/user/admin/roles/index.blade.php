@extends('master')

@section('head-title')
    Alla roller
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
            $("#filter").keyup(function() { fetchData($(this).val(), "/role-filter", 'roles'); });
        });
    </script>
@stop

@section('body')
    <h1>Roller</h1>
    <a href="{{ URL::route('admin-roles-new') }}" class="action">Lägg till ny</a>
    <div class="clear"></div>
    @include('includes.messages')
    <p id="filter-p" style="display:none">Filtrera: {{ Form::text('filter', NULL, array('class' => 'text', 'id' => 'filter')) }}</p>
    <table class="list sortable">
		<thead>
            <tr>
    			<th class="action sorttable_nosort"></th>
                <th class="action sorttable_nosort"></th>
                <th>Roll</th>
                <th>Antal användare</th>
    		</tr>
        </head>
        <tbody id="table-fill">
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
                    <td>{{ count($role->users) }}</td>
        		</tr>
        	@endforeach
        </tbody>
    </table>
    <div class="pagination">
        {{ $roles->links() }}
    </div>
@stop