<?php

/**
 * Valores por defecto generados por Laravel:
 *
 *      Nombre de tabla: 'localizadores_tipos'
 *      Primary Key: 'id'
 *      TimeStamps: 'created_at' y 'updated_at' (las hemos desactivado en esta tabla).
 */
class LocalizadoresTipo extends BaseModel {

    protected $table = 'localizadores_tipos';

    public $timestamps = false;

    protected $fillable = array(
        'tipo'
    );

    public function localizadores()
    {
        return $this->hasMany('Localizador','localizadores_tipo_id');
    }

} 