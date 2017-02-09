<?php

class ImportarController extends \BaseController
{
  public function index(){

    // Conseguir conexion por defecto
    $default = Config::get('database.connections.'.Config::get('database.default'));

    return View::make('importar.index')
      ->with('destino', (object) $default);
  }

  public function indexConectar(){

   //print_r(Input::all());

    
    // Crear conexion de origen
    
    Config::set('database.connections.origen', array(
      'driver'    => 'mysql',
      'host'      => 'localhost', //Input::get('host_origen') ? Input::get('host_origen') : '',
      'database'  => 'aemetold', //Input::get('database_origen') ? Input::get('database_origen') : '',
      'username'  => 'root', //Input::get('username_origen') ? Input::get('username_origen') : '',
      'password'  => '', //Input::get('password_origen' ? Input::get('password_origen') : ''),
      'charset'   => 'utf8',
      'collation' => 'utf8_unicode_ci',
      'prefix'    => '',
    ));
    
    $origen = Config::get('database.connections.origen');
    //print_r($origen);



    // Crear conexion de destino
    
    Config::set('database.connections.destino', array(
      'driver'    => 'mysql',
      'host'      => 'localhost', //Input::get('host_destino') ? Input::get('host_destino') : '',
      'database'  => 'webext', //Input::get('database_destino') ? Input::get('database_destino') : '',
      'username'  => 'root', //Input::get('username_destino') ? Input::get('username_destino') : '',
      'password'  => '', //Input::get('password_destino' ? Input::get('password_destino') : ''),
      'charset'   => 'utf8',
      'collation' => 'utf8_unicode_ci',
      'prefix'    => '',
    ));
    
    $destino = Config::get('database.connections.destino');
    //print_r($destino);

    
    if(Config::get('database.connections.origen')){
      // Comprobamos que la conexión funciona
      if($origen){
        $tables = DB::connection('origen')->select('show tables');
      }else{
        print_r("Error");
      }
        //print_r("if");
    }else{
      print_r("else");
    }

    //print_r($tables);
    
    $tables = DB::connection('origen')->select('show tables');

    // Listado de tablas reconocidas y exportables
    $exportables = array(
      // VACIO
    );

    return View::make('importar.index')
      ->with('origen', (object) $origen)
      ->with('destino', (object) $destino)
      ->with('tables', $tables)
      ->with('exportables', $exportables);

      print_r($tables);
  }


  /**
   * IMPORTAR datos de xc_colaborador
   */

  /*
  public function xc_colaborador()
  {

    // Nombrar las Bases de datos
    $origen = DB::connection('origen');
    $destino = DB::connection('destino');

    $colaboradores = $origen->table('xc_colaborador')->get();

    foreach($colaboradores as $col){

      // Intentar seleccionar un colaborador que ya exista
      $colaborador = Colaborador::where('cif_nif', '=', $col->CIF_NIF)
        ->where('delegacion_cod',$this->delegacion_cod($col->CMT_CODIGOID))
        ->get();


      // Si no existe crear uno nuevo
      if(!$colaborador){
        $colaborador = Colaborador::Create(array(
            'delegacion_cod', $this->delegacion_cod($col->CMT_CODIGOID))
        );
      }

      // Rellenar el resto de datos de este colaborador
      $colaborador = new Colaborador;
      $colaborador->cif_nif               = $col->CIF_NIF;
      $colaborador->colaboradores_tipo_id = $this->colaboradores_tipo_id($col->TIPO);
      $colaborador->nombre                = $col->NOMBRE;
      $colaborador->apellidos             = $col->APELLIDOS;

      // CONTINUARÁ...

    }
  }

  private function delegacion_cod($cmt)
  {
    switch($cmt){
      case 06: return 'EXT'; // Extremadura
      default: break;
    }
  }

  private function colaborador_tipo($tipo)
  {
    switch($tipo){
      case 'EM': return 2; // Empresa
      case 'EP': return 3; // Entidad Publica
      case 'OR': return 4; // Orden Religiosa
      case 'PE': return 5; // Persona Fisica
      case 'AS': return 6; // Asociacion
      default:   return 7; // Contacto
    }
  }
*/
}
