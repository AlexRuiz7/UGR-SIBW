///////////////////////////////////////////////////////////////////
///                                                             ///
///  Implementación de comunicación asíncrona con PHP y AJAX    ///
///                                                             ///
///////////////////////////////////////////////////////////////////

/* Document Ready */
$(document).ready( function() {

  $("#busqueda").keyup(function() {
    var valor_busqueda = $(this).val();

    if(valor_busqueda != "") {
      $(".box").hide();
      incluirCSS();
      $("#resultado-busqueda").css("display", "flex");
      $("#resultado-busqueda").css("width", "100%");
      obtenerDatos(valor_busqueda);
    }
    else {
      $("#css_busqueda").remove();
      $("#resultado-busqueda > div").remove();
      $("#resultado-busqueda").css("display", "none");
      $(".box").show();
    }
  })

})


/* Función de búsqueda */
function obtenerDatos(cadena) {

  $.ajax({
    url       : 'consultaAJAX.php',
    type      : 'POST',
    dataType  : 'json',
    data      : { 'cadena' : cadena },
  })

  .done(function(resultado) {
    procesarRespuesta(resultado);
  })
}


/**
 * [incluirCSS description]
 * @return {[type]} [description]
 */
function incluirCSS() {
  $('head').append('<link rel="stylesheet" type="text/css" href="css/estilo_moderador.css" id="css_busqueda"/>');
}


/**
 * [procesarRespuesta description]
 * @param  {[type]} entrada [description]
 * @return {[type]}         [description]
 */
function procesarRespuesta(entrada) {
  var salida = ""

  for (i = 0; i < entrada.length; i++) {
    item = entrada[i];
    salida +=
      '<div class="navitem comentario noticia-gestor-item-lista">'
      + '<div class="cabecera-comentario">'
      +   '<h4>' + item.autor + '</h4>' + '<h5>' + item.fecha + '</h5>'
      + '</div>'
      + '<div class="cuerpo">'
      +   '<h5> <a href="?p=noticias&id='+item.id+'">'+item.titular+'</a> </h5>'
      + '</div>' +
      '</div>';
  }

  $("#resultado-busqueda").html(salida);
}
