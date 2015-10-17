         
        <div class="wizard-input-section">
            <div id="verUserName" class="form-group ">
                        <label>Nombre del usuario</label>
                        <input type="text" class="form-control" name = "nombreUsuario" id="nombreUsuario" title = "Solo son permitidos numeros y letras 5 caracteres minimo" minlength="5" pattern="[a-zA-Z0-9]{5,}"autocomplete = "off"required >
        </div>

        </div>
        <div class="wizard-input-section">
            <div id="verPass" class="form-group">
                        <label>Contraseña </label>
                        <input type="password" class="form-control" id="password" name="password"  title = "Solo son permitidos numeros y letras 8 caracteres minimo"  pattern="[a-zA-Z0-9]{5,}" autocomplete = "off"required >
                    </div>

        </div>
        <div class="wizard-input-section">
            <div id="verPass2" class="form-group">
                        <label class="control-label">Repetir contraseña</label>
                        <input type="password" class="form-control" id="password2" name="password2" value = "">
                    </div>

        </div>
        <div class="wizard-input-section">
            <div id = "verrol"class="form-group">
            <label class="" for="pwd">Rol del usuario</label>
            <div class="col-sm-10">
                <select id = "rol" class="form-control">
                   
                </select>
            </div>
          </div>

        </div>
        <div class="wizard-input-section">
            <div class="modal-footer clearfix">
              <button  id="guardar_usuario" class="btn btn-primary">Agregar</button>
           </div>
        </div>

