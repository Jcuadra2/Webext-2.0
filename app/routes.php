<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|http://stackoverflow.com/questions/11981621/starting-with-laravel-on-ubuntu
*/


Route::get('/', function()
{
	return View::make('inicio');
});

/**
 * Encripta con bcrypt la contraseña enviada en el link y muestra
 * el string encriptado en pantalla
 * Se usa para encriptar la password de la credencial Administrador por primera vez
 * antes de guardarla en la base de datos
 */
Route::get('/hash/{pass}', function($pass)
{
  return Hash::make($pass);
});

Route::get('test', function()
{

    $origen = DB::connection('origen');

    $colaboradores = $origen->table('xc_colaborador')->get();

    foreach($colaboradores as $col){

        echo $col->CIF_NIF;
        echo "<br>";
    }



});


/**
 * INICIO DE SESIÓN
 * @see http://laravelbook.com/laravel-user-lectorentication/
 */
  Route::get('entrar', 'CredencialController@entrar')
    ->before('guest');
  Route::post('entrar', 'CredencialController@gestionarEntrar')
    ->before('guest');
  Route::get('salir', 'CredencialController@salir')
    ->before('auth')->before('lector');


Route::group(array('before' => 'auth'), function() // Requiere haber iniciado sesión
{
  /**
   * IMPORTAR
   */

  Route::group(array('before' => 'administrador'), function() // Requiere ser Administrador
  {
    Route::get('importar', 'ImportarController@index');
    Route::post('importar', 'ImportarController@indexConectar');
  });


  /**
   * CREDENCIALES
   * Se requiere ser Administrador
   */
  Route::group(array('before' => 'administrador'), function() // Requiere ser Administrador
  {
    // VER LISTADO
    Route::get('credenciales', 'CredencialController@listado');
    // CREAR
    Route::get('credenciales/crear', 'CredencialController@crear');
    Route::post('credenciales', 'CredencialController@gestionarCrear');
    // VER
    Route::get('credenciales/{id}', 'CredencialController@ver');
    // EDITAR
    Route::get('credenciales/{id}/editar', 'CredencialController@editar');
    Route::put('credenciales/{id}', 'CredencialController@gestionarEditar');
    // ELIMINAR
    Route::get('credenciales/{id}/eliminar', 'CredencialController@confirmarEliminar');
    Route::delete('credenciales/{id}/eliminar', 'CredencialController@eliminar');
    // ALTA
    Route::get('credenciales/{id}/alta', 'CredencialController@darAlta');
    // BAJA
    Route::get('credenciales/{id}/baja', 'CredencialController@darBaja');
  });

  Route::group(array('before' => 'lector'), function()
  {
    // VER
    Route::get('credenciales/{id}', 'CredencialController@ver');
    //EDITAR
    Route::get('credenciales/{id}/editar', 'CredencialController@editar');
    Route::put('credenciales/{id}', 'CredencialController@gestionarEditar');
  });

  /**
   * DELEGACIONES
   * Se requiere ser Administrador
   */
  Route::group(array('before' => 'supervisor'), function() // Requiere ser Supervisor o superior (Administrador)
  {
    // VER LISTADO
    Route::get('delegaciones', 'DelegacionController@listado');
    // CREAR
    Route::get('delegaciones/crear', 'DelegacionController@crear');
    Route::post('delegaciones', 'DelegacionController@gestionarCrear');
    // VER
    Route::get('delegaciones/{cod}', 'DelegacionController@ver');
    // EDITAR
    Route::get('delegaciones/{cod}/editar', 'DelegacionController@editar');
    Route::put('delegaciones/{cod}', 'DelegacionController@gestionarEditar');
    // ELIMINAR
    Route::get('delegaciones/{cod}/eliminar', 'DelegacionController@confirmarEliminar');
    Route::delete('delegaciones/{cod}/eliminar', 'DelegacionController@eliminar');
  });

  /**
   * COLABORADORES
   */
  Route::group(array('before' => 'supervisor'), function()  // Requiere ser Supervisor o superior (Administrador)
  {
    // CREAR
    Route::get('colaboradores/alta', 'ColaboradorController@alta');
    Route::post('colaboradores', 'ColaboradorController@gestionarAlta');
    // EDITAR
    Route::get('colaboradores/{id}/editar', 'ColaboradorController@editar');
    Route::put('colaboradores/{id}', 'ColaboradorController@gestionarEditar');
    // ELIMINAR
    Route::get('colaboradores/{id}/eliminar', 'ColaboradorController@confirmarEliminar');
    Route::delete('colaboradores/{id}/eliminar', 'ColaboradorController@eliminar');
    // ALTA
    Route::get('colaboradores/{id}/alta', 'ColaboradorController@darAlta');
    // BAJA
    Route::get('colaboradores/{id}/baja', 'ColaboradorController@darBaja');
  });

  Route::group(array('before' => 'lector'), function() // Requiere ser lector
  {
    // VER LISTADO
    Route::get('colaboradores', 'ColaboradorController@listado');
    // VER
    Route::get('colaboradores/{id}', 'ColaboradorController@ver');
  });

  /**
   * GRATIFICACIONES
   */
  Route::group(array('supervisor'), function() // Requiere ser Supervisor o superior (Administrador)
  {
    // AJAX
    Route::get('colaboradores/{id}/gratificaciones', 'GratificacionController@ajaxListar');
    Route::post('colaboradores/{id}/gratificaciones', 'GratificacionController@ajaxCrear');
    Route::put('colaboradores/{id}/gratificaciones', 'GratificacionController@ajaxActualizar');
    Route::delete('colaboradores/{id}/gratificaciones', 'GratificacionController@ajaxEliminar');
    Route::get('colaboradores/{id}/gratificaciones/estaciones', 'GratificacionController@ajaxEstaciones');
  });

  /**
   * ESTACIONES
   */
  Route::group(array('before' => 'supervisor'), function() // Requiere ser Supervisor o superior (Administrador)
  {
    // CREAR
    Route::get('estaciones/alta', 'EstacionController@alta');
    Route::post('estaciones', 'EstacionController@gestionarAlta');
    // EDITAR
    Route::get('estaciones/{indicativo}/editar', 'EstacionController@editar');
    Route::put('estaciones/{indicativo}', 'EstacionController@gestionarEditar');
    // ELIMINAR
    Route::get('estaciones/{indicativo}/eliminar', 'EstacionController@confirmarEliminar');
    Route::delete('estaciones/{indicativo}/eliminar', 'EstacionController@eliminar');
    // ALTA
    Route::get('estaciones/{indicativo}/alta', 'EstacionController@darAlta');
    // BAJA
    Route::get('estaciones/{indicativo}/baja', 'EstacionController@darBaja');
  });

  Route::group(array('before' => 'lector'), function() // Requiere ser lector
  {
    // VER LISTADO
    Route::get('estaciones', 'EstacionController@listado');
    // VER
    Route::get('estaciones/{indicativo}', 'EstacionController@ver');
  });

  /**
   * INCIDENCIAS
   */
  Route::group(array('before' => 'supervisor'), function() // Requiere ser Supervisor o superior (Administrador)
  {
    // AJAX
    Route::get('estaciones/{indicativo}/incidencias', 'IncidenciaController@ajaxListar');
    Route::post('estaciones/{indicativo}/incidencias', 'IncidenciaController@ajaxCrear');
    Route::put('estaciones/{indicativo}/incidencias', 'IncidenciaController@ajaxActualizar');
    Route::delete('estaciones/{indicativo}/incidencias', 'IncidenciaController@ajaxEliminar');


  });

  /**
   * DIRECCIONES
   */
  Route::group(array('before' => 'supervisor'), function() // Requiere ser Supervisor o superior (Administrador)
  {
    // DROPDOWN MUNICIPIOS CON AJAX
    // Crear?
    //Route::post('colaboradores/provincia', 'DireccionController@ajaxMunicipios');
    ///Route::post('estaciones/provincia', 'DireccionController@ajaxMunicipios');
    //Route::post('delegaciones/provincia', 'DireccionController@ajaxMunicipios');
    // Editar?
    //Route::post('colaboradores/{id}/provincia', 'DireccionController@ajaxMunicipios');
    Route::post('{modelo}/provincia', 'DireccionController@ajaxMunicipios');
    Route::post('{modelo}/{id}/provincia', 'DireccionController@ajaxMunicipios');
    Route::post('{modelo}/{id}/editar/provincia', 'DireccionController@ajaxMunicipios');
    //Route::post('delegaciones/{cod}/provincia', 'DireccionController@ajaxMunicipios');
  });

  Route::group(array('before' => 'supervisor'), function() //Credencial mayor o igual a Supervisor
  {
    Route::get('excel', 'ExcelController@excel');
  });

  Route::group(array('before' => 'supervisor'), function() //Credencial mayor o igual a Supervisor
  {
    Route::get('listadogratificacion', 'ListadoGratificacionController@listadogratificacion');
  });

}); // FIN FILTRO: before => auth
