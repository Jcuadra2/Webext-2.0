<?php
// http://scotch.io/tutorials/simple-laravel-crud-with-resource-controllers
/**
 * Todos los controladores necesarios para gestionar un colaborador se encuentran aquí
 */
class ColaboradorController extends \BaseController
{

	/**
   * VER LISTADO
	 * Mostrar todos los colaboradores
	 */
	public function listado()
	{
    // Obtener todos los colaboradores
    if(Auth::user()->tipo->tipo == 'Administrador' or Auth::user()->tipo->tipo == 'Supervisor'){
      $colaboradores = Colaborador::withTrashed()->get();
      //$colaboradoresActivos = Colaborador::all();
      //$colaboradoresInactivos = Colaborador::onlyTrashed()->get();
    } else {
      $colaboradores = Auth::user()->delegacion->colaboradores;
      $colaborador->estaciones()->first();

      /*
       * Mediante Pivot Table
          $colaboradores = DB::select('SELECT id, cif_nif, nombre, apellidos, c.f_alta, c.f_modificacion, c.f_baja
          FROM colaboradores as c
          LEFT JOIN estaciones_has_colaboradores as ec
          ON (c.id = ec.colaborador_id)
          LEFT JOIN estaciones as e
          ON (e.indicativo = ec.estacion_indicativo)
          WHERE e.delegacion_cod = :cod', array( 'cod' => Auth::user()->delegacion->cod));
       */
    }

    // enviar los colaboradores a la vista
    return View::make('colaborador.listado')
      ->with('colaboradores', $colaboradores);
  }

  /**
   * ALTA
	 * Mostrar el formulario para dar de alta un nuevo colaborador
	 */
	public function alta()
	{
    // Estaciones
    if(Auth::user()->tipo->tipo == 'Administrador'){
    // Todas las estaciones Vacias
      $estaciones = Estacion::estacionesVacias();
    } else {
    // Estaciones Vacias de la delegacion del usuario
      $estaciones = Estacion::estacionesVaciasDelegacion();
    }

    // Obtener el array de datos a enviar a la vista
    $datos = array(
      'estudios' => Estudio::all(),
      'tipos' => ColaboradoresTipo::all(),
      'profesiones' => Profesion::all(),
      // Estaciones
      'estaciones' => $estaciones,
      // Delegaciones
      'delegaciones' => Delegacion::all(),
      // Provincias
      'provincias' => Provincia::all()
    );

    // Cargar la vista (app/views/colaborador/alta.blade.php) con esos datos
    return View::make('colaborador.alta', $datos);
	}


