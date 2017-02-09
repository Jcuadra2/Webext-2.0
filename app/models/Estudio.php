<?php

/**
 * Valores por defecto generados por Laravel:
 *
 *      Nombre de tabla: 'estudios' (lo saca de convertir 'Estudio' a 'estudios')
 *      Primary Key: 'id'
 *      TimeStamps: 'created_at' y 'updated_at' (las hemos desactivado en esta tabla).
 */
class Estudio extends BaseModel {

    public $timestamps = false;

    protected $fillable = array(
        'estudio'
    );

    public function colaborador()
    {
        return $this->HasMany('Colaborador');
    }
} 