@extends('plantilla')

@section('head')
  <title>Alta de Estaciones - AEMET</title>
@stop

@section('login')
  @parent
@stop

@section('submenu')
<a href="{{ URL::to('estaciones') }}" class="item"><i class="list layout icon"></i>Listado de Estaciones</a>
<a href="{{ URL::to('estaciones/alta') }}" class="item"><i class="add icon"></i>Alta Nueva</a>
@stop

@section('header')
  <div class="content">
    Alta de estaciones
    <div class="sub header">Dar de alta una nueva estación</div>
  </div>
@stop

@section('content')

  {{-- method: POST (by default) --}}
  {{ Form::open(array('url' => 'estaciones','class' => 'ui form segment small')) }}

@include('general/delegaciones')

<div class="ui piled red segment">
  <h2 class="ui header">
    <i class="icon inverted circular red docs basic"></i> Datos
  </h2>
  <div class="three fields">
    @include('estacion/input/indicativo')
    @include('estacion/input/estacion')
    @include('estacion/input/tipos')
  </div>

  <div class="three fields">
    @include('estacion/input/categorias')
    @include('estacion/input/propietarios')
    @include('estacion/input/cuencas')
  </div>
</div>

{{--
<div class="ui piled green segment">
  <h2 class="ui header">
    <i class="icon inverted circular green unhide"></i> Inspecciones
  </h2>
    @include('estacion/input/inspeccion')
</div>
--}}

{{--
<div class="ui piled purple segment">
  <h2 class="ui header">
    <i class="icon inverted circular purple photo"></i> Imágenes
  </h2>
  <div class="field">
    @include('estacion/input/fotos')
  </div>
</div>
--}}

@include('general/direccion')

<div class="ui piled teal segment">
  <h2 class="ui header">
    <i class="icon inverted circular teal location"></i> Localización
  </h2>
  <div class="field">
    @include('estacion/input/geolocalizacion')
  </div>
</div>

  <div class="ui buttons">
    <a href="{{ URL::to('estaciones/alta') }}" class="ui button">Resetear</a>
      <div class="or"></div>
    {{ Form::submit('Alta', array('class' => 'ui positive button submit')) }}
  </div>

{{ Form::close() }}

</div>

@include('js/dropdownActivar')
@include('js/dropdownMunicipios')

@stop