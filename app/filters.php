<?php

/*
|--------------------------------------------------------------------------
| Application & Route Filters
|--------------------------------------------------------------------------
|
| Below you will find the "before" and "after" events for the application
| which may be used to do any work before or after a request into your
| application. Here you may also register your custom route filters.
|
*/

App::before(function($request)
{
	//
});


App::after(function($request, $response)
{
	//
});

/*
|--------------------------------------------------------------------------
| Authentication Filters
|--------------------------------------------------------------------------
|
| The following filters are used to verify that the user of the current
| session is logged into this application. The "basic" filter easily
| integrates HTTP Basic authentication for quick, simple checking.
|
*/

Route::filter('auth', function()
{
	if (Auth::guest()) return Redirect::guest('login');
});


Route::filter('auth.basic', function()
{
	return Auth::basic();
});

/*
|--------------------------------------------------------------------------
| Guest Filter
|--------------------------------------------------------------------------
|
| The "guest" filter is the counterpart of the authentication filters as
| it simply checks that the current user is not logged in. A redirect
| response will be issued if they are, which you may freely change.
|
*/

Route::filter('guest', function()
{
	if (Auth::check()) return Redirect::to('/');
});

/*
|--------------------------------------------------------------------------
| Admin Filter
|--------------------------------------------------------------------------
|
| Ensure that the current user has admin privileges.
| Otherwise redirect to generic 404 not found page.
|
*/

Route::filter('admin', function()
{
	if (Auth::guest() || Auth::user()->admin != 1)
  {
    throw new \Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
  }
});

/*
|--------------------------------------------------------------------------
| CSRF Protection Filter
|--------------------------------------------------------------------------
|
| The CSRF filter is responsible for protecting your application against
| cross-site request forgery attacks. If this special token in a user
| session does not match the one given in this request, we'll bail.
|
*/

Route::filter('csrf', function()
{
	if (Session::token() != Input::get('_token'))
	{
		throw new Illuminate\Session\TokenMismatchException;
	}
});

/*
|--------------------------------------------------------------------------
| Language Route Filter
|--------------------------------------------------------------------------
|
| Tries to determine the users request language settings
|
*/

Route::before(function()
{
  // Set default session language if none is set
  if(!Session::has('language'))
  {
      // detect browser language
      $headerlang = Request::server('http_accept_language');
      if(isset($headerlang))
      {
          $headerlang = substr(Request::server('http_accept_language'), 0, 2);

          if(array_key_exists($headerlang, Config::get('app.languages')))
          {
              // browser lang is supported, use it
              $lang = $headerlang;
          }
          // use default application lang
          else
          {
              $lang = Config::get('app.locale');
          }
      }
      // use default
      else
      {
        // use default application lang
        $lang = Config::get('app.locale');
      }

      // set application language for that user
      Session::put('language', $lang);
      Config::set('app.locale',  $lang);
  }
  // session is available
  else
  {
      // set application to session lang
      Config::set('app.locale', Session::get('language'));
  }
});
