 <?php
 if(!isset($_SESSION)) 
  { 
    session_start(); 
  } 
  
  // define la pestana activa en el navbar.
  if(isset($_GET['contenido']))
  {
      $contenido = $_GET['contenido'];
  }
  else
  {
      $contenido = 'neonatos';
  }
  
  // validacion de seguridad 
  if(!isset($_SESSION['auntentificado']) ) {
    header("location: ../../login/login.php?error_code=2");
  }


 $maindir = "../../";

 require_once($maindir."pages/navbar.php");
 

?>

<div id="wrapper">
            <div class="navbar-default sidebar" role="navigation">
                <div class="">
                  <ul class="nav nav-list bs-docs-sidenav nav-collapse" id="">
                  <li class="nav-header active">
                    <a id="neonatos_home" href="#"><i class="glyphicon glyphicon-home"></i> Inicio Neonatos</a>
                  </li>
                  <hr><script></script>
                  <li>
                      <a  id="neonatos_pacientes" href="#"><i class="fa fa-male"></i> Pacientes</a>
                  </li>
                  <li>
                      <a  id="neonatos_traslados" href="#"><i class="glyphicon glyphicon-refresh"></i>Traslados</a>
                  </li>
                  <li>
                      <a  id="neonatos_altas" href="#"><i class="fa fa-bar-chart-o fa-fw"></i>Altas</a>
                  </li>
                   <li data-popover="true" rel="popover" data-placement="right">
                      <a href="#" data-target=".premium-menu" class="nav-header collapsed" data-toggle="collapse">
                      <i class="fa fa-gears fa-fw"></i>Mantenimineto<i class="fa fa-collapse"></i></a>
                   </li>
                    <li><ul class="premium-menu nav nav-list collapse">
                            <li ><a id="areas" href="premium-profile.html"><span class="fa fa-caret-right"></span> Areas</a></li>
                            <li ><a id="tipoDeAreas" href="premium-blog.html"><span class="fa fa-caret-right"></span> Tipos De Areas</a></li>
                        </ul>
                    </li>
                    </ul>
                </div>
            </div>
                <!-- /.sidebar-collapse -->
    </div>
    <div id="page-wrapper" >
      <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
              <div class="featurette">

                    <img class="featurette-image  pull-left" src="img/angel.png">
                    <div class="alert alert-success"><h1>Esta es la pantalla principal del modulo de Neonatos</h1></div>
               
              </div>
            </div>
        </div>
        
      </div>
    </div>
    <!-- fin div wrapper-->

<script src = "pages/Neonatos/menu_principal.js"></script>
