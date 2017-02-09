@if($errors->has('placa'))
<div class="error field">
@else
<div class="field">
@endif
  {{ Form::label('placa', 'Placa') }}
  <div class="ui left labeled icon input">
    @if(isset($placa))
    {{ Form::text('placa', $placa) }}
    @else
    {{ Form::text('placa', Input::old('placa'), array('placeholder'=>'Año de entrega')) }}
    @endif
    <i class="ticket icon"></i>
  </div>
  @if($errors->has('placa'))
  <div class="ui red pointing above ui label">{{ $errors->first('placa') }}</div>
  @endif
</div>