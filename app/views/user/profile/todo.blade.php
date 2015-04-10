@extends('master')

@section('head-title')
Användare: {{ Auth::user()->name }}
@stop

@section('head-extra')
{{ HTML::script('js/infoWindow.js'); }}
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
<button onclick="show('infoWindow')">?</button>
<!-- end of infoWindow-->  
<table class="list">
    <tr>
        <th>Typ</th>
        <th>Nummer</th>
        <th>Rubrik</th>
        <th>Uppgift</th>
        <th>Skapad</th>
    </tr>
    @foreach($events as $event)
    <tr>
        <td></td> <!-- TODO: Add PM document type -->
        <td>{{ $event->id}}</td> 
        <td>"{{ $event->title }}"</td>
        <td>{{ $event->assignment }}</td>
        <td> {{ $event->first_published_date }}</td>
        <!-- Add something to manage the given task -->
    </tr>
    @endforeach
</table>
@stop