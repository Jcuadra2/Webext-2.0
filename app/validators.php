<?php

/**
 * app/validators.php
 */


Validator::extend('alpha_spaces', function($attribute, $value)
{
  return preg_match('/^[\pL\s]+$/u', $value);
});

// El rango YEAR de SQL es de 1901 a 2155. Ademas debe ser inferior a la fecha actual.
Validator::extend('year', function($attribute, $value)
{
  if($value <= date('Y') AND $value <= 2155 AND $value >= 1901)
    return 1;
  else
    return 0;
});

// CIF o NIF válido
Validator::extend('cif_nif', function($attribute, $value)
{
  $value = strtoupper($value);

  // CIF VALIDATION
  $cif_codes = 'JABCDEFGHI';

  $sum = $value[2] + $value[4] + $value[6];

  for ($i = 1; $i<8; $i += 2) {
    $tmp = (string) (2 * $value[$i]);

    $tmp = $tmp[0] + ((strlen ($tmp) == 2) ?  $tmp[1] : 0);

    $sum += $tmp;
  }

  $sum = (string) $sum;

  $n = (10 - substr ($sum, -1)) % 10;

  if (preg_match ('/^[ABCDEFGHJNPQRSUVW]{1}/', $value)) {
    if (in_array ($value[0], array ('A', 'B', 'E', 'H'))) {
      // CIF Numerico
      return ($value[8] == $n);
    } elseif (in_array ($value[0], array ('K', 'P', 'Q', 'S'))) {
      // CIF Letras
      return ($value[8] == $cif_codes[$n]);
    } else {
      // CIF Alfanumérico
      if (is_numeric ($value[8])) {
        return ($value[8] == $n);
      } else {
        return ($value[8] == $cif_codes[$n]);
      }
    }
  }

  // Aqui hariamos un return false, pero si no es un CIF supondremos que es un DNI

  // DNI NIE VALIDATION
  $nif_codes = 'TRWAGMYFPDXBNJZSQVHLCKE';

  $n = 10 - substr($sum, -1);

  if (preg_match ('/^[0-9]{8}[A-Z]{1}$/', $value)) {
    // DNIs
    if(strlen($value) === 8)
      $value = substr_replace($value, '0', 0, 0);
    $num = substr($value, 0, 8);
    return ($value[8] == $nif_codes[$num % 23]);
  } elseif (preg_match ('/^[XYZ][0-9]{7}[A-Z]{1}$/', $value)) {
    // NIEs normales
    $tmp = substr ($value, 1, 7);
    $tmp = strtr(substr ($value, 0, 1), 'XYZ', '012') . $tmp;
    return ($value[8] == $nif_codes[$tmp % 23]);
  } elseif (preg_match ('/^[KLM]{1}/', $value)) {
    // NIFs especiales
    return ($value[8] == chr($n + 64));
  } elseif (preg_match ('/^[T]{1}[A-Z0-9]{8}$/', $value)) {
    // NIE extraño
    return true;
  }

  return false;

});