<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>@yield('head-title')</title>
	@yield('head-extra')
</head>
<body>
	<h1>@yield('head-title')</h1>
	<br /><br /><br /><br />
	Allt här nedanför ska tas bort. (Och här ovanför också)
	<h2>En liten minimeny</h2>
	<p>Finns på alla sidor eftersom den ligger i master.</p>
	<ul>
		<li><a href="{{ URL::route('index') }}">Start</a></li>
		<li>
			<b>Inloggning</b>
			<ul>
				<li><a href="{{ URL::route('sign-in') }}">Logga in</a></li>
				<li><a href="{{ URL::route('sign-up') }}">Registrera dig</a></li>
				<li><a href="{{ URL::route('reset-password') }}">Glömt lösenord</a></li>
			</ul>
		</li>
		<li>
			<b>Användare</b>
			<ul>
				<li><a href="{{ URL::route('user', array('id' => '1337')) }}">Användarsida</a></li>
				<li><a href="{{ URL::route('user-edit', array('id' => '1234')) }}">Ändra profil</a></li>
				<li><a href="{{ URL::route('user-favourites', array('id' => '4711')) }}">Dina favoriter</a></li>
				<li>
					<b>Administratör</b>
					<ul>
						<li><a href="{{ URL::route('admin-persons', array('id' => '1337')) }}">Lista alla personer</a></li>
						<li><a href="{{ URL::route('admin-pms', array('id' => '1234')) }}">Lista PM</a></li>
						<li><a href="{{ URL::route('admin-roles', array('id' => '4711')) }}">Lista roller</a></li>
						<li><a href="{{ URL::route('admin-tags', array('id' => '4711')) }}">Lista taggar</a></li>
					</ul>
				</li>
			</ul>
		</li>
		<li>
			<b>Sök</b>
			<ul>
				<li><a href="{{ URL::route('search-form') }}">Index</a></li>
				<li><a href="{{ URL::route('search-result', array('searchQuery' => 'det här är söksträngen')) }}">Sökresultat</a></li>
			</ul>
		</li>
		<li>
			<b>PM</b>
			<ul>
				<li><a href="{{ URL::route('pm-show', array('token' => 'hej')) }}">Visa PM 'hej'</a></li>
				<li><a href="{{ URL::route('pm-edit', array('token' => 'hej')) }}">Ändra PM 'hej'</a></li>
				<li><a href="{{ URL::route('pm-download', array('token' => 'hej')) }}">Ladda ner PM 'hej'</a></li>
				<li><a href="{{ URL::route('pm-verify', array('token' => 'hej')) }}">Verifiera PM 'hej'</a></li>
				<li><a href="{{ URL::route('pm-add') }}">Lägg till nytt PM</a></li>
				<li><a href="{{ URL::route('pm-add-tag', array('token' => 'hej')) }}">Lägg till en tagg till PM 'hej'</a></li>
			</ul>
		</li>
		<li>
			<b>Taggar</b>
			<ul>
				<li><a href="{{ URL::route('tag-show', array('tag' => 'hej')) }}">Visa inlägg med tagg 'hej'</a></li>
			</ul>
		</li>
		<li>
			<b>Statistik</b>
			<ul>
				<li><a href="{{ URL::route('statistics-index') }}">Index</a></li>
				<li><a href="{{ URL::route('statistics-history') }}">Historik</a></li>
				<li><a href="{{ URL::route('statistics-pm', array('token' => '1337')) }}">För specifikt PM 1337</a></li>
			</ul>
		</li>
		<li>
			<b>Hjälp</b>
			<ul>
				<li><a href="{{ URL::route('help-index') }}">Index</a></li>
			</ul>
		</li>
		<li>
			<b>Om</b>
			<ul>
				<li><a href="{{ URL::route('about-index') }}">Index</a></li>
			</ul>
		</li>
	</ul>
	@yield('body')
</body>
</html>