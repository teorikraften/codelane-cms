@extends('master')

@section('head-title')
    Att göra
@stop

@section('head-extra')
@stop

@section('submenu')
@include('includes.admin-menu')
@stop

@section('body') 
    <h1>Dina aktuella uppgifter</h1> 
    <!--infoWindow-->
    <div id="infoWindow" style="display:none;"><h3>
        <button onclick="show('infoWindow')">X</button> Hjälp :: Uppgifter</h3>
        <p>Här visas en lista med uppgifter där du har tilldelats att utföra.</p>
    </div>
    <!-- end of infoWindow-->  
    <table class="list">
        <tr>
            <th class="action"></th>
            <th>Nummer</th>
            <th>Rubrik</th>
            <th>Uppgift</th>
            <th>Skapad</th>
        </tr>
        @foreach($events as $event)
            <tr>
                <td>
                    @if($event->assignment == 'author')
                        <a href="{{ URL::route('pm-edit', $event->token) }}" title="Skriv">
                            {{ HTML::image('images/edit.png', 'Skriv') }}
                        </a>
                    @elseif($event->assignment == 'reviewer')
                        <a href="{{ URL::route('pm-review', $event->token) }}" title="Granska">
                            {{ HTML::image('images/review.png', 'Granska') }}
                        </a>
                    @elseif($event->assignment == 'end-reviewer')
                        <a href="{{ URL::route('pm-end-review', $event->token) }}" title="Slutgranska">
                            {{ HTML::image('images/end-review.png', 'Slutgranska') }}
                        </a>
                    @elseif($event->assignment == 'settler')
                        <a href="{{ URL::route('pm-settle', $event->token) }}" title="Fastställ">
                            {{ HTML::image('images/settle.png', 'Visa information') }}
                        </a>
                    @endif
                </td>
                <td>{{ $event->code }}</td> 
                <td>{{ $event->title }}</td>
                <td>{{ ucfirst($event->assignmentString) }}</td>
                <td> {{ $event->first_published_date }}</td>
            </tr>
        @endforeach
    </table>
@stop