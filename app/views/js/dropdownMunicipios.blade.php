<script>

  function alCambiarProvincia() {
    $("#provincias").dropdown({
      onChange: function() {
        $.ajax({
          url: 'provincia',
          type: 'POST',
          data: {provincia_cod: $('#provincia_cod').val()},
          dataType: 'JSON',
          beforeSend: function() {
            $("#selectMunicipio").html('<i class="loading icon"></i> Buscando municipios...');
          },
          error: function() {
            $("#selectMunicipio").html('<i class="warning icon"></i> Ha surgido un error!');
          },
          success: function(municipios) {
            if (municipios) {
              // Vaciamos los datos del menu desplegable
              $("#municipios").html('');
              var i;
              // Rellenamos los datos del menu desplegable
              for (i= 0; i < municipios.length; ++i) {
                $("#municipios").append('<div class="item" data-value="' + municipios[i].cod + '">' + municipios[i].municipio + '</div>');
              }
              // Al cargar una nueva lista de municipios olvidamos el municipio seleccionado anteriormente
              $('#municipio_cod').val('');
            } else {
              $("#selectMunicipio").html('<i class="ban circle icon"></i> No hay municipios para esta Provincia');
            }
          },
          complete: function() {
            $("#selectMunicipio").html('Seleccionar');
            $('.ui.dropdown').dropdown();
            alCambiarProvincia();
          }
        });//^ ajax
      }
    })
  }



  // Cuando toda la pagina este cargada
  $(document).ready(function(){

    alCambiarProvincia();

    dropdownMunicipios();

    function dropdownMunicipios (){
      $.ajax({
        url: 'provincia',
        type: 'POST',
        data: {provincia_cod: $('#provincia_cod').val()},
        dataType: 'JSON',
        beforeSend: function() {
          $("#selectMunicipio").html('<i class="loading icon"></i> Buscando municipios...');
        },
        error: function() {
          $("#selectMunicipio").html('<i class="warning icon"></i> Ha surgido un error!');
        },
        success: function(municipios) {
          if (municipios) {
            // Vaciamos los datos del menu desplegable
            $("#municipios").html('');
            var i;
            // Rellenamos los datos del menu desplegable
            for (i= 0; i < municipios.length; ++i) {
              $("#municipios").append('<div class="item" data-value="' + municipios[i].cod + '">' + municipios[i].municipio + '</div>');
            }
          } else {
            $("#selectMunicipio").html('<i class="ban circle icon"></i> No hay municipios para esta Provincia');
          }
        },
        complete: function() {
          $("#selectMunicipio").html('Seleccionar');
          $('.ui.dropdown').dropdown();
          alCambiarProvincia();
        }
      });//^ ajax
    } // FIN dropdownMunicipios()

  });

</script>