<?php
 


    include '../../conexion/config.inc.php';

     require_once('funciones.php');
	
	  if (!empty($_POST['nombre'])) 
    {
        $nombre = $_POST['nombre']; 
		    $pais = $_POST['pais']; 
        
     //   $query = "INSERT INTO universidad(Nombre_universidad,Id_Pais) VALUES('$nombre','$pais')";
        
      //  mysql_query($query); 



         $query = $db->prepare("INSERT INTO universidad(Nombre_universidad,Id_Pais)  VALUES ('".$nombre."','".$pais."')");
      // $result = mysql_query($query, $conexion) or die("error en la consulta");
         
       if ($query->execute()) {
           echo mensajes('Universidad ingresada con Exito','verde');




          
		  
    } 
    }
    else{
        
        echo mensajes('requisitos en blanco','rojo');
        
    }   
    


  // $query  = $db->prepare("SELECT * FROM universidad inner join pais on pais.Id_pais=universidad.Id_pais");
  // $query->execute();
  // $result1 = $query->fetchAll();
  



  
  // $sql = "INSERT INTO books (title,author) VALUES (:title,:author)";
  // $q = $db->prepare($sql);
  // $q->execute(array(':author'=>$author,

  //                   ':title'=>$title));

   
	
?>

