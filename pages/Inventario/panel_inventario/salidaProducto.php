<!-- esta pagina se encargar de registrar las salidas de producto -->
	<h1 style="color: black; margin-left:30px;">Nueva salida</h1>
  <div class="box-body table-responsive ">
    <table id = "tabla_prductos" class='table table-bordered table-striped display' cellspacing="0" >
       <thead >
         <tr style="background-color: rgb(71, 58, 147);" >
           <th style= "color: white">Codigo</th>
           <th style= "color: white">nombre</th>
           <th style= "color: white">unidad</th>
           <th style= "color: white">En Inventario</th>
           <th style= "color: white">Cantidad</th>
           <th style= "color: white">Agregar a la salida</th>
         </tr>
       </thead>
       <tbody>
         <tr class="">
        		<td style="width:80px;">2</td>
        		<td>toallas</td>
        		<td>50</td>

        		<td>	48		</td>
        		<td>
        		<input type="hidden" name="product_id" value="2">
        		<input type="" class="form-control" required="" name="q" placeholder="Cantidad de producto ..."></td>
        		<td style="width:183px;">
        		<button type="submit" class="btn btn-primary"><i class="glyphicon glyphicon-shopping-cart"></i> Agregar a la Salida</button>
        		</td>
        	</tr>
       <?php

       ?>
       </tbody>
   </table>
 </div>
 <!-- fin tabla -->


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
$('#tabla_prductos').dataTable();

</script>
