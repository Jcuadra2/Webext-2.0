@if($errors->has('puesto'))
<div class="error field">
@else
<div class="field">
@endif
  {{ Form::label('puesto', 'Puesto de trabajo') }}
  <div class="ui left labeled icon input">
    {{ Form::text('puesto', Input::old('puesto'), array('placeholder'=>'Puesto de trabajo')) }}
    <div class="ui corner label">
      <i class="icon asterisk"></i>
    </div>
  </div>
  @if($errors->has('puesto'))
  <div class="ui red pointing above ui label">{{ $errors->first('puesto') }}</div>
  @endif
</div>