<?php

/**
 * Valores por defecto generados por Laravel:
 *
 *      Nombre de tabla: 'anotacions' (renombrado manualmente a 'anotaciones')
 *      Primary Key: 'id'
 *      TimeStamps: 'created_at' y 'updated_at' (las hemos renombrado a 'f_alta' y 'f_modificacion' en el BaseModel).
 */
class Anotacion extends BaseModel {

    protected $table = 'anotaciones';

    protected $fillable = array(
        'anotacion',
        'f_alta',
        'f_modificacion',
        'f_baja',
        'anotaciones_tipo_id',
        'colaborador_id'
    );

    public function colaborador()
    {
        return $this->belongsTo('Colaborador','colaborador_id');
    }

    public function tipo()
    {
        return $this->belongsTo('AnotacionesTipo','anotaciones_tipo_id');
    }
} 