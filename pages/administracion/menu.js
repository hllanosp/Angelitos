/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

  $(document).ready(function(){

    $("#usuarios").click(function(event) {
      event.preventDefault();
      // alert("has presionado estadisticas");

      $("#div_contenido" ).load( "pages/administracion/admin.php" );
      });
    $("#historial_ingreso").click(function(event) {
      event.preventDefault();
      // alert("has presionado estadisticas");

      $("#contenedor" ).load( "pages/administracion/panel_Grafos/historial_ingreso.php" );
      });
    $("#usuarios_activos").click(function(event) {
      event.preventDefault();
      // alert("has presionado estadisticas");

      $("#contenedor" ).load( "pages/administracion/panel_Grafos/grafo_empleados.php" );
      });

    $("#logs").click(function(event) {
      event.preventDefault();
      $("#contenedor").load("pages/administracion/logs/Logs.php" );
      });
});
