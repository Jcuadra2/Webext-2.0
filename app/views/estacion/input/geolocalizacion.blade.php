@if($errors->has('geolocalizacion'))
<div class="error field">
@else
<div class="field">
@endif

  {{----------------------------------------------------------------------------------------
  HOJA_MAPA, UBICACION
  -----------------------------------------------------------------------------------------}}
  <div class="four fields">
    <div class="field">
      {{-- HOJA MAPA --}}
      {{ Form::label('hoja_mapa', 'Hoja Mapa') }}
      <div class="ui input">
        @if(isset($hoja_mapa))
        {{ Form::text('hoja_mapa', $hoja_mapa) }}
        @else
        {{ Form::text('hoja_mapa', Input::old('hoja_mapa'), array('placeholder'=>'Hoja Mapa')) }}
        @endif
      </div>
      @if($errors->has('hoja_mapa'))
      <div class="ui red pointing above ui label">{{ $errors->first('hoja_mapa') }}</div>
      @endif
    </div>
    <div class="field">
      {{-- UBICACION --}}
      {{ Form::label('ubicacion', 'Ubicación') }}
      <div class="ui input">
        @if(isset($ubicacion))
        {{ Form::text('ubicacion', $ubicacion) }}
        @else
        {{ Form::text('ubicacion', Input::old('huso'), array('placeholder'=>'Ubicación')) }}
        @endif
      </div>
      @if($errors->has('ubicacion'))
      <div class="ui red pointing above ui label">{{ $errors->first('ubicacion') }}</div>
      @endif
    </div>
    @include('estacion/input/comarcas')
    @include('estacion/input/islas')

  </div>

  {{----------------------------------------------------------------------------------------
  LONGITUD
  ----------------------------------------------------------------------------------------}}
  {{ Form::label('geolocalizacion', 'Longitud') }}
  <div class="four fields">
    <div class="field">
      {{-- LONGITUD GRADOS --}}
      <div class="ui input">
        @if(isset($longitud_g))
        {{ Form::text('longitud_g', $longitud_g) }}
        @else
        {{ Form::text('longitud_g', Input::old('longitud_g'), array('placeholder'=>'Grados')) }}
        @endif
      </div>
      @if($errors->has('longitud_g'))
      <div class="ui red pointing above ui label">{{ $errors->first('longitud_g') }}</div>
      @endif
    </div>
    <div class="field">
      {{-- LONGITUD MINUTOS --}}
      <div class="ui input">
        @if(isset($longitud_m))
        {{ Form::text('longitud_m', $longitud_m) }}
        @else
        {{ Form::text('longitud_m', Input::old('longitud_m'), array('placeholder'=>'Minutos')) }}
        @endif
      </div>
      @if($errors->has('longitud_m'))
      <div class="ui red pointing above ui label">{{ $errors->first('longitud_m') }}</div>
      @endif
    </div>
    <div class="field">
      {{-- LONGITUD SEGUNDOS --}}
      <div class="ui input">
        @if(isset($longitud_s))
        {{ Form::text('longitud_s', $longitud_s) }}
        @else
        {{ Form::text('longitud_s', Input::old('longitud_s'), array('placeholder'=>'Segundos')) }}
        @endif
      </div>
      @if($errors->has('longitud_s'))
      <div class="ui red pointing above ui label">{{ $errors->first('longitud_s') }}</div>
      @endif
    </div>

    <div class="field">
      <div class="ui selection dropdown fluid">
        <div class="default text">Selecciona</div>
        <i class="dropdown icon"></i>
        @if(isset($longitud_w_e))
        {{ Form::hidden('longitud_w_e', $longitud_w_e) }}
        @else
        {{ Form::hidden('longitud_w_e', Input::old('longitud_w_e')) }}
        @endif
        <div class="menu ui transition">
          <div class="item" data-value="e">Este</div>
          <div class="item" data-value="o">Oeste</div>
        </div>
      </div>
    </div>

  </div>


  {{----------------------------------------------------------------------------------------
  LATITUD
  -----------------------------------------------------------------------------------------}}
  {{ Form::label('geolocalizacion', 'Latitud') }}
  <div class="four fields">
    <div class="field">
      {{-- LATITUD GRADOS --}}
      <div class="ui input">
        @if(isset($latitud_g))
        {{ Form::text('latitud_g', $latitud_g) }}
        @else
        {{ Form::text('latitud_g', Input::old('latitud_g'), array('placeholder'=>'Grados')) }}
        @endif
      </div>
      @if($errors->has('latitud_g'))
      <div class="ui red pointing above ui label">{{ $errors->first('latitud_g') }}</div>
      @endif
    </div>
    <div class="field">
      {{-- LATITUD MINUTOS --}}
      <div class="ui input">
        @if(isset($latitud_m))
        {{ Form::text('latitud_m', $latitud_m) }}
        @else
        {{ Form::text('latitud_m', Input::old('latitud_m'), array('placeholder'=>'Minutos')) }}
        @endif
      </div>
      @if($errors->has('latitud_m'))
      <div class="ui red pointing above ui label">{{ $errors->first('latitud_m') }}</div>
      @endif
    </div>
    <div class="field">
      {{-- LATITUD SEGUNDOS --}}
      <div class="ui input">
        @if(isset($latitud_s))
        {{ Form::text('latitud_s', $latitud_s) }}
        @else
        {{ Form::text('latitud_s', Input::old('latitud_s'), array('placeholder'=>'Segundos')) }}
        @endif
      </div>
      @if($errors->has('latitud_s'))
      <div class="ui red pointing above ui label">{{ $errors->first('latitud_s') }}</div>
      @endif
    </div>
    <div class="field">
      <div class="ui selection dropdown fluid">
        <div class="default text">Selecciona</div>
        <i class="dropdown icon"></i>
        @if(isset($latitud_n_s))
        {{ Form::hidden('latitud_n_s', $latitud_n_s) }}
        @else
        {{ Form::hidden('latitud_n_s', Input::old('latitud_n_s')) }}
        @endif
        <div class="menu">
          <div class="item" data-value="n">Norte</div>
          <div class="item" data-value="s">Sur</div>
        </div>
      </div>
    </div>

  </div>

  {{----------------------------------------------------------------------------------------
  ALTITUD, HUSO, UMT_X UMT_Y
  -----------------------------------------------------------------------------------------}}
  <div class="four fields">
    <div class="field">
      {{-- ALTITUD --}}
      {{ Form::label('altitud', 'Altitud') }}
      <div class="ui input">
        @if(isset($altitud))
        {{ Form::text('altitud', $altitud) }}
        @else
        {{ Form::text('altitud', Input::old('altitud'), array('placeholder'=>'Altitud')) }}
        @endif
      </div>
      @if($errors->has('altitud'))
      <div class="ui red pointing above ui label">{{ $errors->first('altitud') }}</div>
      @endif
    </div>
    <div class="field">
      {{-- HUSO --}}
      {{ Form::label('huso', 'Huso') }}
      <div class="ui input">
        @if(isset($huso))
        {{ Form::text('huso', $huso) }}
        @else
        {{ Form::text('huso', Input::old('huso'), array('placeholder'=>'Huso')) }}
        @endif
      </div>
      @if($errors->has('huso'))
      <div class="ui red pointing above ui label">{{ $errors->first('huso') }}</div>
      @endif
    </div>
    <div class="field">
      {{-- UMT_X --}}
      {{ Form::label('umt_x', 'UMT X') }}
      <div class="ui input">
        @if(isset($umt_x))
        {{ Form::text('umt_x', $umt_x) }}
        @else
        {{ Form::text('umt_x', Input::old('umt_x'), array('placeholder'=>'UMT X')) }}
        @endif
      </div>
      @if($errors->has('umt_x'))
      <div class="ui red pointing above ui label">{{ $errors->first('umt_x') }}</div>
      @endif
    </div>
    <div class="field">
      {{-- UMT_Y --}}
      {{ Form::label('umt_y', 'UMT Y') }}
      <div class="ui input">
        @if(isset($umt_y))
        {{ Form::text('umt_y', $umt_y) }}
        @else
        {{ Form::text('umt_y', Input::old('umt_y'), array('placeholder'=>'UMT Y')) }}
        @endif
      </div>
      @if($errors->has('umt_y'))
      <div class="ui red pointing above ui label">{{ $errors->first('umt_y') }}</div>
      @endif
    </div>


  </div>




</div>