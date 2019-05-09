<?php
  // IMPORTANTE -- No usar el modo debug junto con la vista. Debug consume los
  // resultados de las consultas a la BD, por lo que no llegará nada a la vista
  define("DEBUG", false);
  define('__ROOT__', dirname(dirname(__FILE__)).'/');
?>
