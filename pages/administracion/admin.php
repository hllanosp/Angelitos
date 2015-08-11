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
 // include ($maindir.'conexion/.php');
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
      <div>
        <h1 class="page-header">
            <small>Administracion de Usuarios</small>
        </h1>
        <ol class="breadcrumb">
            <li class="active">
                <span class="fa fa-dashboard"></span></i> Administracion
            </li>
            
        </ol>
      </div>



      <div class="mailbox row" id = "mailbox">
    <div class="col-xs-12">
      <div class="box box-solid">
        <div class="box-body well" >
          <div class="row">
            <div class="col-md-3 col-sm-3">
             
               
              <div class="panel panel-default">
                <a>
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
                  <div role = "button" class="panel-footer" data-toggle="modal" data-target="#modal_insertar_usuario" style="background-color: rgb(71, 58, 147); color:white;">
                      <span class="pull-left">Nuevo Usuario</span>
                      <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                      <div class="clearfix"></div>
                  </div>
                </a>
              </div>

              
                <div class = "box" style="margin-top: 15px;">
                  <div class="box-header well">
                    <i class="fa fa-bar-chart-o fa-fw"></i>
                    <h5 class="box-title" style = "color:black;"> usuarios activos</h5>
                  </div>
                    
                        <?php 
                          require_once('panel_Grafos/grafo_empleados.php');
                         ?>                                                                   
                    
                </div>
              </div>
              <!-- /.col (LEFT) -->

              <div class="col-md-9 col-sm-8">
                <div class="box">
                    <div class="box-header">
                    </div>
                    <div class="box-body table-responsive" id = "contenedor">
                      <?php
                       require_once("panel_usuarios/panel_gestion_usuarios.php");
                       ?>
                     </div>
                     <!-- /.box-body -->
                </div>
               <!-- /.box -->
              </div>
              <!-- /.col (RIGHT) -->

            </div>
            <!-- /.row -->
          </div>
          <!-- /.box-body -->
        </div>
        <!-- /.box -->
      </div>
      <!-- /.col (MAIN) -->
    </div>
  </div>
    <!-- </div> -->
<!-- </div> -->

<!-- eventos para el menu contextual -->

    <script type="text/javascript" src="pages/administracion/menu.js" />
