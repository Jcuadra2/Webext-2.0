@extends('plantilla')

@section('head')
<title>
  @if(isset($colaborador->nombre) AND isset($colaborador->apellidos) )
  {{ $colaborador->nombre }} {{ $colaborador->apellidos }} - AEMET
  @else
    Colaborador no encontrado - AEMET
  @endif
</title>
@stop

@section('login')
@parent
@stop

@section('submenu')
  <a href="{{ URL::to('colaboradores') }}" class="item"><i class="list layout icon"></i>Listado de Colaboradores</a>

  @if(Auth::user()->tipo->tipo == 'Supervisor' OR Auth::user()->tipo->tipo == 'Administrador')
  <a href="{{ URL::to('colaboradores/alta') }}" class="item"><i class="add icon"></i>Alta Nueva</a>
  @endif
@stop

@section('header')
<div style="color:white;" class="content">
  Colaborador
  <div style="color:white;" class="sub header">Información detallada sobre el colaborador</div>
</div>
@stop

@section('content')

@if (!$colaborador)
<div class="ui warning message">
  <div class="header">Vacío</div>
  <p style="color:white;">No se ha encontrado al colaborador.</p>
</div>
@else

{{-- ESTADO ---------------------------------------------------------------------------------------------}}
<button class="ui tiny button {{ ($colaborador->f_baja) ? 'negative' : 'positive' }}">
  <div class="visible content"><i class="user icon"></i>{{ ($colaborador->f_baja) ? 'Inactivo' : 'Activo' }}</div>
</button>

