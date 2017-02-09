<div class="ui piled blue segment">

  <h2 class="ui header">
    <i class="icon inverted circular blue home"></i> Dirección
  </h2>

  <div class="field">
    <div class="two fields">

      <div class="field">

        {{--vvv Input Dirección --------------------------}}
        @if($errors->has('direccion'))
        <div class="error field">
          @else
          <div class="field">
            @endif
            {{ Form::label('direccion', 'Dirección') }}
            @if(isset($direccion))
            {{ Form::text('direccion', $direccion->direccion) }}
            @else
            {{ Form::text('direccion', Input::old('direccion'), array('placeholder'=>'Escriba aquí una dirección...')) }}
            @endif

            @if($errors->has('direccion'))
            <div class="ui red pointing above ui label">{{ $errors->first('direccion') }}</div>
            @endif
          </div>
          {{--^^^ Input Dirección --------------------------}}

          <div class="two fields">

            {{--vvv Input Codigo Postal --------------------------}}
            @if($errors->has('cp'))
            <div class="error field">
              @else
              <div class="field">
                @endif
                {{ Form::label('cp', 'Código Postal') }}
                @if(isset($direccion))
                {{ Form::text('cp', $direccion->cp) }}
                @else
                {{ Form::text('cp', Input::old('cp'), array('placeholder'=>'Código Postal')) }}
                @endif

                @if($errors->has('cp'))
                <div class="ui red pointing above ui label">{{ $errors->first('cp') }}</div>
                @endif
              </div>
              {{--^^^ Input Codigo Postal --------------------------}}

              {{--vvv Input Localidad ------------------------------}}
              @if($errors->has('localidad'))
              <div class="error field">
                @else
                <div class="field">
                  @endif
                  {{ Form::label('localidad', 'Localidad') }}
                  @if(isset($direccion))
                  {{ Form::text('localidad', $direccion->localidad) }}
                  @else
                  {{ Form::text('localidad', Input::old('localidad'), array('placeholder'=>'Localidad')) }}
                  @endif

                  @if($errors->has('localidad'))
                  <div class="ui red pointing above ui label">{{ $errors->first('localidad') }}</div>
                  @endif
                </div>
                {{--^^^ Input Localidad ------------------------------}}

              </div>

              {{--vvv Dropdown Provincia ------------------------------}}
              @if($errors->has('provincia_cod'))
              <div class="error field">
                @else
                <div class="field">
                  @endif
                  {{ Form::label('provincia_cod', 'Provincia') }}
                  <div id='provincias' class="ui selection dropdown fluid">
                    <div class="text">Seleccionar</div>
                    <i class="dropdown icon"></i>
                    @if(isset($direccion))
                    {{ Form::hidden('provincia_cod', $provincia->cod) }}
                    @else
                    {{ Form::hidden('provincia_cod', Input::old('provincia_cod')) }}
                    @endif
                    <div class="menu">
                      @if(isset($provincias))
                        @foreach($provincias as $provincia)
                        <div class="item" data-value="{{ $provincia->cod }}">{{ $provincia->provincia }}</div>
                        @endforeach
                      @endif
                    </div>
                  </div>

                  @if($errors->has('provincia_cod'))
                  <div class="ui red pointing above ui label">{{ $errors->first('provincia_cod') }}</div>
                  @endif
                </div>
                {{--^^^ Dropdown Provincia ------------------------------}}

                {{--vvv Dropdown Municipio AJAX -------------------------}}
                @if($errors->has('municipio_cod'))
                <div class="error field">
                  @else
                  <div class="field">
                    @endif
                    {{ Form::label('municipio_cod', 'Municipio') }}
                    <div class="ui left labeled icon selection dropdown fluid">
                      <div class="text" id="selectMunicipio"><i class="loading icon"></i> Esperando selección de Provincia...</div>
                      <i class="dropdown icon"></i>
                      @if(isset($direccion))
                      {{ Form::hidden('municipio_cod', $direccion->municipio_cod) }}
                      @else
                      {{ Form::hidden('municipio_cod', Input::old('municipio_cod')) }}
                      @endif
                      <div class="menu" id="municipios">
                      </div>
                    </div>

                    @if($errors->has('municipio_cod'))
                    <div class="ui red pointing above ui label">{{ $errors->first('municipio_cod') }}</div>
                    @endif
                  </div>
                  {{--^^^ Dropdown Municipio AJAX -------------------------}}

                </div>

                <div class="field">

                {{--vvv TextArea Detalles -------------------------}}
                  @if($errors->has('detalles'))
                  <div class="error field">
                  @else
                  <div class="field">
                  @endif
                    {{ Form::label('detalles', 'Detalles') }}
                    @if(isset($direccion))
                    {{ Form::textarea('detalles', $direccion->detalles) }}
                    @else
                    {{ Form::textarea('detalles', Input::old('detalles'), array('placeholder'=>'Escriba aquí detalles...')) }}
                    @endif

                    @if($errors->has('detalles'))
                    <div class="ui red pointing above ui label">{{ $errors->first('detalles') }}</div>
                    @endif
                  </div>
                  {{--^^^ TextArea Detalles -------------------------}}

                </div>

              </div>
  </div>
</div>






