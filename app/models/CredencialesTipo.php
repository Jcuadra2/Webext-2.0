<?php

/**
 * Valores por defecto generados por Laravel:
 *
 *      Nombre de tabla: 'credenciales_tipos'
 *      Primary Key: 'id'
 *      TimeStamps: 'created_at' y 'updated_at' (las hemos desactivado en esta tabla).
 */
class CredencialesTipo extends BaseModel {

    protected $table = 'credenciales_tipos';

    public $timestamps = false;

    protected $fillable = array(
        'tipo'
    );

    public function credenciales()
    {
        return $this->hasMany('Credencial');
    }
} 