<div>
      <h1 class="page-header">
          <small>Registrar Categoria</small>
      </h1>
      <ol class="breadcrumb">
          <li class="active">
              <span class="fa fa-dashboard"></span></i> Inventario
          </li>
           <li class="active">
              <i class="fa fa-table"></i>mantenimiento
          </li>
      </ol>
    </div>
    <h1 class="page-header" style="color:black;">Registrar nueva Categoria<button class="btn btn-default" data-toggle="modal" data-target="#compose-modal-insertar"><i class="glyphicon glyphicon-wrench"></i> Agregar </button></h1>


  <div class="box-body table-responsive ">
    <table id = "tabla_categorias" class='table table-bordered table-striped display' cellspacing="0" >
       <thead >
         <tr style="background-color: rgb(71, 58, 147);" >
           <th style= "color: white">Codigo</th>
            <th style= "color: white">imagen</th>
           <th style= "color: white">nombre</th>
           <th style= "color: white">categoria</th>

           <th style= "color: white">Acciones</th>
         </tr>
       </thead>
       <tbody>
         <tr class="">
        		<td style="width:80px;">2</td>
            <td>-----</td>
        		<td>toallas</td>
        		<td>insumos</td>

            <td style="width:70px;">
          		<a href="index.php?view=editproduct&amp;id=2" class="btn btn-xs btn-warning"><i class="glyphicon glyphicon-pencil"></i></a>
          		<a href="index.php?view=delproduct&amp;id=2" class="btn btn-xs btn-danger"><i class="fa fa-trash"></i></a>
      		</td>

        	</tr>
       <?php

       ?>
       </tbody>
   </table>
 </div>
 <!-- fin tabla -->


<script type="text/javascript">
$('#tabla_categorias').dataTable();

</script>
