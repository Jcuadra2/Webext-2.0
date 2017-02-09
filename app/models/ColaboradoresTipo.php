<?php

/**
 * Valores por defecto generados por Laravel:
 *
 *      Nombre de tabla: 'colaboladores_tipos' (lo saca de convertir 'ColaboradoresTipo' a underscore)
 *      Primary Key: 'id'
 *      TimeStamps: 'created_at' y 'updated_at' (las hemos desactivado en esta tabla).
 */
class ColaboradoresTipo extends BaseModel {

    public $timestamps = false;

    protected $fillable = array(
        'tipo'
    );

    public function colaborador()
    {
        return $this->HasMany('Colaborador');
    }
} 