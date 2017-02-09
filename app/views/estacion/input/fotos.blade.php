@if($errors->has('foto'))
<div class="error field">
@else
<div class="field">
@endif
  {{ Form::label('foto', 'Foto') }}
  <div class="ui left labeled icon input">
    @if(isset($foto))
    {{ Form::text('foto', $foto) }}
    @else
    {{ Form::text('foto', Input::old('foto'), array('placeholder'=>'Foto ')) }}
    @endif
  </div>
  @if($errors->has('foto'))
  <div class="ui red pointing above ui label">{{ $errors->first('foto') }}</div>
  @endif
</div>