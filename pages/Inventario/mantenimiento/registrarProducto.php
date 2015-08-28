<div>
      <h1 class="page-header">
          <small>registrar Producto</small>
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
    <h1 class="page-header" style="color:black;">Registrar nueva Categoria </h1><button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">Open Modal</button>

    <!-- Modal -->
    <div id="myModal" class="modal fade" role="dialog">
    <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
    	<div class="modal-header">
    		<button type="button" class="close" data-dismiss="modal">&times;</button>
    		<h4 class="modal-title">Modal Header</h4>
    	</div>
    	<div class="modal-body">
    		<p>Some text in the modal.</p>
    	</div>
    	<div class="modal-footer">
    		<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
    	</div>
    </div>

    </div>
    </div>

  <div class="box-body table-responsive ">
    <table id = "tabla_prductos_man" class='table table-bordered table-striped display' cellspacing="0" >
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
          		<a href="index.php?view=editproduct&amp;id=2" class="btn btn-xs btn-warning"><i class="glyphicon glyphicon-edit"></i></a>
          		<a href="index.php?view=delproduct&amp;id=2" class="btn btn-xs btn-danger"><i class="glyphicon glyphicon-trash"></i></a>
      		</td>

        	</tr>
       <?php

       ?>
       </tbody>
   </table>
 </div>
 <!-- fin tabla -->


<script type="text/javascript">
$('#tabla_prductos_man').dataTable();

</script>
