<?php

class Estacion extends BaseModel
{
    protected $table = 'estaciones';

    protected $primaryKey = 'indicativo';

    public $incrementing = false;

    /**
     * softDelete es utilizado como dar de baja
     *
     * Cuando softDelete esta activado en en lugar de eliminar un modelo
     * en su lugar se rellena el campo f_baja (por defecto deleted_at,
     * pero lo hemos renombrado en BaseModel.php)
     * @var bool
     */
    protected $softDelete = true;

    protected $fillable = array(
        'indicativo',
        'estacion',
        'f_alta',
        'f_modificacion',
        'f_baja',
        'propietario_id',
        'categoria_id',
        'estaciones_tipo_id',
        'cuenca_cod',
        'comarca_id',
        'isla_id',
        'delegacion_cod'
    );

    public function delegacion()
    {
        return $this->belongsTo('Delegacion','delegacion_cod');
    }

    public function propietario()
    {
        return $this->belongsTo('Propietario');
    }

    public function categoria()
    {
        return $this->belongsTo('Categoria');
    }

    public function tipo()
    {
        return $this->belongsTo('EstacionesTipo','estaciones_tipo_id');
    }

    public function cuenca()
    {
        return $this->belongsTo('Cuenca', 'cuenca_cod');
    }

    public function comarca()
    {
        return $this->belongsTo('Comarca');
    }

    public function isla()
    {
        return $this->belongsTo('Isla');
    }

    public function inspecciones()
    {
        return $this->hasMany('Inspeccion','estacion_indicativo');
    }

    public function fotos()
    {
        return $this->hasMany('Foto','estacion_indicativo');
    }

    public function incidencias()
    {
        return $this->hasMany('Incidencia','estacion_indicativo');
    }

    public function direcciones()
    {
      return $this->morphMany('Direccion', 'direccionable');
    }

    public function geolocalizaciones()
    {
        return $this->hasMany('Geolocalizacion','estacion_indicativo');
    }

    public function colaboradores()
    {
        return $this->belongsToMany('Colaborador','estaciones_has_colaboradores','estacion_indicativo','colaborador_id')
          ->withTimestamps();
    }

    public function gratificaciones()
    {
      return $this->hasMany('Gratificacion', 'estacion_indicativo');
    }

    public static function estacionesVaciasDelegacion()
    {
      $indicativos = DB::table('estaciones_has_colaboradores')
        ->lists('estacion_indicativo');

      // Si $indicativos falla generar un array vacio
      if(!$indicativos) $indicativos = array('');

      return DB::table('estaciones')
        ->leftJoin('estaciones_has_colaboradores', 'estaciones.indicativo', '=', 'estaciones_has_colaboradores.estacion_indicativo')
        ->whereNull('estaciones.f_baja')
        ->where('estaciones.delegacion_cod','=', Auth::user()->delegacion->cod)
        ->whereNotIn('indicativo', $indicativos)
        ->get();
    }

    public static function estacionesVacias()
    {
      $indicativos = DB::table('estaciones_has_colaboradores')
        ->lists('estacion_indicativo') ;

      // Si $indicativos falla generar un array vacio
      if(!$indicativos) $indicativos = array('');

      return DB::table('estaciones')
        ->leftJoin('estaciones_has_colaboradores', 'estaciones.indicativo', '=', 'estaciones_has_colaboradores.estacion_indicativo')
        ->whereNull('estaciones.f_baja')
        ->whereNotIn('indicativo', $indicativos)
        ->get();
    }

}

