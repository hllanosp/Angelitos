<?php
	session_start();
	include("../conexion/conexion.php");
	$usuario = $_SESSION['usuario_ID'];
	$query = "UPDATE usuario SET Logeado = 0 where usuario_ID = '".$usuario."' ;";
					$result = mysql_query($query, $conexion) or die("error en la consulta");
	$_SESSION = array();
	session_destroy();
	header("location:../login/login.php");
 ?>