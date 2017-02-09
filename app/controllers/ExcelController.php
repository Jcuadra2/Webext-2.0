<?php

class ExcelController extends \BaseController
{
  /**
   * LISTAR
   * Mostrar listado con todas las estaciones
   */
   public function excel(){
      
    if(Auth::user()->tipo->tipo == 'Administrador' or Auth::user()->tipo->tipo == 'Supervisor'){

      $colaboradores = DB::select('SELECT cif_nif,nombre,apellidos,c.delegacion_cod,estacion
              FROM colaboradores AS c INNER JOIN estaciones_has_colaboradores AS ec
              ON (c.id = ec.colaborador_id)
              INNER JOIN estaciones AS e
              ON (ec.estacion_indicativo = e.indicativo)');

    } else {
      $colaboradores = Auth::user()->delegacion->colaboradores;
      $colaborador->estaciones()->first();
    }

    // enviar los colaboradores a la vista
    return View::make('colaborador.listadocsv')
      ->with('colaboradores', $colaboradores);
  }
}

?>