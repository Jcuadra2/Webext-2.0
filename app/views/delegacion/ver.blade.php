@extends('plantilla')

@section('head')
<title>Delegacion - AEMET
@if(isset($delegacion->delegacion) )
  {{ $delegacion->delegacion }} - AEMET
@else
  Delegación no encontrada - AEMET
@endif
</title>
@stop

@section('login')
@parent
@stop

@section('submenu')
  <a href="{{ URL::to('delegaciones') }}" class="item"><i class="list layout icon"></i>Listado de Delegaciones</a>
  @if(Auth::user()->tipo->tipo == 'Administrador')
  <a href="{{ URL::to('delegaciones/crear') }}" class="item"><i class="add icon"></i>Crear Nueva</a>
  @endif
@stop

@section('header')
<div class="content">
  Delegación
  <div class="sub header">Información detallada sobre la delegación</div>
</div>
@stop

@section('content')

@if (!$delegacion)
  <div class="ui warning message">
    <div class="header">Vacío</div>
    <p>No se ha encontrado la delegación.</p>
  </div>
@else

  {{-- BOTONES DE ACCIONES --------------------------------------------------------------------------------}}
  @if(Auth::user()->tipo->tipo == 'Administrador')
  <div class="ui small icon buttons">
    <a class="ui small down animated button" href="{{ URL::to('delegaciones/'.$delegacion->cod . '/editar') }}">
      <div class="hidden content accion">Edita</div>
      <div class="visible content">
        <i class="edit icon"></i>
      </div>
    </a>
    <a class="ui small down animated button" href="{{ URL::to('delegaciones/'.$delegacion->cod . '/eliminar') }}">
      <div class="hidden content accion">Borra</div>
      <div class="visible content">
        <i class="remove icon"></i>
      </div>
    </a>
  </div>
  @endif
  
  {{-- FICHA DATOS ------------------------------------------------------------------------------------------}}
  <div class="ui piled feed form segment">
    <h2 class="ui header">
      {{ $delegacion->delegacion }}
    </h2>
  
    <div class="four fields">
  
      <div class="field">
        <div class="event">
          <div class="label">
            <i class="circular building icon"></i>
          </div>
          <div class="content">
            <div class="summary">
              <div class="ui list">

                @if(isset($delegacion->cod))
                <div class="item">
                  <div class="content">
                    <strong>Código</strong>
                    <div class="description">{{ $delegacion->cod }}</div>
                  </div>
                </div>
                @endif

                @if(isset($delegacion->delegado_territorial))
                <div class="item">
                  <div class="content">
                    <strong>Delegado Territorial</strong>
                    <div class="description">{{ $delegacion->delegado_territorial }}</div>
                  </div>
                </div>
                @endif

              </div>
            </div>
          </div>
        </div>
      </div>

      @if($delegacion->estaciones->first())
      <div class="field">
        <div class="event">
          <div class="label">
            <i class="circular grid layout icon"></i>
          </div>
          <div class="content">
            <div class="date">
            </div>
            <div class="summary">
              <strong>Estaciones</strong>
              <div class="ui divided list">
                @foreach($delegacion->estaciones as $estacion)
                <div class="item">
                  <div class="content">
                    <a href="{{ URL::to('estaciones/' . $estacion->indicativo) }}">{{ $estacion->estacion }}</a>
                    <div class="description">{{ $estacion->indicativo }}</div>
                  </div>
                </div>
                @endforeach
              </div>
            </div>
          </div>
        </div>
      </div>

        @if($delegacion->estaciones->first()->colaboradores->first())
        <div class="field">
          <div class="event">
            <div class="label">
              <i class="circular community basic icon"></i>
            </div>
            <div class="content">
              <div class="date">
              </div>
              <div class="summary">
                <strong>Colaboradores</strong>
                <div class="ui divided list">
                  @foreach($delegacion->estaciones as $estacion)
                    @foreach($estacion->colaboradores as $colaborador)
                    <div class="item">
                      <div class="content">
                        <a href="{{ URL::to('colaboradores/' . $colaborador->id) }}">{{ $colaborador->nombre }}</a>
                        <div class="description">{{ $estacion->estacion }}</div>
                      </div>
                    </div>
                    @endforeach
                  @endforeach
                </div>
              </div>
            </div>
          </div>
        </div>
        @endif
      @endif

      @if($delegacion->credenciales->first())
      <div class="field">
        <div class="event">
          <div class="label">
            <i class="circular key icon"></i>
          </div>
          <div class="content">
            <div class="date">
            </div>
            <div class="summary">
              <strong>Credenciales</strong>
              <div class="ui divided list">
                @foreach($delegacion->credenciales as $credencial)
                  @if($credencial->nombre OR $credencial->apellidos)
                  <div class="item">
                    <div class="content">
                      <a href="{{ URL::to('credenciales/' . $credencial->id) }}">{{ $credencial->nombre }} {{ $credencial->apellidos }}</a>
                      <div class="description">{{ $credencial->tipo->tipo }}</div>
                    </div>
                  </div>
                @endif
                @endforeach
              </div>
            </div>
          </div>
        </div>
      </div>
      @endif

      {{-- DIRECCION --}}
      @if($delegacion->direcciones->first())
      <div class="field">

        <div class="event">
          <div class="label">
            <i class="circular home icon"></i>
          </div>
          <div class="content">
            <div class="summary">
              <div class="ui list">

                <div class="item">
                  <div class="content">
                    <strong>Dirección</strong>
                    <div class="description">{{ $delegacion->direcciones->first()->direccion }}</div>
                    <div class="description">{{ $delegacion->direcciones->first()->cp }}</div>
                    <div class="description">{{ $delegacion->direcciones->first()->localidad }}</div>
                    <div class="description">{{ $municipio->municipio }}</div>
                    <div class="description">{{ $provincia->provincia }}</div>
                  </div>
                </div>

                @if($delegacion->direcciones->first()->detalles)
                <div class="item">
                  <div class="content">
                    <strong>Detalles</strong>
                    <div class="description">{{ $delegacion->direcciones->first()->detalles }}</div>
                  </div>
                </div>
                @endif

              </div>
            </div>
          </div>
        </div>
      </div>
      @endif

  </div>
@endif

@stop