  /**
   * GESTIONAR ALTA
   * Gestionar los datos recibidos del formulario para dar de alta un nuevo colaborador
   * Input::all() guarda los datos recibidos por el formulario
   *
   * @see http://laravel.com/docs/validation
   * @see http://daylerees.com/codebright/validation
   * @see http://blog.elenakolevska.com/laravel-alpha-validator-that-allows-spaces/
   * @return Object Redirect
   */
  public function gestionarAlta()
  {
    // $this->debug(Input::all());

    $requisitos = array(
      // Requisitos para Colaborador
      'delegacion_cod' => 'required|exists:delegaciones,cod',
      'cif_nif' => 'required|size:9|cif_nif|unique_with:colaboradores,delegacion_cod',
      'nombre' => 'required|alpha_spaces|max:45',
      'apellidos' => 'required|alpha_spaces|max:45',
      'f_alta' => 'date',         //created_at
      'f_modificacion' => 'date', //updated_at
      'f_baja' => 'date',         //deleted_at
      'f_nacimiento' => "date_format:d/m/Y",
      'fiabilidad' => 'numeric|min:0|max:5',
      'continuidad' => 'numeric|min:0|max:5',
      'profesion_id' => 'exists:profesiones,id',
      'estudio_id' => 'exists:estudios,id',
      'tipo' => 'exists:colaboradores_tipos,id',
      'colaborador_id' => 'exists:colaboradores,cif_nif', // No comprueba que colaborador y asociado sean la misma persona

      // Requisitos para Delegacion
      'delegacion_cod' => 'required|exists:delegaciones,cod',
      // Estaciones (que exista en estaciones, que no este dada de baja y que pertenezca a la delegacion del usuario)
      //'estacion_indicativo' => 'exists:estaciones,indicativo|unique_with:estaciones_has_colaboradores,colaborador_id',

      // Requisitos para Cuentas
      'cuenta' => 'required|alpha_dash',

      // Requisitos para Localizadores
      'fijo' => 'numeric',
      'movil' => 'numeric',
      'fax' => 'numeric',
      'email' => 'email',

      // Requisitos para Galardones
      'diploma' => "year",
      'placa' => "year",
      'premio' => "year",
      'condecoracion'=> "year",

      // Requisitos para Direccion
      'direccion' => 'required',
      'cp' => 'required|alpha_num',
      'localidad' => 'alpha_spaces',
      'provincia_cod' => 'required|exists:provincias,cod',
      'municipio_cod' => 'required_with:provincia_cod|exists:municipios,cod',
      'detalles' => '',
    );

    $validar = Validator::make(Input::all(), $requisitos);

    // Si hay error de validacion redireccionamos a colaboradores/alta
    if ($validar->fails()) {
      return Redirect::to('colaboradores/alta')
        // Devuelve los errores generados
        ->withErrors($validar)
        // Devuelve los datos recibidos por el formulario que ya han sido validados
        ->withInput(Input::all());
    } else {

      // cif_nif a mayúsculas
      Input::merge( array('cif_nif' => strtoupper( Input::get('cif_nif') ) ) );

      // f_nacimiento en formato mySql
      Input::merge( array('f_nacimiento' => HelperController::fechaCastellano_a_mysql( Input::get('f_nacimiento') ) ) );

      // Rellenar a null campos opcionales
      Input::merge( array('colaboradores_tipo_id' => Input::get('colaboradores_tipo_id') ? Input::get('colaboradores_tipo_id') : null ) );
      Input::merge( array('estudio_id' => Input::get('estudio_id') ? Input::get('estudio_id') : null ) );
      Input::merge( array('colaborador_id' => Input::get('colaborador_id') ? Input::get('colaborador_id') : null ) );
      Input::merge( array('profesion_id' => Input::get('profesion_id') ? Input::get('profesion_id') : null ) );

      // COLABORADOR----------------------------------------
      $colaborador = Colaborador::create(Input::all());
      //----------------------------------------------------

      // CUENTA---------------------------------------------
      CuentaController::crear($colaborador);
      //----------------------------------------------------

      // DIRECCION------------------------------------------
      DireccionController::crear($colaborador);
      //----------------------------------------------------

      // GALARDONES-----------------------------------------
      GalardonController::crear($colaborador);
      //----------------------------------------------------

      // LOCALIZADORES-----------------------------------
      LocalizadorController::crearActualizarLocalizador('fijo', $colaborador);
      LocalizadorController::crearActualizarLocalizador('movil', $colaborador);
      LocalizadorController::crearActualizarLocalizador('fax', $colaborador);
      LocalizadorController::crearActualizarLocalizador('email', $colaborador);
      //-------------------------------------------------

      // ESTACIONES--------------------------------------
      EstacionController::asociarColaborador($colaborador);
      //-------------------------------------------------

      // Redireccionar a colaboradores con un mensaje de que ha salido bien
      return Redirect::to('colaboradores')
        ->with('flash_notice', 'Alta realizada con éxito!');
    }
  }



	/**
   * VER
	 * Ver los datos  de un colaborador
	 */
	public function ver($id)
	{
    $colaborador = Colaborador::withTrashed()->find($id);
    // Sustituimos la f_nacimiento almacenada en mySql por la misma pero en castellano
    $colaborador->f_nacimiento = date('d/m/Y', strtotime($colaborador->f_nacimiento));

    $datos = array(
      // Datos de la estación
      'colaborador' => $colaborador,
      // Datos Direccion
      'provincias' => Provincia::all(),
      'direccion' => DireccionController::direccion($colaborador),
      'municipio' => DireccionController::municipio($colaborador),
      'provincia' => DireccionController::provincia($colaborador)
    );

    return View::make('colaborador.ver', $datos);
	}


