<!-- esta pagina se encargar de registrar las salidas de producto -->

<?php
// <!-- Declaramos la direccion raiz -->
   $maindir = "../../../";
	 include ($maindir.'conexion/config.inc.php');
 ?>
 <div class="container">
	<h1 style="color :black;"><i class="glyphicon glyphicon-stats"></i> Inventario de Productos</h1>

 </div>
  <div class="box-body table-responsive ">
    <table id = "tabla_prductos" class='table table-bordered table-striped display' cellspacing="0" >
       <thead >
         <tr style="background-color: rgb(71, 58, 147); " >
           <th style= "color: white">Codigo</th>
           <th style= "color: white">nombre</th>
           <th style= "color: white">categoria</th>
           <th style= "color: white">En Inventario</th>
           <th> </th>
           <!-- <th style= "color: white">Cantidad</th> -->

         </tr>
       </thead>
       <tbody>
				<?php
				//ejecutamos la consulta con ayuda del archivo conexion.php que se encuentra arriba
					$query  = $db->prepare("select  i_producto.id_producto, i_producto.nombre, i_producto.tipo_producto, i_instancia_producto.cantidad FROM  i_producto inner join i_instancia_producto on i_instancia_producto.id_producto = i_producto.id_producto ");
					$query->execute();
					$result1 = $query->fetchAll();
						foreach($result1 as $row)
						{
  						echo "<tr>
  										<td><center> $row[id_producto] </td></center>
  										<td><center> $row[nombre] </td></center>
  										<td><center> $row[tipo_producto]</td></center>
                      <td><center> $row[cantidad]</td></center>


                      <td style=''>
                      	<a href='' class='btn btn-xs btn-primary'><i class='glyphicon glyphicon-time'></i> Historial</a>
                  		</td>
  									</tr>";
						}
				?>
				</tbody>
       </tbody>
   </table>
 </div>

<!--
<form method="post" class="form-horizontal" id="processsell" action="index.php?view=processsell">
    <div class="form-group">
        <div class="col-lg-offset-2 col-lg-10">
          <div class="checkbox">
            <label>
    		<a href="index.php?view=clearcart" class="btn btn-lg btn-danger"><i class="glyphicon glyphicon-remove"></i> Cancelar</a>
            <button class="btn btn-lg btn-primary"><i ></i> Finalizar Transaccion </button>
            </label>
          </div>
        </div>
      </div>
      <hr><hr>
</form> -->

<script type="text/javascript">
	$(document).ready(function(){
		$('#tabla_prductos').dataTable();

    $(".reabastecer").click(function(){
      // alert("reabas");
      $('#cuerpo').append("<tr><td>1</td><td>panal</td><td>5</td><td style='width:30px;''><a  class='btn btn-danger'><i class='glyphicon glyphicon-remove'></i> Cancelar</a></td></tr>");
      //  $("#cuerpo").append("
      //  <tr>
      //      <td>1</td>
      //      <td> panles</td>
      //      <td>5</td>
      //      <td> cancelar</td>
      //   </tr>
      //   <tr>
      //     <td>1</td>
      //     <td> panles</td>
      //     <td>5</td>
      //     <td> cancelar</td>
      //   </tr>"
      // );
      //

      //     var id = $('.reabastecer').data('id');
      //  $.get('pages/Inventario/panel_inventario/reabastecer_producto.php?producto_ID=' + id, function(html){
      //            $('#notificaciones').html(html);
       //
       //
      //   });
        });
	});

</script>
