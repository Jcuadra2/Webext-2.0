<?php

class DireccionController extends \BaseController
{
  /**

  [_method] => PUT
  [_token] => EHaNpJLxmqmkZ8jxZHJoCHgOcxdVu01iNkoDWmV7
  [delegacion] => Castilla y Leon
  [cod] => CAS
  [delegado_territorial] => bbbb
  [direccion] => C/Madrid
  [cp] => 55555
  [localidad] => Madrid
  [provincia_cod] => 09
  [municipio_cod] => 006
  [detalles] => MadridMadridMadridMadridMadridMadridMadrid

   */

  public static function direccion($model)
  {
    $direccion = $model->direcciones->first();
    return $direccion ? $direccion : null;
  }

  public static function municipio($model)
  {
    if($model->direcciones->first()){
      $cod_municipio = $model->direcciones->first()->municipio_cod;
      $cod_provincia = $model->direcciones->first()->municipios_provincia_cod;
      $municipio = Municipio::where('cod',$cod_municipio)->where('provincia_cod',$cod_provincia)->first();
      return $municipio;
    }
    return null;
  }

  public static function provincia($model)
  {
    if($model->direcciones->first()){
      $cod_provincia = $model->direcciones->first()->municipios_provincia_cod;
      $provincia = Provincia::where('cod',$cod_provincia)->first();
      return $provincia;
    }
    return null;
  }

  public function ajaxMunicipios()
  {
    $municipios = Municipio::where('provincia_cod', Input::get('provincia_cod'))
      ->orderBy('municipio')
      ->get();

    return Response::json($municipios);
  }

  /**
   * Crear una Direccion
   */
  public static function crear($modelo)
  {
    $direccion = new Direccion;
    $direccion->direccion = Input::get('direccion');
    $direccion->cp = Input::get('cp');
    $direccion->detalles = Input::get('detalles');
    $direccion->localidad = Input::get('localidad');
    $direccion->municipio_cod = Input::get('municipio_cod');
    $direccion->municipios_provincia_cod = Input::get('provincia_cod');
    $modelo->direcciones()->save($direccion);
  }

  /**
   * Actualizar una Direccion
   */
  public static function actualizar($modelo)
  {
    $direccion = $modelo->direcciones->first();
    $direccion->direccion = Input::get('direccion');
    $direccion->cp = Input::get('cp');
    $direccion->detalles = Input::get('detalles');
    $direccion->localidad = Input::get('localidad');
    $direccion->municipio_cod = Input::get('municipio_cod');
    $direccion->municipios_provincia_cod = Input::get('provincia_cod');
    $direccion->save();
  }


}
