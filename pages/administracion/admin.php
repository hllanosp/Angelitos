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


<!-- =====HTML====== -->
<div class="container">
  <div class="row">
    
     <!-- =========PANEL 1: Gestion de Usuarios==========
          MODALES 2: -nuevos usuarios
                     -editar usuarios -->
    <div  id = "panel_usuario">
      <div class="col-sx-12 col-sm-8 col-md-9">
        <div  class="panel panel-info">
          <!-- Default panel contents -->
          <div class="panel-heading">
            <div class="btn-group" role="group" aria-label="usuarios/logs">
                <button type="button" class="btn btn-small btn-default" id="cargar_usuarios">usuarios</button>
                <!-- <button type="button" class="btn btn-default" id="cargas_logs">Logs</button> -->
            </div>
          </div>

          <div class="panel-body">
            <!-- cuerpo del panel -->
           <?php 
           require_once($maindir."pages/administracion/panel_usuarios/panel_gestion_usuarios.php");?>
          </div>
        </div>
      </div>
      <!-- fin del panel gestion de usuarios -->

    </div>
      <!-- panel de usuarios activos -->
      <div class = "col-sx-12 col-sm-4 col-md-3">
        <div class="panel panel-info">
          <div class="panel-heading">
            <h4><i class="fa fa-pie-chart"></i> Usuarios Activos</h4>
          </div>
             <div class="panel-body">
                    <div class="clearfix"></div>
                <div id="grafo_usuarios">
                    <h1>
                      elemento1
                    </h1>
              </div>      
             </div>
          </div>
          <!-- fin panel usuarios_activos -->
      </div>

      <!-- panel de usuarios activos -->
      <div class = "col-sx-12 col-sm-4 col-md-3">
        <div class="panel panel-info">
          <div class="panel-heading">
            <h4><i class="fa fa-pie-chart"></i>Bitacora</h4>
          </div>
             <div class="panel-body">
                    <div class="clearfix"></div>
                <div id="grafo_usuarios">
                    <h1>
                          elemento2
                    </h1>
              </div>      
             </div>
          </div>
          <!-- fin panel usuarios_activos -->
    </div>
  <!-- fin de row -->
  


</div>