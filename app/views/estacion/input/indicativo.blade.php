@if($errors->has('indicativo'))
<div class="error field">
@else
<div class="field">
@endif
  {{ Form::label('indicativo', 'Indicativo') }}
  <div class="ui left labeled icon input">
    {{ Form::text('indicativo', Input::old('indicativo'), array('placeholder'=>'Indicativo')) }}
    <div class="ui corner label">
      <i class="icon asterisk"></i>
    </div>
  </div>
  @if($errors->has('indicativo'))
  <div class="ui red pointing above ui label">{{ $errors->first('indicativo') }}</div>
  @endif
</div>