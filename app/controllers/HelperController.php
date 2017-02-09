<?php

class HelperController extends \BaseController
{
  /**+
   * Cambia una fecha en castellano al formato mySql
   *
   * La fecha que recibimos en el formulario esta en formato dd/mm/yyyy
   * y para almacenarla en la base de datos hay que cambiarla a yyyy-mm-dd.
   *
   * @param $fecha
   * @return null|string
   */
  public static function fechaCastellano_a_mysql($fecha)
  {
    if ($fecha<>''){
      $partes=explode('/',$fecha,3);
      return $partes[2].'-'.$partes[1].'-'.$partes[0];
    } else {
      return null;
    }
  }



  /**+
   * Cambia una fecha en mySql al formato castellano
   *
   * La fecha que recibimos en el formulario esta en formato yyyy-mm-dd
   * y para mostrarla al usuario hay que cambiarla a dd/mm/yyyy.
   *
   * @param $fecha
   * @return null|string
   */
  public static function fechaMysql_a_castellano($fecha)
  {
    if ($fecha<>''){
      $partes=explode('-',$fecha,3);
      return $partes[2].'/'.$partes[1].'/'.$partes[0];
    } else {
      return null;
    }
  }

  public static function timestamp_a_castellano($fecha)
  {
    if ($fecha<>''){
      $partes=explode('-',$fecha,3);
      return $partes[2].'/'.$partes[1].'/'.$partes[0];
    } else {
      return null;
    }
  }

}
