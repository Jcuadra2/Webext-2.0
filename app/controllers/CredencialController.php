<?php

class CredencialController extends \BaseController
{
  /**
   * ENTRAR
   * Inicio de sesión
   */
  public function entrar()
  {
    // Cargamos la vista entrar
    return View::make('credencial/entrar');
  }


  /**
   * GESTIONAR ENTRAR
   * Gestionar credenciales de inicio de sesión
   */
  public function gestionarEntrar()
  {
    // Guardamos las credenciales recibidas mediante POST en $usuarios
    $credenciales = array(
      'usuario' => Input::get('usuario'),
      'password' => Input::get('password')
    );

    // Intentamos iniciar sesión con las credenciales recibidas
    if (Auth::attempt($credenciales)) {
      return Redirect::to('/')
        ->with('flash_notice', 'Sesión iniciada correctamente.');
    }

    // Si no lo logramos volvemos a login e informamos del problema
    return Redirect::to('entrar')
      ->with('flash_error', 'Credenciales de acceso incorrectas!')
      ->withInput(Input::except('password'));
  }


  /**
   * SALIR
   * Cerrar la sesión
   */
  public function salir()
  {
    Auth::logout();

    return Redirect::to('/')
      ->with('flash_notice', 'Sesión finalizada correctamente.');
  }


  /**
   * VER LISTADO
   * Mostrar listado con todas las credenciales y sus datos
   */
  public function listado()
  {
      // Obtener array con todas las credenciales y sus datos
      $credenciales = Credencial::withTrashed()->get();

      // Cargar la vista (app/views/credencial/listado.blade.php) con esos datos
      return View::make('credencial.listado')
        ->with('credenciales', $credenciales);
  }


  /**
   * VER
   * Ver los datos de una credencial
   */
  public function ver($id)
  {
    // Seleccionar credencial activa
    //$credencial = Credencial::find($id);

    // Seleccionar credencial activa o inactiva
    $credencial = Credencial::withTrashed()->find($id);

    // Enviar datos de $credencial a la vista
    return View::make('credencial.ver')
      ->with('credencial', $credencial);
  }


  /**
   * CREAR
   * Mostrar el formulario para crear una nueva credencial
   */
  public function crear()
  {
    $datos = array(
      // Datos necesarios para los menus de selección
      'tipos' => CredencialesTipo::all(),
      'delegaciones' => Delegacion::all()
    );

    // Cargar la vista (app/views/credenciales/crear.blade.php) con esos datos
    return View::make('credencial.crear', $datos);
  }

  /**
   * GESTIONAR CREAR
   * Crea una nueva credencial
   */
  public function gestionarCrear()
  {
    // Validamos Inputs
    $requisitos = array(
      // Datos de la credencial
      'usuario' => "required|alpha|max:100|unique:credenciales",
      'nombre' => 'required|alpha_spaces|max:45',
      'apellidos' => 'required|alpha_spaces|max:45',
      'puesto' => 'alpha_spaces|max:45',
      'observaciones' => 'alpha_spaces|max:140',
      'credenciales_tipo_id' => 'required',
      'delegacion_cod' => 'required_if:credenciales_tipo_id,2|required_if:credenciales_tipo_id,3',
      'password' => 'required|confirmed',
      'password_confirmation' => 'required'
    );
    $validar = Validator::make(Input::all(), $requisitos);

    // Si hay error de validacion redireccionamos
    if ($validar->fails()) {
      return Redirect::to('credenciales/crear')
        // Devuelve los errores generados
        ->withErrors($validar)
        // Devuelve los datos recibidos por el formulario que ya han sido validados
        ->withInput(Input::all());
    } else {
      // Preparamos el array con los datos a insertar
      Input::merge(
        array(
          'password' => Input::get('password') ? Hash::make(Input::get('password')) : null
        )
      );

      // Crear la delegación en la bbdd con los datos recibidos por el formulario
      Credencial::create(Input::all());
    }

    // Finalmente redireccionamos a la vista delegaciones
    return Redirect::to('credenciales')
      ->with('flash_notice', 'Credencial creada con éxito!');
  }


