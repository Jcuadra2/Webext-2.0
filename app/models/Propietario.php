<?php

/**
 * Valores por defecto generados por Laravel:
 *
 *      Nombre de tabla: 'est_propietarios'
 *      Primary Key: 'id'
 *      TimeStamps: 'created_at' y 'updated_at' (las hemos desactivado en esta tabla).
 */
class Propietario extends BaseModel {

    public $timestamps = false;

    protected $fillable = array(
        'propietario'
    );

    public function estacion()
    {
        return $this->hasMany('Estacion');
    }
} 