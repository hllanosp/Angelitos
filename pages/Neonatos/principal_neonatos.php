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
        
       
         
   
                    
       
    <div class="panel panel-default">
        <div class="panel-heading">
            <label><span class="glyphicon glyphicon-list" aria-hidden="true"></span> Pacientes</label>
        </div>
        <div class="panel-body table-responsive">
           <div class="btn-group-box well">
            <button class="btn"><i class=" fa fa-dashboard fa-3x"></i><br>Nuevo Paciente</button>
            <button class="btn"><i class= "fa fa-user fa-3x"></i><br>Account</button>
            <button class="btn"><i class=" fa fa-search fa-3x"></i><br>Buscar Paciente</button>
            <button class="btn"><i class=" fa fa-list-alt fa-3x"></i><br>Imprimir</button>
            <button class="btn"><i class=" fa fa-bar-chart fa-3x"></i><br>busqueda avanzada</button>
          </div>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <section class="content">
                            <div class="box-body table-responsive">
                                <div id="tableProducto_wrapper" class="dataTables_wrapper no-footer"><div class="dataTables_length" id="tableProducto_length"><label>Show <select name="tableProducto_length" aria-controls="tableProducto" class=""><option value="10">10</option><option value="25">25</option><option value="50">50</option><option value="100">100</option></select> entries</label></div><div id="tableProducto_filter" class="dataTables_filter"><label>Search:<input type="search" class="" placeholder="" aria-controls="tableProducto"></label></div><table id="tableProducto" border="1" class="table table-bordered table-striped display dataTable no-footer" role="grid" aria-describedby="tableProducto_info">
                                    <thead>
                                        <tr style="background-color: rgb(71, 58, 147)" ;="" role="row"><th style="color: rgb(255, 255, 255); width: 172.33333325386px;" class="sorting_asc" tabindex="0" aria-controls="tableProducto" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Codigo: activate to sort column descending">Codig3</th><th style="color: rgb(255, 255, 255); width: 182.33333325386px;" class="sorting" tabindex="0" aria-controls="tableProducto" rowspan="1" colspan="1" aria-label="Nombre: activate to sort column ascending">Nombre</th><th style="color: rgb(255, 255, 255); width: 197.33333325386px;" class="sorting" tabindex="0" aria-controls="tableProducto" rowspan="1" colspan="1" aria-label="Tipo: activate to sort column ascending">Tipo</th><th style="color: rgb(255, 255, 255); width: 153.33333325386px;" class="sorting" tabindex="0" aria-controls="tableProducto" rowspan="1" colspan="1" aria-label="Marca: activate to sort column ascending">Marca</th><th style="color: rgb(255, 255, 255); width: 152.33333325386px;" class="sorting" tabindex="0" aria-controls="tableProducto" rowspan="1" colspan="1" aria-label="Editar: activate to sort column ascending">Editar</th><th style="color: rgb(255, 255, 255); width: 190.33333325386px;" class="sorting" tabindex="0" aria-controls="tableProducto" rowspan="1" colspan="1" aria-label="Eliminar: activate to sort column ascending">Eliminar</th></tr>
                                    </thead>
                                    <tbody id="cTablaProducto"><tr role="row" class="odd"><td class="sorting_1">8</td><td>Pañales</td><td>Desechables</td><td>Ceteco</td><td><center><button data-marca="Ceteco" data-tipo="Desechables" data-id="8" href="#" class="editarProducto btn_editar btn btn-info" data-toggle="modal" data-target=""><i class="glyphicon glyphicon-edit"></i></button></center></td><td><center><button data-id="8" href="#" class="eliminaProducto btn_editar btn btn-danger"><i class="glyphicon glyphicon-trash"></i></button></center></td></tr><tr role="row" class="even"><td class="sorting_1">9</td><td>Mantas </td><td>Desechables</td><td>Ceteco</td><td><center><button data-marca="Ceteco" data-tipo="Desechables" data-id="9" href="#" class="editarProducto btn_editar btn btn-info" data-toggle="modal" data-target=""><i class="glyphicon glyphicon-edit"></i></button></center></td><td><center><button data-id="9" href="#" class="eliminaProducto btn_editar btn btn-danger"><i class="glyphicon glyphicon-trash"></i></button></center></td></tr><tr role="row" class="odd"><td class="sorting_1">12</td><td>alcohol</td><td>Medicos</td><td>Ceteco</td><td><center><button data-marca="Ceteco" data-tipo="Medicos" data-id="12" href="#" class="editarProducto btn_editar btn btn-info" data-toggle="modal" data-target=""><i class="glyphicon glyphicon-edit"></i></button></center></td><td><center><button data-id="12" href="#" class="eliminaProducto btn_editar btn btn-danger"><i class="glyphicon glyphicon-trash"></i></button></center></td></tr><tr role="row" class="even"><td class="sorting_1">13</td><td>toallas</td><td>Medicos</td><td>Ceteco</td><td><center><button data-marca="Ceteco" data-tipo="Medicos" data-id="13" href="#" class="editarProducto btn_editar btn btn-info" data-toggle="modal" data-target=""><i class="glyphicon glyphicon-edit"></i></button></center></td><td><center><button data-id="13" href="#" class="eliminaProducto btn_editar btn btn-danger"><i class="glyphicon glyphicon-trash"></i></button></center></td></tr><tr role="row" class="odd"><td class="sorting_1">14</td><td>toallas</td><td>Limpieza</td><td>Ceteco</td><td><center><button data-marca="Ceteco" data-tipo="Limpieza" data-id="14" href="#" class="editarProducto btn_editar btn btn-info" data-toggle="modal" data-target=""><i class="glyphicon glyphicon-edit"></i></button></center></td><td><center><button data-id="14" href="#" class="eliminaProducto btn_editar btn btn-danger"><i class="glyphicon glyphicon-trash"></i></button></center></td></tr></tbody>
                                </table><div class="dataTables_info" id="tableProducto_info" role="status" aria-live="polite">Showing 1 to 5 of 5 entries</div><div class="dataTables_paginate paging_simple_numbers" id="tableProducto_paginate"><a class="paginate_button previous disabled" aria-controls="tableProducto" data-dt-idx="0" tabindex="0" id="tableProducto_previous">Previous</a><span><a class="paginate_button current" aria-controls="tableProducto" data-dt-idx="1" tabindex="0">1</a></span><a class="paginate_button next disabled" aria-controls="tableProducto" data-dt-idx="2" tabindex="0" id="tableProducto_next">Next</a></div></div>
                            </div>
                        </section>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
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