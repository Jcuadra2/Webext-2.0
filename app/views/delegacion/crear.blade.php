@extends('plantilla')

@section('head')
  <title>Crear delegación - AEMET</title>
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
Crear delegación
<div class="sub header">Crear una nueva delegación.</div>
  </div>
@stop

@section('content')

{{-- method: POST (by default) --}}
{{ Form::open(array('url' => 'delegaciones','class' => 'ui form segment small')) }}


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

<div class="ui buttons">
  <a href="{{ URL::to('delegaciones/crear') }}" class="ui button">Resetear</a>
    <div class="or"></div>
  {{ Form::submit('Crear', array('class' => 'ui positive button submit')) }}
</div>

{{ Form::close() }}

</div>

@include('js/dropdownActivar')
@include('js/dropdownMunicipios')

@stop