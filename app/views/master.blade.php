<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>@yield('head-title')</title>
    <link href="styles/style.css" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1">

	@yield('head-extra')
</head>
<body>
	<nav class="navbar clearfix">
			<div class="logo">Logga</div>
			<ul class="searchbar clearfix">
				<li><form class="search-form" role="search">
            		   <input type="text" class="text-area" placeholder="Söktext">
                   	   <button type="submit" class="btn grow">Sök</button>
         		</form></li>
			</ul>
			<ul class="menu clearfix">
				<li><a href="#">Hem</a></li>
				<li>
					<a href="#">Användare</a>
					<!--
					<ul class="menu hidden">
						<li><a href="#">Nurse</a></li>
						<li><a href="#">Doctor</a></li>
					</ul>-->
				</li>
				<li><a href="{{ URL::route('sign-in') }}">Logga in</a></li>
			</ul>
	</nav>
	<div id="container">
		<div id="content">
		
			@yield('body')

		</div>
	</div>
	<div class="push"></div>
	
	<div id="footer" class="clearfix">
			<a href="#" class="pull-left" id="about">Om oss</a>
			<a href="#" class="pull-right" id="contact">Kontakta oss</a>
	</div>
</body>
</html>