<?php
$mkdir = "../../../../";
include($mkdir."conexion/config.inc.php");

    /* Hacemos una consulta a la base de datos para obtener los datos de la tabla marca. */
        $query = $db->prepare("SELECT * FROM i_marca");
        $query->execute();
        $result = $query->fetchAll();
        $json = array();
        $contadorIteracion = 0;


        foreach($result as $fila){
            $json[$contadorIteracion] = array
                (
                "codigo" => $fila["id_marca"],
                "nombre" => $fila["descripcion"]
                );

            $contadorIteracion++;
        }

        //Retornamos el jason con todos los elmentos tomados de la base de datos.
        echo json_encode($json);
?>
