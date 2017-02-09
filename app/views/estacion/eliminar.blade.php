@extends('plantilla')

@section('head')
<title>Eliminar Estación - AEMET</title>
@stop

@section('login')
@parent
@stop

@section('submenu')
<a href="{{ URL::to('estaciones') }}" class="item"><i class="list layout icon"></i>Listado de Estaciones</a>
<a href="{{ URL::to('estaciones/alta') }}" class="item"><i class="add icon"></i>Alta Nueva</a>
@stop

@section('header')
<div style="color:white;" class="content">
  Eliminar estación
  <div style="color:white;" class="sub header">¿Está seguro de que quiere <strong>eliminar definitivamente</strong> la estación?</div>
</div>
@stop

@section('content')
<div class="two fluid ui buttons">
  {{ Form::open(array('url' => 'estaciones/' . $indicativo . '/eliminar')) }}
  {{ Form::hidden('_method', 'DELETE') }}
  <a class="ui negative labeled icon button" href="{{ URL::to('estaciones/' . $indicativo) }}">
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
