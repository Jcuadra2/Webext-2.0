<?php

/**
 * Valores por defecto generados por Laravel:
 *
 *      Nombre de tabla: 'est_inspeccions' (renombrado a est_inspecciones)
 *      Primary Key: 'id'
 *      TimeStamps: 'created_at' y 'updated_at' (las hemos desactivado en esta tabla).
 */
class Inspeccion extends BaseModel {

    protected $table = 'inspecciones';

    public $timestamps = false;

    protected $fillable = array(
        'fecha',
        'observaciones',
        'estacion_indicativo'
    );

    public function estacion()
    {
        return $this->belongsTo('Estacion','estacion_indicativo');
    }
} 