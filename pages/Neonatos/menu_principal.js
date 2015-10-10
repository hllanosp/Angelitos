
  $(document).ready(function(){

    $("#neonatos_home").click(function(event) {
      event.preventDefault();
      // alert("has presionado neonatos home");

      $("#div_contenido" ).load( "pages/Neonatos/principal_neonatos.php" );
      });

    $("#neonatos_pacientes").click(function(event) {
      event.preventDefault();
      // alert("has presionado estadisticas");

      $("#page-wrapper" ).load( "pages/Neonatos/pacientes/pacientes.php" );
      });

    $("#neonatos_traslados").click(function(event) {
      event.preventDefault();
      // alert("has presionado estadisticas");

      $("#page-wrapper" ).load( "pages/Neonatos/traslados/traslados.php" );
      });

    // $("#logs").click(function(event) {
    //   event.preventDefault();
    //   $("#page-wrapper").load("pages/administracion/logs/Logs.php" );
    //   });
});
