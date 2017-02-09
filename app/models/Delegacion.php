<?php

/**
 * Valores por defecto generados por Laravel:
 *
 *      Nombre de tabla: 'delegacions' (renombrado a 'delegaciones')
 *      Primary Key: 'id'
 *      TimeStamps: 'created_at' y 'updated_at' (las hemos desactivado en esta tabla).
 */
class Delegacion extends BaseModel {

    protected $table = 'delegaciones';

    protected $primaryKey = 'cod';

    public $incrementing = false;

    public $timestamps = false;

    protected $fillable = array(
        'cod',
        'delegacion',
        'cif',
        'delegado_territorial',
        'presidente_aemet'
    );

    public function estaciones()
    {
        return $this->hasMany('Estacion','delegacion_cod')->withTrashed(); // Muestra tambien los inactivos
    }

    public function colaboradores()
    {
      return $this->hasMany('Colaborador','delegacion_cod')->withTrashed(); // Muestra tambien los inactivos
    }

    public function credenciales()
    {
        return $this->hasMany('Credencial','delegacion_cod');
    }

    public function direcciones()
    {
      return $this->morphMany('Direccion', 'direccionable');
    }
} 