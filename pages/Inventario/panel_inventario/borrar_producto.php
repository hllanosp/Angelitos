<?php
// <!-- Declaramos la direccion raiz -->
   $maindir = "../../../";
   include ($maindir.'conexion/config.inc.php');

    $matrizResumen = $_GET['matrizResumen'];
    $filas = $_GET["i"];
    $elementos = $_GET["j"];

    $columnas = $elementos/($filas - 1);
    $elemento = 0;

    $stament2 = $db->prepare("CALL aumentar_STOCK(?,?)");
    for($i = 1; $i < $filas; $i++){
        $r = 0;
        for ($j= 1; $j <= $columnas; $j++){
            if (($j+1)%2 == 0){
                $stament2->bindValue($j-$r, $matrizResumen[$elemento]);
                $r++;
            }
                $elemento++;
        }
      //
      // $stament2 = $db->prepare("CALL aumentar_STOCK(?,?,?)");
      // for($i = 1; $i < $filas; $i++){
      //     for ($j= 1; $j <= columnas; $j++){
      //         if ($elemento%2 == 0){
      //           $stament2->bindValue($j, $matrizResumen[$elemento]);
      //         }
      //         $elemento++;
      //     }
      //     $stament2->execute();
      //     $stament2->closeCursor();
      // }

    $mensaje = 'La transaccion se realizo correctamente';
    echo '<div class="alert alert-success alert-succes">
      <a href="#" class="close" data-dismiss="alert">&times;</a>
      <strong> Exito! </strong>'.$mensaje.'</div>';


?>
