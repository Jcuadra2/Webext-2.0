@extends('plantilla')

@section('head')
<title>Editar Colaborador - AEMET</title>
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
  Editar colaborador
  <div style="color:white;" class="sub header">Edita los datos de un colaborador</div>
</div>
@stop

@section('content')

{{ Form::model($colaborador, array(
    'url' => "colaboradores/$colaborador->id",
    $colaborador->id,
    'method' => 'put',
    'class' => 'ui form segment small'
    ))
}}

@include('general/delegaciones')

<div class="ui piled red segment">
  <h2 class="ui header">
    <i class="icon inverted circular red docs basic"></i> Datos
  </h2>
  <div class="three fields">
    @include('colaborador/input/nombre')
    @include('colaborador/input/apellidos')
    @include('colaborador/input/estacionesEditar')
  </div>
  <div class="three fields">
    @include('colaborador/input/nacimiento')
    @include('colaborador/input/cifnif')
    @include('colaborador/input/tipo')
  </div>
  <div class="three fields">
    @include('colaborador/input/cuenta')
    @include('colaborador/input/estudios')
    @include('colaborador/input/profesiones')
  </div>
  <div class="three fields">
    @include('colaborador/input/fiabilidad')
    @include('colaborador/input/continuidad')
  </div>
  <div class="field">
    @include('colaborador/input/anotacion')
  </div>
</div>


<div class="ui piled purple segment">
  <h2 class="ui header">
    <i class="icon inverted circular purple phone"></i> Contacto
  </h2>
  <div class="four fields">
    @include('colaborador/input/movil')
    @include('colaborador/input/fijo')
    @include('colaborador/input/email')
    @include('colaborador/input/fax')
  </div>
</div>

@include('general/direccion')

<div class="ui piled orange segment">
  <h2 class="ui header">
    <i class="icon inverted circular orange trophy"></i> Galardones
  </h2>
  <div class="four fields">
    @include('colaborador/input/diploma')
    @include('colaborador/input/placa')
    @include('colaborador/input/premio')
    @include('colaborador/input/condecoracion')
  </div>
</div>

@if(Auth::user()->tipo->tipo == 'Supervisor')

  @include('colaborador/input/gratificaciones')


  <a href="{{ URL::to('colaboradores/' . $colaborador->id) }}" class="ui button"><i class="left arrow icon"></i>Volver</a>

  <div class="ui buttons">
    <a href="{{ Request::url() }}" class="ui button negative">Deshacer</a>
    <div class="or"></div>
    {{ Form::submit('Guardar cambios', array('class' => 'ui positive button submit')) }}
  </div>

  {{ Form::close() }}

  </div>
@endif

@include('js/ratingActivar')
@include('js/ratingSetGet')

@include('js/addEstaciones')

@include('js/ajaxGratificacion')

@include('js/dropdownActivar')
@include('js/dropdownMunicipios')

@stop