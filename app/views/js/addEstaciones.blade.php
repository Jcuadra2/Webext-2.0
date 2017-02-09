<script>
  /**
   * Añadir Estaciones extra
   */
  $(document).ready(function() {

    var MaxInputs = 8; //maximo numero de inputs
    var x         = $(":input[name^=estacion_indicativo]").length; //numero actual de inputs

    $("#addInput").click(function ()  //boton añadir mas desplegables (+)
    {
      $('.ui.dropdown').dropdown('hide');
      if(x <= MaxInputs) //comprobar que no se excede el maximo numero de inputs
      {
        // Clonamos el desplegable
        $(function(){
          var estaciones = $('.estaciones').first().clone();
          $('#manyInputs').append(estaciones);
        });

        // Activamos el nuevo desplegable
        $('.ui.dropdown').dropdown();

        x++; //incrementar inputs actuales
      }
      return false;
    });

    $("body").on("click",".removeclass", function(){ //eliminar este desplegable
      if( x > 1 ) {
        $(this).parent('div').remove();
        x--;
      } else if ( x > 0 ){
        $('#estacion_indicativo').val('');
        $(this).next('div.text').html('Seleccionar');
        $(this).remove();
      }
      $('.ui.dropdown').dropdown('hide');
      return false;
    })



  });
  $(".estaciones").dropdown({
    onChange: function() {
      if($('.removeclass').length == 0){
        $('.estaciones').prepend('<i class="remove red icon removeclass"></i>');
      }
    }
  })

</script>