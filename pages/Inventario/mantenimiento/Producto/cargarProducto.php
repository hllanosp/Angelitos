<?php
$mkdir = "../../../../";
include($mkdir."conexion/config.inc.php");

    /* Hacemos una consulta a la base de datos para obtener los datos de la tabla Categorias. */
        $query = $db->prepare("SELECT i_producto.id_producto, i_producto.nombre, i_tipo_producto.descripcion as tipo , i_marca.descripcion as marca 
                               FROM i_producto INNER JOIN i_tipo_producto ON(i_tipo_producto.id_tipo_producto = i_producto.tipo_producto)
                               INNER JOIN i_marca ON(i_marca.id_marca = i_producto.id_marca)");
        $query->execute();
        $result = $query->fetchAll();
        $json = array();
        $contadorIteracion = 0;


        foreach($result as $fila){ 
            $json[$contadorIteracion] = array
                (
                "codProducto" => $fila["id_producto"],
                "nombreProducto" => $fila["nombre"],
                "nombreTipo" => $fila["tipo"],
                "nombreMarca" => $fila["marca"]
                );

            $contadorIteracion++;
        }

        //Retornamos el jason con todos los elmentos tomados de la base de datos.
        echo json_encode($json);
?>

