<?php
$maindir = "../../";
 if(isset($_GET['contenido']))
   {
     $contenido = $_GET['contenido'];
   }
 else
   {
     $contenido = 'inventario';
   }

require_once($maindir."pages/navbar.php");
require_once($maindir."funciones/seguridad.php");

?>

<div id="wrapper">
   <div class="navbar-default sidebar" role="navigation">
       <div class="">
           <ul class="nav nav-list bs-docs-sidenav nav-collapse" id="">
             <li class="nav-header">
               <a id="inv_home" href="#"><i class="glyphicon glyphicon-home actived"></i> Inicio</a>
             </li>
             <hr>
               <li class="nav-header">
                 <a id="inv_inventario" href="#"><i class="fa fa-glass"></i> inventario</a>
               </li>
               <li class="nav-header">
                 <a id="inv_reportes" href="#"><i class="fa fa-tasks"></i> Reportes</a>
               </li>
               <li data-popover="true" rel="popover" data-placement="right"><a href="#" data-target=".premium-menu" class="nav-header collapsed" data-toggle="collapse"><i class="fa fa-gears fa-fw"></i>Mantenimiento<i class="fa fa-collapse"></i></a></li>
                 <li><ul class="premium-menu nav nav-list collapse">
                         <li ><a id="registro_producto" href="premium-profile.html"><span class="fa fa-caret-right"></span> Registro Producto</a></li>
                         <li ><a id="registro_categoria" href="premium-blog.html"><span class="fa fa-caret-right"></span>Registro Categorias</a></li>
                         <li ><a id="registro_marca" href="premium-blog.html"><span class="fa fa-caret-right"></span>Registro Marca</a></li>
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
          <small>Modulo de Administracion de Inventario</small>
      </h1>
    </div>
    <div class="col-lg-4">
    <div class="panel panel-red">
        <div class="panel-heading">
            Productos con poca existencia
        </div>
        <div id= "1" class="panel-body">

        </div>
        <div class="panel-footer">

        </div>
    </div>
</div>
    <div class="col-lg-4">
    <div class="panel panel-yellow">
        <div class="panel-heading">
            Productos prontos a vencer
        </div>
        <div id= "2" class="panel-body">

        </div>
        <div class="panel-footer">

        </div>
    </div>
</div>
    <div class="col-lg-4">
      <div class="panel panel-green">
          <div class="panel-heading">
              Productos con bastante existencia
          </div>
          <div id= "3" class="panel-body">

          </div>
          <div class="panel-footer">

          </div>
      </div>
    </div>
 </div>
   <!-- </div> -->
<!-- </div> -->

<!-- eventos para el menu contextual -->

   <script type="text/javascript" src="pages/Inventario/menu.js" />
