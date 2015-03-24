<!DOCTYPE html>
<html lang="en-US">
	<head>
		<meta charset="utf-8">
	</head>
	<body>
		<h2>Lösenordsåterställning</h2>
		<div>
			Du har begärt att ditt lösenord för sjukhusets PM-databas ska återställas.<br>
			För att återställa lösenord, gå in på denna sida: <a href="{{ URL::route('reset-password', array($token)) }}">{{ URL::route('reset-password', array($token)) }}</a>.<br/>
			Länken kommer att vara giltig i {{ Config::get('auth.reminder.expire', 60) }} minuter.
		</div>
	</body>
</html>
