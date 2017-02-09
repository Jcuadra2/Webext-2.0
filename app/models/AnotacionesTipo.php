<?php

/**
 * Valores por defecto generados por Laravel:
 *
 *      Nombre de tabla: 'anotaciones_tipos'
 *      Primary Key: 'id'
 *      TimeStamps: 'created_at' y 'updated_at' (las hemos desactivado en esta tabla).
 */
class AnotacionesTipo extends BaseModel {

    protected $table = 'anotaciones_tipos';

    public $timestamps = false;

    protected $fillable = array(
        'tipo'
    );

    public function anotaciones()
    {
        return $this->hasMany('Anotacion');
    }

} 