  <div class="two fields">

    <div class="field">
      @if($errors->has('direccion'))
      <div class="error field">
      @else
      <div class="field">
      @endif
        {{ Form::label('direccion', 'Dirección') }}
        @if(isset($direccion))
          {{ Form::text('direccion', $direccion) }}
        @else
          {{ Form::text('direccion', Input::old('direccion'), array('placeholder'=>'Escriba aquí una dirección...')) }}
        @endif
        @if($errors->has('direccion'))
        <div class="ui red pointing above ui label">{{ $errors->first('direccion') }}</div>
        @endif
      </div>

      <div class="two fields">
        @if($errors->has('cpostal'))
        <div class="error field">
        @else
        <div class="field">
        @endif
          {{ Form::label('cpostal', 'Código Postal') }}
          @if(isset($fax))
          {{ Form::text('cpostal', $fax) }}
          @else
          {{ Form::text('cpostal', Input::old('cpostal'), array('placeholder'=>'Código Postal')) }}
          @endif
          @if($errors->has('cpostal'))
          <div class="ui red pointing above ui label">{{ $errors->first('cpostal') }}</div>
          @endif
        </div>

        @if($errors->has('localidad'))
        <div class="error field">
        @else
        <div class="field">
        @endif
          {{ Form::label('localidad', 'Localidad') }}
          @if(isset($fax))
          {{ Form::text('localidad', $fax) }}
          @else
          {{ Form::text('localidad', Input::old('localidad'), array('placeholder'=>'Localidad')) }}
          @endif
          @if($errors->has('localidad'))
          <div class="ui red pointing above ui label">{{ $errors->first('localidad') }}</div>
          @endif
        </div>
      </div>

      @if($errors->has('municipio_cod'))
      <div class="error field">
      @else
      <div class="field">
      @endif
      {{ Form::label('municipio_cod', 'Municipio') }}
        <div class="ui selection dropdown fluid">
          <div class="text">Seleccionar</div>
          <i class="dropdown icon"></i>
          @if(isset($provincia))
          {{ Form::hidden('municipio_cod', $provincia) }}
          @else
          {{ Form::hidden('municipio_cod', Input::old('municipio_cod')) }}
          @endif
          <div class="menu">
            @foreach($provincias as $provincia)
            <div class="item" data-value="{{ $provincia->cod }}">{{ $provincia->provincia }}</div>
            @endforeach
          </div>
        </div>
      </div>
    </div>

      <div class="field">
      @if($errors->has('detalles'))
      <div class="error field">
      @else
      <div class="field">
      @endif
        {{ Form::label('detalles', 'Detalles') }}
        @if(isset($detalles))
        {{ Form::textarea('detalles', $detalles) }}
        @else
        {{ Form::textarea('detalles', Input::old('detalles'), array('placeholder'=>'Escriba aquí detalles...')) }}
        @endif
        @if($errors->has('detalles'))
        <div class="ui red pointing above ui label">{{ $errors->first('detalles') }}</div>
        @endif
      </div>


    </div>

  </div>
