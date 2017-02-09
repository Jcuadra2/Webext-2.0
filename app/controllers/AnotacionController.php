<?php

class AnotacionController extends \BaseController
{
  public static function crearActualizarAnotacion($idTipo, $colaborador)
  {
    // De momento solo hay anotaciones de un tipo por falta de tiempo para desarrollar algo mas complejo
    $id = $idTipo;
    $tipo = 'anotacion';

    $datos = Input::get($tipo);

    // Comprobamos si ya tenia una Anotacion o hay que crear una nueva
    $anotacion = $colaborador->anotaciones()->where('anotaciones_tipo_id','=',$id)->first();

    // Se le quitan los espacios al input para que si solo tenia espacios quede vacio
    $datos = trim($datos);

    if(!is_null($anotacion)){
      // Anotacion ya existe
      if(empty($datos)){
        // Input vacio
        // Borramos la Anotacion
        $anotacion->delete();
      } else {
        // Input lleno de datos
        // Actualizamos los datos existentes
        $anotacion->anotacion = $datos;
        $anotacion->save();
      }
    } else {
      // Anotacion no existe
      if(!empty($datos)){
        // Input lleno de datos
        // Creamos una Anotacion de tipo 'Anotacion' para el colaborador
        $anotacion = new Anotacion;
        $anotacion->anotacion = $datos;
        $anotacion->anotaciones_tipo_id = $id;
        $colaborador->anotaciones()->save($anotacion);
      }
    }
  }

}
