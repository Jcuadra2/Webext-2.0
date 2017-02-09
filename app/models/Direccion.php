<?php

/**
 * Valores por defecto generados por Laravel:
 *
 *      Nombre de tabla: 'direccions' (renombrado a 'direcciones')
 *      Primary Key: 'id'
 *      TimeStamps: 'created_at' y 'updated_at' (las hemos renombrado a 'f_alta' y 'f_modificacion' en el BaseModel).
 */
class Direccion extends BaseModel {

    protected $table = 'direcciones';
    public $timestamps = false;

    protected $fillable = array(
        'direccion',
        'cp',
        'detalles',
        'principal',
        'localidad',
        'municipios_provincia_cod',
        'municipio_cod',
        'estacion_indicativo',
        'colaborador_id',
        'delegacion_cod',
        'direccionable_id',
        'direccionable_type'
    );

    public function municipio()
    {
      return $this->belongsTo('Municipio','municipio_cod');
    }

    public function provincia()
    {
      return $this->belongsTo('Provincia','municipios_provincia_cod');
    }

    public function direccionable()
    {
      return $this->morphTo();
    }

} 