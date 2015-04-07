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
    <h1>PM för taggen: {{ $tag->name }}</h1>
    <p>Taggar är nyckelord som kan associeras med varje PM för att enklare kunna hitta det PM man söker efter. De taggar som är möjliga att tagga PM med just nu syns i listan nedan.</p>
    @include('includes.messages')
    <div class="clear"></div>
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
@stop