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
  function listarGratificaciones()
  {
    $.ajax({
      url: 'gratificaciones',
      type: 'GET',
      dataType: 'JSON',
      beforeSend: function() {
        $('#gratificacionesMsg').html(msg('','loading','Cargando Gratificaciones','Por favor, espere...'));
      },
      error: function() {
        $('#gratificacionesMsg').html(msg('red','warning','Error inesperado!','No se han podido cargar las gratificaciones.'));
      },
      success: function(gratificaciones) {
        if (gratificaciones) {
          $('#gratificacionesMsg').html('');
          $('#gratificaciones').html('');
          var i;
          for (i= 0; i < gratificaciones.length; ++i) {
            verGratificacion(gratificaciones[i]);
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
  function crearGratificacion()
  {
    $.ajax({
      url: 'gratificaciones',
      type: 'POST',
      dataType: 'JSON',
      beforeSend: function() {
        $('#gratificacionesMsg').html(msg('','loading','Creando Gratificacion','Por favor, espere...'));
      },
      error: function() {
        $('#gratificacionesMsg').html(msg('red','warning','Error inesperado!','No se ha podido crear la gratificacion.'));
      },
      success: function(gratificacion) {
        if (gratificacion) {
          $('#gratificacionesMsg').html('');
        }
      },
      complete: function() {
        listarGratificaciones();
        $('.ui.dropdown').dropdown();
        $('.ui.accordion').accordion();
      }
    });//^ $.ajax({
  }

  /**
   * ESTACIONES
   */
  function verEstaciones()
  {
    $.ajax({
      url: 'gratificaciones/estaciones',
      type: 'GET',
      dataType: 'JSON',
      beforeSend: function() {
        $('#gratificacionesMsg').html(msg('','loading','Cargando Estaciones','Por favor, espere...'));
      },
      error: function() {
        $('#gratificacionesMsg').html(msg('red','warning','Error inesperado!','No se ha podido cargar las estaciones.'));
      },
      success: function(estaciones) {
        if (estaciones) {
          $('#gratificaciones .menu.estaciones').html('');
          $('#gratificacionesMsg').html('');
          for(var indicativo in estaciones){
            $('#gratificaciones .menu.estaciones')
              .append('<div class="item" data-value="'+indicativo+'">'+indicativo+' - '+estaciones[indicativo]+'</div>');
          }

        }
      },
      complete: function() {
        //listarGratificaciones();
        $('.ui.dropdown').dropdown();
        //$('.ui.accordion').accordion();
      }
    });//^ $.ajax({
  }

  /**
   * VER
   */
  function verGratificacion(gratificacion)
  {
    var year = (gratificacion.year) ? '<span><i class="calendar icon"></i>'+ gratificacion.year + '</span>' : '';
    var estado = (gratificacion.estado) ? '<span><i class="inbox icon"></i>'+ gratificacion.estado + '</span>' : '';
    var importe = (gratificacion.importe) ? '<span><i class="euro icon"></i>'+ gratificacion.importe + '</span>' : '';
    var estacion = (gratificacion.estacion) ? '<span><i class="block layout icon"></i>'+ gratificacion.estacion + '</span>' : '';

    var html = '' +
      '<div class="ui accordion fluid gratificacion" id="' + gratificacion.id + '">' +
      '<div class="title"><i class="dropdown icon"></i>' +
      year +
      estado +
      importe +
      estacion +
      '</div>' +
      '<div class="content">' +
      '<div class="field">' +
      //ESTACIONES
      '<div class="ui selection dropdown fluid">' +
        '<div class="text">Seleccionar estación</div>' +
        '<i class="dropdown icon"></i>' +
        '<input name="gratificacion_estacion_indicativo" type="hidden" value="' + gratificacion.gratificacion_estacion_indicativo + '">' +
        '<div class="menu estaciones">' +
        '</div>' +
      '</div>' +
      //ESTADOS
      '<div class="field">' +
      '<div class="ui selection dropdown fluid">' +
      '<div class="text">Seleccionar estado</div>' +
      '<i class="dropdown icon"></i>' +
      '<input name="gratificacion_estado" type="hidden" value="' + gratificacion.gratificaciones_estado_id + '">' +
      '<div class="menu">' +
      '<div class="item" data-value="1">Anulada</div>' +
      '<div class="item" data-value="2">Devuelta</div>' +
      '<div class="item" data-value="3">Enviada al Banco</div>' +
      '<div class="item" data-value="4">Emitida</div>' +
      '<div class="item" data-value="5">Pagada</div>' +
      '<div class="item" data-value="6">Propuesta</div>' +
      '</div>' +
      '</div>' +
      // Input Año
      '<input placeholder="Año" name="gratificacion_year" type="text" value="'+ gratificacion.year +'">' +
      // Input Importe
      '<input placeholder="Importe" name="gratificacion_importe" type="text" value="'+ gratificacion.importe +'">' +
      // Botones de Acciones
      '<div class="ui tiny button eliminarGratificacion">Eliminar</div>' +
      '<div class="ui tiny button actualizarGratificacion">Guardar</div>' +
      '</div>' +
      '</div>' +
      '</div>'

    $('#gratificaciones').append(html);
    verEstaciones();

  }


  /**
   * DOCUMENT READY. COMENZAR
   */
  $(document).ready(function() {

    listarGratificaciones();

    $("#crearGratificacion").click(function () {
      crearGratificacion();
    });

    $("body").on("click",".eliminarGratificacion", function(){
       $.ajax({
        url: 'gratificaciones',
        type: 'DELETE',
        data: {
          gratificacion_id: $(this).closest('div.gratificacion').attr('id')
        },
        dataType: 'JSON',
        beforeSend: function() {
          $('#gratificacionesMsg').html(msg('','loading','Eliminando Gratificacion','Por favor, espere...'));
        },
        complete: function() {
          listarGratificaciones();
          $('.ui.dropdown').dropdown();
          $('.ui.accordion').accordion();
        }
      });//^ $.ajax({*/
    });

    $("body").on("click",".actualizarGratificacion", function(){

      $.ajax({
        url: 'gratificaciones',
        type: 'PUT',
        data: {
          gratificacion_estacion_indicativo: $(this).closest('div.gratificacion').find('input[name=gratificacion_estacion_indicativo]').val(),
          gratificacion_id: $(this).closest('div.gratificacion').attr('id'),
          gratificaciones_estado_id: $(this).closest('div.gratificacion').find('input[name=gratificacion_estado]').val(),
          gratificacion_year: $(this).closest('div.gratificacion').find('input[name=gratificacion_year]').val(),
          gratificacion_importe: $(this).closest('div.gratificacion').find('input[name=gratificacion_importe]').val()
        },
        dataType: 'JSON',
        beforeSend: function() {
          $('#gratificacionesMsg').html(msg('','loading','Actualizando Gratificacion','Por favor, espere...'));
        },
        error: function() {
          $('#gratificacionesMsg').html(msg('red','warning','Error inesperado!','No se ha podido crear la gratificacion.'));
        },
        success: function() {
          $('#gratificacionesMsg').html('');
        },
        complete: function() {
          listarGratificaciones();
          $('.ui.dropdown').dropdown();
          $('.ui.accordion').accordion();
        }
      });//^ $.ajax({*/
    });

  });


</script>