
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
var bad_words = /comechapas|palurdo|bocachancla|cuerpoescombro|cenutrio|cabezabuqe|caraespatula|carajaula|puto|puta|mierda|cabron/gi;


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
 * Recupera la información introducida por el usuario.
 *
 * @return {Boolean} False
 */
function enviarComentario(){
  var nombre     = document.getElementById("nombre").value;
  var comentario = document.getElementById("comentario").value;
  var date       = new Date();
  var fecha      = date.getDate() + "/" + date.getMonth() + "/" + date.getFullYear();
  var hora       = date.getHours() + ":" + date.getMinutes();
  date           = fecha + " - " + hora;

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
  old_data.appendChild(nuevo_comentario);
}


/**
 * Revisar el contenido del comentario y llama a la funcion censurar() en caso
 * de encontrar palabras prohibidas.
 *
 * @return {void}
 */
function revisarComentario(){
  var comentario = document.getElementById("comentario");
  comentario.value = comentario.value.replace(bad_words, "****");
  // alert(comentario.value);
}
