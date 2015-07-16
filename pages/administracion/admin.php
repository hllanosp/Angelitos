 <?php


 $maindir = "../../";
  if(isset($_GET['contenido']))
    {
      $contenido = $_GET['contenido'];
    }
  else
    {
      $contenido = 'administracion';
    }
 
 require_once($maindir."pages/navbar.php");
 include ($maindir.'conexion/conexion.php');
 require_once($maindir."funciones/seguridad.php");

  

?>

<div id="wrapper">
            <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">
                        
                        <li class="nav-header"> 
                          <a id="usuarios" href="#"><i class="glyphicon glyphicon-home"></i> Inicio Administracion</a>
                        </li>
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
          <div>
            <h1 class="page-header">
                <small>Administracion de Usuarios</small>
            </h1>
            <ol class="breadcrumb">
                <li class="active">
                    <span class="glyphicon glyphicon-cog"></span></i> Administracion
                </li>
                 
            </ol>
          </div>
          <div  class="panel panel-default">
            <!-- Default panel contents -->
            <div class="panel-heading">
              <div class="btn-group" role="group" aria-label="usuarios/logs">
                  <!-- <button type="button" class="btn btn-small btn-default" id="cargar_usuarios">usuarios</button> -->
              </div>
              <div class="btn-group" role="group" aria-label="usuarios/logs">
                  <!-- <button type="button" class="btn btn-default" id="cargas_logs">Logs</button> -->
              </div>
            </div>
            <div class="panel-body ">
              <!-- cuerpo del panel -->
             <?php 
             require_once("panel_usuarios/panel_gestion_usuarios.php");?>
            </div>
                
                <!-- fin del panel gestion de usuarios -->

          </div>
        </div>
      </div>
  <!--   </div> -->
<!-- </div> -->

<!-- eventos para el menu contextual -->

    <script type="text/javascript" src="pages/administracion/menu.js" />