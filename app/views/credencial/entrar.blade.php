@extends('plantilla')

@section('head')
<title>Iniciar sesion - AEMET</title>
@stop

@section('header')
  <div style="color:white;" class="content">
    Aun no ha iniciado sesion
    <div style="color:white;" class="sub header">Introduzca sus credenciales y pinche en Iniciar sesion.</div>
  </div>
@stop

@section('content')
  {{ Form::open(array('url'=>'entrar', 'class'=>'ui form segment small')) }}
  {{ Form::text('usuario', null, array('placeholder'=>'Usuario')) }}
  {{ Form::password('password', array('placeholder'=>'Contraseña')) }}

  {{ Form::submit('Iniciar sesión', array('class' => 'ui blue small button submit')) }}
  {{ Form::close() }}
@stop
