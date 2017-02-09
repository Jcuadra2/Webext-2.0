@if($errors->has('movil'))
<div class="error field">
@else
<div class="field">
@endif
  {{ Form::label('movil', 'Teléfono móvil') }}
    @if(isset($movil))
    {{ Form::text('movil', $movil) }}
    @else
    {{ Form::text('movil', Input::old('movil'), array('placeholder'=>'Teléfono móvil')) }}
    @endif
  @if($errors->has('movil'))
  <div class="ui red pointing above ui label">{{ $errors->first('movil') }}</div>
  @endif
</div>