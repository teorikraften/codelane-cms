@extends('master')

@section('head-title')
    Användare: {{ Auth::user()->real_name }}
@stop

@section('submenu')
    @include('includes.admin-menu')
@stop

@section('body') 
    <h1>Ditt konto, {{ Auth::user()->real_name }}</h1>
    <p>Det här vet vi om dig:</p>
    <table>
        <tr>
            <th>Du är:</th>
            <td>{{ Auth::user()->privileges }}</td>
        </tr>
        <tr>
            <th>Namn:</th>
            <td>{{ Auth::user()->real_name }}</td>
        </tr>
        <tr>
            <th>E-postadress:</th>
            <td>{{ Auth::user()->email }}</td>
        </tr>
    </table>
    <p>Du kan <a href="{{ URL::route('user-edit') }}">ändra informationen</a>.</p>
    <p>Du kan <a href="{{ URL::route('pm-import') }}">importera PM</a>.</p>
@stop