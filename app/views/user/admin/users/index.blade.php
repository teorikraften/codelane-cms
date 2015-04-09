@extends('master')

@section('head-title')
    Alla användare
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
            $("#filter").keyup(function() { fetchData($(this).val(), "/user-filter", 'users'); });
        });
    </script>
@stop

@section('body')
    <h1>Användare</h1>
    <a href="{{ URL::route('admin-users-new') }}" class="action">Lägg till ny</a>
    <div class="clear"></div>
    @include('includes.messages')
    <p id="filter-p" style="display:none">Filtrera: {{ Form::text('filter', NULL, array('class' => 'text', 'id' => 'filter')) }}</p>
    <table class="list sortable">
        <thead>
            <tr>
                <th class="action sorttable_nosort"></th>
                <th class="action sorttable_nosort"></th>
                <th class="action sorttable_nosort"></th>
                <th>Namn</th>
                <th>E-postadress</th>
                <th>Behörighet</th>
            </tr>
        </thead>
        <tbody id="table-fill">
        	@foreach($users as $user)
        		<tr>
        			<td>
                        <a href="{{ URL::route('admin-users-edit', $user->id) }}" title="Ändra">
                            {{ HTML::image('images/edit.png', 'Ändra') }}
                        </a>
                    </td>
                    <td>
                        <a href="{{ URL::route('admin-users-delete', $user->id) }}" title="Ta bort">
                            {{ HTML::image('images/delete.png', 'Ta bort') }}
                        </a>
                    </td>
                    <td>
                        @if($user->privileges == 'unverified')
                            <a href="{{ URL::route('admin-users-verify', $user->id) }}" title="Verifiera">
                                {{ HTML::image('images/check.png', 'Verifiera') }}
                            </a>
                        @endif
                    </td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ ucfirst($user->privilegesString()) }}</td>
        		</tr>
        	@endforeach
        </tbody>
    </table>
    <div class="pagination">
        {{ $users->links() }}
    </div>
@stop