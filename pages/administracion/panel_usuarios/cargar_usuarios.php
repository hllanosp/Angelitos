
<!---INFORMACION DE LA PAGINA- -->


<?php 


 // <!-- Declaramos la direccion raiz -->
  $maindir = "../../";

// <!-- anadimos los archivos necesarios para trabajar-->

//acceso a bases de datos
include ($maindir.'conexion/conexion.php');

// verifica la sesion

 
// // verifica el tiempo de la sesion 
require_once($maindir."login/time_out.php");

  ?>

  <section >
    <h3 class="box-title" style = "color:black">Usuarios</h3>


     <div class="box-body table-responsive ">
       <table id = "tabla_usuarios" class='table table-bordered table-striped display' cellspacing="0" >
          <thead >
            <tr>
              <th>Usuario</th>
              <th>Rol</th>
              <th>Fecha Creacion</th>
              <th>Estado</th>
              <th>Editar</th>
            </tr>
          </thead>
          <tbody>
          <?php
          //ejecutamos la consulta con ayuda del archivo conexion.php que se encuentra arriba
            $query = "SELECT usuario.usuario, usuario.usuario_ID, usuario.rol_ID, usuario.fecha_creacion, usuario.estado, rol.rol_ID, rol.descripcion FROM usuario INNER JOIN rol ON usuario.rol_ID = rol.rol_ID";
            $result = mysql_query($query, $conexion) or die("asdfasdf");
            
            // aqui se rellena las filas
           while($row=mysql_fetch_array($result))
              {
               $estado = $row['estado'];
               echo "<tr>
                       <td> $row[usuario] </td>
                       <td> $row[descripcion] </td>
                       <td> $row[fecha_creacion]</td>";
                        if ($estado == 0) {
                         echo"
                           <td>
                              <input data-off-color  = 'success' data-off-text = 'Activo' data-on-text = 'activo' type='checkbox' name='checkbox_tabla' disabled >
                           </td>";

                       }
                       else{
                        echo"
                        
                           <td>
                              <input data-on-color = 'danger' data-off-text = 'Inactivo' data-on-text = 'Inactivo' type='checkbox' name='checkbox_tabla' disabled checked>
                           </td>";
                       }
                       echo"
                       <td>
                          <button data-id = \"$row[usuario_ID]\" href=\"#\" class = \"btn_editar btn btn-info\" id = \"editar\" data-toggle=\"modal\" data-target = \"#modal_editar_usuario\">Actualizar</button>
                        </td>
                    </tr>";
              }
          ?> 
          </tbody>
      </table>
    </div>
    <!-- fin tabla -->
    
  </section>

<!-- modal para modificar datos del usuario -->
<!-- ===============MODAL PARA EDITAR LA INFORMACION DEL USUARIO -->
<!-- Modal nuevo_usuario-->
<div class="modal fade" id="modal_editar_usuario" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title"><i class="glyphicon glyphicon-floppy-disk"></i> Editar Datos de Usuario </h4>
      </div>
      <div class="modal-body">
        <!-- aqui se cargar el form actualizado con los datos del usuario a modificar -->
      </div>
     <div class="modal-footer clearfix">
            <button   id="editar_usuario" class="btn btn-primary">Agregar</button>
          </div>
    </div>
  </div>
</div>

    <!-- fin modal nuevo usuario-->



<script type="text/javascript" charset="utf-8">
  $(document).ready(function() {
    // stilos de los switches
    $("[name='checkbox_tabla']").bootstrapSwitch();
    

    
		$(".btn_editar").on('click',function(){
          

          id = $(this).data('id');
          // alert('id='+id);
		   $.get('pages/administracion/panel_usuarios/modal_editar_usuario.php?usuario_ID=' + id, function(html){
                 $('#modal_editar_usuario .modal-body').html(html);
                 $('#modal_editar_usuario').modal('show', {backdrop: 'static'});
		    });
        });
		 // example es el id de la tabla
		    $('#tabla_usuarios').dataTable();
	
      });
</script>
