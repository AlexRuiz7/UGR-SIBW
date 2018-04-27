
/**
 * Variable global para controlar el estado del panel de comentarios.
 *
 * @type {Boolean}
 */
var oculto = true;


/**
 * Array de palabras prohibidas que serán censuradas
 *
 * Sacado con gracia de:
 * https://listas.20minutos.es/lista/insultos-en-castellano-que-deberias-conocer-y-su-significado-393340/
 *
 * @type {Array}
 */
var bad_words = / comechapas | palurdo | bocachancla | cuerpoescombro | cenutrio | cabezabuque | caraespatula | carajaula | puto | puta | mierda | cabron /gi;


/**
 * Muestra u oculta la sección de comentarios.
 *
 * @return {void}
 */
function mostrarComentarios(){
  var css = document.getElementById("desplegable-comentarios").style;
  oculto ? css.left = "50%" : css.left = "116%";
  oculto = !oculto;
}


/**
 * [comprobarDate description]
 * @param  {[type]} date [description]
 * @return {[type]}      [description]
 */
function comprobarDate(date){
  var format_date = date;
  if(date<10){
    format_date = "0"+date;
  }
  console.log(format_date);
  return format_date;
}

/**
 * Recupera la información introducida por el usuario.
 *
 * @return {Boolean} False
 */
function enviarComentario(){
  var nombre     = document.getElementById("nombre").value;
  var comentario = document.getElementById("comentario").value;
  var email      = document.getElementById("email").value;
  var date       = new Date();
  var dia        = comprobarDate(date.getDate());
  var mes        = comprobarDate(date.getMonth());
  var fecha      = dia + "/" + mes + "/" + date.getFullYear();
  var horas      = comprobarDate(date.getHours());
  var minutos    = comprobarDate(date.getMinutes());
  var hora       = horas + ":" + minutos;
  date           = fecha + " - " + hora;

  // Comprueba si los campos están completados
  if ( !(nombre==="" || comentario==="" || email==="" ))
    crearNuevoComentario(date, nombre, comentario);

  // Devulve false para evitar que la página se refresque al hacer submit
  return false;
}


/**
 * Crea y añade el nuevo comentario a la sección de comentarios.
 *
 * @param  {String} fecha  Concatenación de fecha y hora
 * @param  {String} nombre Nombre del cliente
 * @param  {String} texto  Comentario introducido por el cliente
 * @return {void}
 */
function crearNuevoComentario(fecha, nombre, texto){
  // Variables auxiliares para crear nodos de texto
  var text_node;
  var parrafo;

  // Crear nuevos elementos
  var nuevo_comentario = document.createElement("div");
  nuevo_comentario.setAttribute("class", "comentario");
  var fecha_nombre = document.createElement("div");
  fecha_nombre.setAttribute("class", "comentario-fecha");
  // Añadir fecha y autor a la sección comentario-fecha
  parrafo = document.createElement("p");
  text_node = document.createTextNode(fecha);
  parrafo.appendChild(text_node);
  fecha_nombre.appendChild(parrafo);
  parrafo = document.createElement("p");
  text_node = document.createTextNode(nombre);
  parrafo.appendChild(text_node);
  fecha_nombre.appendChild(parrafo);
  // Añadir la sección comentario-fecha al nuevo comentario
  nuevo_comentario.appendChild(fecha_nombre);
  // Crear cuerpo del comentario y añadirlo al nuevo comentario
  var comentario = document.createElement("div");
  comentario.setAttribute("class", "texto");
  text_node = document.createTextNode(texto);
  comentario.appendChild(text_node);
  nuevo_comentario.appendChild(comentario);

  // Recuperar comentarios anteriores y añadir el nuevo
  var old_data  = document.getElementById("comentarios");
  old_data.appendChild(nuevo_comentario);return false;
}


/**
 * Revisar el contenido del comentario y llama a la funcion censurar() en caso
 * de encontrar palabras prohibidas.
 *
 * @return {void}
 */
function revisarComentario(){
  var comentario = document.getElementById("comentario");
  comentario.value = comentario.value.replace(bad_words, " **** ");
}


/**
 * Comprueba el valor introducido al servidor en la variable GET para evitar
 * inyección de código SQL.
 *
 * @param  {[type]} id datos de entrada
 * @return {[type]}    true si es un número, false si es cualquier otra cosa.
 */
function getEsNumero(id){
  return !id.isNaN();
}


function alerta(msg){
  alert(msg);
}
