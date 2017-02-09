<?php

/**
 * Class Colaborador
 *
 * Valores por defecto generados por Laravel:
 *
 *      Nombre de tabla: 'colaboradors' (lo hemos tenido que cambiar manualmente a 'colaboradores')
 *      Primary Key: 'id'
 *      TimeStamps: 'created_at' y 'updated_at' (las hemos renombrado a 'f_alta' y 'f_modificacion' en el BaseModel).
 */
class Colaborador extends BaseModel
{

    /**
     * Por defecto Laravel usará el nombre de esta clase
     * en minúsculas y con una 's' al final como el nombre de la tabla
     * alojada en la base de datos.
     * Aquí podemos definir un nombre de tabla personalizado.
     *
     * @var string
     */
    protected $table = 'colaboradores';

    /**
     * softDelete es utilizado como dar de baja
     *
     * Cuando softDelete esta activado en en lugar de eliminar un modelo
     * en su lugar se rellena el campo f_baja (por defecto deleted_at,
     * pero lo hemos renombrado en BaseModel.php)
     * @var bool
     */
    protected $softDelete = true;

    /**
     * Por defecto Laravel espera 'id' como el nombre de la PRIMARY KEY.
     * Aquí definimos un nombre de primary key personalizado.
     */
    //protected $primaryKey = 'cif_nif';

    /**
     * Por defecto Laravel espera que las PRIMARY KEY sean
     * auto-incrementales. Si hemos definido una clave personalizada
     * lo desactivamos con $incrementing .
     *
     * @var true | false
     */
    //public $incrementing = false;

    /**
     * Por defecto Laravel espera que una tabla contenga dos columnas
     * de tipo TIMESTAMP llamadas updated_at y created_at. Para evitar
     * que se rellenen automaticamente lo desactivamos con $timestamps .
     *
     * @var true | false
     */
    //public $timestamps = false;

    /**
     * Guardar en este array los campos que no queremos exportar en JSON.
     *
     * @var array
     */
    //protected $hidden = array('password');

    /**
     * Especificar que columnas de la tabla pueden ser rellenadas
     *
     * @var array
     */
    protected $fillable = array(
        'cif_nif',
        'nombre',
        'apellidos',
        'f_alta',
        'f_baja',
        'f_modificacion',
        'f_nacimiento',
        'fiabilidad',
        'continuidad',
        'profesion_id',
        'colaboradores_tipo_id',
        'estudio_id',
        'colaborador_id',
        'delegacion_cod'
    );

    /**
     * Define relaciones con otras tablas.
     *
     * Para declarar una relación uno-a-uno se utiliza hasOne().
     * Para declarar una relacion uno-a-varios se utiliza hasMany().
     * Para declarar una relacion de pertenencia-a-uno se utiliza belongsTo().
     * Esta función recibe como primer parámetro el model con el cual queremos hacer la relación.
     * El segundo parámetro es la primary-key o foreign-key que relaciona el modelo.
     *
     *  $this->belongsTo('User', 'local_key', 'parent_key');
     *  $this->hasOne('Phone', 'foreign_key', 'local_key');
     *
     * @see http://laravel.com/docs/eloquent#one-to-one
     * @see http://scotch.io/tutorials/php/a-guide-to-using-eloquent-orm-in-laravel
     */
    public function delegacion()
    {
      return $this->belongsTo('Delegacion','delegacion_cod');
    }

    public function asociado()
    {
      return $this->belongsTo('Colaborador', 'colaborador_id');
    }

    public function profesiones()
    {
        return $this->belongsTo('Profesion','profesion_id');
    }

    public function estudios()
    {
        return $this->belongsTo('Estudio','estudio_id');
    }

    public function tipos()
    {
        return $this->belongsTo('ColaboradoresTipo', 'colaboradores_tipo_id');
    }

    public function cuentas()
    {
      return $this->hasMany('Cuenta','colaborador_id');
    }

    public function anotaciones()
    {
        return $this->hasMany('Anotacion');
    }

    public function localizadores()
    {
        return $this->hasMany('Localizador','colaborador_id');
    }

    public function direcciones()
    {
      return $this->morphMany('Direccion', 'direccionable');
    }

    public function gratificaciones()
    {
      return $this->hasMany('Gratificacion', 'colaborador_id');
    }


    /**
    * PIVOT TABLES
    * Modelo de la tabla relacionada, Nombre de la tabla intermedia, ID de ésta tabla, ID de la relacionada
    */

    public function galardones()
    {
        return $this->belongsToMany('Galardon','colaboradores_has_galardones','colaborador_id','galardon_id')
            ->withPivot('year');
    }

    public function estaciones()
    {
        return $this->belongsToMany('Estacion','estaciones_has_colaboradores','colaborador_id','estacion_indicativo')
          ->withTimestamps();
    }


}

