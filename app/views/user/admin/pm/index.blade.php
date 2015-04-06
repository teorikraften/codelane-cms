@extends('master')

@section('head-title')
    Visa alla PM
@stop

@section('head-extra')
    {{ HTML::script('js/admin-filter.js') }}
@stop

@section('submenu')
	@include('includes.admin-menu')
@stop

@section('body')
    <h1>PM</h1>
    @include('includes.messages')
    @if(Auth::user()->privilegesNum() > 2 /* More than verified */)
        <a href="{{ URL::route('pm-add-assign') }}" class="action">Skapa och tilldela PM</a>
    @endif

    <div class="clear"></div>

    @if(count($userPms) > 0)
        <h2>Dina PM</h2>
        <table>
            <tr>
                <th></th>
                <th></th>
                <th></th>
                <th>Status</th>
                <th>Din uppgift</th>
                <th>Rubrik</th>
            </tr>
            @foreach($userPms as $pm)
                <tr>
                    <td><a href="{{ URL::route('pm-show', $pm->token) }}">Visa</a></td>
                    <td>
                        @if (Auth::user()->privilegesNum() > 2 /* More than verified */) 
                            <a href="{{ URL::route('pm-edit-assignments', $pm->token) }}">Ändra personer</a>
                        @endif
                    </td>
                    <td>
                        @if ($pm->pivot->assignment == 'author') 
                            <a href="{{ URL::route('pm-edit', $pm->token) }}">Ändra</a>
                        @elseif ($pm->pivot->assignment == 'reviewer') 
                            <a href="{{ URL::route('pm-review', $pm->token) }}">Granska</a>
                        @endif
                    </td>
                    <th>{{ $pm->status }}</th>
                    <td>{{ ucfirst(User::assignmentString($pm->pivot->assignment)) }}</td>
                    <td>{{ $pm->title }}</td>
                </tr>
            @endforeach
        </table>
    @endif

    @if(Auth::user()->privileges == 'admin')
        <h2>Alla PM</h2>
        <div class="form wide">
            <table>
        		<tr style="font-size: 20px">
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th>ID</th>
        			<th>Rubrik</th>
                    <th>Personer</th>
        		</tr>
                <tr>
                    <td colspan="4">Filtrera: </td>
                    <td>{{ Form::text('id-filter', NULL, array('id' => 'id-filter', 'class' => 'text short')) }}</td>
                    <td>{{ Form::text('title-filter', NULL, array('id' => 'title-filter', 'class' => 'text long')) }}</td>
                    <td>{{ Form::text('persons-filter', NULL, array('id' => 'persons-filter', 'class' => 'text middle')) }}</td>
                </tr>
                <tbody id="filter-result">
                	@foreach($pms as $pm)
                		<tr valign="top">
                            <td><a href="{{ URL::route('pm-show', $pm->token) }}" title="Visa">V</a></td>
                            <td><a href="{{ URL::route('pm-edit', $pm->token) }}" title="Ändra">Ä</a></td>
                            <td><a href="{{ URL::route('pm-edit-assignments', $pm->token) }}" title="Ändra personer">ÄP</a></td>
                			<td><a href="{{ URL::route('admin-pm-delete', $pm->token) }}" title="Ta bort">X</a></td>
                            <td>{{ $pm->id }}</td>
                            <td>{{ $pm->title }}</td>
                            <td>
                                <a href="javascript:void()" onclick="$('#pm{{ $pm->id }}').toggle();">Visa</a>
                                <table style="display: none" id="pm{{ $pm->id }}">
                                @foreach ($pm->users as $user)
                                    <tr>
                                        <td>{{ $user->real_name }}</td>
                                        <td>({{ $user->pivot->assignment }})</td>
                                    </tr>
                                @endforeach
                                </table>
                            </td>
                		</tr>
                	@endforeach
                </tbody>
            </table>
        </div>
    @endif
@stop