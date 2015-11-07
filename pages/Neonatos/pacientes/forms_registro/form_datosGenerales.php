<style>
    #radioBtn .notActive{
        color: black;
        background-color: #fff;
    }
</style>
<script>
    $('#radioBtn a').on('click', function(){
        var sel = $(this).data('title');
        var tog = $(this).data('toggle');
        $('#'+tog).prop('value', sel);

        $('a[data-toggle="'+tog+'"]').not('[data-title="'+sel+'"]').removeClass('active').addClass('notActive');
        $('a[data-toggle="'+tog+'"][data-title="'+sel+'"]').removeClass('notActive').addClass('active');
    });
</script>
<form>
<div class="row">
    <div class="col-xs-5">
        <div class="form-group">
            <label class="control-label">Institución de nacimiento</label>
            <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-building"></i></span>
                <input  id="institucion" type="text" class="form-control" name="institucion" value="" placeholder="Institución de nacimiento" required>                                        
            </div>
        </div>
    </div>
    <div class="col-xs-5 col-xs-offset-2">
        <div class="form-group">
            <label class="control-label">Lugar de nacimiento</label>
            <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-map"></i></span>
                <input id="lugarNacimiento" type="text" class="form-control" name="lugarNacimiento" value="" placeholder="Lugar de nacimiento" required>                                        
            </div>
        </div>
    </div>
    <div class="col-xs-12">
        <div class="form-group">
            <label class="control-label">Nombre del recien nacido</label>
            <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-child"></i></span>
                <input id="nombreNacido" type="text" class="form-control" name="nombreNacido" value="" placeholder="Nombre del recien nacido">                                        
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-xs-6 text-left">
        <div class="form-group">
            <label for="happy" class="control-label col-xs-7">¿Tiene pulsera ID?</label>
            <div class="input-group col-xs-5">
                <div id="radioBtn" class="btn-group">
                    <a class="btn btn-default btn-sm active" data-toggle="happy" data-title="Y">Si</a>
                    <a class="btn btn-default btn-sm notActive" data-toggle="happy" data-title="N">No</a>
                </div>
                <input type="hidden" name="happy" id="happy">
            </div>
        </div>
    </div>
    <div class="col-xs-6 text-right">
        <div class="form-group">
            <label for="fun" class="control-label col-xs-4">Sexo</label>
            <div class="input-group col-xs-8">
                <div id="radioBtn" class="btn-group">
                    <a class="btn btn-default btn-sm active" data-toggle="fun" data-title="H">H</a>
                    <a class="btn btn-default btn-sm notActive" data-toggle="fun" data-title="M">M</a>
                    <a class="btn btn-default btn-sm notActive" data-toggle="fun" data-title="N">No determinado</a>
                </div>
                <input type="hidden" name="fun" id="fun">
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-xs-5">
        <div class="form-group">
            <label class="control-label">Nombre de la madre</label>
            <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-female"></i></span>
                <input id="nombreMadre" type="text" class="form-control" name="nombreMadre" value="" placeholder="Nombre de la madre">                                        
            </div>
        </div>
    </div>
    <div class="col-xs-5 col-xs-offset-2">
        <div class="form-group">
            <label class="control-label">Historia clínica de la madre</label>
            <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-file-text"></i></span>
                <input id="historiaClinica" type="text" class="form-control" name="historiaClinica" value="" placeholder="Historia clínica de la madre">                                        
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-xs-5">
        <div class="form-group">
            <label for="funny" class="control-label">Ubicación de la madre</label>
            <div class="input-group">
                <div id="radioBtn" class="btn-group">
                    <a class="btn btn-default btn-sm active" data-toggle="funny" data-title="M">Mismo Hospital</a>
                    <a class="btn btn-default btn-sm notActive" data-toggle="funny" data-title="D">Domicilio</a>
                </div>
                <input type="hidden" name="funny" id="funny">
            </div>
        </div>
        <div class="form-group">
            <div class="input-group">
                <div id="radioBtn" class="btn-group">
                    <a class="btn btn-default btn-sm notActive" data-toggle="funny" data-title="O">  Otro Hospital</a>
                    <a class="btn btn-default btn-sm notActive" data-toggle="funny" data-title="F">Fallecida</a>
                </div>
                <input type="hidden" name="funny" id="funny">
            </div>
        </div>
    </div>
    <div class="col-xs-4">
        <div class="form-group">
            <label for="cheerful" class="control-label">Condición de salud</label>
            <div class="col-xs-12">
                <div class="input-group">
                    <div id="radioBtn" class="btn-group">
                        <a class="btn btn-default btn-sm active" data-toggle="cheerful" data-title="N">Normal</a>
                        <a class="btn btn-default btn-sm notActive" data-toggle="cheerful" data-title="C">Crítica</a>
                    </div>
                    <input type="hidden" name="cheerful" id="cheerful">
                </div>
            </div>
        </div>
    </div>
    <div class="col-xs-3">
        <div class="form-group">
            <label for="sad" class="control-label">Conoció a su hijo(a)</label>
            <div class="col-xs-12">
                <div class="input-group">
                    <div id="radioBtn" class="btn-group">
                        <a class="btn btn-default btn-sm active" data-toggle="sad" data-title="N">Si</a>
                        <a class="btn btn-default btn-sm notActive" data-toggle="sad" data-title="C">No</a>
                    </div>
                    <input type="hidden" name="sad" id="sad">
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-xs-12">
        <div class="form-group">
            <label class="control-label">Nombre del padre</label>
            <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-male"></i></span>
                <input id="nombrePadre" type="text" class="form-control" name="nombrePadre" value="" placeholder="Nombre del padre">                                        
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-xs-5">
        <div class="row">
            <div class="col-xs-6">
                <div class="form-group">
                    <label class="control-label">Dirección</label>
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-location-arrow"></i></span>
                        <input id="direccion" type="text" class="form-control" name="direccion" value="" placeholder="Dirección">                                        
                    </div>
                </div>
            </div>
            <div class="col-xs-6">
                <div class="form-group">
                    <label class="control-label">Teléfono</label>
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-phone"></i></span>
                        <input id="telefono" type="text" class="form-control" name="telefono" value="" placeholder="Teléfono">                                        
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xs-7">
        <center>
            <div class="form-group">
                <label for="info" class="control-label">Información inicial de la familia</label>
                <div class="input-group">
                    <div id="radioBtn" class="btn-group">
                        <a class="btn btn-default btn-sm active" data-toggle="info" data-title="D">Directa</a>
                        <a class="btn btn-default btn-sm notActive" data-toggle="info" data-title="T">Telefónica</a>
                        <a class="btn btn-default btn-sm notActive" data-toggle="info" data-title="N">No se logró</a>
                    </div>
                    <input type="hidden" name="info" id="info">
                </div>
            </div>
        </center>
    </div>
</div></form>