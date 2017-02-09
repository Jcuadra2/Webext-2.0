@extends('plantilla')

@section('head')
<title>Credenciales - AEMET</title>
@stop

@section('login')
@parent
@stop

@section('submenu')
  @if(Auth::user()->tipo->tipo != 'Supervisor' AND Auth::user()->tipo->tipo != 'Lector')
  <a href="{{ URL::to('credenciales/crear') }}" class="item"><i class="add icon"></i>Crear Nueva</a>
  @endif
@stop

@section('header')
  @if(Auth::user()->tipo->tipo != 'Supervisor' AND Auth::user()->tipo->tipo != 'Lector')
    <div style="color:white;" class="content">
      Listado de credenciales {{ ($credenciales->count()) ? '<div class="ui circular black label">'.$credenciales->count().'</div>' : '' }}
      <div style="color:white;" class="sub header">Pincha en los botones de la columna Ver para ver más detalles sobre cada credencial</div>
    </div>
  @endif
@stop

@section('content')

@if ($credenciales->isEmpty())
<div class="ui warning message">
  <div class="header">Vacía</div>
  <p style="color:white;">No se han encontrado credenciales.</p>
</div>
@else
<table id='datos' class="ui table segment sortable">
  <thead>
  <tr>
    <th>Ver</th>
    <th>Usuario</th>
    <th>Nombre completo</th>
    <th>Tipo</th>
    {{ $credenciales ? '<th>Delegación</th>' : '' }}
  </tr>
  </thead>
  <tbody>
  @foreach($credenciales as $credencial)
  <tr>
    <td>
      <a href="{{ URL::to('credenciales/' . $credencial->id) }}"
         class="ui tiny animated button {{ ($credencial->f_baja) ? 'negative' : 'positive' }}">
        <div class="visible content"><i class="open basic icon"></i>{{ ($credencial->f_baja) ? 'Inactivo' : 'Activo' }}</div>
        <div class="hidden content">Ver<i class="right arrow icon"></i></div>
      </a>
    </td>
    <td>{{ $credencial->usuario }}</td>
    <td>{{ $credencial->nombre }} {{ $credencial->apellidos }}</td>
    <td>{{ $credencial->tipo->tipo }}</td>
    <td>{{ $credencial->delegacion_cod ? $credencial->delegacion->delegacion : '' }}</td>
  </tr>
  @endforeach
  </tbody>
</table>
@endif
@stop
