<?php  
$mkdir = "../../../../";
include($mkdir."conexion/config.inc.php");
    $pcCod = $_POST['id'];
    $query = $db->prepare('SELECT * FROM i_marca  WHERE i_marca.id_marca ='.$pcCod);
    $query->execute();
    $result = $query->fetchAll();
    $json = array();
    $contadorIteracion = 0;
    foreach ($result as $fila) { 
        $json[$contadorIteracion] = array
            (
                "codMarca" => $fila["id_marca"],
                "nombreMarca" => $fila["descripcion"]
            );

        $contadorIteracion++;
    }

    //Retornamos el jason con todos los elmentos tomados de la base de datos.
    echo json_encode($json);
?>