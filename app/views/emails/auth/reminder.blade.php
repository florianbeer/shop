<!DOCTYPE html>
<html lang="de-DE">
	<head>
		<meta charset="utf-8">
	</head>
	<body>
		<h2>{{ Lang::get('reminders.mail-subject') }}</h2>

		<div>
            {{ Lang::get('reminders.mail-body') }} {{ HTML::link('password/reset/'.$token) }}
		</div>
	</body>
</html>
