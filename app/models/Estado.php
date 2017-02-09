<?php

/**
 * Valores por defecto generados por Laravel:
 *
 *      Nombre de tabla: 'estados'
 *      Primary Key: 'id'
 *      TimeStamps: 'created_at' y 'updated_at' (las hemos desactivado en esta tabla).
 */
class Estado extends BaseModel {

    public $timestamps = false;

    protected $fillable = array(
        'estado'
    );

    public function estacion()
    {
        return $this->hasMany('Estacion');
    }
}