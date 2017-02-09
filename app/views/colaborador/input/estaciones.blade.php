@if($errors->has('estacion_indicativo[]'))
<div class="error field" id="manyInputs">
@else
<div class="field" id="manyInputs">
@endif
<label for="estacion_indicativo[]" id="addInput"><i class="add green icon"></i>Estación</label>

    <div class="ui selection dropdown fluid" id="estaciones">
      <i class="remove red icon removeclass"></i>
      <div class="text">Seleccionar</div>
      <i class="dropdown icon"></i>

      {{ Form::hidden('estacion_indicativo[]') }}
      <div class="menu">
        @foreach($estaciones as $estacion)
        <div class="item" data-value="{{ $estacion->indicativo }}">
          <span class="s1">{{ $estacion->indicativo }}</span> {{ $estacion->estacion }}
        </div>
        @endforeach
      </div>
  </div>

</div>