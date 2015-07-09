<?php
	/* Este codigo es llamado unicamamente si se ha cerrado la pestaña del navegador
	se inicializa la sesion, se toma el identificador de la sesion logueada,
	se incluyen los datos de conexion, se actualiza el logueo en la base de datos y
	se destruyen las variables de sesion*/
	session_start();
	$usuario_ID = $_SESSION['usuario_ID'];
	include "../conexion/conexion.php";
	$query = "UPDATE usuario SET Logeado = 0 where usuario_ID = '".$usuario_ID."' ;";
	$result = mysql_query($query, $conexion) or die("error en la consulta");
	$_SESSION = array();
	session_destroy();
?>
