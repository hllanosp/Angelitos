
  $(document).ready(function(){

    $("#inv_home").click(function(event) {
      event.preventDefault();
      // alert("has presionado estadisticas");

      $("#div_contenido" ).load( "pages/Inventario/principal_inventario.php" );
      });
    $("#inv_inventario").click(function(event) {
      event.preventDefault();
      // alert("has presionado estadisticas");

      $("#page-wrapper" ).load( "pages/Inventario/panel_inventario.php" );
      });

});
