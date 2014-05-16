<!DOCTYPE html>
<html lang="{{ Config::get('app.locale') }}">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>{{ Config::get('shop.title') }} -  {{ $title or Lang::get('misc.home') }}</title>
  {{ HTML::style('css/bootstrap.min.css') }}
  {{ HTML::style('http://fonts.googleapis.com/css?family=Noto+Sans:700') }}
  {{ HTML::style('css/animate.min.css') }}
  {{ HTML::style('css/theme.css') }}
  <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
  <![endif]-->
  {{ HTML::script('/js/wow.min.js') }}
  <script>new WOW().init();</script>
</head>
<body>