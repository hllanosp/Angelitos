<?php
  session_start() ;
  $usuario_ID = $_SESSION['usuario_ID'];
// <!-- Declaramos la direccion raiz -->
   $maindir = "../../../";
   include ($maindir.'conexion/config.inc.php');


    $matrizResumen = $_GET['matrizResumen'];
    $filas = $_GET["i"];
    $elementos = $_GET["j"];

    $columnas = $elementos/($filas);
    $elemento = 0;

    for($i = 1; $i <= $filas; $i++){
      $stament2 = $db->prepare("CALL PA_nueva_instancia(?,?,?)");
  		$stament2->execute(array($matrizResumen[$elemento],$matrizResumen[$elemento+2],$matrizResumen[$elemento+3]));
  		$stament2->closeCursor();

      $stament2 = $db->prepare("CALL PA_instancia_producto(?)");
      $stament2->execute(array($matrizResumen[$elemento]));
      while($row= $stament2->fetch())
        {

         $indice = $row['indice'];
        }
      $stament2->closeCursor();

      $stament2 = $db->prepare("CALL PA_nueva_entrada(?,?,?)");
      $stament2->execute(array($indice, $matrizResumen[$elemento+2],$usuario_ID));
      $stament2->closeCursor();

      $elemento = $elemento + $columnas;
     }

    $mensaje = 'La transaccion se ha realizado correctamente';
    echo '<div class="alert alert-success alert-succes">
      <a href="#" class="close" data-dismiss="alert">&times;</a>
      <strong> Exito! </strong>'.$mensaje.'</div>';


?>
