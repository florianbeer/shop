<!DOCTYPE html>
<html lang="de-DE">
	<head>
		<meta charset="utf-8">
	</head>
	<body>
		<h2>Passwort Reset</h2>

		<div>
      Um Ihr Passwort zu ändern, füllen sie bitte folgendes Formular aus: {{ URL::to('password/reset', array($token)) }}.
		</div>
	</body>
</html>
