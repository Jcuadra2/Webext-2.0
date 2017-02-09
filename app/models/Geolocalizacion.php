<?php

/**
 * Valores por defecto generados por Laravel:
 *
 *      Nombre de tabla: 'geolocalizacions' (renombrado a 'geolocalizaciones')
 *      Primary Key: 'id'
 *      TimeStamps: 'created_at' y 'updated_at' (las hemos renombrado a 'f_alta' y 'f_modificacion' en el BaseModel).
 */
class Geolocalizacion extends BaseModel {

    protected $table = 'geolocalizaciones';

    protected $fillable = array(
        'f_alta',
        'f_baja',
        'longitud_g',
        'longitud_m',
        'longitud_s',
        'latitud_g',
        'latitud_m',
        'latitud_s',
        'altitud',
        'huso',
        'umt_x',
        'umt_y',
        'hoja_mapa',
        'ubicacion',
        'estacion_indicativo'
    );

    public function estacion()
    {
        return $this->belongsTo('Estacion','estacion_indicativo');
    }
} 