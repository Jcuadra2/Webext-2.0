@if($errors->has('fijo'))
<div class="error field">
@else
<div class="field">
@endif
  {{ Form::label('fijo', 'Teléfono fijo') }}
    @if(isset($fijo))
    {{ Form::text('fijo', $fijo) }}
    @else
    {{ Form::text('fijo', Input::old('fijo'), array('placeholder'=>'Teléfono fijo')) }}
    @endif
  @if($errors->has('fijo'))
  <div class="ui red pointing above ui label">{{ $errors->first('fijo') }}</div>
  @endif
</div>