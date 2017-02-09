<div class="ui piled segment">

  @if( Config::get('database.connections.destino') )
  @if(DB::connection('destino')->getDatabaseName())
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
      <i class="icon inverted circular cloud download"></i> Destino
    </h2>
  </div>

  <div class="field">
    <label>Host</label>
    <div class="ui left labeled icon input">
      {{ Form::text('host_destino', $destino ? $destino->host : Input::old('host_destino'), array('placeholder'=>'127.0.0.1')) }}
      <i class="desktop icon"></i>
      <div class="ui corner label">
        <i class="icon asterisk"></i>
      </div>
    </div>
  </div>

  <div class="field">
    <label>Database</label>
    <div class="ui left labeled icon input">
      {{ Form::text('database_destino', $destino ? $destino->database : Input::old('database_destino'), array('placeholder'=>'Database')) }}
      <i class="hdd icon"></i>
      <div class="ui corner label">
        <i class="icon asterisk"></i>
      </div>
    </div>
  </div>

  <div class="field">
    <label>Username</label>
    <div class="ui left labeled icon input">
      {{ Form::text('username_destino', $destino ? $destino->username : Input::old('username_destino'), array('placeholder'=>'Username')) }}
      <i class="user icon"></i>
      <div class="ui corner label">
        <i class="icon asterisk"></i>
      </div>
    </div>
  </div>


</div>