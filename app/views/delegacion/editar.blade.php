@extends('plantilla')

@section('head')
<title>Editar delegación - AEMET</title>
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
  Editar delegación
  <div class="sub header">Editar los datos de la delegación</div>
</div>
@stop

@section('content')

{{ Form::model($delegacion, array(
  'url' => "delegaciones/$delegacion->cod",
  $delegacion->cod,
  'method' => 'put',
  'class' => 'ui form segment small'
  ))
}}

<div class="ui piled red segment">
  <h2 class="ui header">
    <i class="icon inverted circular red docs basic"></i> Datos
  </h2>
  <div class="three fields">
    @include('delegacion/input/delegacion')
    @include('delegacion/input/cod')
    @include('delegacion/input/delegado')
  </div>
</div>

@include('general/direccion')

<a href="{{ URL::to('delegaciones/' . $delegacion->cod) }}" class="ui button"><i class="left arrow icon"></i>Volver</a>

<div class="ui buttons">
  <a href="{{ Request::url() }}" class="ui button negative">Deshacer</a>
  <div class="or"></div>
  {{ Form::submit('Guardar cambios', array('class' => 'ui positive button submit')) }}
</div>

{{ Form::close() }}

</div>

@include('js/dropdownActivar')
@include('js/dropdownMunicipios')

@stop