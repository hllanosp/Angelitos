<!doctype html>

<?php 

  $rol =$_SESSION['rol_ID'];
  $user = $_SESSION['user'];
  if(isset($_GET['contenido']))
    {
      $contenido = $_GET['contenido'];
    }
  else
    {
      $contenido = 'index';
    }


  // require_once("funciones/check_session.php");
  require_once("login/time_out.php");
  //require_once("navbar.php");
?>
<hr>



<html lang="en">
<head>
  <meta charset="utf-8">
  <title>plantilla</title>
  <meta name = "viewport" content = "width = device-whidth, initial-scale=1">
  
  <!-- ========REFERENCIAS======== -->
  <!-- Rerencia para el header-->
  <script type="text/javascript" src="componentes/jquery-1.11.3.min.js"></script>
  
  <!--  -->
  <link rel="stylesheet" href="bootstrap/css/bootstrap.css">
  <link rel="stylesheet" href="css/stylo.css">
  <script src = "bootstrap/js/bootstrap.js"></script>
  
  <!-- cambios Arle para el navar efectos   -->    
  <link href="bootstrap/components/metisMenu/dist/metisMenu.min.css"  rel="stylesheet">   
  <link href="bootstrap/components/styles.css" rel="stylesheet" type="text/css">   
   
   <!-- plugins para tabla -->
  <script src = "componentes/DataTables/media/js/jquery.dataTables.js" ></script>
  <link rel="stylesheet" href="componentes/DataTables/media/css/jquery.dataTables.css">
  <link rel="stylesheet" href="css/tablas.css">

  <!-- plugins para validar formulario -->
  <script src = "componentes/jquery-validation/dist/jquery.validate.js" ></script>

  <link href="componentes/morrisjs/morris.css" rel="stylesheet"> 
  <script src = "componentes/morrisjs/morris.js" ></script>

  <!-- estilo en el admin -->
  <link href="componentes/sb-admin-2.css" rel="stylesheet">
  

  <!-- stilos personalizados -->
  <link rel="stylesheet" href="css/stylo.css">
  <link rel="stylesheet" href="css/tablas.css">

<!-- graficos -->
  <script src ="componentes/Highcharts-4/js/highcharts.js"></script>

<!-- estilo switch -->
 <link rel="stylesheet" href="componentes/bootstrap-switch-master/dist/css/bootstrap3/bootstrap-switch.css">
 <script src = 'componentes/bootstrap-switch-master/dist/js/bootstrap-switch.js'></script>
 
 <!-- iconos -->
  <link href="componentes/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
<script >

   
   $(document).ready(function(){

    //Al precionar la etiqueta Administracion se levanta el evento de click 
    $("#Administracion").click(function(event) {
      event.preventDefault();
      $("#div_contenido" ).load( "pages/administracion/admin.php");
    }); 
    
    //Al precionar el logo se redirecciona a la pantalla de home
    $("#logo").click(function(event) {
      event.preventDefault();
      $("#div_contenido" ).load( "pages/home.php?contenido=home");
    });

    $("#user").click(function(event) {
      event.preventDefault();
      $("#div_contenido" ).load( "pages/Perfil/perfil.php");
    });

    //agregar mas eventos aqui

   });

</script>
</head>


<body >
  <nav class="navbar navbar-inverse navbar-fixed-top header">
  <div class="col-md-12">
     <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapses">
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
      </button>
      <img  id = "logo" src= "img/logo.png" role = "button" height = "50" >
    </div>
    <div class="collapse navbar-collapse navbar-ex1-collapses">
      <ul class="nav navbar-nav navbar-right">
      <?php

        //En esta parte se carga la sección de administración dentro de la pag

        if($rol == 1){
          
            switch($rol){   
                case 1: 
                  $url = 'pages/administracion/admin.php?contenido=administracion';// 100    
                break;
            }
            echo <<<HTML
            <li class="dropdown">   
            <a id ="Administracion" role="button" class="" > <i class = "glyphicon glyphicon-cog" ></i> Administración</a>
            </li> 
HTML;
          
        }  
    ?>
        <li class="dropdown" >
          <a id="user" href="pages/Perfil/perfil.php"> <i class="glyphicon glyphicon-user"></i><?php echo " ".$user; ?></a></li>
            <span class="caret"></span></a>
        <li class="dropdown" >
          <a href="login/ckeckout.php"><i class="glyphicon glyphicon-log-out"></i> Salir</a></li>
      </ul>
    </div>
  </div> 
  </nav>
  <!-- references -->
  
  <script src = "componentes/jquery.backstretch.min.js"></script>
  <!-- imagen de fondo -->
  

</body>