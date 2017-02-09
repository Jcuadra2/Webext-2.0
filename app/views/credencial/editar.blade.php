@extends('plantilla')

@section('head')
<title>Editar credencial - AEMET</title>
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
  Editar credencial
  <div style="color:white;" class="sub header">Editar los datos de la credencial</div>
</div>
@stop

@section('content')

{{ Form::model($credencial, array(
  'url' => "credenciales/$credencial->id",
  $credencial->id,
  'method' => 'put',
  'class' => 'ui form segment small'
  ))
}}

@include('general/delegaciones')

<div class="ui piled red segment">
  <h2 class="ui header">
    <i class="icon inverted circular red docs basic"></i> Datos
  </h2>
  <div class="two fields">
    @include('credencial/input/nombre')
    @include('credencial/input/apellidos')
  </div>
  <div class="two fields">
    @include('credencial/input/usuario')
    @include('credencial/input/tipos')
  </div>
  <div class="two fields">
    @include('credencial/input/password')
    @include('credencial/input/confirmar_password')
  </div>
  @include('credencial/input/puesto')
  <div class="field">
    @include('credencial/input/observaciones')
  </div>
</div>

<a href="{{ URL::to('credenciales/' . $credencial->id) }}" class="ui button"><i class="left arrow icon"></i>Volver</a>

<div class="ui buttons">
  <a href="{{ Request::url() }}" class="ui button negative">Deshacer</a>
  <div class="or"></div>
  {{ Form::submit('Guardar cambios', array('class' => 'ui positive button submit')) }}
</div>

{{ Form::close() }}

</div>

@include('js/dropdownActivar')

@stop