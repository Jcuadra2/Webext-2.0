@if(Auth::user()->tipo->tipo == 'Administrador')
  <div class="field">
    @if($errors->has('delegacion_cod'))
    <div class="error field">
      @else
      <div class="field">
        @endif
        {{ Form::label('delegacion_cod', 'Delegación') }}
        <div class="ui selection dropdown fluid">
          <div class="text">Seleccionar</div>
          <i class="dropdown icon"></i>
          @if(isset($delegacion))
          {{ Form::hidden('delegacion_cod', $delegacion) }}
          @else
          {{ Form::hidden('delegacion_cod', Input::old('delegacion_cod')) }}
          @endif
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
    </div>
@else
  {{ Form::hidden('delegacion_cod', Auth::user()->delegacion_cod) }}
@endif