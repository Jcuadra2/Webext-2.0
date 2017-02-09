<?php

class EstacionController extends \BaseController
{
  /**
   * LISTAR
   * Mostrar listado con todas las estaciones
   */
  public function listado()
  {
    // Obtener todas las estaciones
    if(Auth::user()->tipo->tipo === 'Administrador'){
      $estaciones = Estacion::withTrashed()->get();
    } else {
      $estaciones = Auth::user()->delegacion->estaciones;
    }

    // enviar las estaciones a la vista
    return View::make('estacion.listado')
      ->with('estaciones', $estaciones);
  }


  /**
   * CREAR
   * Mostrar el formulario para crear una nueva estación
   */
  public function alta()
  {
    // Limitar las delegaciones segun el usuario
    if(Auth::user()->tipo->tipo == 'Administrador'){
      $delegaciones = Delegacion::all();
    } else {
      $delegaciones = array(Auth::user()->delegacion);
    }

    // Obtener el array de datos a enviar a la vista
    $datos = array(
      // Datos necesarios para los menus de selección
      'propietarios' => Propietario::all(),
      'categorias' => Categoria::all(),
      'tipos' => EstacionesTipo::all(),
      'cuencas' => Cuenca::all(),
      'islas' => Isla::all(),
      'comarcas' => Comarca::all(),
      'delegaciones' => $delegaciones,
      // Provincias
      'provincias' => Provincia::all()
    );

    // Cuenca (SOLUCION CASERA A BUG PROVOCADO POR DROPDOWN DE SEMANTIC-UI EN EL QUE EL 0 ES UNDEFINED)
    if(Input::get('cuenca_cod') == '0'){
      Input::merge( array('cuenca_cod' => '9' ) );
    }

    //$this->debug($datos);

    // Cargar la vista (app/views/estacion/alta.blade.php) con esos datos
    return View::make('estacion.alta', $datos);
  }


  /**
   * GESTIONAR CREAR
   * Dar de alta una nueva estación
   * Input::all() guarda los datos recibidos por el formulario
   *
   * @see http://laravel.com/docs/validation
   * @see http://daylerees.com/codebright/validation
   * @see http://blog.elenakolevska.com/laravel-alpha-validator-that-allows-spaces/
   * @return Object Redirect
   */
  public function gestionarAlta()
  {
    //$this->debug(Input::all());

    // Validamos los datos
    $requisitos = array(
      'indicativo' => 'required|max:10|alpha_num|unique:estaciones',
      'estacion' => 'required|alpha_spaces|max:45',

      'f_alta' => 'date',         //created_at
      'f_modificacion' => 'date', //updated_at
      'f_baja' => 'date',         //deleted_at

      'propietario_id' => 'required',
      'categoria_id' => 'required',
      'estaciones_tipo_id' => 'required',
      'cuenca_cod' => 'required',
      'delegacion_cod' => 'required',

      // Requisitos para Geolocalización
      'f_alta' => 'date',
      'f_baja' => 'date',
      'longitud_g' => 'integer|max:360',
      'longitud_m' => 'integer|max:60',
      'longitud_s' => 'integer|max:60',
      'longitud_w_e' => '',
      'latitud_g' => 'integer|max:360',
      'latitud_m' => 'integer|max:60',
      'latitud_s' => 'integer|max:60',
      'latitud_n_s' => 'required_with:latitud_g,latitud_m,latitud_s',
      'altitud' => 'integer',
      'huso' => 'integer',
      'umt_x' => 'numeric',
      'umt_y' => 'numeric',
      'hoja_mapa' => 'alpha_dash|max:6',
      'ubicacion' => 'alpha_spaces|max:45',

      // Requisitos para Direccion
      'direccion' => '',
      'cp' => 'required_with:direccion|numeric',
      'localidad' => '',
      'provincia_cod' => 'required|exists:provincias,cod',
      'municipio_cod' => 'required_with:provincia_cod|exists:municipios,cod',
      'detalles' => ''
    );
    $validar = Validator::make(Input::all(), $requisitos);

    // Si hay error de validacion redireccionamos a estaciones/alta
    if ($validar->fails()) {
      return Redirect::to('estaciones/alta')
        // Devuelve los errores generados
        ->withErrors($validar)
        // Devuelve los datos recibidos por el formulario que ya han sido validados
        ->withInput(Input::all());
    } else {
      // Indicativo a mayúsculas
      Input::merge( array('indicativo' => strtoupper( Input::get('indicativo') ) ) );

      // Rellenar a null campos opcionales
      Input::merge( array('comarca_id' => Input::get('comarca_id') ? Input::get('comarca_id') : null ) );
      Input::merge( array('isla_id' => Input::get('isla_id') ? Input::get('isla_id') : null ) );

      // Delegacion
      if(!Input::get('delegacion_cod')){
        Input::merge( array('delegacion_cod' => Auth::user()->delegacion->cod ) );
      }

      // Cuenca (SOLUCION CASERA A BUG PROVOCADO POR DROPDOWN DE SEMANTIC-UI EN EL QUE EL 0 ES UNDEFINED)
      if(Input::get('cuenca_cod') == '99'){
        Input::merge( array('cuenca_cod' => '0' ) );
      }

      // ESTACION----------------------------------------
      $estacion = Estacion::create(Input::all());
      // ------------------------------------------------

      // GEOLICALIZACION---------------------------------
      GeolocalizacionController::crear($estacion);
      // ------------------------------------------------

      // DIRECCION------------------------------------------
      DireccionController::crear($estacion);
      //----------------------------------------------------

      // Redireccionar con mensaje
      return Redirect::to('estaciones')
        ->with('flash_notice', 'Alta realizada con éxito!');
    }
  }


