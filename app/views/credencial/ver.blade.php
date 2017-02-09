@extends('plantilla')

@section('head')
<title>Credencial - AEMET
@if(isset($credencial->usuario) )
  {{ $credencial->usuario }} - AEMET
@else
  Delegación no encontrada - AEMET
@endif
</title>
@stop

@section('login')
@parent
@stop

@section('submenu')
  <a href="{{ URL::to('credenciales') }}" class="item"><i class="list layout icon"></i>Listado de Credenciales</a>
  @if(Auth::user()->tipo->tipo == 'Administrador')
  <a href="{{ URL::to('credenciales/crear') }}" class="item"><i class="add icon"></i>Crear Nueva</a>
  @endif
@stop

@section('header')
<div style="color:white;" class="content">
  Credencial
  <div style="color:white;" class="sub header">Información detallada sobre la credencial</div>
</div>
@stop

@section('content')

@if (!$credencial)
  <div class="ui warning message">
    <div class="header">Vacío</div>
    <p style="color:black;">No se ha encontrado la credencial.</p>
  </div>
@else

  {{-- ESTADO ---------------------------------------------------------------------------------------------}}
  <button class="ui tiny button {{ ($credencial->f_baja) ? 'negative' : 'positive' }}">
    <div class="visible content"><i class="user icon"></i>{{ ($credencial->f_baja) ? 'Inactiva' : 'Activa' }}</div>
  </button>
  </br></br>

  {{-- BOTONES DE ACCIONES --------------------------------------------------------------------------------}}
  @if(Auth::user()->tipo->tipo == 'Administrador' or Auth::user()->tipo->tipo == 'Supervisor' or Auth::user()->tipo->tipo == 'Lector')
  <div class="">
    <a class="ui small down animated button" href="{{ URL::to('credenciales/'.$credencial->id . '/editar') }}">
      <div class="hidden content accion">Editar</div>
      <div class="visible content">
        <i class="edit icon"></i>
      </div>
    </a>
  @endif
  @if(Auth::user()->tipo->tipo == 'Administrador' or Auth::user()->tipo->tipo == 'Supervisor')  
    <a class="ui small down animated button" href="{{ URL::to('credenciales/'.$credencial->id . '/baja') }}">
      <div class="hidden content accion">Baja</div>
      <div class="visible content">
        <i class="level down icon"></i>
      </div>
    </a>
    <a class="ui small down animated button" href="{{ URL::to('credenciales/'.$credencial->id . '/alta') }}">
      <div class="hidden content accion">Alta</div>
      <div class="visible content">
        <i class="level up icon"></i>
      </div>
    </a>
    <a class="ui small down animated button" href="{{ URL::to('credenciales/'.$credencial->id . '/eliminar') }}">
      <div class="hidden content accion">Borrar</div>
      <div class="visible content">
        <i class="remove icon"></i>
      </div>
    </a>
  </div>
  @endif
  
  {{-- FICHA DATOS ------------------------------------------------------------------------------------------}}
  <div class="ui piled feed form segment">
    <h2 class="ui header">
      {{ $credencial->nombre }} {{ $credencial->apellidos }}
    </h2>
  
    <div class="three fields">
  
      <div class="field">
        <div class="event">
          <div class="label">
            <i class="circular key icon"></i>
          </div>
          <div class="content">
            <div class="summary">
              <div class="ui list">
                <div class="item">
                  <div class="content">
                    <strong>Usuario</strong>
                    <div class="description">{{ $credencial->usuario }}</div>
                  </div>
                </div>
                @if($credencial->credenciales_tipo_id)
                <div class="item">
                  <div class="content">
                    <strong>Tipo</strong>
                    <div class="description">{{ $credencial->tipo->tipo }}</div>
                  </div>
                </div>
                @endif
                @if($credencial->puesto)
                <div class="item">
                  <div class="content">
                    <strong>Puesto</strong>
                    <div class="description">{{ $credencial->puesto }}</div>
                  </div>
                </div>
                @endif
              </div>
            </div>
          </div>
        </div>
      </div>

      @if($credencial->delegacion)
      <div class="field">
        <div class="event">
          <div class="label">
            <i class="circular building icon"></i>
          </div>
          <div class="content">
            <div class="summary">
              <div class="ui list">
                <div class="item">
                  <div class="content">
                    <strong>Delegación</strong>
                    <div class="description">
                      <a href="{{ URL::to('delegaciones/' . $credencial->delegacion->cod . '/ver') }}">{{ $credencial->delegacion->delegacion }}</a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      @endif

    </div>

  </div>
@endif

@stop
