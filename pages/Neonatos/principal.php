 <?php

  if(isset($_GET['contenido']))
    {
      $contenido = $_GET['contenido'];
    }
  else
    {
      $contenido = 'neonatos';
    }
	
 require_once("../navbar.php");
require_once("menu_permisos.php");
 

?>

<!-- Main -->
<div class="container-fluid" >
<div class="row">
    <div class="col-sm-9">
        
       <div class="row">
        <div class="col-md-12">
          <div class="featurette">

			 <img class="featurette-image  pull-left" src="img/angel.png">
			<div class="alert alert-success"><h1>Esta es la Seccion de Neonatos</h1></div>
           
          </div>
        </div>
      </div>
    </div><!--/col-span-9-->     
</div>
</div>

  <script>
       
    </script>
<!-- /Main -->