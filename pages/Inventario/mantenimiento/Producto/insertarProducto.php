<?php  
$mkdir = "../../../../";
include($mkdir."conexion/config.inc.php");
    $pcnombre = $_POST['nombreProducto'];
    $pctipo = $_POST['tipoProducto'];
    $pcMarca = $_POST['marcas'];
    try{
        $sql = "CALL SP_REGISTRAR_PRODUCTO(?,?,?,@mensajeError)";
        $query1 = $db->prepare($sql);
        $query1->bindParam(1,$pcnombre,PDO::PARAM_STR);
        $query1->bindParam(2,$pctipo,PDO::PARAM_STR);
        $query1->bindParam(3,$pcMarca,PDO::PARAM_STR);
        $query1->execute();

        $output = $db->query("select @mensajeError")->fetch(PDO::FETCH_ASSOC);
        $mensaje = $output['@mensajeError'];
        
        if(is_null($mensaje)){

            echo '<div class="alert alert-success alert-succes">
                <a href="#" class="close" data-dismiss="alert">&times;</a>
                <strong> Exito! </strong>'.$mensaje.'</div>';

        }else{
           echo '<div class="alert alert-danger alert-yellow">
                <a href="#" class="close" data-dismiss="alert">&times;</a>'.$mensaje.'</div>';
        }


    }catch(PDOExecption $e){

        echo '<div class="alert alert-danger alert-error">
            <a href="#" class="close" data-dismiss="alert">&times;</a>
            <strong> Error! </strong>'.$mensaje.'</div>';
    }
    
?>