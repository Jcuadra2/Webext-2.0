@if($errors->has('f_nacimiento'))
<div class="error date field">
@else
<div class="field">
@endif
  {{ Form::label('f_nacimiento', 'Fecha de Nacimiento') }}
  {{ Form::text('f_nacimiento', Input::old('f_nacimiento'), array('placeholder'=>'dd/mm/aaaa')) }}
  @if($errors->has('f_nacimiento'))
  <div class="ui red pointing above ui label">{{ $errors->first('f_nacimiento') }}</div>
  @endif
</div>