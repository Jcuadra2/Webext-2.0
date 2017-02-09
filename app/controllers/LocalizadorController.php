<?php

class LocalizadorController extends \BaseController
{

  public static function crearActualizarLocalizador($tipo, $colaborador)
  {
    $idTipo = array('fijo'=>1, 'movil'=>2, 'fax'=>3, 'email'=>4);
    $id = $idTipo[$tipo];

    $datos = Input::get($tipo);

    // Comprobamos si ya tenia un fijo o hay que crear uno nuevo
    $localizador = $colaborador->localizadores()->where('localizadores_tipo_id','=',$id)->first();

    // Se le quitan los espacios al input para que si solo tenia espacios quede vacio
    $datos = trim($datos);

    if(!is_null($localizador)){
      // Localizador ya existe
      if(empty($datos)){
        // Input vacio
        // Borramos el localizador
        $localizador->delete();
      } else {
        // Input lleno numeros
        // Actualizamos los datos existentes
        $localizador->localizador = $datos;
        $localizador->save();
      }
    } else {
      // Localizador no existe
      if(!empty($datos)){
        // Input lleno de numeros
        // Creamos un nuevo localizador de tipo 'Fijo' para el colaborador
        $localizador = new Localizador;
        $localizador->localizador = $datos;
        $localizador->localizadores_tipo_id = $id;
        $colaborador->localizadores()->save($localizador);
      }
    }
  }

}
