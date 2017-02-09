<?php

/**
 * Valores por defecto generados por Laravel:
 *
 *      Nombre de tabla: 'municipios'
 *      Primary Key: 'id' (cambiada a 'cod')
 *      TimeStamps: 'created_at' y 'updated_at' (las hemos desactivado en esta tabla).
 *
 * @todo Reestructurar Municipios y Provincias en la Base de Datos
 */
class Municipio extends BaseModel {

    protected $table = 'municipios';
    protected $primaryKey = 'cod';
    public $incrementing = false;
    public $timestamps = false;

    protected $fillable = array(
      'cod',
      'provincia_cod',
      'municipio'
    );

    public function provincia()
    {
        return $this->belongsTo('Provincia','provincia_cod');
    }

    public function direcciones()
    {
        return $this->hasMany('Direccion','municipio_cod');
    }
} 