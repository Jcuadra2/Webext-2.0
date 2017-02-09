<?php

class GeolocalizacionController extends \BaseController
{

  /**
   * Crear
   */
  public static function crear($estacion)
  {
    // CREAR
    $geolocalizacion = new Geolocalizacion;
    // longitud
    $geolocalizacion->longitud_g = Input::get('longitud_g');
    $geolocalizacion->longitud_m = Input::get('longitud_m');
    $geolocalizacion->longitud_s = Input::get('longitud_s');
    $geolocalizacion->longitud_w_e = Input::get('longitud_w_e');
    // latitud
    $geolocalizacion->latitud_g = Input::get('latitud_g');
    $geolocalizacion->latitud_m = Input::get('latitud_m');
    $geolocalizacion->latitud_s = Input::get('latitud_s');
    $geolocalizacion->latitud_n_s = Input::get('latitud_n_s');
    // UMT
    $geolocalizacion->umt_x = Input::get('umt_x');
    $geolocalizacion->umt_y = Input::get('umt_y');
    // Otras
    $geolocalizacion->altitud = Input::get('altitud');
    $geolocalizacion->huso = Input::get('huso');
    $geolocalizacion->hoja_mapa = Input::get('hoja_mapa');
    $geolocalizacion->ubicacion = Input::get('ubicacion');
    // ASOCIAR
    $estacion->geolocalizaciones()->save($geolocalizacion);
  }

  /**
   * Actualizar
   */
  public static function actualizar($estacion)
  {
    // SELECCIONAR
    $geolocalizacion = $estacion->geolocalizaciones->first();
    // longitud
    $geolocalizacion->longitud_g = Input::get('longitud_g');
    $geolocalizacion->longitud_m = Input::get('longitud_m');
    $geolocalizacion->longitud_s = Input::get('longitud_s');
    $geolocalizacion->longitud_w_e = Input::get('longitud_w_e');
    // latitud
    $geolocalizacion->latitud_g = Input::get('latitud_g');
    $geolocalizacion->latitud_m = Input::get('latitud_m');
    $geolocalizacion->latitud_s = Input::get('latitud_s');
    $geolocalizacion->latitud_n_s = Input::get('latitud_n_s');
    // UMT
    $geolocalizacion->umt_x = Input::get('umt_x');
    $geolocalizacion->umt_y = Input::get('umt_y');
    // Otras
    $geolocalizacion->altitud = Input::get('altitud');
    $geolocalizacion->huso = Input::get('huso');
    $geolocalizacion->hoja_mapa = Input::get('hoja_mapa');
    $geolocalizacion->ubicacion = Input::get('ubicacion');
    // Estacion
    $geolocalizacion->estacion_indicativo = $estacion->indicativo;
    // ACTUALIZAR
    $geolocalizacion->save();
  }

}
