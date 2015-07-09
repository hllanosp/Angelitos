<?php 
	include('login/seguridad.php');
  include('login/time_out.php');
 ?>

<!-- Este codigo en js, tiene como funcion cerrar el log en la base de datos y destruir las variables de sesion si se ha cerrado la pestaña del navegador -->
<script language="JavaScript" type="text/javascript">

    window.onbeforeunload = accionAntesDeSalir;
     
    function accionAntesDeSalir()
    {
	$.ajax("funciones/eventoCerrarPestaña.php");
    }
</script>
<!-- Fin de codigo js -->

<?php
  
$maindir = "";

  // crea el encabezado de la pagina
  require_once($maindir."pages/head.php");

?>

<!-- Div principal el cual contendra la generacion dinamica de la pag -->
<!-- div_contenido -->
<div id="div_contenido">

<?php
  
  if(!isset($_GET['contenido']))
  {
    require_once("pages/home.php");
  }
  else
  {
  	$contenido = $_GET['contenido'];
  }

?>

</div>
<!-- /div_contenido -->

<?php

  // crea el pie de pagina
  require_once("pages/footer.php");

?>
