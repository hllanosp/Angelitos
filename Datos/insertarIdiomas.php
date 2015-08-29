

<?php

require_once('funciones.php');

    include '../../conexion/config.inc.php';

     require_once('funciones.php');
	
	
 if (!empty($_POST['nombreIdioma'])) 
{
     $nombre1 = $_POST['nombreIdioma'];
     $query = $db->prepare("insert into idioma(Idioma)) VALUES ('".$nombre1."')");
    if ($query->execute()) {
         


            echo mensajes('titulo ingresada con Exito','verde');
        
		  
    }  } 
