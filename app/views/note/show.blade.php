@extends('master')

@section('head-title')
    Anteckningar
@stop


@section('body')
@include('includes.messages')
    <a href="{{ URL::route('note-add') }}" class="btn-note">Ny anteckning</a>
    <br>
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
                    <a href="{{ URL::route('note-delete', $note->id) }}" title="Ta bort">
                        {{ HTML::image('images/delete.png', 'Ta bort')  }}
                    </a>
                </td>
            	<td>
                    <a href="{{ URL::route('note-edit', $note->id) }}" title="Ändra">
                        {{ HTML::image('images/edit.png', 'Ändra') }}
                    </a>
                </td>
            	<td>
            		<a href="{{ URL::route('note-show', $note->id) }}">{{ $note->title }}</a>
            	</td>
                <td>
                    <a href="{{ URL::route('pm-show', $note->pm['token']) }}">{{ $note->pm['title'] }}</a>
                </td>
       	    </tr>
    @endforeach
</table>
@stop