@if($errors->has('apellidos'))
<div class="error field">
@else
<div class="field">
@endif
  {{ Form::label('apellidos', 'Apellidos') }}
  <div class="ui labeled input">
    {{ Form::text('apellidos', Input::old('apellidos'), array('placeholder'=>'Apellidos')) }}
    <div class="ui corner label">
      <i class="icon asterisk"></i>
    </div>
  </div>
  @if($errors->has('apellidos'))
  <div class="ui red pointing above ui label">{{ $errors->first('apellidos') }}</div>
  @endif
</div>