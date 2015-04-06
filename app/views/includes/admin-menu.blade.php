@if(Auth::guest())

@elseif(Auth::user()->privileges == 'admin')
	<div class="submenu">
	    <ul>
	    	@if (Auth::user()->assignment->count() > 0)
				<li class="notif"><a href="{{ URL::route('admin-pm') }}">Uppgifter: {{ Auth::user()->assignment->count() }}</a></li>
			@endif
	        <li><a href="{{ URL::route('user') }}">Dina uppgifter</a></li>
	        <li><a href="{{ URL::route('pm-import') }}">Importera PM</a></li>
	        <li><a href="{{ URL::route('admin-tags') }}">Taggar</a></li>
	        <li><a href="{{ URL::route('admin-categories') }}">Kategorier</a></li>
	        <li><a href="{{ URL::route('admin-roles') }}">Roller</a></li>
	        <li><a href="{{ URL::route('admin-users') }}">Användare</a></li>
	        <li><a href="{{ URL::route('admin-pm') }}">PM</a></li>
	    </ul>
	    <div class="clear"></div>
	</div>
@elseif(Auth::user()->privileges == 'pm-admin')
	<div class="submenu">
	    <ul>
	    	@if (count(Auth::user()->allEvents()) > 0)
				<li class="notif"><a href="{{ URL::route('admin-pm') }}">Uppgifter: {{ count(Auth::user()->allEvents()) }}</a></li>
			@endif
	        <li><a href="{{ URL::route('user') }}">Dina uppgifter</a></li>
	        <li><a href="{{ URL::route('pm-import') }}">Importera PM</a></li>
	        <li><a href="{{ URL::route('admin-pm') }}">PM</a></li>
	    </ul>
	    <div class="clear"></div>
	</div>
@elseif(Auth::user()->privileges == 'verified')
	<div class="submenu">
	    <ul>
	    	@if (count(Auth::user()->allEvents()) > 0)
				<li class="notif"><a href="{{ URL::route('admin-pm') }}">Uppgifter: {{ count(Auth::user()->allEvents()) }}</a></li>
			@endif
	        <li><a href="{{ URL::route('user') }}">Dina uppgifter</a></li>
	        <li><a href="{{ URL::route('admin-pm') }}">PM</a></li>
	    </ul>
	    <div class="clear"></div>
	</div>
@endif