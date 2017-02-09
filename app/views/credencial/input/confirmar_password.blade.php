@if($errors->has('password_confirmation'))
<div class="error field">
@else
<div class="field">
@endif
  {{ Form::label('password_confirmation', 'Confirmar Contraseña') }}
  <div class="ui left labeled icon input">
    {{ Form::password('password_confirmation') }}
    <div class="ui corner label">
      <i class="icon asterisk"></i>
    </div>
  </div>
  @if($errors->has('password_confirmation'))
  <div class="ui red pointing above ui label">{{ $errors->first('password_confirmation') }}</div>
  @endif
</div>