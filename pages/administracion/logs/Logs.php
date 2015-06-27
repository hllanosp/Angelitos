
<!---INFORMACION DE LA PAGINA- -->


<?php 


 // <!-- Declaramos la direccion raiz -->
  $maindir = "../../../";

// <!-- anadimos los archivos necesarios para trabajar-->

//acceso a bases de datos
include ($maindir.'conexion/conexion.php');

// verifica la sesion

 
// // verifica el tiempo de la sesion 
require_once($maindir."login/time_out.php");

  ?>

  <section >



     <div class="box-body table-responsive">
       <table id = "tabla_usuarios" class='table table-bordered table-striped' cellspacing="0" width="100%" >
          <thead>
            <tr>
              <th>Usuario</th>
              <th>Fecha Ingreso</th>
              <th>Duración</th>
              <th>IP</th>

            </tr>
          </thead>
          <tbody>
          <?php
          //ejecutamos la consulta con ayuda del archivo conexion.php que se encuentra arriba
            $query = "SELECT usuario_log,fecha_ingreso,fecha_salida,ip_conexion FROM usuario_logs ORDER BY fecha_ingreso DESC  ";
            $result = mysql_query($query, $conexion) or die("asdfasdf");
            
            // aqui se rellena las filas
           while($row=mysql_fetch_array($result))
              {
              
               echo "<tr>
                       <td> $row[usuario_log] </td>
                       <td> $row[fecha_ingreso] </td>
                       <td> $row[fecha_salida]</td>
					    <td> $row[ip_conexion]</td>
                    </tr>";
              }
          ?> 
          </tbody>
      </table>
    </div>
    <!-- fin tabla -->
    
  </section>
  
  <script type="text/javascript" charset="utf-8">
  $(document).ready(function() {
    $('#tabla_logs').dataTable({}); // example es el id de la tabla
	
	$('#tabla_logs')
    .removeClass( 'display' )
    .addClass('table table-striped table-bordered');
  });
</script>



