<?php

/**
 * Valores por defecto generados por Laravel:
 *
 *      Nombre de tabla: 'est_fotos'
 *      Primary Key: 'id'
 *      TimeStamps: 'created_at' y 'updated_at' (las hemos desactivado en esta tabla).
 */
class Foto extends BaseModel {

    public $timestamps = false;

    protected $fillable = array(
        'foto',
        'estacion_indicativo'
    );

    public function estacion()
    {
        return $this->belongsTo('Estacion','estacion_indicativo');
    }
} 