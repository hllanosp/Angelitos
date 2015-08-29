
  <?php

      $mkdir = "../../../../";
      include($mkdir."conexion/config.inc.php");

   ?>

  <script type="text/javascript">

  var combo1 = '';
  var combo2 = '';
  $(document).ready(function() {

    cargarProductos();


    /* Este evento se levanta cuando le damos enviar al formulario que esta dentro de el modal
    de editar el producto */
    $("#form_Modificar").submit(function(e) {
            e.preventDefault();
            $("#compose-modal-modificar").modal('hide');

            datosEditados = {
                codigo: $("#codProducto").data('id'),
                nombre: $("#nombreProducto1").val()
            };
            $.ajax({
                async: true,
                type: "POST",
                dataType: "html",
                data: datosEditados,
                contentType: "application/x-www-form-urlencoded",
                url: "pages/Inventario/Mantenimiento/Producto/submitModal.php",
                success: function(data){
                    $("#notificaciones1").html(data);
                    $("#notificaciones1").fadeOut(4500);
                    cargarProductos();
                },
                timeout: 4000
            });
        });

    /* Este evento se levanta cada vez que le damos click al bottton eliminar */
    $(document).on("click",".eliminaProducto",function () {

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
                    cargarProductos();
                },
                url: "pages/Inventario/mantenimiento/Producto/eliminarProducto.php",
                timeout: 4000
            });
        }
    });

  /* Esta funcion es llamada al principio, es la encargada de actualizar la tabla que muestra
          los productos que estan en el sistema en ese momento, se recarga cada vez que se elimina o se
          actualiza */
      function cargarProductos(){

          $.ajax({
              async: true,
              type: "POST",
              url: "pages/Inventario/mantenimiento/Producto/cargarProducto.php",
              dataType: "html",
              success: function(data){
                  var response = JSON.parse(data);
                  var options = '';
                  /* Seccion para llenar la tabla */
                  for (var index = 0;index < response.length; index++)
                  {
                     options += '<tr>' +
                                      '<td>' + response[index].codProducto + '</td>' +
                                      '<td>' + response[index].nombreProducto + '</td>' +
                                      '<td>' + response[index].nombreTipo + '</td>' +
                                      '<td>' + response[index].nombreMarca + '</td>' +
                                      '<td><center>'+
                                          '<button data-marca = "'+ response[index].nombreMarca+ '" data-tipo = "'+ response[index].nombreTipo+'"  data-id = "'+ response[index].codProducto +'" href= "#" class = "editarProducto btn_editar btn btn-info"  data-toggle="modal" data-target = ""><i class="glyphicon glyphicon-edit"></i></button>'+
                                      '</td></center>' +
                                      '<td><center>'+
                                          '<button data-id = "'+ response[index].codProducto +'" href= "#" class = "eliminaProducto btn_editar btn btn-danger"><i class="glyphicon glyphicon-trash"></i></button>'+
                                      '</td></center>' +
                                '</tr>';
                  }


                  $("#cTablaProducto").html(options);

                  /* Script que permite a la tabla hacer busquedas dentro de ella
                      y ordenarla deacuerdo a lo que se presenta en ella.*/
                  $('#tableProducto').dataTable();
              },
              timeout: 4000
          });
      }

      /* Este evento se levanta cuando se le da click a el boton de editar */
   $(document).on("click",".editarProducto",function (e){
        e.preventDefault();
        llenarCombo1($(this).data('tipo'));
        llenarCombo2($(this).data('marca'));
        $("#Mdiv_editarProducto").html("");
        var datos = {

            id:  $(this).data('id')
        };
        $.ajax({
            async: true,
            type: "GET",
            url: "pages/Inventario/mantenimiento/Producto/actualizarModalProductos.php",
            data: datos,
            dataType: "html",
            success: function(data){
                var response = JSON.parse(data);
                var options = '';
                /* En esta seccion llenamos los datos que se van a editar el modal*/
                for (var index = 0;index < response.length; index++)
                {
                   options +=   '<div class="form-group">'+
                                    '<label>Codigo del producto</label>'+
                                    '<input id="codProducto" disabled = "true" data-id="' + response[index].codProducto + '" placeholder="' + response[index].codProducto + '" class="form-control">'+
                                '</div>'+
                                '<div class="form-group">'+
                                    '<label>Nombre del producto</label>'+
                                    '<input id="nombreCategoria1" value = "'+response[index].nombreProducto+'"  placeholder="'+response[index].nombreProducto+'" class="form-control" required>'+
                                '</div>'+
                                '<div>'+
                                  '<select id = "Tipos" class="form-control" name="combobox1" required>'+combo1+
                                  '</select >'+
                                '</div>'+
                                 '<br>'+
                                '<div>'+
                                  '<select id = "Marcas" class="form-control" name="combobox2" required>'+combo2+
                                  '</select>'+
                                '</div>';
                }
                /* Insertamos dentro del div del modal los datos obtenidos en la base de datos */
                $("#Mdiv_editarProducto").html(options);

                /* Cuando ya tenemos listo el modal con los datos que queriamos abrimos el modal */
                $('#compose-modal-modificar').modal('show');
            },
            timeout: 4000
        });

    });

    function llenarCombo1(valor){
        $.ajax({
              async: true,
              url: "pages/Inventario/mantenimiento/Producto/cargarCombo1.php",
              dataType: "html",
              success: function(data){
                  var response = JSON.parse(data);
                  /* Seccion para llenar el combobox */
                  for (var index = 0;index < response.length; index++)
                  {
                    if(response[index].nombre == valor){
                        combo1 += "<option selected value='"+response[index].codigo+"'>"+response[index].nombre+"</option>";
                    }else{
                      combo1 += "<option value='"+response[index].codigo+"'>"+response[index].nombre+"</option>";
                    }
                  }
              },
              timeout: 4000
          });


    }
    function llenarCombo2(valor){
        $.ajax({
              async: true,
              url: "pages/Inventario/mantenimiento/Producto/cargarCombo2.php",
              dataType: "html",
              success: function(data){
                  var response = JSON.parse(data);
                  /* Seccion para llenar el combobox */
                  for (var index = 0;index < response.length; index++)
                  {
                    if(response[index].nombre == valor){
                        combo2 += '<option selected value="'+response[index].codigo+'">'+response[index].nombre+'</option>';
                    }else{
                      combo2 += '<option value="'+response[index].codigo+'">'+response[index].nombre+'</option>';
                    }
                  }
              },
              timeout: 4000
          });
    }

       /* Evento se levanta cuando queremos insertar un nuevo producto */
    $("#formInsertar").submit(function (e){
        e.preventDefault();
        var datos = {
            nombreProducto: $("#nombreProducto").val(),
            tipoProducto: $('#comboBox1').val(),
            marcas: $('#comboBox2').val()
        }
        $.ajax({
            async: true,
            type: "POST",
            url: "pages/Inventario/mantenimiento/Producto/insertarProducto.php",
            data: datos,
            dataType: "html",
            success: function(data){
                $("#notificaciones1").html(data);
                $("#notificaciones1").fadeOut(4500);
                cargarProductos();
            },
            timeout: 4000
        });

      });
});

