<?php

class CuentaController extends \BaseController
{
  /**
   * Crear una Cuenta
   */
  public static function crear($colaborador)
  {
    $cuenta = new Cuenta;
    $cuenta->ccc = Input::get('cuenta');
    $colaborador->cuentas()->save($cuenta);
  }

  /**
   * Actualizar una Cuenta
   */
  public static function actualizar($colaborador)
  {
    $cuenta = $colaborador->cuentas->first();
    
    var_dump($cuenta);
    /*$cuenta->ccc = Input::get('cuenta');
    $cuenta->save();*/
  }

}
