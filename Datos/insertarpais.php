<?php

     include '../../conexion/config.inc.php';
     require_once('funciones.php');
  
    if (!empty($_POST['Pais'])) 
    {
        $nombre = $_POST['Pais']; 
     
        $query = $db->prepare("INSERT INTO pais(Nombre_pais)  VALUES ('".$nombre."')");
       if ($query->execute()) {
           echo mensajes('Universidad ingresada con Exito','verde');
    } 
    }
    else{
        
        echo mensajes('requisitos en blanco','rojo');   
    }   



   
   
    
    
?>
