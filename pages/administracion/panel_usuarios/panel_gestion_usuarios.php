
<!---INFORMACION DE LA PAGINA- -->


<?php 
  // <!-- Declaramos la direccion raiz -->
  $maindir = "../../";


// <!-- Inicializamos el contenido de esta pagina> -->

  // if(isset($_GET['contenido']))
  //     {
  //       $contenido = $_GET['contenido'];
  //     }
  //   else
  //     {
  //       $contenido = 'administracion';
  //     }


// <!-- anadimos los archivos necesarios para trabajar-->

//acceso a bases de datos
include ($maindir.'conexion/conexion.php');

// verifica la sesion
// require_once($maindir."login/seguridad.php");
 
// // verifica el tiempo de la sesion 
//require_once($maindir."login/time_out.php");

  ?>


<!-- =====================cuerpo del panel============================ -->

<div class="container">
  <div class="col-lg-3 col-md-6"><a>
                </a>
                <div class="panel panel-default"><a>
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-3">
                                <i class="fa fa-user fa-5x"></i>
                            </div>
                            <div class="col-xs-9 text-right">
                                <div>Agregar</div>
                            </div>
                        </div>
                    </div>
                    </a>
                      <a>
                        <div class="panel-footer" data-toggle="modal" data-target="#modal_insertar_usuario">
                            <span class="pull-left">Nuevo Usuario</span>
                            <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                            <div class="clearfix"></div>
                        </div>
                      </a>
                </div>
            </div>
  
</div>
<!-- Resultado de la modal_insertar_usuario -->
<div id = "notificaciones">
  <!-- AREA DE NOFIFICACIONES -->
</div>
<!-- - -->

<!-- aqui se cargara la tabla que contendra todos los usuarios -->
<?php require_once('cargar_usuarios.php') ?>



<!-- ===============MODAL PARA INGRESAR NUEVO USUARIO -->
<!-- Modal nuevo_usuario-->
<div class="modal fade" id="modal_insertar_usuario" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title"><i class="glyphicon glyphicon-floppy-disk"></i> Ingreso de Datos del Usuario </h4>
      </div>
      <div class="modal-body">
        <form id = "form_insertar_usuario" class="form" role="form" name="form_insertar" >
          <div class="form-group">
            <!-- <label  for="pwd">Empleado</label>
            <div > 
                <select class="form-control">
                    <option>  Seleccione un empleado  </option>
                    <option> B </option>
                </select>
            </div>
          </div> -->
         
          <div id="verUserName" class="form-group">
                        <label>Nombre del usuario</label>
                        <input type="text" class="form-control" id="nombreUsuario" value = "">
                    </div>
          <div id="verPass" class="form-group">
                        <label>Contraseña </label>
                        <input type="password" class="form-control" id="password" name="password" value = "">
                    </div>
          <div id="verPass2" class="form-group">
                        <label class="control-label">Repetir contraseña</label>
                        <input type="password" class="form-control" id="password2" name="password2" value = "">
                    </div>
          <div class="form-group">
            <label class="" for="pwd">Rol del usuario</label>
            <div class="col-sm-10"> 
                <select id = "rol" class="form-control">
                    <option> -- Seleccione un rol de usuario -- </option>
                    <!-- cargamos los roles desde la base de datos -->
                    
                    <?php
                    $query = "SELECT rol.rol_ID, rol.descripcion FROM rol ";

                    $result = mysql_query($query, $conexion) or die("asdfasdf");
                    while($row=mysql_fetch_array($result))
                      {

                       echo "<option> $row[rol_ID] $row[descripcion] </option>";
                      }
                      ?> 
                </select>
            </div>
          </div>
        </form>         
     <!-- final form -->
      </div>
     <div class="modal-footer clearfix">
        <hr>
        <button   id="guardar_usuario" class="btn btn-primary">Agregar</button>
     </div>
    </div>
  </div>
