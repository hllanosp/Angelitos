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




// function areas()
// {
//     $.ajax({
//         async:true,
//         type: "POST",
//         dataType: "html",
//         contentType: "application/x-www-form-urlencoded",
//         //url:"pages/mantenimiento.php",    
//         // url:"../cargarPOAs.php",  
//        // beforeSend:inicioEnvio,
//         success:p_areas,
//         timeout:4000,
//         error:problemas
//     }); 
//     return false;
// }

// function tiposDeAreas()
// {
//     $.ajax({
//         async:true,
//         type: "POST",
//         dataType: "html",
//         contentType: "application/x-www-form-urlencoded",
//         //url:"pages/poas.php",    
//         // url:"../cargarPOAs.php",  
//         //beforeSend:inicioEnvio,
//         success:p_tiposDeAreas,
//         timeout:4000,
//         error:problemas
//     }); 
//     return false;
// }




// function estadisticas()
// {
//     alert("estoy en estadisticas");
//     $.ajax({
//         async:true,
//         type: "POST",
//         dataType: "html",
//         contentType: "application/x-www-form-urlencoded",
//         //url:"pages/mantenimiento.php",    
//         // url:"../cargarPOAs.php",  
//        // beforeSend:inicioEnvio,
//         success:llegadaEstadisticas,
//         //timeout:4000,
//         //error:problemas
//     }); 
//     return false;
// }

// function reportes()
// {
//     $.ajax({
//         async:true,
//         type: "POST",
//         dataType: "html",
//         contentType: "application/x-www-form-urlencoded",
//         //url:"pages/mantenimiento.php",    
//         // url:"../cargarPOAs.php",  
//        // beforeSend:inicioEnvio,
//         success:llegadaReportes,
//         //timeout:4000,
//         //error:problemas
//     }); 
//     return false;
// }


// function ajustes()
// {
//     $.ajax({
//         async:true,
//         type: "POST",
//         dataType: "html",
//         contentType: "application/x-www-form-urlencoded",
//         //url:"pages/mantenimiento.php",    
//         // url:"../cargarPOAs.php",  
//        // beforeSend:inicioEnvio,
//         success:llegadaAjuste,
//         timeout:4000,
//         error:problemas
//     }); 
//     return false;
// }
// function actividades()
// {
//     $.ajax({
//         async:true,
//         type: "POST",
//         dataType: "html",
//         contentType: "application/x-www-form-urlencoded",
//         //url:"pages/poas.php",    
//         // url:"../cargarPOAs.php",  
//         //beforeSend:inicioEnvio,
//         success:llegadaCalendario,
//         timeout:4000,
//         error:problemas
//     }); 
//     return false;
// }

// function crear()
// {
    
//     $.ajax({
//         async:true,
//         type: "POST",
//         dataType: "html",
//         contentType: "application/x-www-form-urlencoded",
//         url:"pages/crearPOA.php",    
//         // url:"../cargarPOAs.php",  
//         beforeSend:inicioEnvio,
//         success:llegadaCrear,
//         timeout:4000,
//         error:problemas
//     }); 
//     return false;
// }


// function inicioEnvio()
// {
//     var x=$("#contenedor");
//     x.html('Cargando...');
// }

// function llegadaEstadisticas()
// {
//     $("#contenedor").load('panel_Grafos/grafo_empleados.php');
     //$("#contenedor").load('../cargarPOAs.php');
// }

// function llegadaReportes()
// {
//     $("#contenedor").load('pages/reportesActividades.php');
//      //$("#contenedor").load('../cargarPOAs.php');
// }


// function llegadaAjuste()
// {
//     $("#contenedor").load('pages/mantenimiento.php');
//      //$("#contenedor").load('../cargarPOAs.php');
// }
// function llegadaCalendario()
// {
//     $("#contenedor").load('pages/calendarioActividades.php');
//      //$("#contenedor").load('../cargarPOAs.php');
// }
// function llegadaCrear()
// {
//     $("#contenedor").load('pages/crearPOA.php');
//      //$("#contenedor").load('../cargarPOAs.php');
// }

// function problemas()
// {
//     $("#contenedor").text('Problemas en el servidor.');
// }

// function p_areas()
// {
//     $("#contenedor").load('pages/areas.php');
// }

// function p_tiposDeAreas()
// {
//     $("#contenedor").load('pages/tiposDeAreas.php');
// }