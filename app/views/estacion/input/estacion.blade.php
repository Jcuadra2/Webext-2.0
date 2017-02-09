@if($errors->has('estacion'))
<div class="error field">
@else
<div class="field">
@endif
  {{ Form::label('estacion', 'Estación') }}
  <div class="ui left labeled icon input">
    {{ Form::text('estacion', Input::old('estacion'), array('placeholder'=>'Estación')) }}
    <div class="ui corner label">
      <i class="icon asterisk"></i>
    </div>
  </div>
  @if($errors->has('estacion'))
  <div class="ui red pointing above ui label">{{ $errors->first('estacion') }}</div>
  @endif
</div>