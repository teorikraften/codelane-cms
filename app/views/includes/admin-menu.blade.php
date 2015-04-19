@if(Auth::guest())

@elseif(Auth::user()->privileges == 'admin')
	<?php $countEvents = Auth::user()->countEvents(); ?>
	<div class="submenu">
	    <ul>
	    	@if ($countEvents > 1)
				<li class="notif"><a href="{{ URL::route('to-do') }}">{{ $countEvents }} saker att göra</a></li>
			@elseif ($countEvents > 0)
				<li class="notif"><a href="{{ URL::route('to-do') }}">1 sak att göra</a></li>
			@endif
			<li><a href="{{ URL::route('favourites-show') }}">Dina favoriter</a></li>
	        <li><a href="{{ URL::route('note-show-all') }}">Dina anteckningar</a></li>
	        <li><a href="{{ URL::route('notification-show-all') }}">Notifieringar</a></li>
	        <!--<li><a href="{{ URL::route('pm-import') }}">Importera PM</a></li>-->
	        <li><a href="{{ URL::route('admin-tags') }}">Taggar</a></li>
	        <li><a href="{{ URL::route('admin-categories') }}">Kategorier</a></li>
	        <li><a href="{{ URL::route('admin-roles') }}">Roller</a></li>
	        <li><a href="{{ URL::route('admin-users') }}">Användare</a></li>
	        <li><a href="{{ URL::route('admin-pm') }}">PM</a></li>
			<li><a href="{{ URL::route('sign-out') }}">Logga ut</a></li>
	    </ul>
	    <div class="clear"></div>
	</div>
@elseif(Auth::user()->privileges == 'pm-admin')
	<?php $countEvents = Auth::user()->countEvents(); ?>
	<div class="submenu">
	    <ul>
	    	@if ($countEvents > 1)
				<li class="notif"><a href="{{ URL::route('to-do') }}">{{ $countEvents }} saker att göra</a></li>
			@elseif ($countEvents > 0)
				<li class="notif"><a href="{{ URL::route('to-do') }}">1 sak att göra</a></li>
			@endif
			<li><a href="{{ URL::route('favourites-show') }}">Dina favoriter</a></li>
			<li><a href="{{ URL::route('note-show-all') }}">Dina anteckningar</a></li>
			<li><a href="{{ URL::route('notification-show-all') }}">Notifieringar</a></li>
	        <li><a href="{{ URL::route('admin-pm') }}">PM</a></li>
			<li><a href="{{ URL::route('sign-out') }}">Logga ut</a></li>
	    </ul>
	    <div class="clear"></div>
	</div>
@elseif(Auth::user()->privileges == 'verified')
	<?php $countEvents = Auth::user()->countEvents(); ?>
	<div class="submenu">
	    <ul>
	    	@if ($countEvents > 1)
				<li class="notif"><a href="{{ URL::route('to-do') }}">{{ $countEvents }} saker att göra</a></li>
			@elseif ($countEvents > 0)
				<li class="notif"><a href="{{ URL::route('to-do') }}">1 sak att göra</a></li>
			@endif
	        <li><a href="{{ URL::route('user') }}">Din sida</a></li>
			<li><a href="{{ URL::route('favourites-show') }}">Dina favorit-PM</a></li>
			<li><a href="{{ URL::route('note-show-all') }}">Dina anteckningar</a></li>
			<li><a href="{{ URL::route('notification-show-all') }}">Notifieringar</a></li>
			<li><a href="{{ URL::route('latest-show') }}">Senast uppdaterade-PM</a><li>
	        <li><a href="{{ URL::route('admin-pm') }}">PM</a></li>
			<li><a href="{{ URL::route('sign-out') }}">Logga ut</a></li>
	    </ul>
	    <div class="clear"></div>
	</div>
@endif