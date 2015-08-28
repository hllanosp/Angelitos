  

  <script type="text/javascript">
  
  $(document).ready(function() {

    cargarCategorias();

  /* Esta funcion es llamada al principio, es la encargada de actualizar la tabla que muestra
          las categorias que estan en el sistema en ese momento, se recarga cada vez que se elimina o se 
          actualiza */
      function cargarCategorias(){

          $.ajax({
              async: true,
              type: "POST",
              url: "pages/Inventario/mantenimiento/Categorias/cargarCategorias.php",
              dataType: "html",
              success: function(data){
                  var response = JSON.parse(data);
                  var options = '';
                  /* Seccion para llenar la tabla */
                  for (var index = 0;index < response.length; index++) 
                  {
                     options += '<tr>' +
                                      '<td>' + response[index].codCategoria + '</td>' +
                                      '<td>' + response[index].nombreCategoria + '</td>' +
                                      '<td><center>'+
                                          '<button data-id = "'+ response[index].codCategoria +'" href= "#" class = "editarCategoria btn_editar btn btn-info"  data-toggle="modal" data-target = ""><i class="glyphicon glyphicon-edit"></i></button>'+
                                      '</td></center>' +
                                      '<td><center>'+
                                          '<button data-id = "'+ response[index].codCategoria +'" href= "#" class = "eliminaCategoria btn_editar btn btn-danger"><i class="glyphicon glyphicon-trash"></i></button>'+
                                      '</td></center>' +             
                                '</tr>';
                  }

              
                  $("#cTablaCategorias").html(options);

                  /* Script que permite a la tabla hacer busquedas dentro de ella
                      y ordenarla deacuerdo a lo que se presenta en ella.*/
                  $('#tableCategorias').dataTable(); 
              },
              timeout: 4000
          }); 
      }

      /* Este evento se levanta cuando se le da click a el boton de editar */
   $(document).on("click",".editarCategoria",function (e){
        e.preventDefault();
        $("#Mdiv_editarCategorias").html("");
        var datos = { 
            
            id:  $(this).data('id') 
        };
        $.ajax({
            async: true,
            type: "POST",
            url: "pages/Inventario/mantenimiento/Categorias/actualizarModalCategorias.php",
            data: datos,
            dataType: "html",
            success: function(data){
                var response = JSON.parse(data);
                var options = '';
                /* En esta seccion llenamos los datos que se van a editar el modal*/ 
                for (var index = 0;index < response.length; index++) 
                {
                   options +=   '<div class="form-group">'+
                                    '<label>Codigo de la Categoria</label>'+
                                    '<input id="codCategoria" disabled = "true" data-id="' + response[index].codCategoria + '" placeholder="' + response[index].codCategoria + '" class="form-control">'+
                                '</div>'+
                                '<div class="form-group">'+
                                    '<label>Nombre de la Categoria</label>'+
                                    '<input id="nombreCiudad1" value = "'+response[index].nombreCategoria+'"  placeholder="'+response[index].nombreCategoria+'" class="form-control" required>'+
                                '</div>';
                }
                /* Insertamos dentro del div del modal los datos obtenidos en la base de datos */
                $("#Mdiv_editarCategorias").html(options);

                /* Cuando ya tenemos listo el modal con los datos que queriamos abrimos el modal */
                $('#compose-modal-modificar').modal('show');
            },
            timeout: 4000
        });

    });


    });

</script>

  <div>
      <h1 class="page-header">
          <small>Registrar Categoria</small>
      </h1>
      <ol class="breadcrumb">
          <li class="active">
              <span class="fa fa-dashboard"></span></i> Inventario
          </li>
           <li class="active">
              <i class="fa fa-table"></i> mantenimiento
          </li>
      </ol>
  </div>
  <div class="row">
      <div class="col-lg-12">
          <div class="panel panel-default" style="border-color: #473A93;" >
              <div class="panel-heading" style="color: #FFF; background-color: rgb(71, 58, 147)">
                  <label><span class="glyphicon glyphicon-globe" aria-hidden="true"></span> Ingrese una nueva Categoria</label>
              </div>
              <div class="panel-body">
                  <div>
                         <div id= "noti1" class="alert alert-info" role="alert" style="color: #FFF; background-color: rgb(71, 58, 147)"><center>Por favor ingrese los datos que acontinuacion se le piden</center></div>
                  </div>
                  <div class="row">
                      <div class="col-lg-6">
                          <form id = "formInsertar" role="form" action="#" method="POST">
                              <div id="NCategoria" class="form-group">
                                  <label type="button"  >Nombre de la Categoria</label>
                                  <input placeholder = "Se necesita un nombre" type="text"  class="form-control" name="nombreCategoria" id="nombreCategoria" required >
                              </div>
                              <button style="background-color: #473A93;" type="submit" name="submit"  id="submit" class="submit btn btn-primary" >Agregar</button>
                          </form>
                      </div>
                  </div>
              </div>
          </div>
      </div>
  </div>

<!-- Seccion usada para mostrar la tabla de categorias que estan presentes en el sistema -->
<div class="col-lg-12">
    <div class="panel panel-default">
        <div class="panel-heading">
            <label><span class="glyphicon glyphicon-list" aria-hidden="true"></span> Categorias</label>
        </div>
        <div class="panel-body table-responsive" >
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <section class="content">
                            <div class="box-body table-responsive">
                                <table id= "tableCategorias" border="1" class='table table-bordered table-striped display'>
                                    <thead>
                                        <tr style="background-color: rgb(71, 58, 147)"; role = "row">
                                            <th style="color: #FFF">Codigo</th>
                                            <th style="color: #FFF">Nombre</th>   
                                            <th style="color: #FFF">Editar</th>
                                            <th style="color: #FFF">Eliminar</th>                  
                                        </tr>
                                    </thead>
                                    <tbody id = "cTablaCategorias">
                                        <!-- Contenido de la tabla generado atravez de la consulta a 
                                            la base de datos -->
                                    </tbody>
                                </table>       
                            </div>
                        </section>
                    </div>                
                </div>
            </div>       
        </div>
    </div>
</div>
 <!-- fin tabla -->

<!-- Modal para editar las Categorias -->

<div  class="modal fade" id="compose-modal-modificar" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form role="form" id="form_Modificar" name="form_insertar" action="#">
                <div class="modal-header" >
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="myModalLabel">Modificar Categoria</h4>
                </div>
                <div class = "modal-body">
                    <div id= "Mdiv_editarCategorias">
                        
                    </div>                
                </div>
                <div class="modal-footer">
                    <button style="background-color: #473A93;" id="guardaredicion" class="btn btn-primary" >Guardar</button>
                </div>
            </form>
        </div>
    </div>
</div>
