<?php

/**
 * Valores por defecto generados por Laravel:
 *
 *      Nombre de tabla: 'profesions' (renombrado manualmente a 'profesiones')
 *      Primary Key: 'id'
 *      TimeStamps: 'created_at' y 'updated_at' (las hemos desactivado en esta tabla).
 */
class Profesion extends BaseModel {

    protected $table = 'profesiones';

    public $timestamps = false;

    protected $fillable = array(
        'profesion'
    );

    public static function validate($input)
    {
        $rules = array(
            'profesion' => 'required|alpha|max:45'
        );

        return Validator::make($input, $rules);
    }

    public function colaborador()
    {
        return $this->hasMany('Colaborador');
    }



}

