<?php

/**
 * Todos los modelos se extenderan de este modelo base
 *
 * Esto nos permite el poder renombrar los campos created_at, updated_at y deleted_at
 * que Laravel utiliza por defecto cuando no usas $timestams = false
 * created_at sera utilizado como f_alta
 * updated_at sera utilzado como f_modificacion
 * deleted_at sera utilizado como f_baja, ya que se utiliza al realizar un soft-delete (una baja)
 */
class BaseModel extends Eloquent
{
    const CREATED_AT = 'f_alta';
    const UPDATED_AT = 'f_modificacion';
    const DELETED_AT = 'f_baja';
}