  /**
   * VER
   * Ver los datos de una estacion
   */
  public function ver($indicativo)
  {
    $estacion = Estacion::withTrashed()->find($indicativo);

    $datos = array(
      // Datos de la estación
      'estacion' => $estacion,
      // Geo
      'geolocalizacion' => $estacion->geolocalizaciones->first(),
      // Datos Direccion
      'provincias' => Provincia::all(),
      'direccion' => DireccionController::direccion($estacion),
      'municipio' => DireccionController::municipio($estacion),
      'provincia' => DireccionController::provincia($estacion)
    );

    // enviar la estacion a la vista
    return View::make('estacion.ver', $datos);
  }


  /**
   * EDITAR
   * Formulario para editar los datos de un estacion
   */
  public function editar($indicativo)
  {
    // Limitar las delegaciones segun el usuario
    if(Auth::user()->tipo->tipo == 'Administrador'){
      $delegaciones = Delegacion::all();
    } else {
      $delegaciones = array(Auth::user()->delegacion);
    }

    $estacion = Estacion::withTrashed()->find($indicativo);

    $geolocalizacion = $estacion->geolocalizaciones->first();

    $datos = array(
      // Datos de la estación activa o inactiva
      'estacion' => Estacion::withTrashed()->find($indicativo),

      // Datos de la estación almacenados en otras tablas
      'inspecciones' => Inspeccion::all(),
      'fotos' => Foto::all(),
      'incidencias' => Incidencia::all(),
      'geolocalizaciones' => Geolocalizacion::all(),
  //    'direcciones' => Direccion::all(),

      // Datos necesarios para los menus de selección
      'propietarios' => Propietario::all(),
      'categorias' => Categoria::all(),
      'tipos' => EstacionesTipo::all(),
      'cuencas' => Cuenca::all(),
      'islas' => Isla::all(),
      'comarcas' => Comarca::all(),
      'delegaciones' => $delegaciones,

      // Geolocalizador
      'longitud_g' => $geolocalizacion->longitud_g,
      'longitud_m' => $geolocalizacion->longitud_m,
      'longitud_s' => $geolocalizacion->longitud_s,
      'longitud_w_e' => $geolocalizacion->longitud_w_e,
      'latitud_g' => $geolocalizacion->latitud_g,
      'latitud_m' => $geolocalizacion->latitud_m,
      'latitud_s' => $geolocalizacion->latitud_s,
      'latitud_n_s' => $geolocalizacion->latitud_n_s,
      'altitud' => $geolocalizacion->altitud,
      'huso' => $geolocalizacion->huso,
      'umt_x' => $geolocalizacion->umt_x,
      'umt_y' => $geolocalizacion->umt_y,
      'hoja_mapa' => $geolocalizacion->hoja_mapa,
      'ubicacion' => $geolocalizacion->ubicacion,

      // Incidencias
      'incidencias_tipos' => IncidenciasTipo::all(),

      // Direccion
      'provincias' => Provincia::all(),
      'direccion' => DireccionController::direccion($estacion),
      'municipio' => DireccionController::municipio($estacion),
      'provincia' => DireccionController::provincia($estacion)

    );

    //$this->debug($datos);

    // Cargar la vista (app/views/estacion/editar.blade.php) con esos datos
    return View::make('estacion.editar', $datos);
  }

