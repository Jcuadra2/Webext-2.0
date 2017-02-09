@if($errors->has('password'))
<div class="error field">
@else
<div class="field">
@endif
  {{ Form::label('password', 'Contraseña') }}
  <div class="ui left labeled icon input">
    {{ Form::password('password') }}
    <div class="ui corner label">
      <i class="icon asterisk"></i>
    </div>
  </div>
  @if($errors->has('password'))
  <div class="ui red pointing above ui label">{{ $errors->first('password') }}</div>
  @endif
</div>