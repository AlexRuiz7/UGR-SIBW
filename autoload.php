<?php

  spl_autoload_register(function ($clase) {

    if(file_exists(__ROOT__.'modelo/' . $clase . '.php'))
      include __ROOT__.'modelo/' . $clase . '.php';
    else if(file_exists(__ROOT__.'controlador/' . $clase . '.php'))
      include __ROOT__.'controlador/' . $clase . '.php';

  });


?>
