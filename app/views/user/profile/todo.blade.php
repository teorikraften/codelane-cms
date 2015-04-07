@extends('master')

@section('head-title')
    Användare: {{ Auth::user()->real_name }}
@stop

@section('submenu')
    @include('includes.admin-menu')
@stop

@section('body') 
<script type="text/javascript" src="js/infoWindow.js"></script>

    <h1>Dina aktuella uppgifter</h1>
    <p>
        Du ska:
        <ul>
            @foreach(Auth::user()->allEvents() as $event)
                <li><a href="">{{ $event->verb }} "{{ $event->pm->title }}"</a>.</li>
            @endforeach
        </ul>
    </p>

@stop