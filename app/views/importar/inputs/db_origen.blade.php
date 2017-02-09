<div class="ui pilled segment">

  @if( Config::get('database.connections.origen') )
  @if(DB::connection('origen')->getDatabaseName())
  <div class="ui right corner green label conectado" data-position="left center">
    <i class="checkmark icon"></i>
  </div>
  @else
  <div class="ui right corner red label errorconectar" data-position="left center">
    <i class="exclamation icon"></i>
  </div>
  @endif
  @else
  <div class="ui right corner label desconectado" data-position="left center">
    <i class="off icon"></i>
  </div>
  @endif

  <div class="field">
    <h2 class="ui header">
      <i class="icon inverted circular cloud upload"></i> Origen
    </h2>
  </div>

  <div class="field">
    <label>Host</label>
    <div class="ui left labeled icon input">
      @if(isset($origen))
      {{ Form::text('host_origen', $origen->host, array('placeholder'=>'127.0.0.1')) }}
      @else
      {{ Form::text('host_origen', Input::old('host_origen'), array('placeholder'=>'127.0.0.1')) }}
      @endif
      <i class="desktop icon"></i>
      <div class="ui corner label">
        <i class="icon asterisk"></i>
      </div>
    </div>
  </div>

  <div class="field">
    <label>Database</label>
    <div class="ui left labeled icon input">
      @if(isset($origen))
      {{ Form::text('database_origen', $origen->database, array('placeholder'=>'database')) }}
      @else
      {{ Form::text('database_origen', Input::old('database_origen'), array('placeholder'=>'Database')) }}
      @endif
      <i class="hdd icon"></i>
      <div class="ui corner label">
        <i class="icon asterisk"></i>
      </div>
    </div>
  </div>

  <div class="field">
    <label>Username</label>
    <div class="ui left labeled icon input">
      @if(isset($origen))
      {{ Form::text('username_origen', $origen->username, array('placeholder'=>'username')) }}
      @else
      {{ Form::text('username_origen', Input::old('username_origen'), array('placeholder'=>'Username')) }}
      @endif
      <i class="user icon"></i>
      <div class="ui corner label">
        <i class="icon asterisk"></i>
      </div>
    </div>
  </div>
{{--
  <div class="field">
    <label>Password</label>
    <div class="ui left labeled icon input">
      @if(isset($origen))
      {{ Form::password('password_origen', $origen->password, array('placeholder'=>'password')) }}
      @else
      {{ Form::password('password_origen', Input::old('password_origen')) }}
      @endif
      <i class="lock icon"></i>
      <div class="ui corner label">
        <i class="icon asterisk"></i>
      </div>
    </div>
  </div>
--}}
  @if(isset($origen) AND isset($tables))

  <div class="ui horizontal icon divider">
    <i class="circular down icon"></i>
  </div>

  <div class="field">

    @foreach($tables as $table)
    @foreach($table as $tableName)
    <div class="field">
      <div class="ui accordion fluid">
        <div class="ui title segment">
          @if(in_array($tableName, $exportables))
          <div class="ui right corner label exportable" data-position="left center">
            <i class="external url sign icon"></i>
          </div>
          @else
          <div class="ui right corner red label no exportable" data-position="left center">
            <i class="ban circle icon"></i>
          </div>
          @endif
          <i class="dropdown icon"></i>
          {{ $tableName }}
          <div class="ui small label">{{ DB::connection('origen')->table($tableName)->count() }}</div>
        </div>

        <div class="content">

          {{-- BUTTONS --}}
          <div class="ui labeled icon small button">
            <i class="external url sign icon"></i>
            Exportar
          </div>

          {{-- COLUMNS --}}
          <div class="ui divided tiny list">
            @foreach(DB::connection('origen')->select('describe '.$tableName) as $columns)
            <div class="item">
              {{ $columns->Field }}
            </div>
            @endforeach
          </div>

        </div>
      </div>
    </div>
    @endforeach
    @endforeach

  </div>

  @endif

</div>

