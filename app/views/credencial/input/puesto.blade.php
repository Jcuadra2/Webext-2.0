@if($errors->has('puesto'))
<div class="error field">
@else
<div class="field">
@endif
  {{ Form::label('puesto', 'Puesto') }}
  <div class="ui input">
    {{ Form::text('puesto', Input::old('puesto'), array('placeholder'=>'Puesto')) }}
  </div>
  @if($errors->has('puesto'))
  <div class="ui red pointing above ui label">{{ $errors->first('puesto') }}</div>
  @endif
</div>