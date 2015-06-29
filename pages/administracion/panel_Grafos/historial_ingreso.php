
<h>VISITAS AL SISTEMA </h>

 <?php 
        $maindir = "../../../";
        require_once($maindir."conexion/conexion.php");
      
      try{

            $query = "Select YEAR(fecha_ingreso) as year, MONTHNAME(fecha_ingreso) as Mes, COUNT(day(fecha_ingreso)) as count
                      from (Select fecha_ingreso from usuario_logs where fecha_ingreso > now() - interval 5 month) as t1 group by month(fecha_ingreso)";
            $result = mysql_query($query, $conexion) or die("error en la consulta");

      }catch(PDOExecption $e){
            $mensaje="Error en la obtencion de datos";
            $codMensaje =0;
      }
  ?>

<script type="text/javascript">
    var chart;
    $(document).ready(function() {

        chart = new Highcharts.Chart({
            chart: {
                renderTo: 'graficaLineal',  // Le doy el nombre a la gráfica
                defaultSeriesType: 'line'   // Pongo que tipo de gráfica es
            },
            title: {
                text: 'Datos de las Visitas'    // Titulo (Opcional)
            },
            subtitle: {
                text: 'Fundacion Angelitos'     // Subtitulo (Opcional)
            },
            // Pongo los datos en el eje de las 'X'
            xAxis: {
                categories: 
                [
                    <?php 
                        $numItems = mysql_num_rows($result);
                        $cuenta = 0;        
                        while($row = mysql_fetch_array($result)){ 
                            $x = $row['Mes'].$row['year'];
                            echo "'".$x."'";
                            if(++$cuenta != $numItems) {
                                echo ",";
                            }  
                        }              
                    ?>   

                ],
                // Pongo el título para el eje de las 'X'
                title: {
                    text: 'Meses'
                }
            },
            yAxis: {
                // Pongo el título para el eje de las 'Y'
                title: {
                    text: 'Nº Visitas'
                }
            },
            // Doy formato al la "cajita" que sale al pasar el ratón por encima de la gráfica
            tooltip: {
                enabled: true,
                formatter: function() {
                    return '<b>'+ this.series.name +'</b><br/>'+
                        this.x +': '+ this.y +' '+this.series.name;
                }
            },
            // Doy opciones a la gráfica
            plotOptions: {
                line: {
                    dataLabels: {
                        enabled: true
                    },
                    enableMouseTracking: true
                }
            },
            // Doy los datos de la gráfica para dibujarlas
            series: [{
                        name: 'Visitas',
                        data: 
                        [
                            <?php 
                                $query = "Select YEAR(fecha_ingreso) as year, MONTHNAME(fecha_ingreso) as Mes, COUNT(day(fecha_ingreso)) as count
                                        from (Select fecha_ingreso from usuario_logs where fecha_ingreso > now() - interval 5 month) as t1 group by month(fecha_ingreso)";
                                $result = mysql_query($query, $conexion) or die("error en la consulta");
                                $numItems = mysql_num_rows($result);
                                $cuenta = 0;
                                while($row = mysql_fetch_array($result)){ 
                                    $y = $row['count'];
                                    echo $y;
                                    if(++$cuenta <= $numItems) {
                                        echo ",";
                                    }  
                                }
                            ?>
                        ],
                    }],
        }); 
    });             
</script>

<div id="graficaLineal" style="width: 100%; height: 500px; margin: 0 auto">
    <h1>Hola Mundo</h1>
</div>