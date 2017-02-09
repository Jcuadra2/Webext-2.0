<!doctype html>
<html lang="es">
<head>
  <meta charset="ISO-8859-1">
  <link href="{{ asset('css/fonts.css') }}" rel="stylesheet">
  <link href="{{ asset('css/semantic.css') }}" rel="stylesheet">
  <link href="{{ asset('css/style.css') }}" rel="stylesheet">
  <link href="{{ asset('css/jquery.dataTables.css') }}" rel="stylesheet">

  <link rel="alternate" type="application/rss+xml" title="RSS 2.0" href="http://www.datatables.net/rss.xml">
  <link rel="stylesheet" type="text/css" href="/media/css/site-examples.css?_=b05357026107a2e3ca397f642d976192">
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.2.2/css/buttons.dataTables.min.css">

  <script src="{{ asset('js/jquery-2.2.3.min.js') }}"></script>
  <script src="{{ asset('js/jquery-2.2.3.js') }}"></script>
  <script src="{{ asset('js/semantic.js') }}"></script>
  <script src="{{ asset('js/jquery.dataTables.js') }}"></script>
  <script src="{{ asset('js/jquery.dataTables.min.js') }}"></script>

  <!--<script type="text/javascript" language="javascript" src="//code.jquery.com/jquery-1.12.3.js">
  </script>-->
  <script type="text/javascript" language="javascript" src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js">
  </script>
  <script type="text/javascript" language="javascript" src="https://cdn.datatables.net/buttons/1.2.2/js/dataTables.buttons.min.js">
  </script>
  <script type="text/javascript" language="javascript" src="//cdn.datatables.net/buttons/1.2.2/js/buttons.flash.min.js">
  </script>
  <script type="text/javascript" language="javascript" src="//cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js">
  </script>
  <script type="text/javascript" language="javascript" src="//cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/pdfmake.min.js">
  </script>
  <script type="text/javascript" language="javascript" src="//cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/vfs_fonts.js">
  </script>
  <script type="text/javascript" language="javascript" src="//cdn.datatables.net/buttons/1.2.2/js/buttons.html5.min.js">
  </script>
  <script type="text/javascript" language="javascript" src="//cdn.datatables.net/buttons/1.2.2/js/buttons.print.min.js">-->
  </script>

  <link rel="shortcut icon" href="{{ asset('favicon.png') }}">

  @yield('head')

</head>
<body>

<div class="container">

    <img id="aemet" src="{{ asset('images/aemet-ext.png') }}">

  <div class="ui tubular menu">

    <div class="menu">

    @section('menu')

      @if(Auth::check())

        <a href="{{ URL::to('/') }}" class="header item">
          <i class="home green icon"></i>
          AEMET
        </a>

        <a href="{{ URL::to('colaboradores') }}" class="{{ (Request::is('colaboradores*')) ? 'active' : '' }} item">
          <i class="community basic icon"></i>
          Colaboradores
        </a>

        <a href="{{ URL::to('estaciones') }}" class="{{ (Request::is('estaciones*')) ? 'active' : '' }} item">
          <i class="grid layout icon"></i>
          Estaciones
        </a>

        @if(Auth::user()->tipo->tipo == 'Administrador')

          <a href="{{ URL::to('credenciales') }}" class="{{ (Request::is('credenciales*')) ? 'active' : '' }} item">
            <i class="key icon"></i>
            Credenciales
          </a>

          <a href="{{ URL::to('delegaciones') }}" class="{{ (Request::is('delegaciones*')) ? 'active' : '' }} item">
            <i class="building icon"></i>
            Delegaciones
          </a>

          <a href="{{ URL::to('importar') }}" class="{{ (Request::is('importar*')) ? 'active' : '' }} item">
            <i class="tasks icon"></i>
            Importar
          </a>

          <a href="{{ URL::to('excel') }}" class="{{ (Request::is('exportar*')) ? 'active' : '' }} item">
            <i class="cloud download icon"></i>
            Exportar Estaciones
          </a>
          <!--<a href="{{ URL::to('listadogratificacion') }}" class="{{ (Request::is('exportar*')) ? 'active' : '' }} item">
            <i class="cloud download icon"></i>
            Exportar Gratificaciones
          </a>-->
        {{-- --}}
        @elseif(Auth::user()->tipo->tipo == 'Supervisor')

          <a href="{{ URL::to('delegaciones') }}" class="{{ (Request::is('delegaciones*')) ? 'active' : '' }} item">
            <i class="building icon"></i>
            Delegaciones
          </a>
          <a href="{{ URL::to('excel') }}" class="{{ (Request::is('exportar*')) ? 'active' : '' }} item">
            <i class="cloud download icon"></i>
            Exportar Estaciones
          </a>
          <a href="{{ URL::to('listadogratificacion') }}" class="{{ (Request::is('exportar*')) ? 'active' : '' }} item">
            <i class="cloud download icon"></i>
            Exportar Gratificaciones
          </a>

        @endif

      @else

        <a href="{{ URL::to('/') }}" class="item">
          <i class="home red icon"></i>
          AEMET
        </a>

      @endif

      <div class="right menu">

        @if(Auth::check())
          @section('entrar')
            <?php
              $id = Auth::user()->id;
            ?>
            <!--<div class="ui item">
              <a href="{{ URL::to('excel') }}"><i class="user blue icon"></i></a>
            </div>-->
            <div class="ui item">
              <a href="{{ URL::to('credenciales/' . $id) }}"><i class="user green icon"></i>{{ Auth::user()->usuario }}</a>
            </div>
            <a href="{{ URL::to('salir') }}" class="ui item">
              <i class="orange sign out icon"></i>
              Salir
            </a>
            @else
            <a href="{{ URL::to('entrar') }}" class="ui item">
              <i class="green sign in icon"></i>
              Entrar
            </a>
          @show
        @endif
      </div>

    @show

    </div>

    <div class="ui sub menu">

      @yield('submenu')

    </div>

  </div>


  <header>

    @if($errors->has())
    <div class="ui error message">
      <i class="close icon"></i>
      <div class="header">
        Errores encontrados:
      </div>
      <ul class="list">
      @foreach ($errors->all() as $error)
      <li>{{ $error }}</li>
      @endforeach
      </ul>
    </div>
    @endif

    @if (Session::has('message'))
    <div class="ui warning message">
      <i class="close icon"></i>
      <div class="header">
        {{ Session::get('message') }}
      </div>
    </div>
    @endif

    @if(Session::has('flash_notice'))
    <div class="ui success message flash">
      <i class="close icon"></i>
      <div class="header">
        {{ Session::get('flash_notice') }}
      </div>
    </div>
    @endif

    @if(Session::has('flash_error'))
    <div class="ui error message flash">
      <i class="close icon"></i>
      <div class="header">
        {{ Session::get('flash_error') }}
      </div>
    </div>
    @endif

    <h2 class="ui header">

    @yield('header')

    </h2>
  </header>

  @yield('content')

</div>

</body>
<script>

  // Habilitar que los mensajes informativos se cierren al pinchar en la 'x'
  $('.message .close').on('click', function() {
    $(this).closest('.message').hide();
  });

  // Habilitar que los mensajes informativos se oculten automaticamente
  setTimeout(function(){
    $('.flash').hide();
  }, 2000);

  // Habilitar las tablas dinamicas
  $(document).ready( function () {
    $('#datos').DataTable();
  } );

</script>

</html>