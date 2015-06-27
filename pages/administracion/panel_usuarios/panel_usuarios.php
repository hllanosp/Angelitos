
  <div id="contenedor"></div>
    <div  class="panel panel-info">
              <!-- Default panel contents -->
              <div class="panel-heading">
                <div class="btn-group" role="group" aria-label="usuarios/logs">
                    <button type="button" class="btn btn-small btn-default" id="cargar_usuarios">usuarios</button>
                </div>
                <div class="btn-group" role="group" aria-label="usuarios/logs">
                    <button type="button" class="btn btn-default" id="cargas_logs">Logs</button>
                </div>
              </div>
              <div class="panel-body ">
                <!-- cuerpo del panel -->
               <?php 
               require_once("panel_gestion_usuarios.php");?>
              </div>
          
          <!-- fin del panel gestion de usuarios -->

    </div>

