@extends('plantilla')

@section('head')
  <title>Colaboradores - AEMET</title>
@stop

@section('login')
  @parent
@stop

@section('content') 
  <script type="text/javascript">
    $(document).ready( function () {
    $('#datos').DataTable( {
       dom: 'Bfrtip',
        buttons: [
            'excel', 'pdf', 'print'
        ]
      });
    } );
  </script>
  </br>
  <table id="datos" class="ui table segment sortable">
    <thead>
    <tr>
      <th>Indicativo Estación</th>
      <th>DNI</th>
      <th>Nombre</th>
      <th>Apellidos</th>
      @if(Auth::user()->tipo->tipo == 'Administrador')
      <th>Delegacion</th>
      @endif
      <th>Nº Cuenta</th>
      <th>Estacion</th>
      <th>Año</th>
      <th>Importe</th>
      <th>Estado</th>
    </tr>
    </thead>
    <tbody>
    @foreach($colaboradores as $colaborador)
    <tr>
      <td>{{ $colaborador->indicativo }}</td>
      <td>{{ $colaborador->cif_nif }}</td>
      <td>{{ $colaborador->nombre }}</td>
      <td>{{ $colaborador->apellidos }}</td>
      @if(Auth::user()->tipo->tipo == 'Administrador')
      <td>
        {{ $colaborador->delegacion_cod }}
      </td>
      @endif
      <td>{{ $colaborador->ccc }}</td>
      <td>{{ $colaborador->estacion }}</td>
      <td>{{ $colaborador->year }}</td>
      <td>{{ $colaborador->importe }}</td> 
      <td>{{ $colaborador->estado }}</td>  
    </tr>
    @endforeach
    </tbody>
  </table>

@stop
