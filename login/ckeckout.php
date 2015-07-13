<?php
	session_start();
	if (isset($_SESSION['usuario_ID'])) {
    	include("../conexion/conexion.php");
    	$usuario = $_SESSION['usuario_ID'];
    	$log_id=$_SESSION['Log_id'];

    	$query = "UPDATE usuario SET Logeado = 0 where usuario_ID = '".$usuario."' ;";

        mysql_query($query, $conexion) or die("error en la consulta");

        $query = "UPDATE usuario_logs SET fecha_salida = CURRENT_TIMESTAMP  where 	id_logs = '".$log_id."' ;";

         mysql_query($query, $conexion) or die("error en la consulta");

  	}
	$_SESSION = array();
	session_destroy();
	header("location:../login/login.php");
 ?>