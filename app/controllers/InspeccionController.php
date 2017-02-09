<?php

class InspeccionController extends \BaseController
{

  /**
   * Crear
   */
  public static function crear($estacion)
  {
    $inspecciones = Input::get('inspeccion[]');
    $fechas = Input::get('fecha_inspeccion[]');

    for($i = 0; $i < count($inspecciones); $i++){
      $inspeccion = new Inspeccion;
      $inspeccion->fecha = HelperController::fechaCastellano_a_mysql( $fechas[$i] );
      $inspeccion->observaciones = $inspecciones[$i];
      $estacion->inspecciones()->save($inspeccion);
    }
  }

  /**
   * Actualizar
   */
  public static function actualizar($estacion)
  {
    $inspeccion = $estacion->inspecciones->first();
    $inspeccion->fecha = HelperController::fechaCastellano_a_mysql( Input::get('fecha_inspeccion') );
    $inspeccion->observaciones = Input::get('observaciones');
    $inspeccion->estacion_indicativo = $estacion->indicativo;
    $inspeccion->save();
  }

}
