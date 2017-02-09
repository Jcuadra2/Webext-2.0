  @if($errors->has('isla_id'))
  <div class="error field">
  @else
  <div class="field">
  @endif
    {{ Form::label('isla_id', 'Isla') }}
    <div class="ui selection dropdown fluid">
      <div class="text">Seleccionar</div>
      <i class="dropdown icon"></i>
      {{ Form::hidden('isla_id', Input::old('isla_id')) }}
      <div class="menu">
        @foreach($islas as $isla)
        <div class="item" data-value="{{ $isla->id }}">{{ $isla->isla }}</div>
        @endforeach
      </div>
    </div>
    @if($errors->has('isla_id'))
    <div class="ui red pointing above ui label">{{ $errors->first('isla_id') }}</div>
    @endif
  </div>
