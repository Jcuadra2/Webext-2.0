@if($errors->has('propietario_id'))
<div class="error field">
@else
<div class="field">
@endif
  {{ Form::label('propietario_id', 'Propietario') }}
  <div class="ui selection dropdown fluid">
    <div class="text">Seleccionar</div>
    <i class="dropdown icon"></i>
    {{ Form::hidden('propietario_id', Input::old('propietario_id')) }}
    <div class="menu">
      @foreach($propietarios as $propietario)
      <div class="item" data-value="{{ $propietario->id }}">{{ $propietario->propietario }}</div>
      @endforeach
    </div>
  </div>
  @if($errors->has('propietario_id'))
  <div class="ui red pointing above ui label">{{ $errors->first('propietario_id') }}</div>
  @endif
</div>
