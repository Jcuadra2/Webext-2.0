<?php
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableInterface;

class Credencial extends BaseModel implements UserInterface, RemindableInterface {
/**
 * Valores por defecto generados por Laravel:
 *
 *      Nombre de tabla: 'credencials' (renombrado a 'credenciales')
 *      Primary Key: 'id'
 *      TimeStamps: 'created_at' y 'updated_at' (las hemos renombrado a 'f_alta' y 'f_modificacion' en el BaseModel).
 */

    protected $table = 'credenciales';

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = array('password');

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
        'usuario',
        'password',
        'nombre',
        'apellidos',
        'puesto',
        'observaciones',
        'credenciales_tipo_id',
        'delegacion_cod'
    );

    public static function validate($input)
    {
        $rules = array(
            'usuario' => 'alpha_dash|max:100',
            'password' => 'alpha_dash|max:64',
            'nombre' => 'alpha|max:45',
            'apellidos' => 'alpha|max:45',
            'observaciones' => 'alpha_dash|max:140',
            'puesto' => 'alpha_dash|max:45',
            'remember_token' => '',
        );

        return Validator::make($input, $rules);
    }

    public function delegacion()
    {
        return $this->belongsTo('Delegacion','delegacion_cod');
    }

    public function tipo()
    {
        return $this->belongsTo('CredencialesTipo','credenciales_tipo_id');
    }

    public function getAuthIdentifier()
    {
      return $this->getKey();
    }

    /**
     * Get the password for the user.
     *
     * @return string
     */
    public function getAuthPassword()
    {
      return $this->password;
    }

    /**
     * Get the token value for the "remember me" session.
     *
     * @return string
     */
    public function getRememberToken()
    {
      return $this->remember_token;
    }

    /**
     * Set the token value for the "remember me" session.
     *
     * @param  string  $value
     * @return void
     */
    public function setRememberToken($value)
    {
      $this->remember_token = $value;
    }

    /**
     * Get the column name for the "remember me" token.
     *
     * @return string
     */
    public function getRememberTokenName()
    {
      return 'remember_token';
    }

    /**
     * Get the e-mail address where password reminders are sent.
     *
     * @return string
     */
    public function getReminderEmail()
    {
      return $this->email;
    }
} 