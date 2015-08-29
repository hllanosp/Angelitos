<!-- esta pagina se encargar de registrar las salidas de producto -->

<?php
// <!-- Declaramos la direccion raiz -->
   $maindir = "../../../";
	 include ($maindir.'conexion/config.inc.php');
 ?>
 <div class="container">
	<h1 style="color :black;"><i class="glyphicon glyphicon-stats"></i> Historia de Salidas de Productos</h1>

 </div>
  <div class="box-body table-responsive ">
    <table id = "tabla_prductos" class='table table-bordered table-striped display' cellspacing="0" >
       <thead >
         <tr style="background-color: #f0ad4e " >
           <th style= "color: white">Producto</th>
           <th style= "color: white">Cantidad</th>
           <th style= "color: white">Fecha salida</th>
           <th style= "color: white">Usuario</th>
           <!-- <th style= "color: white">Cantidad</th> -->

         </tr>
       </thead>
       <tbody>
				<?php
				//ejecutamos la consulta con ayuda del archivo conexion.php que se encuentra arriba
					$query  = $db->prepare("CALL PA_salidas()");
					$query->execute();
					$result1 = $query->fetchAll();
						foreach($result1 as $row)
						{
  						echo "<tr>
  										<td><center> $row[producto] </td></center>
  										<td><center> $row[cantidad_salida] </td></center>
  										<td><center> $row[fecha_salida]</td></center>
                      <td><center> $row[usuario]</td></center>
  									</tr>";
						}
				?>
				</tbody>
       </tbody>
   </table>
 </div>

<script type="text/javascript">
	$(document).ready(function(){
		$('#tabla_prductos').dataTable();


	});

</script>
