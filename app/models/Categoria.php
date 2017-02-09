<?php

/**
 * Valores por defecto generados por Laravel:
 *
 *      Nombre de tabla: 'categorias'
 *      Primary Key: 'id'
 *      TimeStamps: 'created_at' y 'updated_at' (las hemos desactivado en esta tabla).
 */
class Categoria extends BaseModel {

    public $timestamps = false;

    protected $fillable = array(
        'categoria',
        'observaciones',
        'limite',
        'f_vigor'
    );

    public function estacion()
    {
        return $this->hasMany('Estacion');
    }
} 