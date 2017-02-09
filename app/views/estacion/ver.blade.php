@extends('plantilla')

@section('head')
<title>
  @if(isset($estacion->indicativo) )
  {{ $estacion->indicativo }} - AEMET
  @else
    Estación no encontrada - AEMET
  @endif
</title>
@stop

@section('login')
@parent
@stop

@section('submenu')
  <a href="{{ URL::to('estaciones') }}" class="item"><i class="list layout icon"></i>Listado de Estaciones</a>
  @if(Auth::user()->tipo->tipo == 'Supervisor' OR Auth::user()->tipo->tipo == 'Administrador')
  <a href="{{ URL::to('estaciones/alta') }}" class="item"><i class="add icon"></i>Alta Nueva</a>
  @endif
@stop

@section('header')
<div style="color:white;" class="content">
  Estación
  <div style="color:white;" class="sub header">Información detallada sobre la estación</div>
</div>
@stop

@section('content')

@if (!$estacion)
<div class="ui warning message">
  <div class="header">Vacío</div>
  <p>No se ha encontrado la estación</p>
</div>
@else

{{-- ESTADO --------------------------------------------------------------------------------}}
<button class="ui tiny button {{ ($estacion->f_baja) ? 'negative' : 'positive' }}">
  <div class="visible content"><i class="user icon"></i>{{ ($estacion->f_baja) ? 'Inactiva' : 'Activa' }}</div>
</button>

