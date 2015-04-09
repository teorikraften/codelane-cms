@extends('master')

@section('head-title')
    Visa alla PM
@stop

@section('head-extra')
    {{ HTML::script('js/admin-filter.js') }}
    {{ HTML::script('js/sort.js') }}
    <script type="text/javascript">
        $(function() {
            $("#filter-p").show();
            $("#filter").keyup(function() { 
                fetchData($(this).val(), "/pm-filter", 'pms'); 
            });
        });
    </script>
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
                <th class="action"></th>
                <th class="action"></th>
                <th>Rubrik</th>
                <th>Dina uppgifter</th>
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
                        <a href="{{ URL::route('pm-info', $pm->token) }}" title="Visa">
                            {{ HTML::image('images/information.png', 'Information') }}
                        </a>
                    </td>
                    <td>
                        @if (in_array('reminder', $userAssignments[$pm->id]) || Auth::user()->privilegesNum() > 2 /* More than verified */) 
                            <a href="{{ URL::route('pm-edit-assignments', $pm->token) }}" title="Ändra personer">
                                {{ HTML::image('images/persons.png', 'Ändra personer') }}
                            </a>
                        @endif
                    </td>
                    <td>
                        @if (in_array('author', $userAssignments[$pm->id]) && ($pm->status == 'assigned' || $pm->status == 'revision-assigned'))
                            <a href="{{ URL::route('pm-edit', $pm->token) }}" title="Ändra">
                                {{ HTML::image('images/edit.png', 'Ändra') }}
                            </a>
                        @endif
                    </td>
                    <td>
                        @if (in_array('reviewer', $userAssignments[$pm->id]) && ($pm->status == 'assigned' || $pm->status == 'revision-assigned')) 
                            <a href="{{ URL::route('pm-review', $pm->token) }}" title="Granska">
                                {{ HTML::image('images/review.png', 'Granska') }}
                            </a>
                        @elseif (in_array('end-reviewer', $userAssignments[$pm->id]) && ($pm->status == 'reviewed' || $pm->status == 'revision-reviewed'))
                            <a href="{{ URL::route('pm-end-review', $pm->token) }}" title="Slutgranska">
                                {{ HTML::image('images/end-review.png', 'Slutgranska') }}
                            </a>
                        @endif
                    </td>
                    <td>
                        @if (in_array('settler', $userAssignments[$pm->id]) && ($pm->status == 'end-reviewed' || $pm->status == 'end-reviewed')) 
                            <a href="{{ URL::route('pm-settle', $pm->token) }}" title="Fastställ">
                                {{ HTML::image('images/settle.png', 'Fastställ') }}
                            </a>
                        @endif
                    </td>
                    <td>{{ $pm->title }}</td>
                    <td>
                        @foreach($userAssignments[$pm->id] as $ua)<?php
                            echo $ua === reset($userAssignments[$pm->id]) ? ucfirst(User::assignmentString($ua)) : ($ua === end($userAssignments[$pm->id]) ? ', ' . User::assignmentString($ua) : ', ' . User::assignmentString($ua));
                        ?>@endforeach
                    </td>
                    <td>{{ $pm->status }}</td>
                </tr>
            @endforeach
        </table>
    @else
        <p>Om du tilldelas en uppgift eller på ett annat sätt blir kopplad till ett PM kommer det dyka upp här.</p>
    @endif

    @if(Auth::user()->privileges == 'admin')
        <h2>Alla PM</h2>
        <p id="filter-p" style="display:none">
            Filtrera: {{ Form::text('filter', NULL, array('class' => 'text', 'id' => 'filter')) }}
        </p>
        <div class="form wide">
            <table class="list sortable">
        		<thead>
                    <tr>
                        <th class="action sorttable_nosort"></th>
                        <th class="action sorttable_nosort"></th>
                        <th class="action sorttable_nosort"></th>
                        <th class="action sorttable_nosort"></th>
                        <th>ID</th>
            			<th>Rubrik</th>
                        <th>Personer</th>
            		</tr>
                </thead>
                <tbody id="table-fill">
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
                                        <td>{{ $user->name }}</td>
                                        <td>({{ $user->pivot->assignment }})</td>
                                    </tr>
                                @endforeach
                                </table>
                            </td>
                		</tr>
                	@endforeach
                </tbody>
            </table>
            <div class="pagination" id="filter-pag">
                {{ $pms->links() }}
            </div>
        </div>
    @endif
@stop