<?php

/**
 * Valores por defecto generados por Laravel:
 *
 *      Nombre de tabla: 'provincias'
 *      Primary Key: 'id' (cambiada a 'cod')
 *      TimeStamps: 'created_at' y 'updated_at' (las hemos desactivado en esta tabla).
 */
class Provincia extends BaseModel {

    protected $table = 'provincias';
    protected $primaryKey = 'cod';
    public $incrementing = false;
    public $timestamps = false;

    protected $fillable = array(
      'cod',
      'provincia'
    );

    public function direcciones()
    {
        return $this->hasMany('Municipio');
    }
} 