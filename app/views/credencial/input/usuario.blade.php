@if($errors->has('usuario'))
<div class="error field">
@else
<div class="field">
@endif
  {{ Form::label('usuario', 'Usuario') }}
  <div class="ui left labeled icon input">
    {{ Form::text('usuario', Input::old('usuario'), array('placeholder'=>'Usuario')) }}
    <div class="ui corner label">
      <i class="icon asterisk"></i>
    </div>
  </div>
  @if($errors->has('usuario'))
  <div class="ui red pointing above ui label">{{ $errors->first('usuario') }}</div>
  @endif
</div>