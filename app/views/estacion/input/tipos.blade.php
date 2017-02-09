@if($errors->has('estaciones_tipo_id'))
<div class="error field">
@else
<div class="field">
@endif
  {{ Form::label('estaciones_tipo_id', 'Tipo') }}
  <div class="ui selection dropdown fluid">
    <div class="text">Seleccionar</div>
    <i class="dropdown icon"></i>
    {{ Form::hidden('estaciones_tipo_id', Input::old('estaciones_tipo_id')) }}
    <div class="menu">
      @foreach($tipos as $tipo)
      <div class="item" data-value="{{ $tipo->id }}">{{ $tipo->tipo }}</div>
      @endforeach
    </div>
  </div>
  @if($errors->has('estaciones_tipo_id'))
  <div class="ui red pointing above ui label">{{ $errors->first('estaciones_tipo_id') }}</div>
  @endif
</div>
