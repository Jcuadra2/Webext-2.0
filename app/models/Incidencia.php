<?php

/**
 * Valores por defecto generados por Laravel:
 *
 *      Nombre de tabla: 'incidencias'
 *      Primary Key: 'id'
 *      TimeStamps: 'created_at' y 'updated_at' (las hemos desactivado en esta tabla).
 */
class Incidencia extends BaseModel {

    protected $table = 'incidencias';

    public $timestamps = false;

    protected $fillable = array(
        'incidencia',
        'fecha',
        'incidencias_tipo_id',
        'estacion_indicativo'
    );

    public function estacion()
    {
        return $this->belongsTo('Estacion','estacion_indicativo');
    }

    public function tipo()
    {
        return $this->belongsTo('IncidenciasTipo','incidencias_tipo_id');
    }
} 