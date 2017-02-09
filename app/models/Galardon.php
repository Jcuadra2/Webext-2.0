<?php

/**
 * Valores por defecto generados por Laravel:
 *
 *      Nombre de tabla: 'galardons' (renombrado manualmente a 'galardones')
 *      Primary Key: 'id'
 *      TimeStamps: 'created_at' y 'updated_at' (las hemos desactivado en esta tabla).
 */
class Galardon extends BaseModel {

    protected $table = 'galardones';

    public $timestamps = false;

    protected $fillable = array(
        'galardon'
    );

    public function colaboradores()
    {
        return $this->belongsToMany('Colaborador','colaboradores_has_galardones','galardon_id','colaborador_id')
            ->withPivot('year');
    }

    public function scopeDiploma($query)
    {
      return $query->where('galardon_id', '=', 1);
    }

    public function scopePlaca($query)
    {
      return $query->where('galardon_id', '=', 2);
    }

    public function scopePremio($query)
    {
      return $query->where('galardon_id', '=', 3);
    }

    public function scopeCondecoracion($query)
    {
      return $query->where('galardon_id', '=', 4);
    }

} 