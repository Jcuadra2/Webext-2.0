@if($errors->has('cuenca_cod'))
<div class="error field">
@else
<div class="field">
@endif
  {{ Form::label('cuenca_cod', 'Cuenca') }}
  <div class="ui selection dropdown fluid">
    <div class="text">Seleccionar</div>
    <i class="dropdown icon"></i>
    {{ Form::hidden('cuenca_cod', Input::old('cuenca_cod')) }}
    <div class="menu">
      @foreach($cuencas as $cuenca)
      <div class="item" data-value="{{ $cuenca->cod == '0' ? '99' : $cuenca->cod }}">{{ $cuenca->cuenca }}</div>
      @endforeach
    </div>
  </div>
  @if($errors->has('cuenca_cod'))
  <div class="ui red pointing above ui label">{{ $errors->first('cuenca_cod') }}</div>
  @endif
</div>