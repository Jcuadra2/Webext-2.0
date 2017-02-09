<?php

class GratificacionController extends \BaseController
{
  public static function ajaxEstaciones($id){
    $colaborador = Colaborador::withTrashed()->find($id);

    foreach($colaborador->estaciones->all() as $estacion){
      $estaciones[$estacion->indicativo] = $estacion->estacion;
    }

    return Response::json($estaciones);
  }


  public static function ajaxListar($id)
  {
    $colaborador = Colaborador::withTrashed()->find($id);

    // CARGAR LISTADO
    $gratificaciones = $colaborador->gratificaciones()->orderBy('year', 'desc')->get();

    foreach($gratificaciones as $gratificacion){

      // ESTADO
      if($gratificacion->gratificaciones_estado_id){
        $estado = GratificacionEstado::find($gratificacion->gratificaciones_estado_id)->estado;
      } else {
        $estado = '';
      }
      $gratificacion->estado = $estado;
      //

      // INDICATIVO
      $gratificacion->gratificacion_estacion_indicativo = $gratificacion->estacion_indicativo;
      //

      // ESTACION
      if($gratificacion->estacion_indicativo){
        $estacion = Estacion::find($gratificacion->estacion_indicativo)->estacion;
      } else {
        $estacion = '';
      }
      $gratificacion->estacion = $estacion;
      //

      if(!$gratificacion->importe)
        !$gratificacion->importe = '';

      if(!$gratificacion->year)
        !$gratificacion->year = '';
    }

    return Response::json($gratificaciones);
  }

  /**
   * CREAR
   */
  public static function ajaxCrear($id)
  {
    // SELECT COLABORADOR
    $colaborador = Colaborador::withTrashed()->find($id);
    // CREAR
    $gratificacion = new Gratificacion;
    $gratificacion->colaborador_id = $colaborador->id;
    //$gratificacion->estacion_indicativo = Input::get('gratificacion_estacion_indicativo');
    //$gratificacion->year = Input::get('gratificacion_year');
    //$gratificacion->importe = Input::get('gratificacion_importe');
    //$gratificacion->gratificaciones_estado_id = Input::get('gratificacion_estado');
    // ASOCIAR
    $colaborador->gratificaciones()->save($gratificacion);
  }
  
  
  
  /**
   * Actualizar
   */
  public static function ajaxActualizar()
  {
    // SELECT GRATIFICACION
    $gratificacion = Gratificacion::find(Input::get('gratificacion_id'));
    // Datos
    $gratificacion->estacion_indicativo = Input::get('gratificacion_estacion_indicativo');
    $gratificacion->year = Input::get('gratificacion_year');
    $gratificacion->importe = Input::get('gratificacion_importe');
    $gratificacion->gratificaciones_estado_id = Input::get('gratificaciones_estado_id');
    // ACTUALIZAR
    $gratificacion->save();
  }

  /**
   * ELIMINAR
   */
  public static function ajaxEliminar()
  {
    Gratificacion::find(Input::get('gratificacion_id'))->delete();
  }

}
