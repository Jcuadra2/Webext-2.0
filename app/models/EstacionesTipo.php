<?php

/**
 * Valores por defecto generados por Laravel:
 *
 *      Nombre de tabla: 'estaciones_tipos'
 *      Primary Key: 'id'
 *      TimeStamps: 'created_at' y 'updated_at' (las hemos desactivado en esta tabla).
 */
class EstacionesTipo extends BaseModel {

    protected $table = 'estaciones_tipos';

    public $timestamps = false;

    protected $fillable = array(
        'tipo',
        'observaciones'
    );

    public function estaciones()
    {
        return $this->hasMany('Estacion');
    }
} 