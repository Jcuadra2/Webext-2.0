<?php

/**
 * Valores por defecto generados por Laravel:
 *
 *      Nombre de tabla: 'islas'
 *      Primary Key: 'id'
 *      TimeStamps: 'created_at' y 'updated_at' (las hemos desactivado en esta tabla).
 */
class Isla extends BaseModel {

    public $timestamps = false;

    protected $fillable = array(
        'isla'
    );

    public function estacion()
    {
        return $this->hasMany('Estacion');
    }
} 