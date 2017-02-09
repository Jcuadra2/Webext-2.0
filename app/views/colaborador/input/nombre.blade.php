@if($errors->has('nombre'))
<div class="error field">
@else
<div class="field">
@endif
  {{ Form::label('nombre', 'Nombre') }}
  <div class="ui labeled input">
    {{ Form::text('nombre', Input::old('nombre'), array('placeholder'=>'Nombre')) }}
    <div class="ui corner label">
      <i class="icon asterisk"></i>
    </div>
  </div>
  @if($errors->has('nombre'))
  <div class="ui red pointing above ui label">{{ $errors->first('nombre') }}</div>
  @endif
</div>