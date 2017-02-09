<?php

class IncidenciaController extends \BaseController
{

  public static function ajaxListar($indicativo)
  {
    // SELECT ESTACION
    $estacion = Estacion::withTrashed()->find($indicativo);
    // CARGAR LISTADO
    $incidencias = $estacion->incidencias()->orderBy('fecha', 'desc')->get();

    foreach($incidencias as $incidencia){

      // FECHA
      $incidencia->fecha = date('d/m/Y', strtotime($incidencia->fecha));

      // INCIDENCIA
      if(!$incidencia->incidencia){
        $incidencia->incidencia = '';
      }
      $incidencia->fecha = $incidencia->fecha ? $incidencia->fecha : '';

      // TIPO
      if($incidencia->incidencias_tipo_id){
        $tipo = IncidenciasTipo::find($incidencia->incidencias_tipo_id)->tipo;
      } else {
        $tipo = '';
      }
      $incidencia->tipo = $tipo;

      // RESUMEN
      if($incidencia->incidencia){
        $incidencia->resumen = substr($incidencia->incidencia, 0, 50).'...';
      } else {
        $incidencia->resumen = '';
      }

    }

    return Response::json($incidencias);
  }

  /**
   * Crear
   * tipos_id:
   * 1 - baja definitiva
   * 2 - cambio de colaborador
   * 3 - cambio de desplazamiento
   * 4 - instalacion de material
   * 5 - otras
   * 6 - revision
   * 7 - cambio de tipo de Estacion
   */
  public static function ajaxCrear($indicativo)
  {
    // SELECT ESTACION
    $estacion = Estacion::withTrashed()->find($indicativo);
    // CREAR
    $incidencia = new Incidencia;
    // ASOCIAR
    $estacion->incidencias()->save($incidencia);
  }

  /**
   * Actualizar
   */
  public static function ajaxActualizar()
  {
    // Convertir dd/mm/yyyy a YYYY-mm-dd
    $hora = date("H:i:s");
    $fecha = Input::get('fecha');
    $fecha = str_replace('/', '-', $fecha);
    $fecha = date('Y-m-d', strtotime($fecha));
    $timestamp = $fecha.' '.$hora;

    // SELECT INCIDENCIA
    $incidencia = Incidencia::find(Input::get('id'));
    // Datos
    $incidencia->incidencia = Input::get('incidencia');
    $incidencia->fecha = $timestamp;
    $incidencia->incidencias_tipo_id = Input::get('tipo');
    // ACTUALIZAR
    $incidencia->save();
  }

  /**
   * ELIMINAR
   */
  public static function ajaxEliminar()
  {
    Incidencia::find(Input::get('id'))->delete();
  }

}
