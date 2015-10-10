<!-- esta pagina se encargar de registrar las salidas de producto -->

<?php
// <!-- Declaramos la direccion raiz -->
   $maindir = "../../../";
	 include ($maindir.'conexion/config.inc.php');
 ?>
	<h1 style="color: black; margin-left:40px;">Reabastecer Producto</h1>
  <div class="box-body table-responsive ">
    <div class="" >
    <table id = "tabla_reabastecer_prductos" class='table table-bordered table-striped display' cellspacing="0" >
       <thead >
         <tr style="background-color: #5cb85c " >
           <th style= "color: white">Codigo</th>
           <th style= "color: white">nombre</th>
           <th style= "color: white">categoria</th>
           <th style= "color: white">En Inventario</th>
           <th style= "color: white">Cantidad</th>
           <th style= "color: white">fecha vencimiento</th>
           <th style= "color: white">Registrar Salida</th>
         </tr>
       </thead>
       <tbody>
				<?php
				//ejecutamos la consulta con ayuda del archivo conexion.php que se encuentra arriba
					$query  = $db->prepare("CALL PA_resumen()");
					$query->execute();
					$result1 = $query->fetchAll();
						foreach($result1 as $row)
						{

						echo "<tr>
                    <td><center> $row[id_producto] </td></center>
                    <td><center> $row[nombre] </td></center>
                    <td><center> $row[tipo_producto]</td></center>
                    <td><center> $row[cantidad]</td></center>
										<td class = 'campo_cantidad'>
											<input type='number' class='form-control cantidad' required=''  name='cantidad' placeholder='Cantidad de producto ...'></input>
										</td>
                    <td class = 'campo_fecha'>
											<input type='date' class='form-control fecha' required=''  name='fecha_vencimiento' placeholder='fecha vencimiento ...'></input>
										</td>
										<td class = 'reabastecer' data-id = $row[id_producto] data-nombre = $row[nombre]>

											<button  type='' class='btn btn-success '  data-toggle='confirmation' data-placement='left'  ><i class='glyphicon glyphicon-refresh'></i> Agregar</button>
										</td>

									</tr>";
						}
				?>
				</tbody>
       </tbody>
     </table>
   </div>

 <!-- fin tabla -->
  <div class="col-xs-8" style="margin-left:20%;">
       <div class="panel panel-default">
               <div class="panel-heading">
                   <label><span class="glyphicon glyphicon-list" aria-hidden="true"></span> Resumen Transaccion Actual</label>
               </div>
               <div class="panel-body ">
                 <table id = "resumen" class="table table-bordered ">
                   <thead>
                     <tr>
                       <td>id</td>
                       <td> nombre</td>
                       <td>cantidad</td>
                       <td hidden="true"> fecha </td>
                       <td> Accion</td>
                     </tr>
                   </thead>
                   <tbody id = "tbl_resumen_cuerpo">

                   </tbody>
                 </table>

               </div>
       </div>
       <div class="" style="margin:auto;">
        <div class="form-horizontal" id="form_resumen" >
            <div class="form-group">
                <div class="col-lg-offset-2 col-lg-10">
                  <div class="checkbox">
                    <label>
            		<a class="btn  btn-danger"><i class="glyphicon glyphicon-remove"></i> Cancelar</a>
                    <button id ="enviarResumen" class="btn  btn-primary"><i class ='glyphicon glyphicon-shopping-cart' ></i> Finalizar Transaccion </button>
                    </label>
                    <div id="notificaciones"></div>
                  </div>
                </div>
              </div>
        </div>

       </div>

   </div>

</div>

<script type="text/javascript">
	$(document).ready(function(){
		$('#tabla_reabastecer_prductos').dataTable();

    $(".reabastecer").click(function(){
      var producto_ID = $(this).data('id');
      var producto_nombre = $(this).data('nombre');

        var cantidad = 0 ;
        var fila = $(this).parent('tr');
        var fila_td =$(fila).children('td.campo_cantidad');
        var fila_td_input = $(fila_td).children('input.cantidad');
        cantidad = $(fila_td_input).val();

        var fecha = '' ;
        var fila = $(this).parent('tr');
        var fila_td =$(fila).children('td.campo_fecha');
        var fila_td_input = $(fila_td).children('input.fecha');
        fecha = $(fila_td_input).val();


        if (cantidad > 0) {
          $('#tbl_resumen_cuerpo').append("<tr><td>"+producto_ID+"</td><td>"+producto_nombre+"</td><td>"+cantidad+"</td><td hidden = 'true'>"+fecha+"</td><td class= 'eliminar'  style='width:30px;''><a  class='btn btn-danger'><i class='glyphicon glyphicon-remove'></i> Cancelar</a></td></tr>");
        }
    });

    $(document).on("click",".eliminar",function(){
     var parent = $(this).parent('tr');
     $(parent).remove();
    });

    $("#Agregar").click(function(){
        producto = $("#producto").val();
        cantidad = $("#cantidad").val();
        $("#resumen").append("<tr><td>"+producto+"</td><td>"+cantidad+"</td></tr>");
        producto = $("#producto").val("");
        cantidad = $("#cantidad").val("");
    });

    $("#enviarResumen").click(function(){
        var matrizResumen = [,];
        var i = 0;
        var j = 0;

        $("#tbl_resumen_cuerpo tr").each(function(){
            $(this).find('td').each(function(){
                matrizResumen[i,j] = $(this).text();
                j++;
            });
            i++;
        });

        $.get("pages/Inventario/panel_inventario/insertar_producto.php", {matrizResumen: matrizResumen, i: i, j: j},function(html){

        $("#notificaciones").html(html);
        $("#notificaciones").fadeOut(4500);
        $('#tbl_resumen_cuerpo').remove();
        $("#cuerpo_panel_inventario" ).load( "pages/Inventario/panel_inventario/reabastecer_producto.php"  );
        });
    });
	});
</script>
