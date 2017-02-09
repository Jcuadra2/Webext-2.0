@if($errors->has('delegacion'))
<div class="error field">
@else
<div class="field">
@endif
  {{ Form::label('delegacion', 'Delegación') }}
  <div class="ui left labeled icon input">
    {{ Form::text('delegacion', Input::old('delegacion'), array('placeholder'=>'Nombre de la delegación')) }}
    <div class="ui corner label">
      <i class="icon asterisk"></i>
    </div>
  </div>
  @if($errors->has('delegacion'))
  <div class="ui red pointing above ui label">{{ $errors->first('delegacion') }}</div>
  @endif
</div>