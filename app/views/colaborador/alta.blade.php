@extends('plantilla')

@section('head')
  <title>Alta de Colaboradores - AEMET</title>
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
    Alta de colaboradores
    <div style="color:white;" class="sub header">Dar de alta un nuevo colaborador.</div>
  </div>
@stop

@section('content')

  {{-- method: POST (by default) --}}
  {{ Form::open(array('url' => 'colaboradores','class' => 'ui form segment small')) }}


@include('general/delegaciones')

<div class="ui piled red segment">
  <h2 class="ui header">
    <i class="icon inverted circular red docs basic"></i> Datos
  </h2>
  <div class="three fields">
    @include('colaborador/input/nombre')
    @include('colaborador/input/apellidos')
    @include('colaborador/input/estacionesAlta')
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

<div class="ui piled green segment">
  <h2 class="ui header">
    <i class="icon inverted circular green trophy"></i> Galardones
  </h2>
  <div class="four fields">
    @include('colaborador/input/diploma')
    @include('colaborador/input/placa')
    @include('colaborador/input/premio')
    @include('colaborador/input/condecoracion')
  </div>
</div>






  <div class="ui buttons">
    <a href="{{ URL::to('colaboradores/alta') }}" class="ui button">Resetear</a>
      <div class="or"></div>
    {{ Form::submit('Alta', array('class' => 'ui positive button submit')) }}
  </div>

{{ Form::close() }}

</div>

@include('js/dropdownActivar')
@include('js/dropdownMunicipios')

@include('js/ratingActivar')
@include('js/ratingSetGet')

@include('js/addEstaciones')


@stop