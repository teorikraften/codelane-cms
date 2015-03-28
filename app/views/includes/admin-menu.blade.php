@if(Auth::user()->privileges == 'admin')
	<div class="submenu">
	    <ul>
	        <li><a href="{{ URL::route('user') }}">Dina uppgifter</a></li>
	        <li><a href="{{ URL::route('pm-import') }}">Importera PM</a></li>
	        <li><a href="{{ URL::route('admin-tags') }}">Taggar</a></li>
	        <li><a href="{{ URL::route('admin-roles') }}">Roller</a></li>
	        <li><a href="{{ URL::route('admin-users') }}">Användare</a></li>
	        <li><a href="{{ URL::route('admin-pm') }}">PM</a></li>
	    </ul>
	    <div class="clear"></div>
	</div>
@elseif(Auth::user()->privileges == 'pm-admin')
	<div class="submenu">
	    <ul>
	        <li><a href="{{ URL::route('user') }}">Dina uppgifter</a></li>
	        <li><a href="{{ URL::route('pm-import') }}">Importera PM</a></li>
	        <li><a href="{{ URL::route('admin-pm') }}">PM</a></li>
	    </ul>
	    <div class="clear"></div>
	</div>
@elseif(Auth::user()->privileges == 'verified')
	<div class="submenu">
	    <ul>
	        <li><a href="{{ URL::route('user') }}">Dina uppgifter</a></li>
	        <li><a href="{{ URL::route('admin-pm') }}">PM</a></li>
	    </ul>
	    <div class="clear"></div>
	</div>
@endif