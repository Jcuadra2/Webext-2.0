<?php

/**
 * Valores por defecto generados por Laravel:
 *
 *      Nombre de tabla: 'cuencas'
 *      Primary Key: 'id' cambiada a 'cod' con auto-incrementar desactivado
 *      TimeStamps: 'created_at' y 'updated_at' (las hemos desactivado en esta tabla).
 */
class Cuenca extends BaseModel {

  protected $primaryKey = 'cod';

  public $incrementing = false;

    protected $fillable = array(
        'cuenca'
    );

    public function estacion()
    {
        return $this->hasMany('Estacion', 'cuenca_cod');
    }
} 