

<!---INFORMACION DE LA PAGINA- -->


<?php 
  // <!-- Declaramos la direccion raiz -->
    // <!-- Declaramos la direccion raiz -->
  $maindir = "../../../";

// <!-- anadimos los archivos necesarios para trabajar-->

//acceso a bases de datos
include ($maindir.'conexion/conexion.php');

// verifica la sesion
require_once($maindir."login/seguridad.php");
 
// // verifica el tiempo de la sesion 
require_once($maindir."login/time_out.php");

  $id = (int)$_GET['usuario_ID'];

  $query_1 = "select usuario.usuario_ID, usuario.usuario, usuario.rol_ID, usuario.fecha_creacion, fecha_alta, usuario.estado,
            rol.descripcion from usuario INNER JOIN rol ON usuario.rol_ID = rol.rol_ID WHERE usuario.usuario_ID = '".$id."';";
  $result_1 = mysql_query($query_1, $conexion) or die("erorr consulta sql");
  $dato1 = mysql_fetch_array($result_1);
  ?>

<form id = "form_insertar_usuario" class="form" role="form" name="form_insertar" >
          <div class="form-group">
           
         
          <div id="verUserName" class="form-group">
                        <label>Nombre del usuario</label>
                        <input type="text" class="form-control" id="nombreUsuario" maxlength="30" value="<?php echo $dato1['usuario']; ?>" required>
                    </div>
          <div id="verPass" class="form-group">
                        <label>Contraseña </label>
                        <input type="password" class="form-control" id="password" name="password" maxlength="20" required>
                    </div>
          <div id="verPass2" class="form-group">
                        <label class="control-label">Repetir contraseña</label>
                        <input type="password" class="form-control" id="password2" name="password2" maxlength="20" required>
                    </div>
          <div class="form-group">
            <label class="" for="pwd">Rol del usuario</label>
            <div class="col-sm-10"> 
                <select id = "rol" class="form-control">
                    <option> -- Seleccione un rol de usuario -- </option>
                    <!-- cargamos los roles desde la base de datos -->
                   <?php
                    $query2 = "SELECT rol.rol_ID, rol.descripcion FROM rol ";

                    $result2 = mysql_query($query2, $conexion) or die("asdfasdf");
                    while($row=mysql_fetch_array($result2))
                      { ?>

                       <option <?php if($row['rol_ID'] == $dato1['rol_ID']){ echo 'selected'; } ?> value="<?php echo $row['rol_ID'];?>"> <?php echo $row['descripcion'] ?> </option>
                      <?php  }
                      ?> 
                    
                </select>
            </div>
          </div>
          <br><br>
          <div class="form-group">
            <br>
                        <label class = "control-label">Estado del usuario</label>
              <?php 
              if($dato1['estado'] == 0){
                  echo "<input class = 'bootstrapSwitch bootstrap-switch-wrapper bootstrap-switch-id-switch-state bootstrap-switch-animate bootstrap-switch-on' data-id = '0' data-on-color = 'primary' data-off-color  = 'danger' data-off-text = 'Inactivo' data-on-text = 'activo' type='checkbox' name='my-checkbox'   checked>  ";
              }else{
                  echo  "<input class = 'bootstrapSwitch bootstrap-switch-wrapper bootstrap-switch-id-switch-state bootstrap-switch-animate bootstrap-switch-on' data-id = '1' data-on-color = 'primary' data-off-color = 'danger' data-off-text = 'Inactivo' data-on-text = 'activo' type='checkbox' name='my-checkbox' > ";
              } 
              ?>
          </div> 
        </form>         
     <!-- final form -->
     <script>

       $("[name='my-checkbox']").bootstrapSwitch();
       $('[name="my-checkbox"]').on('switchChange.bootstrapSwitch', function(event, state) {
          
       });

     </script>


