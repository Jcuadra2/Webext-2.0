@if($errors->has('cuenta'))
<div class="error field">
@else
<div class="field">
@endif
  {{ Form::label('cuenta', 'Cuenta') }}
  @if(isset($cuenta))
    {{ Form::text('cuenta', $cuenta) }}
  @else
    {{ Form::text('cuenta', Input::old('cuenta'), array('placeholder'=>'Número de cuenta corriente')) }}
  @endif
  @if($errors->has('cuenta'))
  <div class="ui red pointing above ui label">{{ $errors->first('cuenta') }}</div>
  @endif
</div>