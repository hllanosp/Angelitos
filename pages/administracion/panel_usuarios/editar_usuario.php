
<!-- inserta el usuario en la base de datos -->
<?php 
  // <!-- Declaramos la direccion raiz -->
  $maindir = "../../../";

//acceso a bases de datos
include ($maindir.'conexion/conexion.php');

// verifica la sesion
require_once($maindir."login/seguridad.php");
 
// // verifica el tiempo de la sesion 
// require_once($maindir."login/time_out.php");

  ?>

 <?php
  // recibimos las variables por post
  $usuario_ID = $_POST["usuario_ID"];
  // $empleado = $_POST["empleado"];
  // $nombreUsuarioAnt = $_POST["nombreUsuarioAnt"];
  $nombreUsuario = $_POST["usuario"];
  $password = $_POST["password"];
  $rol = $_POST["rol"];
  $estado = $_POST["estado"];
  if( $estado == 0 ){
    $fechaFinalizar=date("Y-m-d");
  }else{
    $fechaFinalizar=null;
  }

 function crypt_blowfish($password, $digito = 7) {
     $set_salt = './1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
     $salt = sprintf('$2a$%02d$', $digito);
     for($i = 0; $i < 22; $i++)
     {
         $salt .= $set_salt[mt_rand(0, 63)];
     }
     return crypt($password, $salt);
 }

  
  // Algunas validaciones
  if($nombreUsuario == "" or $password == ""){
    
    $mensaje="Por favor introduzca un nombre de usuario y password validos";
        $codMensaje =0;
    
    }
    // elseif($empleado == -1){

    //     $mensaje="Por favor seleccione un empleado valido";
    //     $codMensaje =0;

    // }
    elseif($rol == -1){
        
        $mensaje="Por favor seleccione un rol valido";
        $codMensaje =0;
    }
    else{
      try{
        // realizamos la consulta
        $password = crypt_blowfish($password);
        
      
          $query = "update usuario set usuario = '".$nombreUsuario."', contrasena = '".$password."',rol_ID = '".$rol."', fecha_alta = '".$fechaFinalizar."',estado = '".$estado."'where usuario_ID = '".$usuario_ID."';";      
        
        $result = mysql_query($query, $conexion) or die("error en la consulta");
        $mensaje = "El usuario se ha modificado exitosamente...";
        $codMensaje = 1;
      
      }catch(PDOExecption $e){
        $mensaje="No se ha procesado su peticion, comuniquese con el administrador del sistema";
        $codMensaje =0;
      }
    }

  if(isset($codMensaje) and isset($mensaje)){
    if($codMensaje == 1){
      echo '<div class="alert alert-success alert-succes">
        <a href="#" class="close" data-dismiss="alert">&times;</a>
        <strong> Exito! </strong>'.$mensaje.'</div>';
    }else{
      echo '<div class="alert alert-danger alert-error">
        <a href="#" class="close" data-dismiss="alert">&times;</a>
        <strong> Error! </strong>'.$mensaje.'</div>';
    }
  } 
?>