@extends('plantilla')

@section('head')
  <title>Importar BBDD - AEMET</title>
@stop

@section('login')
  @parent
@stop

@section('submenu')
@stop

@section('header')
  <div style="color:white;" class="content">
    Importar Base de Datos
    <div style="color:white;" class="sub header">Importa el archivo .sql con la estructura y datos generados por la exportación de Access a MySQL</div>
  </div>
@stop

@section('content')

  {{-- method: POST (by default) --}}
  {{ Form::open(array('url' => 'importar','class' => 'ui form segment small')) }}

  <div class="two fields">
    <div class="field">
      @include('importar/inputs/db_origen')
    </div>
    <div class="field">
      @include('importar/inputs/db_destino')
    </div>
  </div>

  {{ Form::submit('Conectar', array('class' => 'ui positive tiny button submit')) }}

  {{ Form::close() }}

  @include('js/dropdownActivar')
  @include('js/dropdownMunicipios')

  @include('js/ratingActivar')
  @include('js/ratingSetGet')

  @include('js/addEstaciones')

  @include('js/accordionActivar')

  @include('js/activarPopup')

@stop