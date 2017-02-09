<?php

class GratificacionEstado extends BaseModel {

  protected $table = 'gratificaciones_estados';

  public $timestamps = false;

  protected $fillable = array(
    'estado'
  );

  public function gratificaciones()
  {
    return $this->hasMany('Gratificacion','gratificaciones_estado_id');
  }

} 