<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>@yield('head-title')</title>
    <link href="/styles/style.css" rel="stylesheet">
    <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon">
	<link rel="icon" href="/favicon.ico" type="image/x-icon">
	<meta name="_token" content="{{ csrf_token() }}"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script type="text/javascript" src="/js/jquery-1.11.2.js"></script>
  	<script type="text/javascript" src="/js/jquery-ui.js"></script>
	<script type="text/javascript">
  		$(function() {
      		$('.menu-btn').on('click', function(){
             	$('.responsive-menu').slideToggle(150);
      		});
    	});
  	</script>
	@yield('head-extra')
</head>
<body>
	<div class="page-wrap">
		<nav class="navbar clearfix">
			<div class="centrator">
				@if(!Auth::guest() && !Request::is('/') && !Request::is('sok/*'))
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
					<button class="visible-xs" id="burger"></button> <!-- TODO -->
				</div>
				<div class="responsive-menu">
					<ul class="menu clearfix">
						<li><a href="{{ URL::route('index') }}">Hem</a></li>
						@if(false)
							<li><a href="{{ URL::route('sign-in') }}">Logga in</a></li>
							<li><a href="{{ URL::route('sign-up') }}">Registrera dig</a></li>
						@elseif(!Auth::guest())
							<li><a href="{{ URL::route('user') }}">Min sida</a></li>
							<li><a href="{{ URL::route('sign-out') }}">Logga ut</a></li>
						@endif
						<li></li>
					</ul>
				</div>
				<div class="clear"></div>
			</div>
		</nav>
		<div class="clear"></div>
		@yield('submenu')
		<div class="clear"></div>
		<div id="container" class="centrator">
			@yield('body')
		</div>
		<div class="clear"></div>
	</div>
	<div id="footer" class="clearfix">
		<div class="centrator">
			<div class="col">
				<h3>Sidinformation</h3>
				<p>Sidan är gjord för Clinical Innovations Fellowship 2015. Läs mer <a href="{{ URL::route('about-index') }}">om oss som står bakom</a>.</p>
			</div>
			<div class="col">
				<h3>Hjälp!</h3>
				<p><a href="{{ URL::route('help-index') }}">Här hittar du all hjälp du kan behöva.</a></p>
			</div>
			<div class="col">
				<h3>Senast lästa PM</h3>
				<ul>
					<?php $pms = PM::orderBy('id', 'desc')->take(6)->get(); // TODO ?>
					@foreach($pms as $pm)
						<li><a href="{{ URL::route('pm-show', $pm->token) }}">{{ $pm->title }}</a></li>
					@endforeach
				</ul>
			</div>
		</div>
	</div>
</body>
</html>