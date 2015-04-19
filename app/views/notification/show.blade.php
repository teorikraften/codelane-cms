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
                <th>Rubrik</th>
                <th>Angående PM</th>
                <th>Från</th>
                <th>Mottaget</th>
            </tr>
    @foreach($notifications as $notification)
            <tr>
            	<td>
            		<a title="Visa meddelande" class="clickable-title" href="{{ URL::route('notification-show', $notification->id) }}">{{ ucfirst($notification->title) }}</a>
            	</td>
                <td>
                    <a title="Visa PM" class="clickable-title" href="{{ URL::route('pm-show', $notification->pm['token']) }}">{{ $notification->pm['title'] }}</a>
                </td>
                <td>
                    <a title="Skicka meddelande" class="clickable-title" href="{{ URL::route('notification-add', array(User::where('id', '=', $notification->user_id)->first()->email, $notification->pm['title'], $notification->title)) }}">{{ User::where('id', '=', $notification->user_id)->first()->name }}</a>
                </td>
                <td>
                    <h4>{{ $notification->created_at }}</h4>
                </td>
       	    </tr>
    @endforeach
    </table>
    @else
    <p>Du har för närvarande inga notifieringar.</p>
    @endif

@stop