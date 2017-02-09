@if($errors->has('estacion_indicativo'))
<div class="error field" id="manyInputs">
@else
<div class="field" id="manyInputs">
@endif
  <label for="estacion_indicativo" id="addInput"><i class="add green icon"></i>Estación</label>

  @if(isset($estaciones_colaborador))
    @foreach($estaciones_colaborador as $e)
    <div class="ui left icon labeled input" id="estaciones">
      @if(isset($estaciones))
      {{ Form::text('estacion_indicativo', $e->indicativo) }}
      @else
      {{ Form::text('estacion_indicativo', Input::old('estacion_indicativo'), array('placeholder'=>'Indicativo')) }}
      @endif
      <div class="ui icon button removeclass">
        <i class="remove red icon"></i>
      </div>
      <div class="ui corner label">
        <i class="icon asterisk"></i>
      </div>
    </div>
    @endforeach
  @else
    <div class="ui left icon labeled input" id="estaciones">
       {{ Form::text('estacion_indicativo', Input::old('estacion_indicativo'), array('placeholder'=>'Indicativo')) }}

      <div class="ui icon button removeclass" >
        <i class="remove red icon"></i>
      </div>
      <div class="ui corner label">
        <i class="icon asterisk"></i>
      </div>
    </div>
  @endif

  @if($errors->has('estacion_indicativo'))
  <div class="ui red pointing above ui label">{{ $errors->first('estacion_indicativo') }}</div>
  @endif
</div>