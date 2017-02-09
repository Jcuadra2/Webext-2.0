@if($errors->has('fiabilidad'))
<div class="error field">
@else
<div class="field">
@endif
  {{ Form::label('fiabilidad', 'Fiabilidad') }}
  {{ Form::hidden('fiabilidad', Input::old('fiabilidad')) }}
  <div class="ui star rating fiabilidad">
    <i class="icon"></i>
    <i class="icon"></i>
    <i class="icon"></i>
    <i class="icon"></i>
    <i class="icon"></i>
  </div>
  @if($errors->has('fiabilidad'))
  <div class="ui red pointing above ui label">{{ $errors->first('fiabilidad') }}</div>
  @endif
</div>