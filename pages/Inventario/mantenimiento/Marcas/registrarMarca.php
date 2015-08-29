

  <script type="text/javascript">

  $(document).ready(function() {

    cargarMarcas();

    /* Este evento se levanta cuando le damos enviar al formulario que esta dentro de el modal
    de editar la Marca */
    $("#form_Modificar").submit(function(e) {
            e.preventDefault();
            $("#compose-modal-modificar").modal('hide');

            datosEditados = {
                codigo: $("#codMarca").data('id'),
                nombre: $("#nombreMarca").val()
            };
            $.ajax({
                async: true,
                type: "POST",
                dataType: "html",
                data: datosEditados,
                contentType: "application/x-www-form-urlencoded",
                url: "pages/Inventario/Mantenimiento/Marcas/submitModal.php",
                success: function(data){
                    $("#notificaciones1").html(data);
                    $("#notificaciones1").fadeOut(4500);
                    cargarMarcas();
                },
                timeout: 4000
            });
        });

    /* Este evento se levanta cada vez que le damos click al bottton eliminar */
    $(document).on("click",".eliminaMarca",function () {

        var respuesta = confirm("¿Esta seguro de que desea eliminar el registro seleccionado?");
        if (respuesta)
        {
            var id = $(this).data('id');

            var data =
            {
                codigo: id
            };
            $.ajax({
                async: true,
                type: "POST",
                dataType: "html",
                data: data,
                contentType: "application/x-www-form-urlencoded",
                success: function(data){
                    $("#notificaciones1").html(data);
                    $("#notificaciones1").fadeOut(4500);
                    cargarMarcas();
                },
                url: "pages/Inventario/mantenimiento/Marcas/eliminarMarca.php",
                timeout: 4000
            });
        }
    });

  /* Esta funcion es llamada al principio, es la encargada de actualizar la tabla que muestra
          las categorias que estan en el sistema en ese momento, se recarga cada vez que se elimina o se
          actualiza */
      function cargarMarcas(){

          $.ajax({
              async: true,
              type: "POST",
              url: "pages/Inventario/mantenimiento/Marcas/cargarMarcas.php",
              dataType: "html",
              success: function(data){
                  var response = JSON.parse(data);
                  var options = '';
                  /* Seccion para llenar la tabla */
                  for (var index = 0;index < response.length; index++)
                  {
                     options += '<tr>' +
                                      '<td>' + response[index].codMarca + '</td>' +
                                      '<td>' + response[index].nombreMarca + '</td>' +
                                      '<td><center>'+
                                          '<button data-id = "'+ response[index].codMarca +'" href= "#" class = "editarMarca btn_editar btn btn-info"  data-toggle="modal" data-target = ""><i class="glyphicon glyphicon-edit"></i></button>'+
                                      '</td></center>' +
                                      '<td><center>'+
                                          '<button data-id = "'+ response[index].codMarca +'" href= "#" class = "eliminaMarca btn_editar btn btn-danger"><i class="glyphicon glyphicon-trash"></i></button>'+
                                      '</td></center>' +
                                '</tr>';
                  }


                  $("#cTablaMarca").html(options);

                  /* Script que permite a la tabla hacer busquedas dentro de ella
                      y ordenarla deacuerdo a lo que se presenta en ella.*/
                  $('#tableMarca').dataTable();
              },
              timeout: 4000
          });
      }

      /* Este evento se levanta cuando se le da click a el boton de editar */
   $(document).on("click",".editarMarca",function (e){
        e.preventDefault();
        $("#Mdiv_editarMarca").html("");
        var datos = {

            id:  $(this).data('id')
        };
        $.ajax({
            async: true,
            type: "POST",
            url: "pages/Inventario/mantenimiento/Marcas/actualizarModalMarcas.php",
            data: datos,
            dataType: "html",
            success: function(data){
                var response = JSON.parse(data);
                var options = '';
                /* En esta seccion llenamos los datos que se van a editar el modal*/
                for (var index = 0;index < response.length; index++)
                {
                   options +=   '<div class="form-group">'+
                                    '<label>Codigo de la Marca</label>'+
                                    '<input id="codMarca" disabled = "true" data-id="' + response[index].codMarca + '" placeholder="' + response[index].codMarca + '" class="form-control">'+
                                '</div>'+
                                '<div class="form-group">'+
                                    '<label>Nombre de la Marca</label>'+
                                    '<input id="nombreMarca1" value = "'+response[index].nombreMarca+'"  placeholder="'+response[index].nombreMarca+'" class="form-control" required>'+
                                '</div>';
                }
                /* Insertamos dentro del div del modal los datos obtenidos en la base de datos */
                $("#Mdiv_editarMarca").html(options);

                /* Cuando ya tenemos listo el modal con los datos que queriamos abrimos el modal */
                $('#compose-modal-modificar').modal('show');
            },
            timeout: 4000
        });

    });
       /* Evento se levanta cuando queremos insertar una nueva Marca */
    $("#formInsertar").submit(function (e){
        e.preventDefault();
        var datos = {
            nombreMarca: $("#nombreMarca").val()
        }
        $.ajax({
            async: true,
            type: "POST",
            url: "pages/Inventario/mantenimiento/Marcas/insertarMarca.php",
            data: datos,
            dataType: "html",
            success: function(data){
                $("#notificaciones1").html(data);
                $("#notificaciones1").fadeOut(4500);
                cargarMarcas();
            },
            timeout: 4000
        });

      });
});

</script>

  <div>
      <h1 class="page-header">
          <small>Registrar Marca</small>
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
                              <div id="NMarca" class="form-group">
                                  <label type="button"  >Nombre de la Marca</label>
                                  <input placeholder = "Se necesita un nombre" type="text"  class="form-control" name="nombreMarca" id="nombreMarca" required >
                              </div>
                              <button style="background-color: #473A93;" type="submit" name="submit"  id="submit" class="submit btn btn-primary" >Agregar</button>
                          </form>
                      </div>
                  </div>
              </div>
          </div>
      </div>
  </div>

 <div id = "notificaciones1" ></div>
<!-- Seccion usada para mostrar la tabla de categorias que estan presentes en el sistema -->
<div class="row">
    <div class="panel panel-default">
        <div class="panel-heading">
            <label><span class="glyphicon glyphicon-list" aria-hidden="true"></span> Marcas</label>
        </div>
        <div class="panel-body table-responsive" >
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <section class="content">
                            <div class="box-body table-responsive">
                                <table id= "tableMarca" border="1" class='table table-bordered table-striped display'>
                                    <thead>
                                        <tr style="background-color: rgb(71, 58, 147)"; role = "row">
                                            <th style="color: #FFF">Codigo</th>
                                            <th style="color: #FFF">Nombre</th>
                                            <th style="color: #FFF">Editar</th>
                                            <th style="color: #FFF">Eliminar</th>
                                        </tr>
                                    </thead>
                                    <tbody id = "cTablaMarca">
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
<!-- Modal para editar las Marca -->

<div  class="modal fade" id="compose-modal-modificar" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form role="form" id="form_Modificar" name="form_insertar" action="#">
                <div class="modal-header" >
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="myModalLabel">Modificar Categoria</h4>
                </div>
                <div class = "modal-body">
                    <div id= "Mdiv_editarMarca">

                    </div>
                </div>
                <div class="modal-footer">
                    <button style="background-color: #473A93;" id="guardaredicion" class="btn btn-primary" >Guardar</button>
                </div>
            </form>
        </div>
    </div>
</div>
