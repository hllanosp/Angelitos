<?php 
	
	if(!isset($_SESSION)) 
{ 
  session_start(); 
} 

	include("../conexion/config.inc.php");

	$usuario = $_POST['usuario'];
	$password = $_POST['password'];
	// $password = (int)$password;

	$query =  $db->prepare("select usuario,usuario_ID,contrasena,Logeado,estado, rol_ID from usuario where usuario = '".$usuario."' ;");
	$query->execute();
	$result = $query -> rowCount();
	
	if($result >0){
		$row = $query->fetch();
        $passwordenBD = $row['contrasena'];
        $logeado = $row['Logeado'];
        $estado = $row['estado'];
        $usuario_ID = $row['usuario_ID'];
        // hay que validar que una variable si alguien ya se ha validado.
        
        if((crypt($password, $passwordenBD) == $passwordenBD)) {

            if(($logeado == 0)){
            	if(($estado == 1)){

            		$query2 = $db ->prepare("UPDATE usuario SET Logeado = 1 where usuario_ID = '".$usuario_ID."' ;");
					// $result = mysql_query($query, $conexion) or die("error en la consulta");
					$query2->execute();
		            $_SESSION['auntentificado'] = '1';
		            $_SESSION['user'] = $usuario;
		            $_SESSION['usuario_ID'] = $usuario_ID;
		            $_SESSION['time_out'] = time();
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
					//Obtencion del ID-logs
				 	$stmt = $db->prepare("CALL SP_INSERTAR_LOG(?,?,@ultID)");
					//Introduccion de parametros
			        $stmt->bindParam(1, $user_ip, PDO::PARAM_STR); 
			        $stmt->bindParam(2, $usuario, PDO::PARAM_STR);
			        $stmt->execute();

		      		$output = $db->query("select @ultID")->fetch(PDO::FETCH_ASSOC);
		     		//var_dump($output);
		      		$_SESSION['Log_id']= $output['@ultID'];
		      		$codMensaje = 0;

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