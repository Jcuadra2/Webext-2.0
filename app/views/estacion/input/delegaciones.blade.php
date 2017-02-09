@if($errors->has('delegacion_cod'))
<div class="error field">
@else
<div class="field">
@endif
  {{ Form::label('delegacion_cod', 'Delegación') }}
  <div class="ui selection dropdown fluid">
    <div class="text">Seleccionar</div>
    <i class="dropdown icon"></i>
    {{ Form::hidden('delegacion_cod', Input::old('delegacion_cod')) }}
    <div class="menu">
      @foreach($delegaciones as $delegacion)
      <div class="item" data-value="{{ $delegacion->cod }}">{{ $delegacion->delegacion }}</div>
      @endforeach
    </div>
  </div>
  @if($errors->has('delegacion_cod'))
  <div class="ui red pointing above ui label">{{ $errors->first('delegacion_cod') }}</div>
  @endif
</div>

