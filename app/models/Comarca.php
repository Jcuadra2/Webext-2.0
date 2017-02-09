<?php

/**
 * Valores por defecto generados por Laravel:
 *
 *      Nombre de tabla: 'comarcas'
 *      Primary Key: 'id'
 *      TimeStamps: 'created_at' y 'updated_at' (las hemos desactivado en esta tabla).
 */
class Comarca extends BaseModel {

    public $timestamps = false;

    protected $fillable = array(
        'comarca'
    );

    public function estacion()
    {
        return $this->hasMany('Estacion');
    }
} 