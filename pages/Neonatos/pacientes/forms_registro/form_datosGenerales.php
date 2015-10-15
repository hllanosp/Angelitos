<div class="row">
    <!-- <div class="col-md-12">
      <div class="featurette">

            <img class="featurette-image  pull-left" src="img/angel.png">
            <div class="alert alert-success"><h1>(formulario 1) Datos Generales</h1></div>
       
      </div>
    </div> -->

    <form class = "form" role="form" id="form_actualizar">
      <!-- para poder acceder a la variable usuario_ID por javascript -->
      <input type="hidden" id="usuario_ID" name="idUsuario" value="">
          <div class="form-group">

          </div>
          <div id="verUserName_actualizar" class="form-group">
            <label>Nombre del usuario</label>
            <input type="hidden" id="nombreUsuarioAnt" name="nombreUsuarioAnt" value="">
            <input type="text" class="form-control" id="nombreUsuario_actualizar" maxlength="30" value=" " placeholder="" title = "Solo son permitidos numeros y letras 5 caracteres minimo" pattern="[a-zA-Z0-9]{5,}"autocomplete = "off" required>
          </div>
          <div id="verPass_actualizar" class="form-group">
            <label>Contraseña (Maximo 20 carateres)</label>
            <input type="password" class="form-control" id="password_actualizar" name="password_actualizar" title = "Solo son permitidos numeros y letras 8 caracteres minimo" pattern="[a-zA-Z0-9]{5,}" autocomplete = "off" maxlength="20" required>
          </div>
          <div id="verPass2_actualizar" class="form-group">
            <label class="control-label">Repetir contraseña</label>
            <input type="password" class="form-control" id="password_actualizar2" name="" maxlength="20" required>
          </div>
          <div class="form-group">
            <label class="" for="pwd">Rol del usuario</label>
            <div class="col-sm-10">
                <select id = "rol" class="form-control">
                    <option> -- Seleccione un rol de usuario -- </option>
                    

                </select>
            </div>
          </div>

          <div class="row form-group " style = "height:35px; margin-top: 50px; margin-button : 5px;" >
            <div class="col-md-4">
              <label>Estado del usuario:  </label>

            </div>
            <div class="col-md-8">

            </div>
          </div>
          <hr>
          <div class=" form-group clearfix">
              <button id="submit_actualizar_usuario"  class="btn btn-primary pull-right"><i class="glyphicon glyphicon-edit"></i> Actualizar Informacion</button>
          </div>
      </form>
</div>