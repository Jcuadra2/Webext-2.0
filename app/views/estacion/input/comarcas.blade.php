@if(isset($comarcas[0]))
  @if($errors->has('comarca_id'))
  <div class="error field">
  @else
  <div class="field">
  @endif
    {{ Form::label('comarca_id', 'Comarca') }}
    <div class="ui selection dropdown fluid">
      <div class="text">Seleccionar</div>
      <i class="dropdown icon"></i>
      {{ Form::hidden('comarca_id', Input::old('comarca_id')) }}
      <div class="menu">
        @foreach($comarcas as $comarca)
        <div class="item" data-value="{{ $comarca->id }}">{{ $comarca->comarca }}</div>
        @endforeach
      </div>
    </div>
    @if($errors->has('comarca_id'))
    <div class="ui red pointing above ui label">{{ $errors->first('comarca_id') }}</div>
    @endif
  </div>
@endif