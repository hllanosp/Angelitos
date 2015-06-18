<?php

/*
if(!isset($_SESSION)) 
{ 
session_set_cookie_params(1800); // las sesion de los cookies durara 1 hora en el cliente  
session_start();
}
*/

if(!isset($_SESSION['timeout']))
  {
    $_SESSION['timeout'] = time();
  }
else
  {
    $tiempo = $_SESSION['timeout'];

    if (time() >  $tiempo + 60*1) 
      {
       // session timed out
        // // $_SESSION['contenido'] = $contenido;
        
        // session_destroy();
        // header("location:../login/login.php");
      }
    else
      {
        $_SESSION['timeout'] = time();
      }
  }

?>