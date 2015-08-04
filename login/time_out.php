<?php
  session_start();
 
  if (isset($_SESSION['usuario_ID'])) {
      include("../conexion/config.inc.php");
      $usuario = $_SESSION['usuario_ID'];
      $log_id=$_SESSION['Log_id'];

      $query = $db ->prepare("UPDATE usuario_logs SET fecha_salida = CURRENT_TIMESTAMP  where   id_logs = '".$log_id."' ;");
      $query ->execute();
     
      $query2 = $db ->prepare("UPDATE usuario SET Logeado = 0 where usuario_ID = '".$usuario."' ;");
      $query2 ->execute();
    }
  $_SESSION = array();
  session_destroy();
  header("location:../login/login.php?error_code=5, $log_id");
 ?>
