<?php

class Gratificacion extends BaseModel {

  protected $table = 'gratificaciones';

  public $timestamps = false;

  protected $fillable = array(
    'colaborador_id',
    'estacion_indicativo',
    'year',
    'importe',
    'gratificaciones_estado_id'
  );

  public function gratificaciones()
  {
    return $this->belongsTo('GratificacionEstado','gratificaciones_estado_id');
  }

  public function colaboradores()
  {
    return $this->belongsTo('Colaborador', 'colaborador_id');
  }

  public function estaciones()
  {
    return $this->belongsTo('Estacion', 'estacion_indicativo');
  }


} 