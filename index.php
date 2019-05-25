<?php
  require_once 'vendor/autoload.php';
  require_once dirname(__FILE__).'/config/defines.php';
  require_once __ROOT__.'autoload.php';

  date_default_timezone_set("Europe/Madrid");
  ini_set('display_errors', 'On');
  error_reporting(E_ALL | E_STRICT);

  $page = 'inicio';
  if(isset($_GET['p'])) {
    $page = $_GET['p'];
  }

  // Inicializamos el motor de plantillas
  $loader = new Twig_Loader_Filesystem(__DIR__.'/vista');
  $twig = new Twig_Environment($loader, []);
  $twig->addGlobal('current_page', $page);

  // Iniciamos la sesión
  session_start();

  // Inicializamos el controlador
  $controlador = new Controlador($page, $twig);
  $controlador->construir();

?>
