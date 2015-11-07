
<!---INFORMACION DE LA PAGINA- -->


<?php
  if(!isset($_SESSION)) 
  { 
    session_start(); 
  } 

  // <!-- Declaramos la direccion raiz -->
  $maindir = "../../../";
  
  //acceso a bases de datos
  include ($maindir.'conexion/config.inc.php');
  
  //validacion de seguridad
  if(!isset($_SESSION['auntentificado']) ) {
    header("location: ../../../login/login.php?error_code=2");
   }
   
  ?>

<div class="container-fluid">
  <div class = "row">
     <!--  <h1 class="page-header">
          <small>Gestion De Pacientes</small>
      </h1> -->
      <ol class="breadcrumb">
          <li class="active">
              <span class="fa fa-dashboard"></span> Módulo Neonatos
          </li>
           <li class="">
              <i class="fa fa-table " ></i>Gestion de Pacientes
          </li>
      </ol>
    </div>

    <div class="row">
      <div class="panel panel-default well" style  = "padding : 0px; background-color:#4D3992; ">
        
        <div class="panel-body ">
          <div class="btn-group-box" style = "margin-left: 20%;">
              <button id = "open-wizard" class="btn btn-success"><i class=" fa fa-plus fa-2x"></i><br>Nuevo Paciente</button>
              <!-- <button class="btn"><i class= "fa fa-user fa-3x"></i><br>Account</button> -->
              <button class="btn btn-primary "><i class=" fa fa-search fa-2x"></i><br>Buscar Paciente</button>
              <button class="btn btn-warning"><i class=" fa fa-list-alt fa-2x"></i><br>Imprimir</button>
              <button class="btn btn-default"><i class=" fa fa-bar-chart fa-2x"></i><br>busqueda avanzada</button>
            </div>
        </div>
      </div>
    </div>

    <div class="row">
      <div class="panel panel-default">
        <div class="panel-heading">
            <label><span class="glyphicon glyphicon-list" aria-hidden="true"></span> Categorias</label>
        </div>
        <div class="panel-body table-responsive">
          <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <section class="content">
                            <div class="box-body table-responsive">
                                <div id="tableCategorias_wrapper" class="dataTables_wrapper no-footer"><div class="dataTables_length" id="tableCategorias_length"><label>Show <select name="tableCategorias_length" aria-controls="tableCategorias" class=""><option value="10">10</option><option value="25">25</option><option value="50">50</option><option value="100">100</option></select> entries</label></div><div id="tableCategorias_filter" class="dataTables_filter"><label>Search:<input type="search" class="" placeholder="" aria-controls="tableCategorias"></label></div><table id="tableCategorias" border="1" class="table table-bordered table-striped display dataTable no-footer" role="grid" aria-describedby="tableCategorias_info">
                                    <thead>
                                        <tr style="background-color: rgb(71, 58, 147)" ;="" role="row"><th style="color: rgb(255, 255, 255); width: 210.777777671814px;" class="sorting_asc" tabindex="0" aria-controls="tableCategorias" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Codigo: activate to sort column descending">Codigo</th><th style="color: rgb(255, 255, 255); width: 242.777777671814px;" class="sorting" tabindex="0" aria-controls="tableCategorias" rowspan="1" colspan="1" aria-label="Nombre: activate to sort column ascending">Nombre</th><th style="color: rgb(255, 255, 255); width: 189.777777671814px;" class="sorting" tabindex="0" aria-controls="tableCategorias" rowspan="1" colspan="1" aria-label="Editar: activate to sort column ascending">Editar</th><th style="color: rgb(255, 255, 255); width: 233.777777671814px;" class="sorting" tabindex="0" aria-controls="tableCategorias" rowspan="1" colspan="1" aria-label="Eliminar: activate to sort column ascending">Eliminar</th></tr>
                                    </thead>
                                    <tbody id="cTablaCategorias"><tr role="row" class="odd"><td class="sorting_1">4</td><td>Desechables</td><td><center><button data-id="4" href="#" class="editarCategoria btn_editar btn btn-info" data-toggle="modal" data-target=""><i class="glyphicon glyphicon-edit"></i></button></center></td><td><center><button data-id="4" href="#" class="eliminaCategoria btn_editar btn btn-danger"><i class="glyphicon glyphicon-trash"></i></button></center></td></tr><tr role="row" class="even"><td class="sorting_1">9</td><td>Limpieza</td><td><center><button data-id="9" href="#" class="editarCategoria btn_editar btn btn-info" data-toggle="modal" data-target=""><i class="glyphicon glyphicon-edit"></i></button></center></td><td><center><button data-id="9" href="#" class="eliminaCategoria btn_editar btn btn-danger"><i class="glyphicon glyphicon-trash"></i></button></center></td></tr><tr role="row" class="odd"><td class="sorting_1">11</td><td>Medicos</td><td><center><button data-id="11" href="#" class="editarCategoria btn_editar btn btn-info" data-toggle="modal" data-target=""><i class="glyphicon glyphicon-edit"></i></button></center></td><td><center><button data-id="11" href="#" class="eliminaCategoria btn_editar btn btn-danger"><i class="glyphicon glyphicon-trash"></i></button></center></td></tr><tr role="row" class="even"><td class="sorting_1">12</td><td>Comestibles</td><td><center><button data-id="12" href="#" class="editarCategoria btn_editar btn btn-info" data-toggle="modal" data-target=""><i class="glyphicon glyphicon-edit"></i></button></center></td><td><center><button data-id="12" href="#" class="eliminaCategoria btn_editar btn btn-danger"><i class="glyphicon glyphicon-trash"></i></button></center></td></tr></tbody>
                                </table><div class="dataTables_info" id="tableCategorias_info" role="status" aria-live="polite">Showing 1 to 4 of 4 entries</div><div class="dataTables_paginate paging_simple_numbers" id="tableCategorias_paginate"><a class="paginate_button previous disabled" aria-controls="tableCategorias" data-dt-idx="0" tabindex="0" id="tableCategorias_previous">Previous</a><span><a class="paginate_button current" aria-controls="tableCategorias" data-dt-idx="1" tabindex="0">1</a></span><a class="paginate_button next disabled" aria-controls="tableCategorias" data-dt-idx="2" tabindex="0" id="tableCategorias_next">Next</a></div></div>
                            </div>
                        </section>
                    </div>
                </div>
            </div>
        </div>
      </div>
    </div>
