 <?php

  if(isset($_GET['contenido']))
    {
      $contenido = $_GET['contenido'];
    }
  else
    {
      $contenido = 'home';
    }


  require_once("navbar.php");

?>

<!-- Main -->
<div class="container-fluid" >
<div class="row">
    <div class="col-sm-12">

       <div class="row">
        <div class="col-md-12">
          <div class="featurette">

			 <img class="featurette-image  pull-left" src="img/home.jpg">

          </div>
        </div>
      </div>
    </div><!--/col-span-9-->
</div>
</div>

  <script>
         // $.backstretch("../img/fondo.jpg", {speed: 1000});
    </script>
<!-- /Main -->
