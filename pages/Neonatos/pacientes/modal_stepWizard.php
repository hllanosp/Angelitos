<?php 
 $maindir = "../../../";
 ?>

<style>
    .modal-header{
        background-color: white;
        color: black;
    }
</style>

<div class="wizard" id="some-wizard" data-title="Wizard Title">
    <div class="wizard-card" data-cardname="card1" style="height: 525px;">
        <h3 hidden>Datos Generales</h3>
        <?php
            include($maindir.'pages/Neonatos/pacientes/forms_registro/form_datosGenerales.php');
        ?>
    </div>

    <div class="wizard-card" data-cardname="card2" style="height: 525px;">
        <h3>Transporte</h3>
         <?php 
            include($maindir.'pages/Neonatos/pacientes/forms_registro/form_transporte.php');
         ?>
    </div>

    
    <div class="wizard-card" data-cardname="card3" style="height: 525px;">
        <h3>Ingreso</h3>
         <?php 
            include($maindir.'pages/Neonatos/pacientes/forms_registro/form_ingreso.php');
         ?>
    </div>

    
    <div class="wizard-card" data-cardname="card4" style="height: 525px;">
        <h3>Datos Maternos</h3>
         <?php 
            include($maindir.'pages/Neonatos/pacientes/forms_registro/form_datosMaternos.php');
         ?>
    </div>

    
    <div class="wizard-card" data-cardname="card5" style="height: 525px;">
        <h3>Datos Recien Nacido</h3>
        <?php 
            include($maindir.'pages/Neonatos/pacientes/forms_registro/form_recienNacidos.php');
         ?>
    </div>

    
    <div class="wizard-card" data-cardname="card6" style="height: 525px;">
        <h3>Valoracion Inicial</h3>
        <?php 
            include($maindir.'pages/Neonatos/pacientes/forms_registro/form_valoracionInicial.php');
         ?>
    </div>

    
    <div class="wizard-card" data-cardname="card7" style="height: 525px;">
        <h3>Examen Fisico</h3>
         <?php 
            include($maindir.'pages/Neonatos/pacientes/forms_registro/form_examenFisico.php');
         ?>  
    </div>

    
    <div class="wizard-card" data-cardname="card8" style="height: 525px;">
        <h3>Test Silverman</h3>
          <?php 
            include($maindir.'pages/Neonatos/pacientes/forms_registro/form_testSilverman.php');
         ?>
    </div>

    <div class="wizard-card" data-cardname="card9" style="height: 525px;">
        <h3>Patologias</h3>
          <?php 
            include($maindir.'pages/Neonatos/pacientes/forms_registro/form_patologias_tratamientos.php');
         ?>
    </div>

</div>