	/**
   * EDITAR
	 * Muestra el formulario para editar los datos de un colaborador
	 */
	public function editar($id)
	{
    $colaborador = Colaborador::withTrashed()->find($id);

    $cuenta = $colaborador->cuentas->first();
    $fijo = $colaborador->localizadores()->fijo()->first();
    // Localizadores
    $movil = $colaborador->localizadores()->movil()->first();
    $fax = $colaborador->localizadores()->fax()->first();
    $email = $colaborador->localizadores()->email()->first();
    $anotacion = $colaborador->anotaciones->first();
    // Galardones
    $diploma = $colaborador->galardones()->diploma()->first();
    $placa = $colaborador->galardones()->placa()->first();
    $premio = $colaborador->galardones()->premio()->first();
    $condecoracion = $colaborador->galardones()->condecoracion()->first();

    // Estaciones
    if(Auth::user()->tipo->tipo == 'Administrador'){
      // Todas las estaciones Vacias
      $estaciones = Estacion::estacionesVacias();
    } else {
      // Estaciones Vacias de la delegacion del usuario
      $estaciones = Estacion::estacionesVaciasDelegacion();
    }
    $estaciones_colaborador = $colaborador->estaciones->first();

    $datos = array(
      'colaborador' => $colaborador,
      'estudios' => Estudio::all(),
      'tipos' => ColaboradoresTipo::all(),
      'profesiones' => Profesion::all(),
      'cuenta' => $cuenta ? $cuenta->ccc : null,
      'anotacion' => $anotacion ? $anotacion->anotacion : null,

      // Estaciones
      'estaciones' => $estaciones,
      'estaciones_colaborador' => $estaciones_colaborador ? $colaborador->estaciones : null,

      // Delegaciones
      'delegaciones' => Delegacion::all(),
      'delegacion' => $colaborador->delegacion->cod,

      // Localizadores
      'fijo' => $fijo ? $fijo->localizador : null,
      'movil' => $movil ? $movil->localizador : null,
      'fax' => $fax ? $fax->localizador : null,
      'email' => $email ? $email->localizador : null,

      // Galardones
      'diploma' => $diploma ? $diploma->pivot->year : null,
      'placa' => $placa ? $placa->pivot->year : null,
      'premio' => $premio ? $premio->pivot->year : null,
      'condecoracion' => $condecoracion ? $condecoracion->pivot->year : null,

      // Direccion
      'provincias' => Provincia::all(),
      'direccion' => DireccionController::direccion($colaborador),
      'municipio' => DireccionController::municipio($colaborador),
      'provincia' => DireccionController::provincia($colaborador)
    );

    //$this->debug($datos['estaciones_colaborador']);

    // Sustituimos la f_nacimiento almacenada en mySql por la misma pero en castellano
    $colaborador->f_nacimiento = date('d/m/Y', strtotime($colaborador->f_nacimiento));

    // Cargar la vista (app/views/colaborador/editar.blade.php) con esos datos
    return View::make('colaborador.editar', $datos);
	}

