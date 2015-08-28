
   <?php
    $maindir = "../../";

    ?>

<div>
  <h1 class="page-header">
      <small>Inventario</small>
  </h1
</div>

<div class="mailbox row" id = "mailbox">
  <div class="box box-solid">
      <div class="box-body well" >
          <div class="row">
            <!--columna del historial de movimientos -->
            <div class="col-xs-12 col-md-3">
                <div class="row">
                	<div class="col-md-12">
                    <h1 style="color:black; margin-left:50px;">Acciones <small></small></h1>
                	</div>
              	</div>

                  <div class="panel panel-green">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-refresh fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <div class="huge">26</div>
                                        <div>Historial</div>
                                    </div>
                                </div>
                            </div>

                                <div class="panel-footer"  role="button" id="reabastecer">
                                    <span class="pull-left" >Reabastecer</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                        <div class="panel panel-yellow">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-shopping-cart fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <div class="huge">12</div>
                                        <div>Historial</div>
                                    </div>
                                </div>
                            </div>

                                <div role = "button" class="panel-footer"  id = "nueva_salida">
                                    <span class="pull-left">Nueva Salida</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                </div>
            <!-- cuerpo principal  del panel inventario -->
          	<div class="col-xs-12 col-md-9 " >
              <div class="box" id="cuerpo_panel_inventario">
                <div id="notificaciones">

                </div>
                  <?php
                    require_once('panel_historial.php');
                   ?>
              </div>
            </div>
          </div>
          <!-- fin panel inventario -->

      </div>
    </div>
</div>

<script type="text/javascript">
  $(document).ready(function(){

    $("#reabastecer").click(function(event) {
      event.preventDefault();
      // alert("has presionado estadisticas");

      $("#cuerpo_panel_inventario" ).load("pages/Inventario/panel_inventario/reabastecer.php" );
      });
    $("#nueva_salida").click(function(event) {
      event.preventDefault();
      // alert("has presionado estadisticas");

      $("#cuerpo_panel_inventario" ).load( "pages/Inventario/panel_inventario/salidaProducto.php"  );
      });

  });

</script>
