
<?php 
  // <!-- Declaramos la direccion raiz -->
  $maindir = "../../";

//acceso a bases de datos
include ($maindir.'conexion/conexion.php');

// // verifica la sesion
// require_once($maindir."login/seguridad.php");
 
// // // verifica el tiempo de la sesion 
// require_once($maindir."login/time_out.php");

?>

<?php 

  try{

    $query = "select count(estado) as cuenta from usuario where estado = 1";
    $result = mysql_query($query, $conexion) or die("error en la consulta");

    $query = "select count(estado) as cuenta from usuario where estado = 0";
    $result1 = mysql_query($query, $conexion) or die("error en la consulta");
    
    $numero = mysql_fetch_array($result);
    $numero1 = mysql_fetch_array($result1);
    
    echo $numero1["cuenta"];
    $codMensaje = 1;
  }
  catch(PDOExecption $e){
    $mensaje="Error en la obtencion de datos";
    $codMensaje =0;
  }


?>

<script>
 $(function () {
    $('#container').highcharts({
        chart: {
            plotBackgroundColor: null,
            plotBorderWidth: 0,
            plotShadow: false
        },
        title: {
            text: 'Usuarios<br>Activos',
            align: 'center',
            verticalAlign: 'middle',
            y: 50
        },
        tooltip: {
            pointFormat: '<b>{point.y}</b>'
        },
        plotOptions: {
            pie: {
                dataLabels: {
                    enabled: true,
                    distance: -50,
                    style: {
                        fontWeight: 'bold',
                        color: 'white',
                        textShadow: '0px 1px 2px black'
                    }
                },
                startAngle: -90,
                endAngle: 90,
                center: ['50%', '60%']
            }
        },
        series: [{
            type: 'pie',
            name: 'Usuarios Activos',
            innerSize: '50%',
            data: [
                <?php
                  echo '["Activos",'.$numero["cuenta"].'],';
                  echo '["Desactivos",'.$numero1["cuenta"].']';
                ?>
            ]
        }]
    });
});

</script>