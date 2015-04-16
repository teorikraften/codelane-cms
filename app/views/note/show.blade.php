@extends('master')

@section('head-title')
    Anteckningar
@stop


@section('body')
@include('includes.messages')
    @foreach($notes as $note)
                <tr>
                	<td>
                        <a href="{{ URL::route('note-edit', $note->id) }}" title="Ändra">
                            {{ HTML::image('images/edit.png', 'Ändra') }}
                        </a>
	                </td>
                	<td>
                		<a href="{{ URL::route('note-show', $note->id) }}">{{ $note->title }}</a>
                	</td>
           	    </tr>
           	    <br>
    @endforeach
@stop