<div>
      <h1 class="page-header">
          <small>Usuarios Activos en el Sistema</small>
      </h1>
      <ol class="breadcrumb">
          <li class="active">
              <span class="fa fa-dashboard"></span></i> Administracion
          </li>
           <li class="active">
              <i class="fa fa-table"></i> Usuarios Activos
          </li>
      </ol>
</div>
<?php 
  // <!-- Declaramos la direccion raiz -->
  $maindir = "../../../";

//acceso a bases de datos
include ($maindir.'conexion/conexion.php');

// // verifica la sesion
// require_once($maindir."login/seguridad.php");
 
// // // verifica el tiempo de la sesion 
// require_once($maindir."login/time_out.php");

  try{

    $query = "select count(estado) as cuenta from usuario where estado = 1";
    $result = mysql_query($query, $conexion) or die("error en la consulta");

    $query = "select count(estado) as cuenta from usuario where estado = 0";
    $result1 = mysql_query($query, $conexion) or die("error en la consulta");
    
    $numero = mysql_fetch_array($result);
    $numero1 = mysql_fetch_array($result1);
    $codMensaje = 1;
  }
  catch(PDOExecption $e){
    $mensaje="Error en la obtencion de datos";
    $codMensaje =0;
  }


?>

    
<script type="text/javascript">
 $(document).ready(function () {
    $('#graficaUsers').highcharts({
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

<div id="graficaUsers" style="width: 100%; height: 500px; margin: 0 auto">
    <h1>Hola Mundo</h1>
</div>