</div>
 <!-- container fluid -->


<!-- se carga el modal wizard -->
<?php 
include("modal_stepWizard.php");
 ?>


  <script type="text/javascript">
  $(document).ready(function(){
    var wizard = $('#some-wizard').wizard({
          keyboard : true,
          contentHeight : 600,
          contentWidth : 900,
          backdrop: 'static',
          showCancel: 'true' ,
     });
    $('#open-wizard').click(function(e) {
          e.preventDefault();
          wizard.show();
          wizard.setTitle("Nuevo Historial Clinico");
        });

//     wizard.cards["card1"].on("validate", function(card) {
//     var retValue = {};
//     var input = card.el.find("#institucion");
//     // var input_institucion = card.el.find('#lugarNacimiento');
//     // var nombrenacido = card.el.find('#nombreNacido');
//     // var nombre_madre = card.el.find('#nombreMadre');
//     // var nombrePadre = card.el.find('#nombrePadre');
    
     

//     var name = input.val();
//     // var input_institucion1 = input_institucion.val();
//     // var nombrenacido1 = nombrenacido.val();
//     // var nombre_madre1 = nombre_madre.val();
//     // var nombrePadre1 = nombrePadre.val();
//     if (name == "") {
//         retValue.status = false;
//         retValue.msg = "Please enter a labbbbbel";
//     }
//     else{retValue.status = true;}
//     // if (input_institucion1 == "") {
//     //     card.wizard.errorPopover(input_institucion, "Campo requerido1");
//     //     return false;
//     // }
//     // if (nombrenacido1 == "") {
//     //     card.wizard.errorPopover(nombrenacido, "Campo requerido2");
//     //     return false;
//     // }
//     // if (nombrePadre1 == "") {
//     //     card.wizard.errorPopover(nombre_madre, "Campo requerido3");
//     //     return false;
//     // }

//    return retValue;
// });





  });

  function validarInstitucion(el){
        // var input = el.find("#institucion");
        // var name = input.val();
        // var retValue = {};

        // if (name == "") {
        //   retValue.status = false;
        //   retValue.msg = "Please enter a labbbbbel";
        // } else {
        //   retValue.status = true;
        // }

        // return retValue;
  }
   
  </script>

