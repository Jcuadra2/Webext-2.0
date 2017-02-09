@if(isset($profesiones[0]))
  @if($errors->has('profesion'))
  <div class="error field">
  @else
  <div class="field">
  @endif
    {{ Form::label('profesion', 'Profesión') }}
    <div class="ui selection dropdown fluid">
      <div class="text">Seleccionar</div>
      <i class="dropdown icon"></i>
      {{ Form::hidden('profesion_id', Input::old('profesion_id')) }}
      <div class="menu">
        @foreach($profesiones as $profesion)
        <div class="item" data-value="{{ $profesion-id }}">{{ $profesion->profesion }}</div>
        @endforeach
      </div>
    </div>
    @if($errors->has('profesion'))
    <div class="ui red pointing above ui label">{{ $errors->first('profesion') }}</div>
    @endif
  </div>
@endif