@if(Auth::guest())

@elseif(Auth::user()->privileges == 'admin')
	<div class="submenu">
	    <ul>
	    	@if (count(Auth::user()->allEvents()))
				<li class="notif"><a href="{{ URL::route('to-do') }}">{{ count(Auth::user()->allEvents()) }} saker att göra</a></li>
			@endif
	        <li><a href="{{ URL::route('user') }}">Din sida</a></li>
			<li><a href="{{ URL::route('favourites-show') }}">Dina favorit-PM</a></li>
	        <!--<li><a href="{{ URL::route('pm-import') }}">Importera PM</a></li>-->
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
	    	@if (count(Auth::user()->allEvents()))
				<li class="notif"><a href="{{ URL::route('to-do') }}">{{ count(Auth::user()->allEvents()) }} saker att göra</a></li>
			@endif
	        <li><a href="{{ URL::route('user') }}">Din sida</a></li>
			<li><a href="{{ URL::route('favourites-show') }}">Dina favorit-PM</a></li>
	        <li><a href="{{ URL::route('pm-import') }}">Importera PM</a></li>
	        <li><a href="{{ URL::route('admin-pm') }}">PM</a></li>
	    </ul>
	    <div class="clear"></div>
	</div>
@elseif(Auth::user()->privileges == 'verified')
	<div class="submenu">
	    <ul>
	    	@if (count(Auth::user()->allEvents()))
				<li class="notif"><a href="{{ URL::route('to-do') }}">{{ count(Auth::user()->allEvents()) }} saker att göra</a></li>
			@endif
	        <li><a href="{{ URL::route('user') }}">Din sida</a></li>
			<li><a href="{{ URL::route('favourites-show') }}">Dina favorit-PM</a></li>
			<li><a href="{{ URL::route('latest-show') }}">Senast uppdaterade-PM</a><li>
	        <li><a href="{{ URL::route('admin-pm') }}">PM</a></li>
	    </ul>
	    <div class="clear"></div>
	</div>
@endif