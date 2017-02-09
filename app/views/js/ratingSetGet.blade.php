<script>
  /**
   * Rellenar fiabilidad y continuidad con los valores almacenados en el Form
   */
  function setRating()
  {
    $('.fiabilidad').rating('set rating', $('#fiabilidad').val());
    $('.continuidad').rating('set rating', $('#continuidad').val());
  }

  setRating();

  /**
   * Almacenar los valores de fiabilidad y continuidad en el Form
   */
  function getRating()
  {
    var rating = $('.ui.rating').rating('get rating');

    if( rating[0] === 0 )
      $('#fiabilidad').removeAttr('value');
    else
      $('#fiabilidad').val( rating[0] );

    if( rating[1] === 0 )
      $('#continuidad').removeAttr('value');
    else
      $('#continuidad').val( rating[1] );
  }

  $('.continuidad')
    .rating({
      onRate: getRating
    })
  ;

  $('.fiabilidad')
    .rating({
      onRate: getRating
    })
  ;
</script>