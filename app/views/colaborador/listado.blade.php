@extends('plantilla')

@section('head')
  <title>Colaboradores - AEMET</title>
@stop

@section('login')
  @parent
@stop

@section('submenu')
  @if(Auth::user()->tipo->tipo == 'Supervisor' OR Auth::user()->tipo->tipo == 'Administrador')
  <a href="{{ URL::to('colaboradores/alta') }}" class="item"><i class="add icon"></i>Alta Nueva</a>
  @endif
@stop

@section('header')
  <div class="content">
    <div style="color:white;">Listado de colaboradores {{ ($colaboradores->count()) ? '<div class="ui circular black label">'.$colaboradores->count().'</div></div>' : '' }}
    <div style="color:white;" class="sub header">Pincha en los botones de la columna estado para ver más detalles sobre cada colaborador</div>
  </div>
@stop

@section('content')

  @if ($colaboradores->isEmpty())
  <div class="ui warning message">
    <div class="header">Vacía</div>
    <p style="color:white;">No se han encontrado colaboradores.</p>
  </div>
  @else
  <table id='datos' class="ui table segment sortable">
    <thead>
    <tr>
      <th>Estado</th>
      <th>DNI</th>
      <th>Nombre</th>
      <th>Apellidos</th>
      @if(Auth::user()->tipo->tipo == 'Administrador')
      <th>Delegacion</th>
      @endif
    </tr>
    </thead>
    <tbody>
    @foreach($colaboradores as $colaborador)
    <tr>
      <td>
        <a href="{{ URL::to('colaboradores/' . $colaborador->id) }}" class="ui tiny animated button {{ ($colaborador->f_baja) ? 'negative' : 'positive' }}">
          <div class="visible content"><i class="open basic icon"></i>{{ ($colaborador->f_baja) ? 'Inactivo' : 'Activo' }}</div>
          <div class="hidden content">Ver<i class="right arrow icon"></i></div>
        </a>
      </td>
      <td>{{ $colaborador->cif_nif }}</td>
      <td>{{ $colaborador->nombre }}</td>
      <td>{{ $colaborador->apellidos }}</td>
      @if(Auth::user()->tipo->tipo == 'Administrador')
      <td>
        {{ $colaborador->delegacion->delegacion }}
      </td>
      @endif
    </tr>
    @endforeach
    </tbody>
  </table>
  @endif
@stop
