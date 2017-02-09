@extends('plantilla')

@section('head')
<title>Eliminar Colaborador - AEMET</title>
@stop

@section('login')
@parent
@stop

@section('submenu')
<a href="{{ URL::to('colaboradores') }}" class="item"><i class="list layout icon"></i>Listado de Colaboradores</a>
<a href="{{ URL::to('colaboradores/alta') }}" class="item"><i class="add icon"></i>Alta Nueva</a>
@stop

@section('header')
<div style="color:white;" class="content">
  Eliminar colaborador
  <div style="color:white;" class="sub header">¿Está seguro de que quiere <strong>eliminar definitivamente</strong> al colaborador?</div>
</div>
@stop

@section('content')
<div class="two fluid ui buttons">
  {{ Form::open(array('url' => 'colaboradores/' . $id . '/eliminar')) }}
  {{ Form::hidden('_method', 'DELETE') }}
  <a class="ui negative labeled icon button" href="{{ URL::to('colaboradores/' . $id) }}">
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
