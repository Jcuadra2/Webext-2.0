<?php

return array(

  /*
  |--------------------------------------------------------------------------
  | Validation Language Lines
  |--------------------------------------------------------------------------
  |
  | The following language lines contain the default error messages used by
  | the validator class. Some of these rules have multiple versions such
  | as the size rules. Feel free to tweak each of these messages here.
  |
  */

  "accepted"         => "Hay que aceptar el campo :attribute.",
  "active_url"       => ":attribute no es una URL válida.",
  "after"            => "La fecha :attribute debe ser posterior a :date.",
  "alpha"            => "El campo :attribute solo puede contener letras.",
  "alpha_dash"       => "El campo :attribute solo puede contener letras, números y guiones.",
  "alpha_num"        => "El campo :attribute solo puede contener letras y números.",
  "alpha_spaces"     => "El campo :attribute solo puede contener letras y espacios.",
  "array"            => "El campo :attribute debe contener un array.",
  "before"           => "La fecha :attribute debe ser anterior a :date.",
  "between"          => array(
    "numeric" => "El campo :attribute debe valer entre :min y :max.",
    "file"    => "El campo :attribute debe ocupar entre :min y :max kilobytes.",
    "string"  => "El campo :attribute debe tener entre :min y :max caracteres.",
    "array"   => "El campo :attribute debe tener entre :min y :max elementos.",
  ),
  "cif_nif"          => "El :attribute no es válido.",
  "confirmed"        => "La confirmación del campo :attribute no coincide.",
  "date"             => ":attribute no es una fecha correcta.",
  "date_format"      => ":attribute no cumple el formato dd/mm/yyyy.",
  "different"        => "Los campos :attribute y :other deben ser diferentes.",
  "digits"           => "El campo :attribute debe tener :digits digitos.",
  "digits_between"   => "El campo :attribute debe tener entre :min y :max digitos.",
  "email"            => "El formato del campo :attribute es inválido.",
  "exists"           => "El campo :attribute seleccionado es inválido.",
  "image"            => "El campo :attribute debe de contener una imágen.",
  "in"               => "El campo :attribute seleccionado es inválido.",
  "integer"          => "El campo :attribute debe de contener un entero.",
  "ip"               => "El campo :attribute debe de contener una direción IP válida.",
  "max"              => array(
    "numeric" => "El campo :attribute no puede ser mayor de :max.",
    "file"    => "El campo :attribute no puede ocupar más de :max kilobytes.",
    "string"  => "El campo :attribute no puede contener más de :max caracteres.",
    "array"   => "El campo :attribute no puede tener más de :max elementos.",
  ),
  "mimes"            => "The :attribute must be a file of type: :values.",
  "min"              => array(
    "numeric" => "El campo :attribute debe de ser superior a :min.",
    "file"    => "El campo :attribute debe de ser de al menos :min kilobytes.",
    "string"  => "El campo :attribute debe de tener al menos :min caracteres.",
    "array"   => "El campo :attribute debe de tener al menos :min objetos.",
  ),
  "not_in"           => "El campo :attribute seleccionado es inválido.",
  "numeric"          => "El campo :attribute debe de ser numérico.",
  "regex"            => "El formato del campo :attribute es inválido.",
  "required"         => "El campo :attribute es obligatorio.",
  "required_if"      => "El campo :attribute es requerido si :other es :value.",
  "required_with"    => "El campo :attribute es requerido junto con :values.",
  "required_without" => "El campo :attribute es requerido cuando :values no está presente.",
  "same"             => ":attribute y :other deben coincidir.",
  "size"             => array(
    "numeric" => "El campo :attribute debe ser :size.",
    "file"    => "El campo :attribute debe ocupar :size kilobytes.",
    "string"  => "El campo :attribute debe de ser de :size caracteres.",
    "array"   => "El campo :attribute tiene que contener :size elementos.",
  ),
  "unique"           => ":attribute ya existe.",
  "url"              => "El formato del campo :attribute es inválido.",
  "year"     => "El campo :attribute debe ser entre 1901 y el año actual.",

  /*
  |--------------------------------------------------------------------------
  | Custom Validation Language Lines
  |--------------------------------------------------------------------------
  |
  | Here you may specify custom validation messages for attributes using the
  | convention "attribute.rule" to name the lines. This makes it quick to
  | specify a specific custom language line for a given attribute rule.
  |
  */

  'custom' => array(),

  /*
  |--------------------------------------------------------------------------
  | Custom Validation Attributes
  |--------------------------------------------------------------------------
  |
  | The following language lines are used to swap attribute place-holders
  | with something more reader friendly such as E-Mail Address instead
  | of "email". This simply helps us make messages a little cleaner.
  |
  */

  'attributes' => array(),



);
