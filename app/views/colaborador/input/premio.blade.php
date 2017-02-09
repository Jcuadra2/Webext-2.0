@if($errors->has('premio'))
<div class="error field">
@else
<div class="field">
@endif
  {{ Form::label('premio', 'Premio Nacional') }}
  <div class="ui left labeled icon input">
    @if(isset($premio))
    {{ Form::text('premio', $premio) }}
    @else
    {{ Form::text('premio', Input::old('premio'), array('placeholder'=>'Año de entrega')) }}
    @endif
    <i class="trophy icon"></i>
  </div>
  @if($errors->has('premio'))
  <div class="ui red pointing above ui label">{{ $errors->first('premio') }}</div>
  @endif
</div>