  /**
   * EDITAR
   * Formulario para editar los datos de una credencial
   */
  public function editar($id)
  {
    $datos = array(
      // Datos de la credencial activa o inactiva
      'credencial' => Credencial::withTrashed()->find($id),
      // Datos necesarios para los menus de selección
      'tipos' => CredencialesTipo::all(),
      'delegaciones' => Delegacion::all()
    );

    // Cargar la vista (app/views/credencial/editar.blade.php) con esos datos
    return View::make('credencial.editar', $datos);
  }


  /**
   * GESTIONAR EDITAR
   * Edita los datos de una credencial
   */
  public function gestionarEditar($id)
  {
    //$this->debug(Input::all());

    // Validamos Inputs
    $requisitos = array(
      // Datos de la credencial
      'usuario' => "required|alpha|max:100|unique:credenciales,usuario,$id",
      'nombre' => 'required|alpha_spaces|max:45',
      'apellidos' => 'required|alpha_spaces|max:45',
      'puesto' => 'alpha_spaces|max:45',
      'observaciones' => 'alpha_spaces|max:140',
      'credenciales_tipo_id' => 'required',
      'delegacion_cod' => 'required_if:credenciales_tipo_id,2|required_if:credenciales_tipo_id,3',
      'password' => 'required|confirmed',
      'password_confirmation' => 'required'
    );
    $validar = Validator::make(Input::all(), $requisitos);

    // Si hay error de validacion redireccionamos a credenciales/{id}/editar
    if ($validar->fails()) {
      return Redirect::to("credenciales/$id/editar")
        // Devuelve los errores generados
        ->withErrors($validar)
        // Devuelve los datos recibidos por el formulario que ya han sido validados
        ->withInput(Input::all());
    } else {
      // Seleccionar credencial activa
      //$credencial = Credencial::find($id);

      // Seleccionar credencial activa o inactiva
      $credencial = Credencial::withTrashed()->find($id);

      // Preparamos la actualizacion de sus datos
      $credencial->usuario = Input::get('usuario') ? Input::get('usuario') : null;
      $credencial->nombre = Input::get('nombre') ? Input::get('nombre') : null;
      $credencial->apellidos = Input::get('apellidos') ? Input::get('apellidos') : null;
      $credencial->puesto = Input::get('puesto') ? Input::get('puesto') : null;
      $credencial->observaciones = Input::get('observaciones') ? Input::get('observaciones') : null;
      $credencial->credenciales_tipo_id = Input::get('credenciales_tipo_id') ? Input::get('credenciales_tipo_id') : null;
      $credencial->delegacion_cod = Input::get('delegacion_cod') ? Input::get('delegacion_cod') : null;
      $credencial->password = Input::get('password') ? Hash::make(Input::get('password')) : null;

      // Guardamos los cambios
      $credencial->save();

      // Actualizamos la credencial directamente desde un array
      //$credencial->update(Input::all());

      return Redirect::to("credenciales/$id")
        ->with('flash_notice', 'Modificación realizada con éxito!')
        ->withEstación(Credencial::find($id));
    }
  }

  /**
   * BAJA
   * Dar de baja una credencial
   */
  public function darBaja($id)
  {
    // Recuperamos la credencial de la bbdd y la damos de baja
    Credencial::withTrashed()->find($id)->delete();

    // Redireccionamos a credenciales con un mensaje de que ha salido bien
    return Redirect::to("credenciales/$id")
      ->with('flash_notice', 'Se ha dado de baja la credencial!');
  }


  /**
   * ALTA
   * Dar de alta una credencial
   */
  public function darAlta($id)
  {
    // Recuperamos la credencial y restauramos su estado a Alta
    Credencial::withTrashed()->find($id)->restore();

    // Redireccionamos a credenciales con un mensaje de que ha salido bien
    return Redirect::to("credenciales/$id")
      ->with('flash_notice', 'Se ha dado de alta la credencial!');
  }


  /**
   * ELIMINAR:
   * Eliminar definitivamente una credencial
   */
  public function eliminar($id)
  {
    // Seleccionamos la credencial de la bbdd y la eliminamos definitvamente
    Credencial::withTrashed()->find($id)->forceDelete();

    // Redireccionamos a credenciales con un mensaje de que ha salido bien
    return Redirect::to('credenciales')
      ->with('flash_notice', 'Estación eliminada con éxito!');
  }

  public function confirmarEliminar($id){
    return View::make('credencial.eliminar')
      ->with('id',$id);
  }


} 