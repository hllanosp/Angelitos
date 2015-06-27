<?php 
	SESSION_START();
	if ($_SESSION['auntentificado'] != '1') {
		// hay que agregarle un codigo para el error
		header("location:./login/login.php");
		exit;
	}
	
 ?>