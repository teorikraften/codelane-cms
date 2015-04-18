<!DOCTYPE html>
<html lang="sv">
	<head>
		<meta charset="UTF-8" />
		<title>@yield('head-title')</title>
		<meta name="description" content="{{ $description or '' }}" />
		<meta name="_token" content="{{ csrf_token() }}"/>
	    <meta name="viewport" content="width=device-width, initial-scale=1" />
	    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}" />
		<link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon"/>
	    {{ HTML::style('styles/style.css'); }}
	    {{ HTML::script('js/jquery-1.11.2.js'); }}
	    {{ HTML::script('js/jquery-ui.js'); }}
	    {{ HTML::script('js/responsive-menu.js'); }}
	    {{ HTML::script('js/infoWindow.js'); }}
		@yield('head-extra')
	</head>
	<body>
		<div class="page-wrap">
			@include('includes.menu')
			<div class="clear"></div>
			@include('includes.admin-menu')
			<div class="clear"></div>
			<div id="container" class="centrator">
				@yield('body')
				<div class="breadcrumb"><button onclick="show('infoWindow')">?</button></div>
			</div>
			<div id="blanket" style="display:none;" onclick="hide('infoWindow')"></div>
			<div class="clear"></div>
		</div>
		@include('includes.footer')
	</body>
</html>