</div>
    <!-- fin modal nuevo usuario-->

    <script>
    $(document).ready(function(){

      // plugin para formato de la tabla
  
      // --------------------------------------------------------------------
     
      // -------evento modal GUARDAR USUARIO----------------------------------------------
      $("#guardar_usuario").click(function() {

        
        // $("#form_insertar_usuario").validate();
        if (validador()) {
          var datos ={ 
            //empleado:$("#test option:selected").val(),

            "nombreUsuario":$('#nombreUsuario').val(),
            "password":$('#password').val(),
            "rol":$('#rol option:selected').val()
            // tipoProcedimiento:"insertar"
          };

          $.ajax({
              data: datos,
              url: 'pages/administracion/panel_usuarios/insertar_usuario.php',
              type : 'post',
              success: function(data) {
                  
                  $("#modal_insertar_usuario").modal('hide');
                  $('#notificaciones').html(data);
                  $('#nombreUsuario').val() = "";
                  $('#password').val() = "";                }

            });
        };
      });
        
      // ------------funcion para validar Modal_insertar_usuario-------------
     function validador(){
      var nombre = $("#nombreUsuario").val();
      var pass1 = $("#password").val();
    var pass2 = $("#password2").val();
    
    //valida si se han itroduzido otros digitos aparte de numeros y letras\
    
    $('.form-group').removeClass("has-warning");
    $('.form-group').removeClass("has-error");
    
    // 
    // if(soloLetrasYNumeros(nombre) == false){
    //     $("#verUserName").addClass("has-warning");
    //   $("#verUserName").find("label").text("Nombre del usuario: Solo son permitidos numeros y letras");
    //   $("#nombreUsuario").focus();
    //   return false;
    // }else{
    //     $("#verUserName").removeClass("has-warning");
    //   $("#verUserName").find("label").text("Nombre del usuario");
    // }
    
    // if(soloLetrasYNumeros(pass1) == false){
    //     $("#verPass").addClass("has-warning");
    //   $("#verPass").find("label").text("Contraseña: Solo son permitidos numeros y letras");
    //   $("#password").focus();
    //   return false;
    // }else{
    //     $("#verPass").removeClass("has-warning");
    //   $("#verPass").find("label").text("Contraseña (Maximo 20 carateres)");
    // } 
    
    // if(soloLetrasYNumeros(pass2) == false){
    //     $("#verPass2").addClass("has-warning");
    //   $("#verPass2").find("label").text("Repetir contraseña: Solo son permitidos numeros y letras");
    //   $("#password2").focus();
    //   return false;
    // }else{
    //     $("#verPass2").removeClass("has-warning");
    //   $("#verPass2").find("label").text("Repetir contraseña");
    // }
    
    // valida si el password es el mismo que se ingreso la segunda vez
    if(pass1 == pass2){
        $("#verPass2").removeClass("has-error");
      $("#verPass2").find("label").text("Repetir contraseña");
    }else{
        $("#verPass2").addClass("has-error");
      $("#verPass2").find("label").text("Repetir contraseña: Error la contraseña no coincide");
      $("#password2").focus();
        return false;
    }
    
    // valida el numero de caracteres valido para el nombre
    if(nombre.length < 5){
        $("#verUserName").addClass("has-warning");
      $("#verUserName").find("label").text("Nombre del usuario: El nombre debe ser mayor a 5 caracteres");
      $("#nombreUsuario").focus();
      return false;
    }
    // valida el numero de caracteres valido para la contrasena
    if(pass1.length < 8){
        $("#verPass").addClass("has-warning");
      $("#verPass").find("label").text("Contraseña: debe contener por lo menos 8 caracteres");
      $("#password").focus();
      return false;
    }
    
    if(pass2.length < 8){
        $("#verPass2").addClass("has-warning");
      $("#verPass2").find("label").text("Repetir contraseña: debe contener por lo menos 8 caracteres");
      $("#password2").focus();
      return false;
    }
    
    return true;
     }
     // fin del validador
     function soloLetrasYNumeros(text){
      var letters = /^[0-9a-zA-Z]+$/; 
      if(text.match(letters)){
          return true;
      }else{
          return false;
      }
     }



  }); 
  // fin del evento ready
  </script>



