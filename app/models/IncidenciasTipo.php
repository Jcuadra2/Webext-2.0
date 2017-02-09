<?php

/**
 * Valores por defecto generados por Laravel:
 *
 *      Nombre de tabla: 'incidencias_tipos'
 *      Primary Key: 'id'
 *      TimeStamps: 'created_at' y 'updated_at' (las hemos desactivado en esta tabla).
 */
class IncidenciasTipo extends BaseModel {

    protected $table = 'incidencias_tipos';

    public $timestamps = false;

    protected $fillable = array(
        'tipo'
    );

    public function incidencia()
    {
        return $this->hasMany('Incidencia','incidencias_tipo_id');
    }
} 