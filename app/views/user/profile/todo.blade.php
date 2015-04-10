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
        <table class="list">
            <tr>
                    <th>Typ</th>
                    <th>Nummer</th>
                    <th>Rubrik</th>
                    <th>Uppgift</th>
                    <th>Skapad</th>
            </tr>
        @foreach(Auth::user()->allEvents() as $event)
            <tr>
                <td></td> <!-- TODO: Add PM document type -->
                <td></td> <!-- TODO: Add PM number -->
                <td>"{{ $event->pm->title }}"</td>
                <td>{{ $event->verb }}</td>
                <td></td> <!-- TODO: Add PM creation date -->
                <!-- Add something to manage the given task -->
            </tr>
        @endforeach
        </table>
@stop