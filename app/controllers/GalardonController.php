<?php

class GalardonController extends \BaseController
{
  /**
   * Crear Galardon
   */
  public static function crear($colaborador)
  {
    $galardones = array(
      'diploma'       => 1,
      'placa'         => 2,
      'premio'        => 3,
      'condecoracion' => 4
    );

    foreach($galardones as $galardon_tipo => $galardon_id){
      if(Input::get($galardon_tipo))
        $colaborador->galardones()->attach($galardon_id, array('year' => Input::get($galardon_tipo)));
    }
  }

  /**
   * Actualizar Galardon
   */
  public static function actualizar($colaborador)
  {
    foreach(Galardon::all() as $galardon)
    {
      $galardonInput = Input::get(strtolower($galardon->galardon));
      $galardonExiste = $colaborador->galardones()->where('galardon_id', $galardon->id)->first();

      if($galardonExiste)
        $colaborador->galardones()->detach($galardon);

      if(trim($galardonInput))
        $colaborador->galardones()->attach($galardon, array('year' => $galardonInput));
    }
  }

}
