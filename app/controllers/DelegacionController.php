<?php

/**
 * Todos los controladores necesarios para gestionar una delegación se encuentran aquí
 */
class DelegacionController extends \BaseController
{
  /**
   * VER LISTADO
   * Mostrar listado con todas las delegaciones y sus datos
   */
  public function listado()
  {
    // Obtener array con todas las delegaciones y sus datos
    $delegaciones = Delegacion::all();

    // Cargar la vista (app/views/delegacion/listado.blade.php) con esos datos
    return View::make('delegacion.listado')
      ->with('delegaciones', $delegaciones);
  }


  /**
   * VER
   * Ver detalles de una delegacion
   */
  public function ver($cod)
  {
    $delegacion = Delegacion::find($cod);

    $datos = array(
      // Datos de la estación
      'delegacion' => $delegacion,
      // Datos Direccion
      'provincias' => Provincia::all(),
      'direccion' => DireccionController::direccion($delegacion),
      'municipio' => DireccionController::municipio($delegacion),
      'provincia' => DireccionController::provincia($delegacion)
    );

    // Crear una vista con esos datos
    return View::make('delegacion.ver', $datos);
  }


  /**
   * CREAR
   * Mostrar el formulario para crear una nueva estación
   */
  public function crear()
  {
    // Obtener un array con todos los datos necesarios para crear el formulario
    $datos = array(
      'provincias' => Provincia::all()
    );

    // Cargar la vista (app/views/delegaciones/crear.blade.php) con esos datos
    return View::make('delegacion.crear', $datos);
  }


  /**
   * GESTIONAR CREAR
   */
  public function gestionarCrear()
  {
    // Debug
    //echo "<pre>"; print_r(Input::all()); exit;

    // Validamos los datos POST "Input::all()" segun los requisítos
    $requisitos = array(
      'cod' => 'required|alpha|size:3|unique:delegaciones',
      'delegacion' => 'required|alpha_spaces|max:45',
      'delegado_territorial' => 'required|alpha_spaces|max:45',

      // Direccion
      'direccion' => 'required',
      'cp' => 'required|alpha_num',
      'localidad' => 'alpha_spaces',
      'provincia_cod' => 'required|exists:provincias,cod',
      'municipio_cod' => 'required_with:provincia_cod|exists:municipios,cod',
      'detalles' => ''
    );
    $validar = Validator::make(Input::all(), $requisitos);

    // Si hay error de validacion redireccionamos
    if ($validar->fails()) {
      return Redirect::to('delegaciones/crear')
        // Devuelve los errores generados
        ->withErrors($validar)
        // Devuelve los datos recibidos por el formulario que ya han sido validados
        ->withInput(Input::all());
    } else {
      // Crear la delegación en la bbdd con los datos recibidos por el formulario
      $delegacion = Delegacion::create(Input::all());

      // DIRECCION------------------------------------------
        DireccionController::crear($delegacion);
      //----------------------------------------------------
    }

    // Finalmente redireccionamos a la vista delegaciones
    return Redirect::to('delegaciones')
      ->with('flash_notice', 'Delegación creada con éxito!');
  }


  /**
   * EDITAR
   * Formulario para editar los datos de un estacion
   */
  public function editar($cod)
  {
    $delegacion = Delegacion::find($cod);

    $datos = array(
      'delegacion' => $delegacion,

      // Direccion
      'provincias' => Provincia::all(),
      'direccion' => DireccionController::direccion($delegacion),
      'municipio' => DireccionController::municipio($delegacion),
      'provincia' => DireccionController::provincia($delegacion)
    );

    // $this->debug($datos);

    // Cargar la vista (app/views/delegacion/editar.blade.php) con esos datos
    return View::make('delegacion.editar', $datos);
  }


  /**
   * GESTIONAR EDITAR
   * Edita los datos de un estacion
   */
  public function gestionarEditar($cod)
  {
    //$this->debug(Input::all());

    // Validamos Inputs
    $requisitos = array(
      // Datos de la estación
      'cod' => "required|alpha|size:3|unique:delegaciones,cod,$cod,cod",
      'delegacion' => 'required|alpha_spaces|max:45',
      'delegado_territorial' => 'required|alpha_spaces|max:45',

      // Direccion
      'direccion' => 'required',
      'cp' => 'required|alpha_num',
      'localidad' => 'alpha_spaces',
      'provincia_cod' => 'required|exists:provincias,cod',
      'municipio_cod' => 'required_with:provincia_cod|exists:municipios,cod',
      'detalles' => ''
    );
    $validar = Validator::make(Input::all(), $requisitos);

    // Si hay error de validacion redireccionamos a delegaciones/{cod}/editar
    if ($validar->fails()) {
      return Redirect::to("delegaciones/$cod/editar")
        // Devuelve los errores generados
        ->withErrors($validar)
        // Devuelve los datos recibidos por el formulario que ya han sido validados
        ->withInput(Input::all());
    } else {
      // Seleccionamos la estacion de la bbdd
      $delegacion = Delegacion::find($cod);

      // Preparamos la actualizacion de sus datos
      $delegacion->cod = Input::get('cod') ? strtoupper( Input::get('cod') ) : null;
      $delegacion->delegacion = Input::get('delegacion') ? Input::get('delegacion') : null;
      $delegacion->delegado_territorial = Input::get('delegado_territorial') ? Input::get('delegado_territorial') : null;

      // Guardamos los cambios
      $delegacion->save();

      //$this->debug(Input::all());

      // DIRECCION---------------------------------------
      if($delegacion->direcciones->first()){
        DireccionController::actualizar($delegacion);
      } else {
        DireccionController::crear($delegacion);
      }
      //-------------------------------------------------

      return Redirect::to("delegaciones/$delegacion->cod")
        ->with('flash_notice', 'Modificación realizada con éxito!')
        ->withEstación(Delegacion::find($delegacion->cod));
    }
  }



  /**
   * ELIMINAR
   * Eliminar una delegación
   */
  public function eliminar($cod)
  {
    // Seleccionamos la delegación de la bbdd y la eliminamos definitvamente
    Delegacion::find($cod)->delete();
    // ...y redireccionamos a delegaciones con un mensaje de que ha salido bien
    return Redirect::to('delegaciones')
      ->with('flash_notice', 'Delegación eliminada con éxito!');
  }

  public function confirmarEliminar($cod){
    return View::make('delegacion.eliminar')
      ->with('cod',$cod);
  }

}