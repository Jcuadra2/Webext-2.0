@if($errors->has('colaborador_id'))
<div class="error field">
@else
<div class="field">
@endif
  {{ Form::label('colaborador_id', 'CIF&#47;NIF Asociado') }}
  <div class="ui input">
    {{ Form::text('colaborador_id', Input::old('colaborador_id'), array('placeholder'=>'CIF NIF Asociado')) }}
  </div>
  @if($errors->has('colaborador_id'))
  <div class="ui red pointing above ui label">{{ $errors->first('colaborador_id') }}</div>
  @endif
</div>