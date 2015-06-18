 <?php

  if(isset($_GET['contenido']))
    {
      $contenido = $_GET['contenido'];
    }
  else
    {
      $contenido = 'perfil';
    }
	
 require_once("../navbar.php");


?>


<h>Pantalla para administrar perfil </h>

