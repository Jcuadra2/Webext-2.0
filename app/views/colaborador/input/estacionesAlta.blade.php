<div class="field" id="manyInputs">

  <label for="estacion_indicativo[]">Estación<span id="addInput"><i class="add green icon"></i>añadir otra</span></label>

  <div class="ui selection dropdown fluid estaciones">
    <div class="text">Seleccionar</div>
    <i class="dropdown icon"></i>

    <input name="estacion_indicativo[]" type="hidden" id="estacion_indicativo">

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

</div>