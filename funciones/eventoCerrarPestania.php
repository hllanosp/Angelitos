<?php
	/* Este codigo es llamado unicamamente si se ha cerrado la pestaña del navegador
	se inicializa la sesion, se toma el identificador de la sesion logueada,
	se incluyen los datos de conexion, se actualiza el logueo en la base de datos y
	se destruyen las variables de sesion*/
	session_start();
	$usuario_ID = $_SESSION['usuario_ID'];
	include("../conexion/config.inc.php");

	$query2 = $db ->prepare("UPDATE usuario SET Logeado = 0 where usuario_ID = '".$usuario_ID."' ;");
	$query2 ->execute();

	header("location: login/login.php");

?>
