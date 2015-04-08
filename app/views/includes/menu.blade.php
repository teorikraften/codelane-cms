<nav class="navbar clearfix">
	<div class="centrator">
		@if(Auth::check() && !Request::is('/') && !Request::is('sok/*'))
			<ul class="searchbar clearfix">
				<li>
					{{ Form::open(array('class' => 'search-form', 'role' => 'search', 'route' => 'post-search')) }}
						{{ Form::text('search-query', NULL, array('class' => 'text-area', 'placeholder' => 'Söktext')) }}
						{{ Form::submit('Sök', array('class' => 'btn grow')) }}
	     			{{ Form::close(); }}
	     		</li>
			</ul>
		@endif
		<div class="menu-btn">
			<button class="visible-xs" id="burger"></button>
		</div>
		<div class="responsive-menu">
			<ul class="menu clearfix">
				<li><a href="{{ URL::route('index') }}">Hem</a></li>
				@if(Auth::guest())
					<li><a href="{{ URL::route('index') }}">Logga in</a></li>
					<li><a href="{{ URL::route('sign-up') }}">Registrera dig</a></li>
				@else
					<li><a href="{{ URL::route('user') }}">Din sida</a></li>
					<li><a href="{{ URL::route('category-show-all') }}">Kategorier</a></li>
					<li><a href="{{ URL::route('favourites-show') }}">Favoriter</a></li>
					<li><a href="{{ URL::route('sign-out') }}">Logga ut</a></li>
				@endif
			</ul>
		</div>
		<div class="clear"></div>
	</div>
</nav>