@if($errors->has('delegado_territorial'))
<div class="error field">
@else
<div class="field">
@endif
  {{ Form::label('delegado_territorial', 'Delegado Territorial') }}
  <div class="ui left labeled icon input">
    {{ Form::text('delegado_territorial', Input::old('delegado_territorial'), array('placeholder'=>'Nombre del Delegado Territorial')) }}
    <div class="ui corner label">
      <i class="icon asterisk"></i>
    </div>
  </div>
  @if($errors->has('delegado_territorial'))
  <div class="ui red pointing above ui label">{{ $errors->first('delegado_territorial') }}</div>
  @endif
</div>