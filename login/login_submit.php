<?php 
	
	if(!isset($_SESSION)) 
{ 
  session_start(); 
} 

	include("../conexion/conexion.php");

	$usuario = $_POST['usuario'];
	$password = $_POST['password'];
	$password = (int)$password;

	$query = "select usuario.usuario, usuario.rol_ID from usuario where usuario = '".$usuario."' and contrasena = '".$password."';";
	$result = mysql_query($query, $conexion) or die("asdfasdf");
	$filas = mysql_num_rows($result);

	if($filas == 1){
		$result2 = mysql_fetch_array($result);
		$_SESSION['auntentificado'] = '1';
		$_SESSION['user'] = $usuario;
		$_SESSION['password'] = $password;
		$_SESSION['rol_ID'] = $result2['rol_ID'];
		
		header('location:../index.php');
	}
	else{
		header('location:login.php?error_code=1');
	}

 ?>