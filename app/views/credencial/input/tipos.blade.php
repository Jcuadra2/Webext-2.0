@if($errors->has('credenciales_tipo_id'))
<div class="error field">
@else
<div class="field">
@endif
  {{ Form::label('credenciales_tipo_id', 'Tipo de Usuario') }}
  <div class="ui selection dropdown fluid">
    <div class="text">Seleccionar</div>
    <i class="dropdown icon"></i>
    {{ Form::hidden('credenciales_tipo_id', Input::old('credenciales_tipo_id')) }}
    <div class="menu">
      @foreach($tipos as $tipo)
      <div class="item" data-value="{{ $tipo->id }}">{{ $tipo->tipo }}</div>
      @endforeach
    </div>
  </div>
  @if($errors->has('credenciales_tipo_id'))
  <div class="ui red pointing above ui label">{{ $errors->first('credenciales_tipo_id') }}</div>
  @endif
</div>
