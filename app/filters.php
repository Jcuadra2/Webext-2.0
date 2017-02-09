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
  if (Auth::guest())
    return Redirect::to('entrar')
      ->with('flash_error', 'Debes iniciar sesión para poder acceder al sitio!');
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
  if (Auth::check())
    return Redirect::to('/')
      ->with('flash_notice', 'Ya habías iniciado sesión!');
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
| Adminstrador Filter
|--------------------------------------------------------------------------
|
| El Administrador es el único que puede leer, crear, editar, modificar y eliminar
| delegaciones y credenciales.
|
*/
Route::filter('administrador', function()
{
  if ( (Auth::user()->tipo->tipo != 'Administrador') )
    return Redirect::to('/')
      ->with('flash_error', 'Debes iniciar sesión como Administrador para poder acceder al sitio!');
});


/*
|--------------------------------------------------------------------------
| Supervisor Filter
|--------------------------------------------------------------------------
|
| El Supervisor puede leer, crear, editar, modificar y eliminar
| estaciones y colaboradores de su delegación.
|
*/
Route::filter('supervisor', function()
{
  if ( (Auth::user()->tipo->tipo != 'Supervisor') AND (Auth::user()->tipo->tipo != 'Administrador') )
    return Redirect::to('/')
      ->with('flash_error', 'Debes iniciar sesión como Supervisor o Administrador para poder acceder al sitio!');
});


/*
|--------------------------------------------------------------------------
| Lector Filter
|--------------------------------------------------------------------------
|
| El Lector sólo puede leer estaciones y colaboradores de su delegación.
|
*/
Route::filter('lector', function()
{
  // Si no eres ni Lector ni Supervisor ni Administrador debes iniciar sesión
  if ( (Auth::user()->tipo->tipo != 'Lector') AND (Auth::user()->tipo->tipo != 'Supervisor') AND (Auth::user()->tipo->tipo != 'Administrador') )
    return Redirect::to('/')
      ->with('flash_error', 'Debes iniciar sesión para poder acceder al sitio!');
});