</script>

  <div>
      <h1 class="page-header">
          <small>Registrar Producto</small>
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
                  <label><span class="glyphicon glyphicon-globe" aria-hidden="true"></span> Ingrese un nuevo Producto</label>
              </div>
              <div class="panel-body">
                  <div>
                         <div id= "noti1" class="alert alert-info" role="alert" style="color: #FFF; background-color: rgb(71, 58, 147)"><center>Por favor ingrese los datos que acontinuacion se le piden</center></div>
                  </div>
                  <div class="row">
                      <div class="col-lg-6">
                          <form id = "formInsertar" role="form" action="#" method="POST">
                              <div id="NProducto" class="form-group">
                                  <label type="button"  >Nombre del productp</label>
                                  <input placeholder = "Se necesita un nombre" type="text"  class="form-control" name="nombreProducto" id="nombreProducto" required >
                              </div>
                              <div>
                                  <select class="form-control" name="combobox1" id="comboBox1" required>
                                    <?php
                                      $query = $db->prepare("SELECT * FROM i_tipo_producto");
                                      $query->execute();
                                      $result = $query->fetchAll();
                                      foreach($result as $row){
                                        echo "<option value='".$row['id_tipo_producto']."'>".$row['descripcion']."</option>";
                                      }
                                    ?>
                                  </select>
                              </div>
                              <br>
                              <div>
                                  <select class="form-control" name="combobox1" id="comboBox2" required>
                                    <?php
                                      $query = $db->prepare("SELECT * FROM i_marca");
                                      $query->execute();
                                      $result = $query->fetchAll();
                                      foreach($result as $row){
                                        echo "<option value='".$row['id_marca']."'>".$row['descripcion']."</option>";
                                      }
                                    ?>
                                  </select>
                              </div>
                              <br>
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
<div class=row">
    <div class="panel panel-default">
        <div class="panel-heading">
            <label><span class="glyphicon glyphicon-list" aria-hidden="true"></span> Producto</label>
        </div>
        <div class="panel-body table-responsive" >
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <section class="content">
                            <div class="box-body table-responsive">
                                <table id= "tableProducto" border="1" class='table table-bordered table-striped display'>
                                    <thead>
                                        <tr style="background-color: rgb(71, 58, 147)"; role = "row">
                                            <th style="color: #FFF">Codigo</th>
                                            <th style="color: #FFF">Nombre</th>
                                            <th style="color: #FFF">Tipo</th>
                                            <th style="color: #FFF">Marca</th>
                                            <th style="color: #FFF">Editar</th>
                                            <th style="color: #FFF">Eliminar</th>
                                        </tr>
                                    </thead>
                                    <tbody id = "cTablaProducto">
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
<!-- Modal para editar las Producto -->

<div  class="modal fade" id="compose-modal-modificar" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form role="form" id="form_Modificar" name="form_insertar" action="#">
                <div class="modal-header" >
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="myModalLabel">Modificar Producto</h4>
                </div>
                <div class = "modal-body">
                    <div id= "Mdiv_editarProducto">

                    </div>
                </div>
                <div class="modal-footer">
                    <button style="background-color: #473A93;" id="guardaredicion" class="btn btn-primary" >Guardar</button>
                </div>
            </form>
        </div>
    </div>
</div>
