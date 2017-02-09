@extends('plantilla')

@section('head')
  <title>Estaciones - AEMET</title>
@stop

@section('login')
  @parent
@stop

@section('submenu')
  @if(Auth::user()->tipo->tipo == 'Supervisor' OR Auth::user()->tipo->tipo == 'Administrador')
  <a href="{{ URL::to('estaciones/alta') }}" class="item"><i class="add icon"></i>Alta Nueva</a>
  @endif
@stop

@section('header')
  <div style="color:white;" class="content">
    Listado de estaciones {{ ($estaciones->count()) ? '<div class="ui circular black label">'.$estaciones->count().'</div>' : '' }}
    <div style="color:white;" class="sub header">Pincha en los botones de la columna estado para ver más detalles sobre cada estación</div>
  </div>
@stop

@section('content')

  @if ($estaciones->isEmpty())
  <div class="ui warning message">
    <div class="header">Vacía</div>
    <p style="color:white;" >No se han encontrado estaciones.</p>
  </div>
  @else
  <table id='datos' class="ui table segment sortable">
    <thead>
    <tr>
      <th>Estado</th>
      <th>Indicativo</th>
      <th>Estación</th>
      <th>Tipo</th>
      <th>Categoría</th>
      <th>Cuenca</th>
      @if(Auth::user()->tipo->tipo == 'Administrador')
      <th>Delegación</th>
      @endif
    </tr>
    </thead>
    <tbody>
    @foreach($estaciones as $estacion)
    <tr>
      <td>
        <a href="{{ URL::to('estaciones/' . $estacion->indicativo) }}" class="ui tiny animated button {{ ($estacion->f_baja) ? 'negative' : 'positive' }}">
          <div class="visible content"><i class="open basic icon"></i>{{ ($estacion->f_baja) ? 'Inactivo' : 'Activo' }}</div>
          <div class="hidden content">Ver<i class="right arrow icon"></i></div>
        </a>
      </td>
      <td>{{ $estacion->indicativo }}</td>
      <td>{{ $estacion->estacion }}</td>
      <td>{{ $estacion->tipo->tipo }}</td>
      <td>{{ $estacion->categoria->categoria }}</td>
      <td>{{ $estacion->cuenca->cuenca }}</td>
      @if(Auth::user()->tipo->tipo == 'Administrador')
      <td>{{ $estacion->delegacion->delegacion }}</td>
      @endif
    </tr>
    @endforeach
    </tbody>
  </table>
  @endif
@stop
