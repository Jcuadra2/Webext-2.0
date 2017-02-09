<script>
  /**
   * Mensajes
   */
  function msg(color, icon, header, p){
    return '<div class="ui icon '+ color +' message">' +
      '<i class="'+ icon +' icon"></i>' +
      '<div class="content">' +
      '<div class="header">'+ header +'</div>' +
      '<p>'+ p +'</p>' +
      '</div>' +
      '</div>'
  }

  /**
   * LISTAR
   */
  function listarIncidencias()
  {
    $.ajax({
      url: 'incidencias',
      type: 'GET',
      data: {
        indi: $(this).closest('#indicativo').html()
      },
      dataType: 'JSON',
      beforeSend: function() {
        $('#incidenciasMsg').html(msg('','loading','Cargando Incidencias','Por favor, espere...'));
      },
      error: function() {
        $('#incidenciasMsg').html(msg('red','warning','Error inesperado!','No se han podido cargar las incidencias.'));
      },
      success: function(incidencias) {
        if (incidencias) {
          $('#incidenciasMsg').html('');
          $('#incidencias').html('');
          var i;
          for (i= 0; i < incidencias.length; ++i) {
            verIncidencia(incidencias[i]);
          }
        }
      },
      complete: function() {
        $('.ui.dropdown').dropdown();
        $('.ui.accordion').accordion();
      }
    });//^ $.ajax({
  }

  /**
   * CREAR
   */
  function crearIncidencia()
  {
    $.ajax({
      url: 'incidencias',
      type: 'POST',
      dataType: 'JSON',
      beforeSend: function() {
        $('#incidenciasMsg').html(msg('','loading','Creando Incidencia','Por favor, espere...'));
      },
      error: function() {
        $('#incidenciasMsg').html(msg('red','warning','Error inesperado!','No se ha podido crear la incidencia.'));
      },
      success: function(incidencia) {
        if (incidencia) {
          $('#incidenciasMsg').html('');
        }
      },
      complete: function() {
        listarIncidencias();
        $('.ui.dropdown').dropdown();
        $('.ui.accordion').accordion();
      }
    });//^ $.ajax({
  }

  /**
   * VER
   */
  function verIncidencia(incidencia)
  {
    var fecha = (incidencia.fecha) ? '<span><i class="calendar icon"></i>'+ incidencia.fecha + '</span>' : '';
    var tipo = (incidencia.tipo) ? '<span><i class="inbox icon"></i>'+ incidencia.tipo + '</span>' : '';
    var resumen = (incidencia.resumen) ? '<span class="resumen"><i class="comment icon"></i>'+ incidencia.resumen + '</span>' : '';

    var html = '' +
      '<div class="ui accordion fluid incidencia" id="' + incidencia.id + '">' +
      '<div class="title"><i class="dropdown icon"></i>' +
      fecha +
      tipo +
      resumen +
      '</div>' +
      '<div class="content">' +
      '<div class="field">' +
      '<div class="ui selection dropdown fluid">' +
      '<div class="text">Seleccionar tipo</div>' +
      '<i class="dropdown icon"></i>' +
      '<input name="incidencia_tipo" type="hidden" value="' + incidencia.incidencias_tipo_id + '">' +
      '<div class="menu">' +
      '<div class="item" data-value="1">Baja Definitiva</div>' +
      '<div class="item" data-value="2">Cambio de Colaborador</div>' +
      '<div class="item" data-value="3">Cambio de Desplazamiento</div>' +
      '<div class="item" data-value="7">Cambio de Tipo de Estacion</div>' +
      '<div class="item" data-value="4">Instalacion de Material</div>' +
      '<div class="item" data-value="5">Otras</div>' +
      '<div class="item" data-value="6">Revision</div>' +
      '</div>' +
      '</div>' +
      '<input placeholder="dd/mm/aaaa" name="fecha_incidencia" type="text" value="'+ incidencia.fecha +'">' +
      '<textarea placeholder="Escriba aquí la incidencia" name="incidencia" cols="50" rows="10">'+ incidencia.incidencia +'</textarea>' +

      '<div class="ui tiny button eliminarIncidencia">Eliminar</div>' +
      '<div class="ui tiny button actualizarIncidencia">Guardar</div>' +
      '</div>' +
      '</div>' +
      '</div>'

    $('#incidencias').append(html);

  }


  /**
   * DOCUMENT READY. COMENZAR
   */
  $(document).ready(function() {

    listarIncidencias();

    $("#crearIncidencia").click(function () {
      crearIncidencia();
    });

    $("body").on("click",".eliminarIncidencia", function(){
       $.ajax({
        url: 'incidencias',
        type: 'DELETE',
        data: {
          id: $(this).closest('div.incidencia').attr('id')
        },
        dataType: 'JSON',
        beforeSend: function() {
          $('#incidenciasMsg').html(msg('','loading','Eliminando Incidencia','Por favor, espere...'));
        },
        complete: function() {
          listarIncidencias();
          $('.ui.dropdown').dropdown();
          $('.ui.accordion').accordion();
        }
      });//^ $.ajax({*/
    });

    $("body").on("click",".actualizarIncidencia", function(){

      $.ajax({
        url: 'incidencias',
        type: 'PUT',
        data: {
          id: $(this).closest('div.incidencia').attr('id'),
          tipo: $(this).closest('div.incidencia').find('input[name=incidencia_tipo]').val(),
          fecha: $(this).closest('div.incidencia').find('input[name=fecha_incidencia]').val(),
          incidencia: $(this).closest('div.incidencia').find('textarea[name=incidencia]').val()
        },
        dataType: 'JSON',
        beforeSend: function() {
          $('#incidenciasMsg').html(msg('','loading','Actualizando Incidencia','Por favor, espere...'));
        },
        error: function() {
          $('#incidenciasMsg').html(msg('red','warning','Error inesperado!','No se ha podido crear la incidencia.'));
        },
        success: function() {
          $('#incidenciasMsg').html('');
        },
        complete: function() {
          listarIncidencias();
          $('.ui.dropdown').dropdown();
          $('.ui.accordion').accordion();
        }
      });//^ $.ajax({*/
    });

  });


</script>