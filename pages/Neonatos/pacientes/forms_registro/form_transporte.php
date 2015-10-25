<div class="row">
    <div class="col-xs-7">
        <div class="col-xs-12">
            <div class="form-group">
                <div class="input-group">
                    <div id="radioBtn" class="btn-group">
                        <a class="btn btn-default btn-sm Active" data-toggle="weird" data-title="In">Intrahospitalario</a>
                        <a class="btn btn-default btn-sm notActive" data-toggle="weird" data-title="Oh">Otro hospital</a>
                        <a class="btn btn-default btn-sm notActive" data-toggle="weird" data-title="Cm">CMI</a>
                        <a class="btn btn-default btn-sm notActive" data-toggle="weird" data-title="Us">US</a>
                    </div>
                    <input type="hidden" name="weird" id="weird">
                </div>
            </div>
        </div>
    </div>
    <div class="col-xs-5">
        <div class="form-group">
            <label class="control-label col-xs-3">Motivo </label>
            <div class="input-group col-xs-9">
                <span class="input-group-addon"><i class="fa fa-pencil-square-o"></i></span>
                <input id="telefono" type="text" class="form-control" name="motivo" value="" placeholder="Motivo">                                        
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-xs-9">
        <div class="col-xs-4">
            <div class="form-group">
                <label for="love" class="control-label">Tipo</label>
                <div class="input-group">
                    <div id="radioBtn" class="btn-group">
                        <a class="btn btn-default btn-sm active" data-toggle="love" data-title="A">Aéreo</a>
                        <a class="btn btn-default btn-sm notActive" data-toggle="love" data-title="T">Terrestre</a>
                    </div>
                    <input type="hidden" name="love" id="love">
                </div>
            </div>
        </div>
        <div class="col-xs-4">
            <div class="form-group">
                <label class="control-label">Distancia Km</label>
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-map-pin"></i></span>
                    <input id="distancia" type="text" class="form-control" name="distancia" value="" placeholder="Distancia en Kilómetros">                                        
                </div>
            </div>
        </div>
        <div class="col-xs-4">
            <div class="col-xs-6">
                <div class="form-group">
                    <label class="control-label">Horas</label>
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-clock-o"></i></span>
                        <input id="horas" type="text" class="form-control" name="horas" value="" placeholder="Horas">                                        
                    </div>
                </div>
            </div>
            <div class="col-xs-6">
                <div class="form-group">
                    <label class="control-label">Minutos</label>
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-clock-o"></i></span>
                        <input id="minutos" type="text" class="form-control" name="minutos" value="" placeholder="Minutos">                                        
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xs-3">
        <div class="form-group">
            <label for="crazy" class="control-label">Complicaciones en el transporte</label>
            <div class="input-group">
                <div id="radioBtn" class="btn-group">
                    <a class="btn btn-default btn-sm active" data-toggle="crazy" data-title="S">Si</a>
                    <a class="btn btn-default btn-sm notActive" data-toggle="crazy" data-title="N">No</a>
                </div>
                <input type="hidden" name="crazy" id="crazy">
            </div>
        </div>
        <div class="form-group">
            <label class="control-label">Cual</label>
            <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-file-text-o"></i></span>
                <input id="cTransporte" type="text" class="form-control" name="cTransporte" value="" placeholder="Describa la complicación">                                        
            </div>
        </div>
    </div>
</div>
<div class="col-xs-9 col-xs-offset-3">
    <label class="control-label">
        CONDICIONES DE TRANSPORTE
    </label>
