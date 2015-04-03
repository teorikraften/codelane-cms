<!DOCTYPE html>
<html lang="sv-SE">
	<head>
		<meta charset="utf-8">
	</head>
	<body>
		<h2>Välkommen!</h2>
		<div>
			<p>Du har fått ett konto i PM-databasen skapat åt dig.</p>
			<p>Din e-postadress i systemet är {{ $user->email }}.</p>
			<p>Nu måste du skapa ett lösenord, vilket du gör på denna länk: <a href="{{ URL::route('create-password', array('token' => $user->id)) }}">{{ URL::route('create-password', array('token' => $user->id)) }}</a>.</p>
		</div>
	</body>
</html>
