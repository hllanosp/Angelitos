<?php
	include('funciones/seguridad.php');
  //include('login/time_out.php');
 ?>

<!-- Este codigo en js, tiene como funcion cerrar el log en la base de datos y destruir las variables de sesion si se ha cerrado la pestaña del navegador -->
<script language="JavaScript" type="text/javascript">

    window.onbeforeunload = accionAntesDeSalir;

    function accionAntesDeSalir()
    {
      $.ajax("funciones/eventoCerrarPestania.php");
    	// return "Perderas todos tus datos de sesion";
		}
</script>

<!-- Fin de codigo js -->

<script type="text/javascript">
var time;
function inicio() {
  time = setTimeout(function() {
    $(document).ready(function(e) {
		document.location.href = "login/time_out.php";
});
	},2000000);//fin timeout
}//fin inicio

function reset() {
  clearTimeout(time);//limpia el timeout para resetear el tiempo desde cero
  time = setTimeout(function() {
    $(document).ready(function(e) {
    document.location.href = "login/time_out.php";
});
	},200000);//fin timeout
}//fin reset
</script>
<?php

$maindir = "";

  // crea el encabezado de la pagina
  require_once($maindir."pages/head.php");

?>

<!-- Div principal el cual contendra la generacion dinamica de la pag -->
<!-- div_contenido -->
<div id="div_contenido" onUnload = "accionAntesDeSalir()" accionAntesd onload="inicio()" onkeypress="reset()" onclick="reset()" onMouseMove="reset()">

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
