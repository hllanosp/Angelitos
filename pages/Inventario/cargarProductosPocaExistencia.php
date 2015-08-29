<?php
$mkdir = "../../";
include($mkdir."conexion/config.inc.php");

    /* Hacemos una consulta a la base de datos para obtener los datos de la tabla de productos que tienen menor de 10. */
        $query = $db->prepare("select i_producto.nombre, i_instancia_producto.cantidad 
                            from i_instancia_producto 
                            inner join i_producto on(i_instancia_producto.id_producto = i_producto.id_producto)
                            where i_instancia_producto.cantidad <= 10 LIMIT 10" );
        $query->execute();
        $result = $query->fetchAll();
        $json = array();
        $contadorIteracion = 0;


        foreach($result as $fila){ 
            $json[$contadorIteracion] = array
                (
                    "producto" => $fila["nombre"],
                    "cantidad" => $fila["cantidad"]
                );

            $contadorIteracion++;
        }

        //Retornamos el jason con todos los elmentos tomados de la base de datos.
        echo json_encode($json);
?>

