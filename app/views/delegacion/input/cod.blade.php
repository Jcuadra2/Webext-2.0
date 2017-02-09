@if($errors->has('cod'))
<div class="error field">
@else
<div class="field">
@endif
  {{ Form::label('cod', 'Código de la delegación') }}
  <div class="ui left labeled icon input">
    {{ Form::text('cod', Input::old('cod'), array('placeholder'=>'Código de la delegación')) }}
    <div class="ui corner label">
      <i class="icon asterisk"></i>
    </div>
  </div>
  @if($errors->has('cod'))
  <div class="ui red pointing above ui label">{{ $errors->first('cod') }}</div>
  @endif
</div>