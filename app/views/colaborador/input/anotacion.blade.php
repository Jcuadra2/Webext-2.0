@if($errors->has('anotacion'))
<div class="error field">
@else
<div class="field">
@endif
  {{ Form::label('anotacion', 'Anotación') }}
  @if(isset($anotacion))
    {{ Form::textarea('anotacion', $anotacion) }}
  @else
    {{ Form::textarea('anotacion', Input::old('anotacion'), array('placeholder'=>'Escriba aquí una anotación...')) }}
  @endif
  @if($errors->has('anotacion'))
  <div class="ui red pointing above ui label">{{ $errors->first('anotacion') }}</div>
  @endif
</div>