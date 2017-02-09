<script>
  /**
   * Añadir Inspecciones
   */
  $(document).ready(function() {

    var html = '<div class="field" id="inspecciones">' +
      '<div class="inspeccion ui message">' +
      '<div class="date field">' +
      '<label for="fecha_inspeccion[]">Fecha de Inspección</label>' +
      '<input placeholder="dd/mm/aaaa" name="fecha_inspeccion[]" type="text" id="fecha_inspeccion[]">' +
      '</div>' +
      '<div class="field">' +
      '<label for="inspeccion[]">Observaciones</label>' +
      '<div class="ui left labeled icon input">' +
      '<textarea placeholder="Escribe aquí las observaciones de la inspección " name="inspeccion[]" cols="50" rows="10" id="inspeccion[]"></textarea></div>' +
      '</div>' +
      '<div class="ui tiny red button" id="removeInspeccion">' +
      'Eliminar' +
      '</div>' +
      '</div>' +
      '</div>'
    $("#addInspeccion").click(function () {
      $('#inspecciones').append(html); // Clonamos
    });

    $("body").on("click","#removeInspeccion", function(){ //eliminar este desplegable
        $(this).parent('div.inspeccion').remove();

    })

  });


</script>