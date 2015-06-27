<?php 
	
	if(!isset($_SESSION)) 
{ 
  session_start(); 
} 

	include("../conexion/conexion.php");

	$usuario = $_POST['usuario'];
	$password = $_POST['password'];
	// $password = (int)$password;

	$query = "select usuario, contrasena, rol_ID from usuario where usuario = '".$usuario."' ;";
	$result = mysql_query($query, $conexion) or die("error en la consulta");
	$filas = mysql_num_rows($result);
	
	if($filas == 1){
		$row = mysql_fetch_array($result);
        $passwordenBD = $row['contrasena'];
        
        if( crypt($password, $passwordenBD) == $passwordenBD) {
            
            $_SESSION['auntentificado'] = '1';
            $_SESSION['user'] = $usuario;
            // $_SESSION['password'] = $password;
            $_SESSION['rol_ID'] = $row['rol_ID'];
			
			function get_client_ip() {
				$ipaddress = '';
				if (getenv('HTTP_CLIENT_IP'))
					$ipaddress = getenv('HTTP_CLIENT_IP');
				else if(getenv('HTTP_X_FORWARDED_FOR'))
					$ipaddress = getenv('HTTP_X_FORWARDED_FOR');
				else if(getenv('HTTP_X_FORWARDED'))
					$ipaddress = getenv('HTTP_X_FORWARDED');
				else if(getenv('HTTP_FORWARDED_FOR'))
					$ipaddress = getenv('HTTP_FORWARDED_FOR');
				else if(getenv('HTTP_FORWARDED'))
					$ipaddress = getenv('HTTP_FORWARDED');
				else if(getenv('REMOTE_ADDR'))
					$ipaddress = getenv('REMOTE_ADDR');
				else
					$ipaddress = 'UNKNOWN';
				return $ipaddress;
			}
			
			$user_ip = get_client_ip();
			
			
			$query = "INSERT INTO usuario_logs ( usuario_log, fecha_ingreso, ip_conexion) VALUES ( '$usuario', CURRENT_TIMESTAMP,'$user_ip')";
						$result = mysql_query($query, $conexion) or die("error en la consulta");

            header('location:../index.php');
        }
	}
	else{
		header('location:login.php?error_code=1');
	}

 ?>