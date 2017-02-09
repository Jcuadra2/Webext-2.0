@if($errors->has('observaciones'))
<div class="error field">
@else
<div class="field">
@endif
  {{ Form::label('observaciones', 'Observaciones') }}
  @if(isset($observaciones))
    {{ Form::textarea('observaciones', $observaciones) }}
  @else
    {{ Form::textarea('observaciones', Input::old('observaciones'), array('placeholder'=>'Escriba aquí una observación...')) }}
  @endif
  @if($errors->has('observaciones'))
  <div class="ui red pointing above ui label">{{ $errors->first('observaciones') }}</div>
  @endif
</div>