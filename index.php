<?php

define("DEBUG", true);
// echo dirname(__FILE__) . "/modelo/BD.php";
include(dirname(__FILE__) . "/modelo/BD.php");


$a = new BD();
$a->conectar();
$a->desconectar();

?>
