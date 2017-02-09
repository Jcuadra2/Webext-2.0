<?php

/**
 * Valores por defecto generados por Laravel:
 *
 *      Nombre de tabla: 'clocalizadors' (renombrado manualmente a 'localizadores')
 *      Primary Key: 'id'
 *      TimeStamps: 'created_at' y 'updated_at' (las hemos desactivado).
 */
class Localizador extends BaseModel {

    protected $table = 'localizadores';

    public $timestamps = false;

    protected $fillable = array(
        'localizador',
        'principal',
        'localizadores_tipo_id',
        'colaborador_id'
    );

    public static function validate($input)
    {
        $rules = array(
            'localizador' => 'required|alpha_dash|max:45',
            'principal' => 'numeric|min:0|max:1'
        );

        return Validator::make($input, $rules);
    }

    public function colaborador()
    {
        return $this->belongsTo('Colaborador','colaborador_id');
    }

    public function tipos()
    {
        return $this->belongsTo('LocalizadoresTipo','localizadores_tipo_id');
    }

    public function scopeFijo($query)
    {
      return $query->where('localizadores_tipo_id', 1);
    }

    public function scopeMovil($query)
    {
      return $query->where('localizadores_tipo_id', 2);
    }

    public function scopeFax($query)
    {
      return $query->where('localizadores_tipo_id', 3);
    }

    public function scopeEmail($query)
    {
      return $query->where('localizadores_tipo_id', 4);
    }
} 