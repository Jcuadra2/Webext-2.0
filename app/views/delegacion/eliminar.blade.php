@extends('plantilla')

@section('head')
<title>Eliminar Delegación - AEMET</title>
@stop

@section('login')
@parent
@stop

@section('submenu')
<a href="{{ URL::to('delegaciones') }}" class="item"><i class="list layout icon"></i>Listado de Delegaciones</a>
<a href="{{ URL::to('delegaciones/crear') }}" class="item"><i class="add icon"></i>Crear Nueva</a>
@stop

@section('header')
<div class="content">
  Eliminar delegación
  <div class="sub header">¿Está seguro de que quiere <strong>eliminar definitivamente</strong> la delegación?
    <ul>
      <li>Se <strong>eliminarán definitivamente</strong> sus credenciales</li>
      <li>Se <strong>eliminarán definitivamente</strong> sus estaciones y datos asociados</li>
      <li>Se <strong>eliminarán definitivamente</strong> sus colaboradores y datos asociados</li>
    </ul>
  </div>
</div>
@stop

@section('content')
<div class="two fluid ui buttons">
  {{ Form::open(array('url' => 'delegaciones/' . $cod . '/eliminar')) }}
  {{ Form::hidden('_method', 'DELETE') }}
  <a class="ui negative labeled icon button" href="{{ URL::to('delegaciones/' . $cod) }}">
    <i class="remove icon"></i>
    No
  </a>
  <button type="submit" class="ui positive right labeled icon button">
    Si
    <i class="checkmark icon"></i>
  </button>
  {{ Form::close() }}
</div>

@stop
