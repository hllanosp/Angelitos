 
<!-- inserta el usuario en la base de datos -->
<?php 
  // <!-- Declaramos la direccion raiz -->
  $maindir = "../../../";

//acceso a bases de datos
include ($maindir.'conexion/conexion.php');

// verifica la sesion
require_once($maindir."login/seguridad.php");
 
// // verifica el tiempo de la sesion 
require_once($maindir."login/time_out.php");

  ?>

 <?php

   // $empleado = $_POST["empleado"];
   $nombreUsuario = $_POST["nombreUsuario"];
   $password = $_POST["password"];
   $rol = (int)$_POST["rol"];
   $fecha_creacion=date("Y/m/d");

  
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
      $query = "insert into usuario (usuario, contrasena, rol_ID, fecha_creacion, estado) VALUES ('".$nombreUsuario."','".$password."','".$rol."','".$fecha_creacion."',0);";
      $result = mysql_query($query, $conexion) or die("error en la consulta");
      $mensaje = "El usuario se ha creado exitosamente...";
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