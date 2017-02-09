<?php

class ListadoGratificacionController extends \BaseController
{
  
   public function listadogratificacion(){
      
    if(Auth::user()->tipo->tipo == 'Administrador' or Auth::user()->tipo->tipo == 'Supervisor'){

      $colaboradores = DB::select('SELECT e.indicativo,cif_nif,nombre,apellidos,ccc,estacion,c.delegacion_cod,estacion,year,importe,estado
          FROM cuentas AS cu INNER JOIN colaboradores AS c
          ON(cu.colaborador_id=c.id) INNER JOIN estaciones_has_colaboradores AS ec
          ON (c.id=ec.colaborador_id) INNER JOIN estaciones AS e
          ON (ec.estacion_indicativo=e.indicativo)INNER JOIN gratificaciones AS g
          ON (e.indicativo=g.estacion_indicativo) INNER JOIN gratificaciones_estados AS ge
          ON(g.gratificaciones_estado_id=ge.id)
          ORDER BY e.estacion;');

    } else {
      $colaboradores = Auth::user()->delegacion->colaboradores;
      $colaborador->estaciones()->first();

    }

    // enviar los colaboradores a la vista

    return View::make('colaborador.listadogratificacion')
      ->with('colaboradores', $colaboradores);
  }
}

?>