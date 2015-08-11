
<!-- Descripcion de la pagina -->

<?php
	session_start();
  if (isset($_SESSION['usuario_ID'])) {
    include("../conexion/config.inc.php");
    $usuario = $_SESSION['usuario_ID'];
    $query = $db->prepare("UPDATE usuario SET Logeado = 0 where usuario_ID = '".$usuario."' ;");
    $query ->execute();    
  }
	$_SESSION = array();
	session_destroy();
 ?>

<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>plantilla</title>
  <meta name = "viewport" content = "width = device-whidth, initial-scale=1">
  <script src="../bootstrap/js/jquery-1.11.3.min.js"></script>
  <link rel="stylesheet" href="../bootstrap/css/bootstrap.css">
  <link rel="stylesheet" href="../css/stylo.css">
</head>
<script>
  $(document).ready(function(){
     // $("#rectangulo").css('mozAnimationName','animar');
    $( "a" ).click(function() {
      login();
    });

});
</script>


<script type="text/javascript">
  function login(){
     var usuario = $('#usuario');
     var password = $('#password');

     var text = "";
     var valid = true;

     if(usuario == "" || password == ""){
         text = "Introduzca un nombre de usuario y contraseña validos";
         valid = false;
     }

     if(!valid){
         alert(text);
         return;
     }

     // redirigimos hacia el archivo loginInfo
     var loginInfo = "login_submit.php"
     window.location.href = loginInfo;
  }

</script>

<!-- Se procesan cualquier tipo de error ocurrido en la pantalla de login -->
<?php
  function cargar_error(){
     if(isset($_GET["error_code"]))
     {
         $accion = $_GET["error_code"];
          switch ($accion) {
              case 0:
                  error_print(0);
                  break;
              case 1:
                  error_print(1);
                  break;
              case 2:
                  error_print(2);
                  break;
              case 3:
                  error_print(3);
                  break;
              case 4:
                  error_print(4);
                  break;
              case 5:
                  error_print(5);
                  break;
              case 6:
                  error_print(6);
                  break;
              case 7:
                  error_print(7);
                  break;
              default:
                  break;
          }
     }
  }

   function error_print($error_code)
   {
       $mensaje = "";
       switch ($error_code) {
            case 0:
                $mensaje = "Sus credenciales ya expiraron, por favor trate de ingresar dentro de unos segundos";
                break;
            case 1:
                $mensaje = "Usuario o contraseña incorrecto";
                break;
            case 2:
                $mensaje = "Credenciales inválidas, por favor trate de ingresar con un usuario y contraseña validos";
                break;
            case 3:
                $mensaje = "Por el momento no es posible procesar su petición, por favor trate de ingresar dentro de unos momentos";
                break;
            case 4:
                $mensaje = "La conexión con el sevidor no fue exitosa, por favor trate de ingresar dentro de unos segundos";
                break;
            case 5:
                $mensaje = "Lo sentimos pero su sesión ya ha expirado, por favor ingrese otra vez";
                break;
            case 6:
                $mensaje = "Este usuario esta deshabilitado, contacte el administrador del sistema";
                break;
            case 7:
                $mensaje = "Error en autenticacion, usuario ya esta logeado";
                break;
            default:
                break;
        }
        echo '<div class="alert alert-danger alert-error">
        <a href="#" class="close" data-dismiss="alert">&times;</a>
        <strong> Error! </strong>'.$mensaje.'</div>';
   }

?>


<body class =  "well">
  <div class ="container well sha" id = "content_login">
    <div class="text-center">
      <div class="row">
        <div class="col-xs-12">
          <img class = "animacion" id= "avatar" src="../img/logo.png" alt="Logo Fundacion Angelitos">
        </div>
      </div>
      <br>
      <h4 style="color: #FFD400">FUNDACION ANGELITOS</h4>
      <h5><strong style="color: #FFD400">INICIAR SESIÓN</strong></h5>
      <br>

      <?php 
        cargar_error();
       ?>
    </div>
 
    <form class = "login" action = "login_submit.php" method = "POST">
      <div class="form-group">
        <input type="text" id = "usuario" class = "form-control" placeholder = "usuario" name = "usuario" required autofocus>
      </div>
      <div class="form-group">
        <i class="fa fa-key overlay"></i>
        <input type="password" id = "password" class="form-control" placeholder = "contrasena" name = "password" required>
      </div>
      <div class="form-group">
        <button id = "iniciar_sesion" class = "btn btn-lg btn-block" >Inciar Sesion</button>
      </div>

      <div class="clear"></div>
    	
      <label id= 'forgot'rol ="button" style = "color:#FFD400"  class=""><i class = "glyphicon glyphicon-chevron-right"></i>Olividaste la Contrasena?</label>
     </div>
    </form>
  </div>
  

  <!-- references -->
  <script src = "../bootstrap/js/bootstrap.js"></script>
  <script src = "../componentes/jquery.backstretch.min.js"></script>
  <!-- imagen de fondo -->
  <script>
    $(document).ready(function(){
        $('#forgot').click(function(){
          $("#content_login").addClass('animacion');
          $('#content_login').load('forgot_pass.php');
        });

        $("#login_forgot").submit(function(e) {
            e.preventDefault();
            alert ('que ondas');
            if (validador()) {
               var datos ={
                 "usuario":$('#usuario').val(),
                 "email":$('#email').val(),
                 
               };
               $.ajax({
                       data: datos,
                       url: 'send_mail.php',
                       type : 'post',
                       success: function(data) {
                           $('#resultado').html(data);
                         }

                     });
            };
        });

        $('#back_login').click(function(){
          $('content_login').load("content_login");
          $("#content_login").addClass('animacion');
        });
    });



    $.backstretch("../img/fondo.jpg", {speed: 800});

  </script>

</body>
