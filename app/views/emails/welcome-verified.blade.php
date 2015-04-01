<!DOCTYPE html>
<html lang="sv-SE">
	<head>
		<meta charset="utf-8">
	</head>
	<body>
		<h2>Välkommen {{ $name }}!</h2>

		<div>
			Ditt konto för PM-databasen har nu verifierats. Du kan logga in med e-postadressen {{ $email }} och lösenordet du angav när du registrerade dig. Har du glömt det, kan du återställa det här: {{ URL::route('recover-password') }}.
		</div>
	</body>
</html>
