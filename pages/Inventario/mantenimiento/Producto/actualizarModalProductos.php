<?php  
$mkdir = "../../../../";
include($mkdir."conexion/config.inc.php");
    $pcCod = $_GET['id'];
    $query = $db->prepare('SELECT * FROM i_producto  WHERE i_producto.id_producto ='.$pcCod);
    $query->execute();
    $result = $query->fetchAll();
    $json = array();
    $contadorIteracion = 0;
    foreach ($result as $fila) { 
        $json[$contadorIteracion] = array
            (
                "codProducto" => $fila["id_producto"],
                "nombreProducto" => $fila["nombre"],
                "idTipo" => $fila["tipo_producto"],
                "marca" => $fila["id_marca"]
            );

        $contadorIteracion++;
    }

    //Retornamos el jason con todos los elmentos tomados de la base de datos.
    echo json_encode($json);
?>