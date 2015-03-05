<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>@yield('head-title')</title>
    <link href="/styles/style.css" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="/js/jquery-1.11.2.js"></script>
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
	<nav class="navbar clearfix">
		<div class="centrator">
			<ul class="searchbar clearfix">
				<li>
					{{ Form::open(array('class' => 'search-form', 'role' => 'search', 'route' => 'post-search')) }}
						{{ Form::text('search-query', NULL, array('class' => 'text-area', 'placeholder' => 'Söktext')) }}
						{{ Form::submit('Sök', array('class' => 'btn grow')) }}
	     			{{ Form::close(); }}
	     		</li>
			</ul>
			<div class="menu-btn">
				<button class="visible-xs" id="burger"></button> <!-- TODO -->
			</div>
			<div class="responsive-menu">
				<ul class="menu clearfix">
					<li><a href="{{ URL::route('index') }}">Hem</a></li>
					@if(Auth::guest())
						<li><a href="{{ URL::route('sign-in') }}">Logga in</a></li>
						<li><a href="{{ URL::route('sign-up') }}">Registrera dig</a></li>
					@else
						<li><a href="{{ URL::route('user', array(Auth::user()->id)) }}">Min sida</a></li>
						<li><a href="{{ URL::route('sign-out') }}">Logga ut</a></li>
					@endif
					<li></li>
				</ul>
			</div>
		</div>
	</nav>
	<div class="clear"></div>
	<div id="container" class="centrator">
		<div id="content">
		
			@yield('body')

		</div>
	</div>
	<div class="push"></div>
	
	<div id="footer" class="clearfix">
			<a href="{{ URL::route('about-index') }}" class="pull-left" id="about">Om oss</a>
			<a href="{{ URL::route('help-index') }}" class="pull-right" id="contact">Hjälp!</a>
	</div>
</body>
</html>