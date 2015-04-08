@extends('master')

@section('head-title')
    Användare: {{ Auth::user()->real_name }}
@stop

@section('head-extra')
    {{ HTML::script('js/infoWindow.js'); }}
@stop

@section('submenu')
    @include('includes.admin-menu')
@stop

@section('body') 
    <h1>Ditt konto, {{ Auth::user()->real_name }}</h1>  
    <table>
        <tr>
            <th>Namn:</th>
            <td>{{ Auth::user()->real_name }}</td>
        </tr>
        <tr>
            <th>Kontostatus:</th>
            <td>{{ ucfirst(Auth::user()->privileges()) }}</td>
        </tr>
        <tr>
            <th>E-postadress:</th>
            <td>{{ Auth::user()->email }}</td>
        </tr>
        <tr>
            <th>Dina roller:</th>
            <td>
                @foreach(Auth::user()->roles as $role)
                    <a href="{{ URL::route('search-result', array('searchQuery' => $role->name, 'order' => 'alphabetical', 'page' => 1, 'options' => '010')) }}" class="action">{{ $role->name }}</a>
                @endforeach
            </td>
        </tr>
    </table>
    <p>Du kan <a href="{{ URL::route('user-edit') }}" class="inline-action">ändra informationen</a>.</p>  
    <!--infoWindow-->    
    <div id="infoWindow" style="display:none;"><h3>
<button onclick="show('infoWindow')">X</button> Hjälp :: Profil</h3>
        <p>Det här är profilsidan, du kan se vad du har för information och ändra information.</p>
    </div>  
    <button onclick="show('infoWindow')">?</button>
<!-- end of infoWindow--> 
@stop