<?php 
	
	if(!isset($_SESSION)) 
{ 
  session_start(); 
} 

	include("../conexion/conexion.php");

	$usuario = $_POST['usuario'];
	$password = $_POST['password'];
	// $password = (int)$password;

	$query = "select usuario,usuario_ID,contrasena,Logeado,estado, rol_ID from usuario where usuario = '".$usuario."' ;";
	$result = mysql_query($query, $conexion) or die("error en la consulta");
	$filas = mysql_num_rows($result);
	
	if($filas == 1){
		$row = mysql_fetch_array($result);
        $passwordenBD = $row['contrasena'];
        $logeado = $row['Logeado'];
        $estado = $row['estado'];
        $usuario_ID = $row['usuario_ID'];
        // hay que validar que una variable si alguien ya se ha validado.
        
        if((crypt($password, $passwordenBD) == $passwordenBD)) {

            if(($logeado == 0)){
            	if(($estado == 1)){

            		$query = "UPDATE usuario SET Logeado = 1 where usuario_ID = '".$usuario_ID."' ;";
					$result = mysql_query($query, $conexion) or die("error en la consulta");
		            $_SESSION['auntentificado'] = '1';
		            $_SESSION['user'] = $usuario;
		            $_SESSION['usuario_ID'] = $usuario_ID;
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
		        }else{
		        	header('location:login.php?error_code=6');	
		        }
		     }
		     else{
		     	header('location:login.php?error_code=7');
		     }
        }
        else{
        	header('location:login.php?error_code=1');	
        }
	}
	else{
		header('location:login.php?error_code=1');
	}

 ?>