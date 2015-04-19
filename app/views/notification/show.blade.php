@extends('master')

@section('head-title')
    Visa alla notifieringar
@stop


@section('body')
    <h1>Dina notifieringar</h1>
    <a href="{{ URL::route('notification-add') }}" class="btn-note">Nytt meddelande</a>
    <p>Här ser du notifieringar du har fått från andra personer angående specifika PM. Du kan även skicka meddelanden själv.</p>
    @include('includes.messages')
    @if ($notifications->count() > 0)
    <table class="list">
            <tr>
                <th class="action"></th>
                <th class="action"></th>
                <th>Rubrik</th>
                <th>Angående PM</th>
                <th>Från</th>
            </tr>
    @foreach($notifications as $notification)
            <tr>
            	<td>
                    <a href="{{ URL::route('note-edit', $notification->id) }}" title="Ändra">
                        {{ HTML::image('images/edit.png', 'Ändra') }}
                    </a>
                </td>
                <td>
                    <a href="{{ URL::route('note-delete', $notification->id) }}" title="Ta bort">
                        {{ HTML::image('images/delete.png', 'Ta bort')  }}
                    </a>
                </td>
            	<td>
            		<a class="clickable-title" href="{{ URL::route('notification-show', $notification->id) }}">{{ $notification->title }}</a>
            	</td>
                <td>
                    <a class="clickable-title" href="{{ URL::route('pm-show', $notification->pm['token']) }}">{{ $notification->pm['title'] }}</a>
                </td>
                <td>
                    <a class="clickable-title" href="{{ URL::route('notification-add', User::where('id', '=', $notification->user_id)->first()->email) }}">{{ User::where('id', '=', $notification->user_id)->first()->name }}</a>
                </td>
       	    </tr>
    @endforeach
    </table>
    @else
    <p>Du har för närvarande inga anteckningar.</p>
    @endif

@stop