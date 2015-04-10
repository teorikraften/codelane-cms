@extends('master')

@section('head-title')
    Visa alla PM
@stop

@section('head-extra')
    {{ HTML::script('js/admin-filter.js') }}
    {{ HTML::script('js/sort.js') }}
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
        <table class="list">
            <tr>
                <th class="action"></th>
                <th class="action"></th>
                <th class="action"></th>
                <th class="action"></th>
                <th>Rubrik</th>
                <th>Din uppgift</th>
                <th>Status</th>
            </tr>
            @foreach($userPms as $pm)
                <tr>
                    <td>
                        <a href="{{ URL::route('pm-show', $pm->token) }}" title="Visa">
                            {{ HTML::image('images/view.png', 'Visa') }}
                        </a>
                    </td>
                    <td>
                        @if (Auth::user()->privilegesNum() > 2 /* More than verified */) 
                            <a href="{{ URL::route('pm-edit-assignments', $pm->token) }}" title="Ändra personer">
                                {{ HTML::image('images/persons.png', 'Ändra personer') }}
                            </a>
                        @endif
                    </td>
                    <td>
                        @if ($pm->pivot->assignment == 'author') 
                            <a href="{{ URL::route('pm-edit', $pm->token) }}" title="Ändra">{{ HTML::image('images/edit.png', 'Ändra') }}</a>
                        @endif
                    </td>
                    <td>
                        @if ($pm->pivot->assignment == 'reviewer') 
                            <a href="{{ URL::route('pm-review', $pm->token) }}" title="Granska">{{ HTML::image('images/review.png', 'Granska') }}</a>
                        @endif
                    </td>
                    <td>{{ $pm->title }}</td>
                    <td>{{ ucfirst(User::assignmentString($pm->pivot->assignment)) }}</td>
                    <td>{{ $pm->status }}</td>
                </tr>
            @endforeach
        </table>
    @endif

    @if(Auth::user()->privileges == 'admin')
        <h2>Alla PM</h2>
        <div class="form wide">
            <table class="list sortable">
        		<tr>
                    <th class="action sorttable_nosort"></th>
                    <th class="action sorttable_nosort"></th>
                    <th class="action sorttable_nosort"></th>
                    <th class="action sorttable_nosort"></th>
                    <th>ID</th>
        			<th>Rubrik</th>
                    <th>Personer</th>
        		</tr>
            	@foreach($pms as $pm)
            		<tr valign="top">
                        <td>
                            <a href="{{ URL::route('pm-show', $pm->token) }}" title="Visa">
                                {{ HTML::image('images/view.png', 'Visa')  }}
                            </a>
                        </td>
                        <td>
                            <a href="{{ URL::route('pm-edit', $pm->token) }}" title="Ändra">
                                {{ HTML::image('images/edit.png', 'Ändra')  }}
                            </a>
                        </td>
                        <td>
                            <a href="{{ URL::route('pm-edit-assignments', $pm->token) }}" title="Ändra personer">
                                {{ HTML::image('images/persons.png', 'Ändra personer')  }}
                            </a>
                        </td>
            			<td>
                            <a href="{{ URL::route('admin-pm-delete', $pm->token) }}" title="Ta bort">
                                {{ HTML::image('images/delete.png', 'Ta bort')  }}
                            </a>
                        </td>
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
            </table>
        </div>
    @endif
@stop