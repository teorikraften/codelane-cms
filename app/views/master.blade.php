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
              	$('.responsive-menu').toggleClass('expand');
      		});
    	});
  </script>

	@yield('head-extra')
</head>
<body>
	<nav class="navbar clearfix">

			<div class="logo hidden-xs">Logga</div>
			<div class="logo visible-xs">L</div>
			<ul class="searchbar clearfix">
				<li><form class="search-form" role="search">
            		   <input type="text" class="text-area" placeholder="Söktext">
                   	   <button type="submit" class="btn grow">Sök</button>
         		</form></li>
			</ul>
			<div class="menu-btn">
				<button class="visible-xs" id="burger">Meny</button>
			</div>
			<div class="responsive-menu">
				<ul class="menu clearfix">
					<li><a href="{{ URL::route('index') }}">Hem</a></li>
					@if(Auth::guest())
						<li><a href="{{ URL::route('sign-in') }}">Logga in</a></li>
						<li><a href="{{ URL::route('sign-up') }}">Registrera dig</a></li>
					@else
						<li><a href="{{ URL::route('user', array(Auth::user())) }}">Min sida</a></li>
						<li><a href="{{ URL::route('sign-out') }}">Logga ut</a></li>
					@endif
				</ul>
			</div>
	</nav>
	<div id="container">
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