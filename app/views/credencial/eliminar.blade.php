@extends('plantilla')

@section('head')
<title>Eliminar Credencial - AEMET</title>
@stop

@section('login')
@parent
@stop

@section('submenu')
<a href="{{ URL::to('credenciales') }}" class="item"><i class="list layout icon"></i>Listado de Credenciales</a>
<a href="{{ URL::to('credenciales/crear') }}" class="item"><i class="add icon"></i>Crear Nueva</a>
@stop

@section('header')
<div style="color:white;" class="content">
  Eliminar credencial
  <div style="color:white;" class="sub header">¿Está seguro de que quiere <strong>eliminar definitivamente</strong> la credencial?</div>
</div>
@stop

@section('content')
<div class="two fluid ui buttons">
  {{ Form::open(array('url' => 'credenciales/' . $id . '/eliminar')) }}
  {{ Form::hidden('_method', 'DELETE') }}
  <a class="ui negative labeled icon button" href="{{ URL::to('credenciales/' . $id) }}">
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