{{-- BOTONES DE ACCIONES --------------------------------------------------------------------------------}}
@if(Auth::user()->tipo->tipo == 'Supervisor' OR Auth::user()->tipo->tipo == 'Administrador')
<div class="ui small icon buttons">
  <a class="ui small down animated button" href="{{ URL::to('colaboradores/'.$colaborador->id . '/editar') }}">
    <div class="hidden content accion">Edita</div>
    <div class="visible content">
      <i class="edit icon"></i>
    </div>
  </a>
  <a class="ui small down animated button" href="{{ URL::to('colaboradores/'.$colaborador->id . '/baja') }}">
    <div class="hidden content accion">Baja</div>
    <div class="visible content">
      <i class="level down icon"></i>
    </div>
  </a>
  <a class="ui small down animated button" href="{{ URL::to('colaboradores/'.$colaborador->id . '/alta') }}">
    <div class="hidden content accion">Alta</div>
    <div class="visible content">
      <i class="level up icon"></i>
    </div>
  </a>
  <a class="ui small down animated button" href="{{ URL::to('colaboradores/'.$colaborador->id . '/eliminar') }}">
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
    {{ $colaborador->nombre }} {{ $colaborador->apellidos }}
  </h2>

  <div class="three fields">

    <div class="field">

      <div class="event">
        <div class="label">
          <i class="circular user icon"></i>
        </div>
        <div class="content">
          <div class="summary">
            <div class="ui list">

              @if(isset($colaborador->cif_nif))
              <div class="item">
                <div class="content">
                  <strong>CIF NIF</strong>
                  <div class="description">{{ $colaborador->cif_nif }}</div>
                </div>
              </div>
              @endif

              @if(isset($colaborador->tipos->tipo))
              <div class="item">
                <div class="content">
                  <strong>Tipo</strong>
                  <div class="description">{{ $colaborador->tipos->tipo }}</div>
                </div>
              </div>
              @endif

              @if(isset($colaborador->f_nacimiento))
              <div class="item">
                <div class="content">
                  <strong>Fecha de Nacimiento</strong>
                  <div class="description">{{ $colaborador->f_nacimiento }}</div>
                </div>
              </div>
              @endif

              @if(isset($colaborador->profesiones->profesion))
              <div class="item">
                <div class="content">
                  <strong>Profesión</strong>
                  <div class="description">{{ $colaborador->profesiones->profesion }}</div>
                </div>
              </div>
              @endif

              @if(isset($colaborador->estudios->estudio))
              <div class="item">
                <div class="content">
                  <strong>Estudios</strong>
                  <div class="description">{{ $colaborador->estudios->estudio }}</div>
                </div>
              </div>
              @endif

              @if(isset($colaborador->asociado->cif_nif))
              <div class="item">
                <div class="content">
                  <strong>Colaborador de</strong>
                  <div class="description">{{ $colaborador->asociado->cif_nif }}</div>
                </div>
              </div>
              @endif

              @if(!is_null( $cuenta = $colaborador->cuentas()->first() ))
              <div class="item">
                <div class="content">
                  <strong>Cuenta Corriente</strong>
                  <div class="description">{{ $cuenta->ccc }}</div>
                </div>
              </div>
              @endif

            </div>
          </div>
        </div>
      </div>

    </div>

    @if($colaborador->localizadores()->first())
    <div class="field">
      <div class="event">
        <div class="label">
          <i class="circular phone icon"></i>
        </div>
        <div class="content">
          <div class="summary">
            <div class="ui list">

              @if(!is_null($fijo = $colaborador->localizadores()->where('localizadores_tipo_id','=',1)->first()) )
              <div class="item">
                <div class="content">
                  <strong>Teléfono fijo</strong>
                  <div class="description">{{ $fijo->localizador }}</div>
                </div>
              </div>
              @endif

              @if(!is_null($movil = $colaborador->localizadores()->where('localizadores_tipo_id','=',2)->first()) )
              <div class="item">
                <div class="content">
                  <strong>Teléfono móvil</strong>
                  <div class="description">{{ $movil->localizador }}</div>
                </div>
              </div>
              @endif

              @if(!is_null($fax = $colaborador->localizadores()->where('localizadores_tipo_id','=',3)->first()) )
              <div class="item">
                <div class="content">
                  <strong>Fax</strong>
                  <div class="description">{{ $fax->localizador }}</div>
                </div>
              </div>
              @endif

              @if(!is_null($email = $colaborador->localizadores()->where('localizadores_tipo_id','=',4)->first()) )
              <div class="item">
                <div class="content">
                  <strong>Email</strong>
                  <div class="description">{{ $email->localizador }}</div>
                </div>
              </div>
              @endif

            </div>
          </div>
        </div>

      </div>
    </div>
    @endif


    @if($colaborador->direcciones->first())
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
                    <div class="description">{{ $colaborador->direcciones->first()->direccion }}</div>
                    <div class="description">{{ $colaborador->direcciones->first()->cp }}</div>
                    <div class="description">{{ $colaborador->direcciones->first()->localidad }}</div>
                    <div class="description">{{ $municipio->municipio }}</div>
                    <div class="description">{{ $provincia->provincia }}</div>
                  </div>
                </div>

                @if($colaborador->direcciones->first()->detalles)
                <div class="item">
                  <div class="content">
                    <strong>Detalles</strong>
                    <div class="description">{{ $colaborador->direcciones->first()->detalles }}</div>
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

  <div class="three fields">
    @if($colaborador->delegacion->first())
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
                  <a href="{{ URL::to('delegaciones/' . $colaborador->delegacion->cod ) }}">{{ $colaborador->delegacion->delegacion }}</a>
                  @else
                  {{ $colaborador->delegacion->delegacion  }}
                  @endif
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    @endif

    @if($colaborador->estaciones->first())
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

              @foreach($colaborador->estaciones as $estacion)

              <div class="item">
                <div class="content">
                  <a href="{{ URL::to('estaciones/' . $estacion->indicativo) }}"> {{ $estacion->indicativo }} - {{ $estacion->estacion }}</a>
                  <div class="description">
                    {{ $estacion->pivot->observaciones }}
                  </div>
                </div>
              </div>
              @endforeach
            </div>
          </div>
        </div>
      </div>
    </div>
    @endif

    @if($colaborador->fiabilidad OR $colaborador->continuidad)
    <div class="field">

      <div class="event">
        <div class="label">
          <i class="circular trophy icon"></i>
        </div>
        <div class="content">
          <div class="summary">
            <div class="ui list">

              @if($colaborador->fiabilidad)
              <div class="item">
                <div class="content">
                  <input type="hidden" id="fiabilidad" value="{{ $colaborador->fiabilidad }}"/>
                  <strong>Fiabilidad</strong>
                  <div class="description">
                    <div class="ui star rating fiabilidad ">
                      <i class="icon"></i>
                      <i class="icon"></i>
                      <i class="icon"></i>
                      <i class="icon"></i>
                      <i class="icon"></i>
                    </div>
                  </div>
                </div>
              </div>
              @endif

              @if($colaborador->continuidad)
              <div class="item">
                <div class="content">
                  <input type="hidden" id="continuidad" value="{{ $colaborador->continuidad }}"/>
                  <strong>Continuidad</strong>
                  <div class="description">
                    <div class="ui star rating continuidad">
                      <i class="icon"></i>
                      <i class="icon"></i>
                      <i class="icon"></i>
                      <i class="icon"></i>
                      <i class="icon"></i>
                    </div>
                  </div>
                </div>
              </div>
              @endif

              @if($colaborador->galardones()->diploma()->first())
              <div class="item">
                <div class="content">
                  <div class="description">
                    <i class="file icon"></i> Diploma recibido en {{ $colaborador->galardones()->diploma()->first()->pivot->year }}
                  </div>
                </div>
              </div>
              @endif

              @if($colaborador->galardones()->placa()->first())
              <div class="item">
                <div class="content">
                  <div class="description">
                    <i class="ticket icon"></i> Placa recibida en {{ $colaborador->galardones()->placa()->first()->pivot->year }}
                  </div>
                </div>
              </div>
              @endif

              @if($colaborador->galardones()->premio()->first())
              <div class="item">
                <div class="content">
                  <div class="description">
                    <i class="trophy icon"></i> Premio recibido en {{ $colaborador->galardones()->premio()->first()->pivot->year }}
                  </div>
                </div>
              </div>
              @endif

              @if($colaborador->galardones()->condecoracion()->first())
              <div class="item">
                <div class="content">
                  <div class="description">
                    <i class="bookmark icon"></i> Condecoración recibida en {{ $colaborador->galardones()->condecoracion()->first()->pivot->year }}
                  </div>
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

  {{-- ANOTACIONES ------------------------------------------------------------------------------------------}}
  @if(!is_null($anotacion = $colaborador->anotaciones()->where('anotaciones_tipo_id','=',4)->first()) )
  <div class="ui icon message">
    <i class="comment icon"></i>
    <div class="content">
      <div class="header">
        Anotaciones:
      </div>
      <p>{{ $anotacion->anotacion }}</p>
    </div>
  </div>
  @endif
</div>



@endif

<script>



  /**
   * Rating (estrellas)
   */
  function setRating()
  {
    $('.fiabilidad').rating('set rating', $('#fiabilidad').val());
    $('.continuidad').rating('set rating', $('#continuidad').val());
  }

  setRating();
  $('.ui.rating').rating('disable');

</script>

@stop

