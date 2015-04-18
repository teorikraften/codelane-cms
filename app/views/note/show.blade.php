@extends('master')

@section('head-title')
    Visa alla anteckningar
@stop


@section('body')
    <h1>Dina anteckningar</h1>
    <a href="{{ URL::route('note-add') }}" class="btn-note">Ny anteckning</a>
    <p>Detta är dina personliga anteckningar som kan associeras med PM för att komma ihåg saker som ska göras.</p>
    @include('includes.messages')
    <table class="list">
            <tr>
                <th class="action"></th>
                <th class="action"></th>
                <th>Rubrik</th>
                <th>PM</th>
            </tr>
    @foreach($notes as $note)
            <tr>
            	<td>
                    <a href="{{ URL::route('note-edit', $note->id) }}" title="Ändra">
                        {{ HTML::image('images/edit.png', 'Ändra') }}
                    </a>
                </td>
                <td>
                    <a href="{{ URL::route('note-delete', $note->id) }}" title="Ta bort">
                        {{ HTML::image('images/delete.png', 'Ta bort')  }}
                    </a>
                </td>
            	<td>
            		<a class="clickable-title" href="{{ URL::route('note-show', $note->id) }}">{{ $note->title }}</a>
            	</td>
                <td>
                    <a class="clickable-title" href="{{ URL::route('pm-show', $note->pm['token']) }}">{{ $note->pm['title'] }}</a>
                </td>
       	    </tr>
    @endforeach
</table>
@stop