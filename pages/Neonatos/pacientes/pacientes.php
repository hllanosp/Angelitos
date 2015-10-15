
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

<div>
      <!-- <h1 class="page-header">
          <small>historial de ingreso</small>
      </h1> -->
      <ol class="breadcrumb">
          <li class="active">
              <span class="fa fa-dashboard"></span> Modulo Neonatos
          </li>
           <li class="active">
              <i class="fa fa-table"></i> Pacientes
          </li>
      </ol>
    </div>


<div id="wizard">
    <h2>Datos Generales</h2>
    <section>
        <?php 
            include($maindir.'pages/Neonatos/pacientes/forms_registro/form_datosGenerales.php');
         ?>
    </section>

    <h2>Datos Maternos</h2>
    <section>
        <?php 
            include($maindir.'pages/Neonatos/pacientes/forms_registro/form_datosMaternos.php');
         ?>
    </section>

    <h2>Examen Fisico</h2>
    <section>
        <?php 
            include($maindir.'pages/Neonatos/pacientes/forms_registro/form_examenFisico.php');
         ?>
    </section>

    <h2>Ingreso</h2>
    <section>
        <?php 
            include($maindir.'pages/Neonatos/pacientes/forms_registro/form_ingreso.php');
         ?>
    </section>
    
    <h2>Patologias y Tratamientos</h2>
    <section>
        <?php 
            include($maindir.'pages/Neonatos/pacientes/forms_registro/form_patologias_tratamientos.php');
         ?>
    </section>

    <h2>Recien Nacidos</h2>
    <section>
        <?php 
            include($maindir.'pages/Neonatos/pacientes/forms_registro/form_recienNacidos.php');
         ?>
    </section>

    <h2>Test Silverman</h2>
    <section>
        <?php 
            include($maindir.'pages/Neonatos/pacientes/forms_registro/form_testSilverman.php');
         ?>    
    </section>

    <h2>Transporte</h2>
    <section>
        <?php 
            include($maindir.'pages/Neonatos/pacientes/forms_registro/form_transporte.php');
         ?>
    </section>

    <h2>Valoracion Inicial</h2>
    <section>
        <?php 
            include($maindir.'pages/Neonatos/pacientes/forms_registro/form_valoracionInicial.php');
         ?>
    </section>

    
</div>

  <script>
   $("#wizard").steps({
        headerTag: "h2",
        bodyTag: "section",
        transitionEffect: "slideLeft",
        stepsOrientation: "vertical"
    });
  </script>