<?php
  session_start();
  unset($_SESSION['username']);
  unset($_SESSION['tipo']);
  unset($_SESSION['loggedin']);
  session_destroy();

  header('Location: http://localhost:8080/web_sibw/panelControl.php');
?>