{{-- BOTONES DE ACCIONES --------------------------------------------------------------------------------}}
@if(Auth::user()->tipo->tipo == 'Supervisor' OR Auth::user()->tipo->tipo == 'Administrador')
<div class="ui small icon buttons">
  <a class="ui small down animated button" href="{{ URL::to('estaciones/'.$estacion->indicativo . '/editar') }}">
    <div class="hidden content accion">Edita</div>
    <div class="visible content">
      <i class="edit icon"></i>
    </div>
  </a>
  <a class="ui small down animated button" href="{{ URL::to('estaciones/'.$estacion->indicativo . '/baja') }}">
    <div class="hidden content accion">Baja</div>
    <div class="visible content">
      <i class="level down icon"></i>
    </div>
  </a>
  <a class="ui small down animated button" href="{{ URL::to('estaciones/'.$estacion->indicativo . '/alta') }}">
    <div class="hidden content accion">Alta</div>
    <div class="visible content">
      <i class="level up icon"></i>
    </div>
  </a>
  <a class="ui small down animated button" href="{{ URL::to('estaciones/'.$estacion->indicativo . '/eliminar') }}">
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
    {{ $estacion->estacion }}
  </h2>

  <div class="four fields">

    <div class="field">
      <div class="event">
        <div class="label">
          <i class="circular grid layout icon"></i>
        </div>
        <div class="content">
          <div class="summary">
            <div class="ui list">

              @if(isset($estacion->indicativo))
              <div class="item">
                <div class="content">
                  <strong>Indicativo</strong>
                  <div class="description" id="indicativo">{{ $estacion->indicativo }}</div>
                </div>
              </div>
              @endif

              @if(isset($estacion->tipo->tipo))
              <div class="item">
                <div class="content">
                  <strong>Tipo</strong>
                  <div class="description">{{ $estacion->tipo->tipo }}</div>
                </div>
              </div>
              @endif

              @if(isset($estacion->propietario->propietario))
              <div class="item">
                <div class="content">
                  <strong>Propietario</strong>
                  <div class="description">{{ $estacion->propietario->propietario }}</div>
                </div>
              </div>
              @endif

              @if(isset($estacion->categoria->categoria))
              <div class="item">
                <div class="content">
                  <strong>Categoría</strong>
                  <div class="description">{{ $estacion->categoria->categoria }}</div>
                </div>
              </div>
              @endif

              @if(isset($estacion->cuenca->cuenca))
              <div class="item">
                <div class="content">
                  <strong>Cuenca</strong>
                  <div class="description">{{ $estacion->cuenca->cuenca }}</div>
                </div>
              </div>
              @endif

              @if(isset($estacion->isla->isla))
              <div class="item">
                <div class="content">
                  <strong>Isla</strong>
                  <div class="description">{{ $estacion->isla->isla }}</div>
                </div>
              </div>
              @endif

              @if(isset($estacion->comarca->comarca))
              <div class="item">
                <div class="content">
                  <strong>Comarca</strong>
                  <div class="description">{{ $estacion->comarca->comarca }}</div>
                </div>
              </div>
              @endif

            </div>
          </div>
        </div>
      </div>
    </div>

    @if($estacion->delegacion->first())
    <div class="field">

      <div class="event">
        <div class="label">
          <i class="circular building icon"></i>
        </div>
        <div class="content">
          <div class="date">
          </div>
          <div class="summary">
            <strong>Delegacion</strong>
            <div class="ui list">
              <div class="item">
                <div class="content">
                  @if(Auth::user()->tipo->tipo == 'Administrador')
                  <a href="{{ URL::to('delegaciones/' . $estacion->delegacion->cod ) }}">{{ $estacion->delegacion->delegacion }}</a>
                  @else
                  {{ $estacion->delegacion->delegacion  }}
                  @endif
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      @if($estacion->colaboradores->first())
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
              @foreach($estacion->colaboradores as $colaborador)
              <div class="item">
                <div class="content">
                  <a href="{{ URL::to('colaboradores/' . $colaborador->id) }}">{{ $colaborador->nombre }} {{ $colaborador->apellidos }}</a>
                  <div class="description">
                    {{ $colaborador->pivot->observaciones }}
                  </div>
                </div>
              </div>
              @endforeach
            </div>

          </div>
        </div>
      </div>
      @endif

    </div>
    @endif

    {{------------------------------------------------------
        INSPECCIONES
    ------------------------------------------------------}}
    @if($estacion->inspecciones->first())
    <div class="field">

      <div class="event">
        <div class="label">
          <i class="circular stethoscope icon"></i>
        </div>
        <div class="content">
          <div class="date">
          </div>
          <div class="summary">
            <strong>Inspecciones</strong>
            <div class="ui divided list">
              @foreach($estacion->inspecciones as $inspeccion)
              <div class="item">
                <div class="content">
                  <div class="header">{{ HelperController::fechaMysql_a_castellano($inspeccion->fecha) }}</div>
                  <div class="description">{{ $inspeccion->observaciones }}</div>
                </div>
              </div>
              @endforeach
            </div>
          </div>
        </div>
      </div>

    </div>
    @endif

    {{------------------------------------------------------
    GEOLOCALIZACIONES
    ------------------------------------------------------}}
    @if($estacion->geolocalizaciones->first())
    <div class="field">
      <div class="event">
        <div class="label">
          <i class="circular location icon"></i>
        </div>
        <div class="content">
          <div class="summary">
            <strong>Longitud</strong>
            {{--  grados (°), minutos (') y segundos (”) --}}
            <div class="description">{{ $geolocalizacion->longitud_g }}º {{ $geolocalizacion->longitud_m }}' {{ $geolocalizacion->longitud_s }}” {{ ucfirst($geolocalizacion->longitud_w_e) }}</div>
            <strong>Latitud</strong>
            <div class="description">{{ $geolocalizacion->latitud_g }}º {{ $geolocalizacion->latitud_m }}' {{ $geolocalizacion->latitud_s }}” {{ ucfirst($geolocalizacion->latitud_n_s) }}</div>
            <strong>Altitud</strong>
            <div class="description">{{ $geolocalizacion->altitud }}</div>
            <strong>Huso</strong>
            <div class="description">{{ $geolocalizacion->huso }}</div>
            <strong>UMT</strong>
            <div class="description">X{{ $geolocalizacion->umt_x }}, Y{{ $geolocalizacion->umt_y }}</div>
            <strong>Hoja Mapa</strong>
            <div class="description">{{ $geolocalizacion->hoja_mapa }}</div>
            <strong>Ubicación</strong>
            <div class="description">{{ $geolocalizacion->ubicacion }}</div>
          </div>
        </div>
      </div>
    </div>
    @endif

    @if($estacion->direcciones->first())
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
                  <div class="description">{{ $estacion->direcciones->first()->direccion }}</div>
                  <div class="description">{{ $estacion->direcciones->first()->cp }}</div>
                  <div class="description">{{ $estacion->direcciones->first()->localidad }}</div>
                  <div class="description">{{ $municipio->municipio }}</div>
                  <div class="description">{{ $provincia->provincia }}</div>
                </div>
              </div>

              @if($estacion->direcciones->first()->detalles)
              <div class="item">
                <div class="content">
                  <strong>Detalles</strong>
                  <div class="description">{{ $estacion->direcciones->first()->detalles }}</div>
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

  <div class="field">
    {{------------------------------------------------------
    FOTOS
    ------------------------------------------------------}}
    @if($estacion->fotos->first())
    <div class="field">
      <div class="event">
        <div class="label">
          <i class="circular photo icon"></i>
        </div>
        <div class="content">
          <div class="date">
          </div>
          <div class="summary">
            <strong>Imágenes</strong>
          </div>
          <div class="extra images">
            <img src="/images/demo/item1.jpg">
            <img src="/images/demo/item2.jpg">
          </div>
        </div>
      </div>
    </div>
    @endif
  </div>

</div>



@endif

<script>
  function setRating()
  {
    $('.fiabilidad').rating('set rating', $('#fiabilidad').val());
    $('.continuidad').rating('set rating', $('#continuidad').val());
  }
  setRating();
  $('.ui.rating').rating('disable');
</script>


@stop