  /**
   * GESTIONAR EDITAR
   * Edita los datos de un estacion
   */
  public function gestionarEditar($indicativo)
  {
    //$this->debug(Input::all());

    // Validamos Inputs
    $requisitos = array(
      'indicativo' => "required|max:10|alpha_num|unique:estaciones,indicativo,$indicativo,indicativo",
      'estacion' => 'required|max:45',
      'f_alta' => 'date',         //created_at
      'f_modificacion' => 'date', //updated_at
      'f_baja' => 'date',         //deleted_at
      'propietario_id' => 'required',
      'categoria_id' => 'required',
      'estaciones_tipo_id' => 'required',
      'cuenca_cod' => 'required',
      'delegacion_cod' => 'required',

      // Requisitos para Geolocalización
      'f_alta' => 'date',
      'f_baja' => 'date',
      'longitud_g' => 'integer|max:360',
      'longitud_m' => 'integer|max:60',
      'longitud_s' => 'integer|max:60',
      'longitud_w_e' => 'required_with:longitud_g,longitud_m,longitud_s',
      'latitud_g' => 'integer|max:360',
      'latitud_m' => 'integer|max:60',
      'latitud_s' => 'integer|max:60',
      'latitud_n_s' => 'required_with:latitud_g,latitud_m,latitud_s',
      'altitud' => 'integer',
      'huso' => 'integer',
      'umt_x' => 'numeric',
      'umt_y' => 'numeric',
      'hoja_mapa' => 'alpha_dash|max:6',
      'ubicacion' => 'alpha_spaces|max:45',

      // Requisitos para Direccion
      'direccion' => '',
      'cp' => 'required_with:direccion|numeric',
      'localidad' => '',
      'provincia_cod' => 'required|exists:provincias,cod',
      'municipio_cod' => 'required_with:provincia_cod|exists:municipios,cod',
      'detalles' => ''
    );
    $validar = Validator::make(Input::all(), $requisitos);

    // Si hay error de validacion redireccionamos a estaciones/{indicativo}/editar
    if ($validar->fails()) {
      return Redirect::to("estaciones/$indicativo/editar")
        // Devuelve los errores generados
        ->withErrors($validar)
        // Devuelve los datos recibidos por el formulario que ya han sido validados
        ->withInput(Input::all());
    } else {
      // Seleccionar estacion activa
      //$estacion = Estacion::find($indicativo);

      // Cuenca (SOLUCION CASERA A BUG PROVOCADO POR DROPDOWN DE SEMANTIC-UI EN EL QUE EL 0 ES UNDEFINED)
      if(Input::get('cuenca_cod') == '99'){
        Input::merge( array('cuenca_cod' => '0' ) );
      }

      // Seleccionar estacion activa o inactiva
      $estacion = Estacion::withTrashed()->find($indicativo);

      // Preparamos la actualizacion de sus datos
      $estacion->indicativo = Input::get('indicativo') ? strtoupper( Input::get('indicativo') ) : null;
      $estacion->estacion = Input::get('estacion') ? Input::get('estacion') : null;
      $estacion->propietario_id = Input::get('propietario_id') ? Input::get('propietario_id') : null;
      $estacion->categoria_id = Input::get('categoria_id') ? Input::get('categoria_id') : null;
      $estacion->estaciones_tipo_id = Input::get('estaciones_tipo_id') ? Input::get('estaciones_tipo_id') : null;
      $estacion->cuenca_cod = Input::get('cuenca_cod'); // SI TERNARIO POR QUE PUEDE SER 0
      $estacion->comarca_id = Input::get('comarca_id') ? Input::get('comarca_id') : null;
      $estacion->isla_id = Input::get('isla_id') ? Input::get('isla_id') : null;
      $estacion->delegacion_cod = Input::get('delegacion_cod') ? Input::get('delegacion_cod') : null;

      // Guardamos los cambios
      $estacion->save();

      // DIRECCION---------------------------------------
      if($estacion->direcciones->first()){
        DireccionController::actualizar($estacion);
      } else {
        DireccionController::crear($estacion);
      }
      //-------------------------------------------------

      // GEOLICALIZACION---------------------------------
      GeolocalizacionController::actualizar($estacion);
      // ------------------------------------------------

      return Redirect::to("estaciones/$estacion->indicativo")
        ->with('flash_notice', 'Modificación realizada con éxito!')
        ->withEstación(Estacion::find($estacion->indicativo));
    }
  }

