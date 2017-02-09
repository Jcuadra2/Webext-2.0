@if($errors->has('continuidad'))
<div class="error field">
@else
<div class="field">
@endif
  {{ Form::label('continuidad', 'Continuidad') }}
  {{ Form::hidden('continuidad', Input::old('continuidad')) }}
  <div class="ui star rating continuidad">
    <i class="icon"></i>
    <i class="icon"></i>
    <i class="icon"></i>
    <i class="icon"></i>
    <i class="icon"></i>
  </div>
  @if($errors->has('continuidad'))
  <div class="ui red pointing above ui label">{{ $errors->first('continuidad') }}</div>
  @endif
</div>