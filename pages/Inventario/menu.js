
  $(document).ready(function(){

    cargarProductosPE();
    cargarProductosSA();
    cargarProductosMC();

    $("#inv_home").click(function(event) {
      event.preventDefault();
      // alert("has presionado estadisticas");

      $("#div_contenido" ).load( "pages/Inventario/principal_inventario.php" );
      });
    $("#inv_inventario").click(function(event) {
      event.preventDefault();
      // alert("has presionado estadisticas");

      $("#page-wrapper" ).load( "pages/Inventario/panel_inventario/panel_inventario.php" );
      });

      $("#inv_reportes").click(function(event) {
        event.preventDefault();
        // alert("has presionado estadisticas");

        $("#page-wrapper" ).load( "pages/Inventario/Reporte/generarReportes.php" );
        });
      
      $("#registro_producto").click(function(event) {
        event.preventDefault();
        // alert("has presionado estadisticas");

        $("#page-wrapper" ).load( "pages/Inventario/mantenimiento/Producto/registrarProducto.php" );
        });
    //
    $("#registro_categoria").click(function(event) {
      event.preventDefault();
      $("#page-wrapper").load("pages/Inventario/mantenimiento/Categorias/registrarCategoria.php" );
      });

    $("#registro_marca").click(function(event) {
      event.preventDefault();
      $("#page-wrapper").load("pages/Inventario/mantenimiento/Marcas/registrarMarca.php" );
      });

    function cargarProductosPE(){

          $.ajax({
              async: true,
              url: "pages/Inventario/cargarProductosPocaExistencia.php",
              dataType: "html",
              success: function(data){
                  var response = JSON.parse(data);
                  var options = '';
                  /* Seccion para llenar la tabla */
                  for (var index = 0;index < response.length; index++) 
                  {
                     options += '<div>'+
                                  '<li>'+
                                    '<a id="dato1" href="#">'+response[index].producto+ ': '+response[index].cantidad+ '</a>'+
                                  '</li>'+
                                '</div>';
                  }
                  $("#1").html(options); 
              },
              timeout: 4000
          });
      }
      function cargarProductosSA(){

          $.ajax({
              type: "POST",
              async: true,
              url: "pages/Inventario/cargarProductosProntosAvencer.php",
              dataType: "html",
              success: function(data){
                  var response = JSON.parse(data);
                  var options = '';
                  for (var index = 0;index < response.length; index++) 
                  {
                     options += '<div>'+
                                  '<li>'+
                                    '<a id="dato1" href="#">'+response[index].producto+ ': '+response[index].fecha+ '</a>'+
                                  '</li>'+
                                '</div>';
                  }
                  $("#2").html(options); 
              },
              timeout: 4000
          });
      }

      function cargarProductosMC(){

          $.ajax({
              type: "POST",
              async: true,
              url: "pages/Inventario/cargarProductosMayorExistencia.php",
              dataType: "html",
              success: function(data){
                  var response = JSON.parse(data);
                  var options = '';
                  for (var index = 0;index < response.length; index++) 
                  {
                     options += '<div>'+
                                  '<li>'+
                                    '<a id="dato1" href="#"><i></i>'+response[index].producto+ ': '+response[index].cantidad+ '</a>'+
                                  '</li>'+
                                '</div>';
                  }
                  $("#3").html(options); 
              },
              timeout: 4000
          });
      }
    });


