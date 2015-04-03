<!DOCTYPE html>
<html lang="sv-SE">
	<head>
		<meta charset="utf-8">
	</head>
	<body>
		<h2>Lösenordsåterställning</h2>
		<div>
			<p>Du har begärt att ditt lösenord för sjukhusets PM-databas ska återställas.</p>
			<p>För att återställa lösenord, gå in på denna sida: <a href="{{ URL::route('reset-password', array($token)) }}">{{ URL::route('reset-password', array($token)) }}</a>.</p>
			<p>Länken kommer att vara giltig i {{ Config::get('auth.reminder.expire', 60) }} minuter.</p>
		</div>
	</body>
</html>
