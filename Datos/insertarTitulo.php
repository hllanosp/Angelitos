<?php

require_once('funciones.php');

    include '../../conexion/config.inc.php';

     require_once('funciones.php');
	
	
 if (!empty($_POST['titulo'])) 
{
     $nombre1 = $_POST['titulo'];
     $query = $db->prepare("INSERT INTO titulo(titulo) VALUES ('".$nombre1."')");
         if ($query->execute()) {
         


            echo mensajes('titulo ingresada con Exito','verde');
        
		  
    }  } 




else{}
	
	

	
	
    

?>