 <?php
 

 $maindir = "../../";
  require_once($maindir."login/seguridad.php");
  if(isset($_GET['contenido']))
    {
      $contenido = $_GET['contenido'];
    }
  else
    {
      $contenido = 'administracion';
    }
 require_once("../navbar.php");
 include '../../conexion/conexion.php';
 require_once('../../login/time_out.php');
?>


<!-- anadimos los archivos necesarios para trabajar-->
<!-- 
// archivo de seguridad
// include('seguridad.php')

//acceso a bases de datos
// include '../../conexion/conexion.php';

// verifica la sesion
// require_once($maindir."login/seguridad.php");
 
// // verifica el tiempo de la sesion 
// require_once($maindir."login/time_out.php");

//generando la cabecera de la pagina
// require_once("../navbar.php");

 -->

<div id="wrapper">
            <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">
                        
                        <li class="nav-header"> 
                          <a id="usuarios" href="#"><i class="glyphicon glyphicon-home"></i> Inicio Administracion</a>
                        </li>
                        <hr> </hr>
                        <li>
                            <a id="usuarios_activos" href="#"><i class="fa fa-dashboard fa-fw"></i>Usuarios Activos</a>
                        </li>
                        <li>
                            <a  id="logs" href="#"><i class="fa fa-file-pdf-o fa-fw"></i> Logs</a>
                            
                        </li>
                        <li>
                            <a  id="historial_ingreso" href="#"><i class="fa fa-bar-chart-o fa-fw"></i>Historial Ingreso</a>
                            
                        </li>
                                               <li data-popover="true" rel="popover" data-placement="right"><a href="#" data-target=".premium-menu" class="nav-header collapsed" data-toggle="collapse"><i class="fa fa-gears fa-fw"></i>Mantenimineto<i class="fa fa-collapse"></i></a></li>
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
    <div id="page-wrapper">
        <div id="contenedor">
            <!-- cuerpo del panel -->
            <?php 
           require_once($maindir."pages/administracion/panel_usuarios/panel_usuarios.php");?>
      <!-- fin del panel gestion de usuarios --> 
        </div>
      </div>
  <!--   </div> -->
<!-- </div> -->

<!-- eventos para el menu contextual -->

    <script type="text/javascript" src="pages/administracion/menu.js" />