<!-- esta pagina se encargar de registrar las salidas de producto -->

<?php
// <!-- Declaramos la direccion raiz -->
   $maindir = "../../../";
	 include ($maindir.'conexion/config.inc.php');
 ?>
	<h1 style="color: black; margin-left:30px;">Reabastecer Producto</h1>
  <div class="box-body table-responsive ">
    <table id = "tabla_prductos" class='table table-bordered table-striped display' cellspacing="0" >
       <thead >
         <tr style="background-color: #5cb85c " >
           <th style= "color: white">Codigo</th>
           <th style= "color: white">nombre</th>
           <th style= "color: white">unidad</th>
           <th style= "color: white">En Inventario</th>
           <th style= "color: white">Cantidad</th>
           <th style= "color: white">Agregar al inventario</th>
         </tr>
       </thead>
       <tbody>
				<?php
				//ejecutamos la consulta con ayuda del archivo conexion.php que se encuentra arriba
					$query  = $db->prepare("select id, name, unit  FROM product");
					$query->execute();
					$result1 = $query->fetchAll();
						foreach($result1 as $row)
						{

						echo "<tr>
										<td><center> $row[id] </td></center>
										<td><center> $row[name] </td></center>
										<td><center> $row[unit]</td></center>
										<td> pendiente</td>
										<td>
											<input type='' class='form-control' required='' name='cantidad' placeholder='Cantidad de producto ...'>
										</td>
										<td><center>
											<button  type='submit' class='btn btn-success reabastecer'  data-toggle='confirmation' data-placement='left' data-id = $row[id] ><i class='glyphicon glyphicon-refresh'></i> Agregar</button>
										</td></center>

									</tr>";
						}
				?>
				</tbody>
       </tbody>
   </table>
 </div>
 <!-- fin tabla -->
 <div class="container">
   <h1 class="page-header">
       <small>Historial Transaccion</small>
   </h1>

 </div>
 <div class="box-body" style="width:300px ;margin-left :100px;">
   <table id = "resumen" class="table table-bordered ">
     <thead>
       <tr>
         <td>id</td>
         <td> nombre</td>
         <td>cantidad</td>
         <td> Accion</td>
       </tr>

     </thead>
     <tbody id = "cuerpo">

     </tbody>
   </table>
 </div>


<form method="post" class="form-horizontal" id="processsell" action="index.php?view=processsell">
    <div class="form-group">
        <div class="col-lg-offset-2 col-lg-10">
          <div class="checkbox">
            <label>
    		<a href="index.php?view=clearcart" class="btn btn-lg btn-danger"><i class="glyphicon glyphicon-remove"></i> Cancelar</a>
            <button class="btn btn-lg btn-primary"><i ></i> Finalizar </button>
            </label>
          </div>
        </div>
      </div>
      <hr><hr>
</form>

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
