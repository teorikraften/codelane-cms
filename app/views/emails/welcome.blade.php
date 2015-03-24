<!DOCTYPE html>
<html lang="en-US">
	<head>
		<meta charset="utf-8">
	</head>
	<body>
		<h2>Välkommen!</h2>

		<div>
			Du har fått ett konto i PM-databasen skapat åt dig.<br />
			Din e-postadress i systemet är {{ $user->email }}.<br />
			Nu måste du skapa ett lösenord, vilket du gör på denna länk: <a href="{{ URL::route('create-password', array('token' => $user->id)) }}">{{ URL::route('create-password', array('token' => $user->id)) }}</a>.
		</div>
	</body>
</html>
