@if($errors->has('condecoracion'))
<div class="error field">
@else
<div class="field">
@endif
  {{ Form::label('condecoracion', 'Condecoración') }}
  <div class="ui left labeled icon input">
    @if(isset($condecoracion))
    {{ Form::text('condecoracion', $condecoracion) }}
    @else
    {{ Form::text('condecoracion', Input::old('condecoracion'), array('placeholder'=>'Año de entrega')) }}
    @endif
    <i class="bookmark icon"></i>
  </div>
  @if($errors->has('condecoracion'))
  <div class="ui red pointing above ui label">{{ $errors->first('condecoracion') }}</div>
  @endif
</div>