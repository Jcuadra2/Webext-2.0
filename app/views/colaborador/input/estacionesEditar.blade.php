<div class="field" id="manyInputs">

  <label for="estacion_indicativo[]">Estación<span id="addInput"><i class="add green icon"></i>añadir otra</span></label>

  @if($estaciones_colaborador)

  @foreach($estaciones_colaborador as $est)
  <div class="ui selection dropdown fluid estaciones">
    <i class="remove red icon removeclass"></i>
    <div class="text">Seleccionar</div>
    <i class="dropdown icon"></i>

    <input name="estacion_indicativo[]" type="hidden" value="{{ $est->pivot->estacion_indicativo }}" id="estacion_indicativo">

    <div class="menu">
      {{-- MOSTRAR LAS ESTACIONES RECIBIDAS --}}
      @foreach($estaciones as $estacion)
      <div class="item" data-value="{{ $estacion->indicativo }}">
            <span class="s1">
              @if(Auth::user()->tipo->tipo === 'Administrador')
              {{ $estacion->delegacion_cod }}
              @endif
              {{ $estacion->indicativo }}
            </span>
        {{ $estacion->estacion }}
      </div>
      @endforeach

      {{-- MOSTRAR LAS QUE YA TIENE ASIGNADAS PARA PODER RE-SELECCIONARLAS --}}
      @foreach($estaciones_colaborador as $estacion)
      <div class="item" data-value="{{ $estacion->indicativo }}">
            <span class="s1">
              @if(Auth::user()->tipo->tipo === 'Administrador')
              {{ $estacion->delegacion_cod }}
              @endif
              {{ $estacion->indicativo }}
            </span>
        {{ $estacion->estacion }}
      </div>
      @endforeach
    </div>

  </div>
  @endforeach

  @else

  <div class="ui selection dropdown fluid estaciones">
    <div class="text">Seleccionar</div>
    <i class="dropdown icon"></i>

    <input name="estacion_indicativo[]" type="hidden" id="estacion_indicativo[]">

    <div class="menu">
      @foreach($estaciones as $estacion)
      <div class="item" data-value="{{ $estacion->indicativo }}">
            <span class="s1">
              @if(Auth::user()->tipo->tipo === 'Administrador')
              {{ $estacion->delegacion_cod }}
              @endif
              {{ $estacion->indicativo }}
            </span>
        {{ $estacion->estacion }}
      </div>
      @endforeach
    </div>
  </div>

  @endif
</div>