</div>
<div class="row">
    <div class="col-xs-9">
        <div class="col-xs-3">
            <div class="form-group">
                <label for="fool" class="control-label">Incubadora</label>
                <div class="input-group">
                    <div id="radioBtn" class="btn-group">
                        <a class="btn btn-default btn-sm active" data-toggle="fool" data-title="Si">Si</a>
                        <a class="btn btn-default btn-sm notActive" data-toggle="fool" data-title="No">No</a>
                    </div>
                    <input type="hidden" name="fool" id="fool">
                </div>
            </div>
        </div>
        <div class="col-xs-3">
            <div class="form-group">
                <label for="tared" class="control-label">Liq. I.V.</label>
                <div class="input-group">
                    <div id="radioBtn" class="btn-group">
                        <a class="btn btn-default btn-sm active" data-toggle="tared" data-title="Si1">Si</a>
                        <a class="btn btn-default btn-sm notActive" data-toggle="tared" data-title="No1">No</a>
                    </div>
                    <input type="hidden" name="tared" id="tared">
                </div>
            </div>
        </div>
        <div class="col-xs-3">
            <div class="form-group">
                <label for="passion" class="control-label">Oxígeno</label>
                <div class="input-group">
                    <div id="radioBtn" class="btn-group">
                        <a class="btn btn-default btn-sm active" data-toggle="passion" data-title="Si2">Si</a>
                        <a class="btn btn-default btn-sm notActive" data-toggle="passion" data-title="No2">No</a>
                    </div>
                    <input type="hidden" name="passion" id="passion">
                </div>
            </div>
        </div>
        <div class="col-xs-3">
            <div class="form-group">
                <label for="intubated" class="control-label">Intubado</label>
                <div class="input-group">
                    <div id="radioBtn" class="btn-group">
                        <a class="btn btn-default btn-sm active" data-toggle="intubated" data-title="Si3">Si</a>
                        <a class="btn btn-default btn-sm notActive" data-toggle="intubated" data-title="No3">No</a>
                    </div>
                    <input type="hidden" name="intubated" id="intubated">
                </div>
            </div>
        </div>
        <div class="col-xs-3">
            <div class="form-group">
                <label for="help" class="control-label">Vascular</label>
                <div class="input-group">
                    <div id="radioBtn" class="btn-group">
                        <a class="btn btn-default btn-sm active" data-toggle="help" data-title="Si4">Si</a>
                        <a class="btn btn-default btn-sm notActive" data-toggle="help" data-title="No4">No</a>
                    </div>
                    <input type="hidden" name="help" id="help">
                </div>
            </div>
        </div>
        <div class="col-xs-3">
            <div class="form-group">
                <label for="need" class="control-label">Monitoreo</label>
                <div class="input-group">
                    <div id="radioBtn" class="btn-group">
                        <a class="btn btn-default btn-sm active" data-toggle="need" data-title="Si5">Si</a>
                        <a class="btn btn-default btn-sm notActive" data-toggle="need" data-title="No5">No</a>
                    </div>
                    <input type="hidden" name="need" id="need">
                </div>
            </div>
        </div>
        <div class="col-xs-3">
            <div class="form-group">
                <label for="sexy" class="control-label">Medicamento</label>
                <div class="input-group">
                    <div id="radioBtn" class="btn-group">
                        <a class="btn btn-default btn-sm active" data-toggle="sexy" data-title="Si6">Si</a>
                        <a class="btn btn-default btn-sm notActive" data-toggle="sexy" data-title="No6">No</a>
                    </div>
                    <input type="hidden" name="sexy" id="sexy">
                </div>
            </div>
        </div>
        <div class="col-xs-3">
            <div class="form-group">
                <label for="miss" class="control-label">SOG</label>
                <div class="input-group">
                    <div id="radioBtn" class="btn-group">
                        <a class="btn btn-default btn-sm active" data-toggle="miss" data-title="Si7">Si</a>
                        <a class="btn btn-default btn-sm notActive" data-toggle="miss" data-title="No7">No</a>
                    </div>
                    <input type="hidden" name="miss" id="miss">
                </div>
            </div>
        </div>
    </div>
    <div class="col-xs-3">
        <div class="form-group">
            <label class="control-label">Vol. Liq. I.V.</label>
            <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-file-text-o"></i></span>
                <input id="voLiqTipo" type="text" class="form-control" name="voLiqTipo" value="" placeholder="Volumen">                                        
            </div>
        </div>
        <div class="form-group">
            <label class="control-label">Tipo de Liq. I.V.</label>
            <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-file-text-o"></i></span>
                <input id="liqTipo" type="text" class="form-control" name="liqTipo" value="" placeholder="Tipo">                                        
            </div>
        </div>
    </div>
</div>