<?php  
$mkdir = "../../../../";
include($mkdir."conexion/config.inc.php");
    $pcCod = $_POST['id'];
    $query = $db->prepare('SELECT * FROM i_tipo_producto  WHERE i_tipo_producto.id_tipo_producto ='.$pcCod);
    $query->execute();
    $result = $query->fetchAll();
    $json = array();
    $contadorIteracion = 0;
    foreach ($result as $fila) { 
        $json[$contadorIteracion] = array
            (
                "codCategoria" => $fila["id_tipo_producto"],
                "nombreCategoria" => $fila["descripcion"]
            );

        $contadorIteracion++;
    }

    //Retornamos el jason con todos los elmentos tomados de la base de datos.
    echo json_encode($json);
?>