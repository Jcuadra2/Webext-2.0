@extends('plantilla')

@section('head')
<title>Delegaciones - AEMET</title>
@stop

@section('login')
@parent
@stop

@section('submenu')
  @if(Auth::user()->tipo->tipo == 'Administrador')
  <a href="{{ URL::to('delegaciones/crear') }}" class="item"><i class="add icon"></i>Crear Nueva</a>
  @endif
@stop

@section('header')
<div style="color:white;" class="content">
  Listado de delegaciones {{ ($delegaciones->count()) ? '<div class="ui circular black label">'.$delegaciones->count().'</div>' : '' }}
  <div style="color:white;" class="sub header">Pincha en los botones de la columna estado para ver más detalles sobre cada delegación</div>
</div>
@stop

@section('content')

@if ($delegaciones->isEmpty())
<div class="ui warning message">
  <div class="header">Vacía</div>
  <p style="color:white;">No se han encontrado delegaciones.</p>
</div>
@else
<table id='datos' class="ui table segment sortable">
  <thead>
  <tr>
    <th>Ver</th>
    <th>Código</th>
    <th>Delegado</th>
    <th>Delegación</th>
  </tr>
  </thead>
  <tbody>
  @foreach($delegaciones as $delegacion)
  <tr>
    <td>
      <a href="{{ URL::to('delegaciones/' . $delegacion->cod) }}" class="ui tiny button">
        <i class="open basic icon"></i>Detalles
      </a>
    </td>
    <td>{{ $delegacion->cod }}</td>
    <td>{{ $delegacion->delegado_territorial }}</td>
    <td>{{ $delegacion->delegacion }}</td>
  </tr>
  @endforeach
  </tbody>
</table>
@endif
@stop