  /**
   * BAJA
   * Dar de baja una estación
   */
  public function darBaja($indicativo)
  {
    // Recuperamos la estacion de la bbdd y la damos de baja
    Estacion::withTrashed()->find($indicativo)->delete();

    // Redireccionamos a estaciones con un mensaje de que ha salido bien
    return Redirect::to("estaciones/$indicativo")
      ->with('flash_notice', 'Se ha dado de baja la estación!');
  }


  /**
   * ALTA
   * Dar de alta una estación
   */
  public function darAlta($indicativo)
  {
    // Recuperamos la estacion y restauramos su estado a Alta
    Estacion::withTrashed()->find($indicativo)->restore();

    // Redireccionamos a estaciones con un mensaje de que ha salido bien
    return Redirect::to("estaciones/$indicativo")
      ->with('flash_notice', 'Se ha dado de alta la estación!');
  }


  /**
   * ELIMINAR: 
   * Eliminar definitivamente una estación
   */
  public function eliminar($indicativo)
  {
    // Seleccionamos la estacion de la bbdd y la eliminamos definitvamente
    Estacion::withTrashed()->find($indicativo)->forceDelete();

    // Redireccionamos a estaciones con un mensaje de que ha salido bien
    return Redirect::to('estaciones')
      ->with('flash_notice', 'Estación eliminada con éxito!');
  }

  public function confirmarEliminar($indicativo){
    return View::make('estacion.eliminar')
      ->with('indicativo',$indicativo);
  }

  /**
   * ASOCIAR
   * Asociar Colaborador
   */
  public static function asociarColaborador($colaborador){
    if(Input::get('estacion_indicativo')){
      // Quitar todas sus estaciones asociadas
      if($colaborador->estaciones->first())
        $colaborador->estaciones()->detach();

      if(is_array(Input::get('estacion_indicativo'))){
        // Eliminar duplicados en el array
        $estaciones_indicativos = array_unique(Input::get('estacion_indicativo'));

        // Asociar las estaciones que hay en el array
        foreach($estaciones_indicativos as $estacion_indicativo){
          if(!empty($estacion_indicativo))
            $colaborador->estaciones()->attach($estacion_indicativo);
        }
      } else {
        // Asociar la nueva estacion
        $colaborador->estaciones()->attach(Input::get('estacion_indicativo'));
      }
    }
  }


}