  /**
   * GESTIONAR EDITAR
   * Edita los datos de un colaborador
   */
  public function gestionarEditar($id)
  {

    // Debug
    //$this->debug(Input::all());
    /**
     * VALIDATION
     */
    $requisitos = array(
      'delegacion_cod' => 'required|exists:delegaciones,cod',
      'cif_nif' => "required|size:9|cif_nif|unique_with:colaboradores,delegacion_cod,$id",
      'nombre' => 'required|alpha_spaces|max:45',
      'apellidos' => 'required|alpha_spaces|max:45',
      'f_alta' => 'date',         //created_at
      'f_modificacion' => 'date', //updated_at
      'f_baja' => 'date',         //deleted_at
      'f_nacimiento' => "date_format:d/m/Y",
      'fiabilidad' => 'numeric|min:0|max:5',
      'continuidad' => 'numeric|min:0|max:5',
      'profesion_id' => 'exists:profesiones,id',
      'estudio_id' => 'exists:estudios,id',
      'tipo' => 'exists:colaboradores_tipos,id',
      'colaborador_id' => 'exists:colaboradores,cif_nif', // No comprueba que colaborador y asociado sean la misma persona

      // Requisitos para Delegacion
      'delegacion_cod' => 'required|exists:delegaciones,cod',
      // Estaciones (que exista en estaciones, que no este dada de baja y que pertenezca a la delegacion del usuario)
      //'estacion_indicativo' => 'exists:estaciones,indicativo|unique_with:estaciones_has_colaboradores,colaborador_id',

      // Requisitos para Cuentas
      'cuenta' => 'required|alpha_dash',

      // Requisitos para Localizadores
      'fijo' => 'numeric',
      'movil' => 'numeric',
      'fax' => 'numeric',
      'email' => 'email',

      // Requisitos para Galardones
      'diploma' => "year",
      'placa' => "year",
      'premio' => "year",
      'condecoracion'=> "year",

      // Requisitos para Direccion
      'direccion' => 'required',
      'cp' => 'required|alpha_num',
      'localidad' => 'alpha_spaces',
      'provincia_cod' => 'required|exists:provincias,cod',
      'municipio_cod' => 'required_with:provincia_cod|exists:municipios,cod',
      'detalles' => '',
    );

    $validar = Validator::make(Input::all(), $requisitos);

    // Si hay error de validacion redireccionamos a colaboradores/{id}/editar
    if ($validar->fails()) {
      return Redirect::to("colaboradores/$id/editar")
        // Devuelve los errores generados
        ->withErrors($validar)
        // Devuelve los datos recibidos por el formulario que ya han sido validados
        ->withInput(Input::all());
    } else {
      // Seleccionar colaborador activo
      //$colaborador = Colaborador::find($id);

      // Seleccionar colaborador activo o inactivo
      $colaborador = Colaborador::withTrashed()->find($id);

      // Preparamos la actualizacion de sus datos
      $colaborador->cif_nif = strtoupper( Input::get('cif_nif') );
      $colaborador->nombre = Input::get('nombre');
      $colaborador->apellidos = Input::get('apellidos');
      $colaborador->f_nacimiento = HelperController::fechaCastellano_a_mysql( Input::get('f_nacimiento') );
      $colaborador->fiabilidad = Input::get('fiabilidad');
      $colaborador->continuidad = Input::get('continuidad');
      $colaborador->profesion_id = Input::get('profesion_id') ? Input::get('profesion_id') : null;
      $colaborador->estudio_id = Input::get('estudio_id') ? Input::get('estudio_id') : null;
      $colaborador->colaboradores_tipo_id =
        Input::get('colaboradores_tipo_id') ? Input::get('colaboradores_tipo_id') : null;
      $colaborador->delegacion_cod = Input::get('delegacion_cod');

      //$this->debug($colaborador->f_nacimiento);
      // COLABORADOR-------------------------------------
      $colaborador->save();
      //-------------------------------------------------

      //$this->debug(Input::all());

      // DIRECCION---------------------------------------
      if($colaborador->direcciones->first()){
        DireccionController::actualizar($colaborador);
      } else {
        DireccionController::crear($colaborador);
      }
      //-------------------------------------------------

      // CUENTA------------------------------------------
      CuentaController::actualizar($colaborador);
      //-------------------------------------------------

      // GALARDONES--------------------------------------
      GalardonController::actualizar($colaborador);
      //-------------------------------------------------

      // LOCALIZADORES-----------------------------------
      LocalizadorController::crearActualizarLocalizador('fijo', $colaborador);
      LocalizadorController::crearActualizarLocalizador('movil', $colaborador);
      LocalizadorController::crearActualizarLocalizador('fax', $colaborador);
      LocalizadorController::crearActualizarLocalizador('email', $colaborador);
      //-------------------------------------------------

      // ESTACIONES--------------------------------------
      EstacionController::asociarColaborador($colaborador);
      //-------------------------------------------------

      // ESTACIONES--------------------------------------
      AnotacionController::crearActualizarAnotacion(4, $colaborador);
      //-------------------------------------------------

      return Redirect::to("colaboradores/$id")
        ->with('flash_notice', 'Modificación realizada con éxito!')
        ->withColaborador(Colaborador::find($id));
    }
  }


  /**
   * BAJA
   * Dar de baja un colaborador
   *
   * @param  int  $id
   * @return Response
   */
  public function darBaja($id)
  {
    // Recuperamos el colaborador de la bbdd y lo damos de baja
    Colaborador::withTrashed()->find($id)->delete();

    // ...y redireccionamos a colaboradores con un mensaje de que ha salido bien
    return Redirect::to("colaboradores/$id")
      ->with('flash_notice', 'Se ha dado de baja al colaborador!');
  }


  /**
   * ALTA
   * Dar de alta un colaborador
   *
   * @param  int  $id
   * @return Response
   */
  public function darAlta($id)
  {
    // Recuperamos al colaborador y restauramos su estatus a Alta
    Colaborador::withTrashed()->find($id)->restore();

    // ...y redireccionamos a colaboradores con un mensaje de que ha salido bien
    return Redirect::to("colaboradores/$id")
      ->with('flash_notice', 'Se ha dado de alta al colaborador!');
  }


	/**
   * ELIMINAR
	 * Eliminar un colaborador
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function eliminar($id)
	{
    // Seleccionamos el colaborador de la bbdd y lo eliminamos definitvamente
    Colaborador::withTrashed()->find($id)->forceDelete();

    // ...y redireccionamos a colaboradores con un mensaje de que ha salido bien
    return Redirect::to('colaboradores')
      ->with('flash_notice', 'Colaborador eliminado con éxito!');
	}

  public function confirmarEliminar($id){
    return View::make('colaborador.eliminar')
      ->with('id',$id);
  }


}


