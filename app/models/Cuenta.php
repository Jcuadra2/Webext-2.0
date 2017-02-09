<?php

/**
 * Valores por defecto generados por Laravel:
 *
 *      Nombre de tabla: 'cuentas'
 *      Primary Key: 'id'
 *      TimeStamps: 'created_at' y 'updated_at' (las hemos desactivado en esta tabla).
 */
class Cuenta extends BaseModel {

    public $timestamps = false;

    protected $fillable = array(
        'ccc',
        'colaborador_id'
    );


    public function colaborador()
    {
        return $this->belongsTo('Colaborador','colaborador_id');
    }
}

