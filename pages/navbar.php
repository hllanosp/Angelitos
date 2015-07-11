<?php 




//definine esta variable temporal para tener un rol cuon el cual trabajar 
  $rol = 100;
 
?>

<div class="navbar navbar-default" id="subnav">
    <div class="col-md-12">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse2">
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
      </button>
        <div class="collapse navbar-collapse" id="navbar-collapse2">
          <ul class="nav navbar-nav navbar-left">

  <!-- Generacion del navbar  -->
<?php
  // --------------------------------------------------------------
  if($contenido == 'home'){
    echo <<<HTML
      <li  class="active"><a role='button' id="home" >Inicio</a></li>
HTML;
  }
  else{
    $url = 'home.php';
    echo <<<HTML
    <li><a role='button' id="home" >Inicio</a></li>
HTML;
  }

  // ----------------------------------------------------------------
  // pagina del neonatos
  if($rol == 100 || $rol == 50 || $rol == 30 || $rol == 20){
    if($contenido == 'neonatos'){       
      // switch($rol){   
      //   case 100: 
      //     $url = 'pages/Neonatos/principal.php?contenido=neonatos';// 100    
      //     break;
      // }
      echo <<<HTML
      <li class="active"><a id="neonatos">Neonatos</a></li>

HTML;
    }
    else{
      echo <<<HTML
      <li><a role="button" id="neonatos">Neonatos</a></li>
HTML;
    }
  }
    // ----------------------------------------------------------------
             
    // pagina de Reportes
    if($rol == 100 || $rol == 50 || $rol == 30 || $rol == 20){
      if($contenido == 'reportes') 
      {
        // switch($rol){   
        //   case 100: 
        //     $url = 'pages/Reportes/principal_reportes.php?contenido=reportes';
        //     break;
        // }
          echo <<<HTML
          <li class="active"><a role="button" id="reportes">Reportes</a></li>
HTML;
      }
      else{
        echo <<<HTML
        <li><a role="button" id="reportes">Reportes</a></li>
HTML;
      }
    }

    // ----------------------------------------------------------------------
    if($rol == 100){
    // pagina del programa kanguro
      if($contenido == 'kanguro'){
        echo <<<HTML
        <li class="active"><a role="button" id="pkanguro">Programa Kanguro</a></li>

HTML;
      }
      else{
          $url = 'pages/Programa_Kanguro/principal_kanguro.php?contenido=kanguro';
          echo <<<HTML
                <li><a role="button" id="pkanguro">Programa Kanguro</a></li>
HTML;
      }
    } 
    // --------------------------------------------------------------------------

    if($rol >= 40){
     // pagina del modulo de gestion de folios
      if($contenido == 'inventario') {
        $url = 'pages/Inventario/principal_inventario.php?contenido=inventario';
        echo <<<HTML
        <li class="active"><a role="button" id="Inventario" >Inventario</a></li>
HTML;
      }
      else{
        $url = 'pages/Inventario/principal_inventario.php?contenido=inventario';
        echo <<<HTML
        <li><a role='button' id="Inventario"  >Inventario</a></li>
HTML;
        }
    }
    //---------------------------------------------------------------------------- 
?>

           </ul>
        </div>  
     </div> 
</div>
<!-- fin del navbar -->
<script>
  $(document).ready(function() {
      // evento para neonatos
      $("#neonatos").click(function(event) {
      event.preventDefault();
          
      $("#div_contenido" ).load( "pages/Neonatos/principal.php?contenido=neonatos" );
      }); 
      // --------------------------
         
        $("#home").click(function(event) {
      event.preventDefault();
      $("#div_contenido" ).load( "pages/home.php?contenido=home" );
    
      }); 
      // ----------------------------
        $("#Inventario").click(function(event) {
      event.preventDefault();
          
      $("#div_contenido" ).load( "pages/Inventario/principal_inventario.php?contenido=inventario" );
    
      }); 
      
        $("#pkanguro").click(function(event) {
      event.preventDefault();
      $("#div_contenido" ).load( "pages/Programa_Kanguro/principal_kanguro.php?contenido=kanguro" );
    
  
      }); 
      
        $("#reportes").click(function(event) {
      event.preventDefault();
      $("#div_contenido" ).load( "pages/Reportes/principal_reportes.php?contenido=reportes" );
    

      });

      }); 

</script>