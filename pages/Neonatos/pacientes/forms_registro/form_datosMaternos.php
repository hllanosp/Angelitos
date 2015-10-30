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
<div class="row">
    <div class="col-xs-6">
        <div class="form-group">
            <label class="control-label">Estado civil</label>
            <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-pencil-square-o"></i></span>
                <input id="estadoCivil" type="text" class="form-control" name="estadoCivil" value="" placeholder="Estado civil">                                        
            </div>
        </div>
    </div>
    <div class="col-xs-6">
        <div class="form-group">
            <label class="control-label">Escolaridad</label>
            <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-pencil-square-o"></i></span>
                <input id="escolaridad" type="text" class="form-control" name="escolaridad" value="" placeholder="Nivel de escolaridad">                                        
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-xs-9">
        <div class="panel panel-default">
            <div class="panel-heading" role="tab" id="headingFour">
              <h4 class="panel-title">
                <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                  
                </a>
              </h4>
            </div>
            <!-- <div id="collapseFour" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingFour"> -->
            <div class="panel-body" style = "padding-left : 20px; padding-right: 5px;">
                <ul class="nav nav-tabs " style = "">
                    <li class="active"><a data-toggle="tab" href="#anos">Edad en años</a></li>
                    <li ><a data-toggle="tab" href="#antecedentes">Antecedentes obstétricos</a></li>
                    <li ><a data-toggle="tab" href="#atencion">Atencion prenatal</a></li>
                    <li ><a data-toggle="tab" href="#ruptura">Ruptura de membranas</a></li>
                </ul>

                <div class="tab-content" style = "margin-top : 10px;">
                    <div id="anos" class="tab-pane fade in active">
                        <div class="row">
                            <div class="form-group">
                                <div class="form-group">
                                    <center>
                                        <div class="input-group col-xs-8">
                                            <span class="input-group-addon"><i class="fa fa-pencil-square-o"></i></span>
                                            <input id="edadAnos" type="text" class="form-control" name="edadAnos" value="" placeholder="Edad en años">                                        
                                        </div>
                                    </center>
                                </div>
                            </div>
                        </div>    
                    </div>

                    <div id="antecedentes" class="tab-pane fade in">
                        <div class="row">
                            <div class="form-group">
                                <center>
                                    <div class="input-group">
                                        <div id="radioBtn" class="btn-group">
                                            <a class="btn btn-default btn-sm active" data-toggle="lovely" data-title="G">G</a>
                                            <a class="btn btn-default btn-sm notActive" data-toggle="lovely" data-title="P">P</a>
                                        </div>
                                        <input type="hidden" name="lovely" id="lovely">
                                        <div id="radioBtn" class="btn-group">
                                            <a class="btn btn-default btn-sm active" data-toggle="nice" data-title="C">C</a>
                                            <a class="btn btn-default btn-sm notActive" data-toggle="nice" data-title="Ab">Ab</a>
                                        </div>
                                        <input type="hidden" name="nice" id="nice">
                                        <div id="radioBtn" class="btn-group">
                                            <a class="btn btn-default btn-sm active" data-toggle="bad" data-title="Hv">H.V.</a>
                                            <a class="btn btn-default btn-sm notActive" data-toggle="bad" data-title="Hm">H.M.</a>
                                        </div>
                                        <input type="hidden" name="bad" id="bad">
                                    </div>
                                </center>
                            </div>
                        </div>    
                    </div>

                    <div id="atencion" class="tab-pane fade in">
                        <div class="row">
                            <div class="form-group">
                                <div class="col-xs-4">
                                    <label for="sincere" class="control-label">Atención prenatal</label>
                                </div>
                                <div class="col-xs-3">
                                    <div class="input-group">
                                        <div id="radioBtn" class="btn-group">
                                            <a class="btn btn-default btn-sm active" data-toggle="sincere" data-title="S">Si</a>
                                            <a class="btn btn-default btn-sm notActive" data-toggle="sincere" data-title="N">No</a>
                                        </div>
                                        <input type="hidden" name="sincere" id="sincere">
                                    </div>
                                </div>
                                <div class="col-xs-1">
                                    <label class="control-label">No.</label>
                                </div>
                                <div class="col-xs-4">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-pencil-square-o"></i></span>
                                        <input id="No" type="text" class="form-control" name="No" value="" placeholder="">                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="form-group">
                                <div class="col-xs-1">
                                    <label class="control-label">US</label>
                                </div>
                                <div class="col-xs-5">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-pencil-square-o"></i></span>
                                        <input id="us" type="text" class="form-control" name="us" value="" placeholder="">                                        
                                    </div>
                                </div>
                                <div class="col-xs-2">
                                    <label class="control-label">Exp. US</label>
                                </div>
                                <div class="col-xs-4">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-pencil-square-o"></i></span>
                                        <input id="noUS" type="text" class="form-control" name="noUS" value="" placeholder="">                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="form-group">
                                <div class="col-xs-3">
                                    <label for="nurse" class="control-label">Atendido por</label>
                                </div>
                                <div class="col-xs-4">
                                    <div class="input-group">
                                        <div id="radioBtn" class="btn-group">
                                            <a class="btn btn-default btn-sm active" data-toggle="nurse" data-title="Me">Médico</a>
                                            <a class="btn btn-default btn-sm notActive" data-toggle="nurse" data-title="En">Enfermera</a>
                                        </div>
                                        <input type="hidden" name="nurse" id="nurse">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div id="ruptura" class="tab-pane fade in">
                        <div class="row">
                            <center>
                                <div class="col-xs-4">
                                    <div class="input-group">
                                        <div id="radioBtn" class="btn-group">
                                            <a class="btn btn-default btn-sm active" data-toggle="impossible" data-title="rem">R.E.M</a>
                                            <a class="btn btn-default btn-sm notActive" data-toggle="impossible" data-title="ram">R.A.M.</a>
                                        </div>
                                        <input type="hidden" name="impossible" id="impossible">
                                    </div>
                                </div>
                                <div class="col-xs-1">
                                    <label class="control-label">Horas</label>
                                </div>
                                <div class="col-xs-6">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-clock-o"></i></span>
                                        <input id="horas" type="text" class="form-control" name="horas" value="" placeholder="Horas">                                        
                                    </div>
                                </div>
                            </center>
                        </div>    
                    </div>
                </div>
            </div>
            <!-- </div> -->
        </div>
    </div>
    <div class="col-xs-3">
        <div class="row">
            <div class="form-group">
                <label for="loving" class="control-label col-xs-6">Drogas</label>
                <div class="input-group">
                    <div id="radioBtn" class="btn-group">
                        <a class="btn btn-default btn-sm active" data-toggle="loving" data-title="sip">Si</a>
                        <a class="btn btn-default btn-sm notActive" data-toggle="loving" data-title="mop">No</a>
                    </div>
                    <input type="hidden" name="loving" id="loving">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="form-group">
                <label for="evil" class="control-label col-xs-6">Tabaco</label>
                <div class="input-group">
                    <div id="radioBtn" class="btn-group">
                        <a class="btn btn-default btn-sm active" data-toggle="evil" data-title="sip1">Si</a>
                        <a class="btn btn-default btn-sm notActive" data-toggle="evil" data-title="nop1">No</a>
                    </div>
                    <input type="hidden" name="evil" id="evil">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="form-group">
                <label for="unkind" class="control-label col-xs-6">Alcohol</label>
                <div class="input-group">
                    <div id="radioBtn" class="btn-group">
                        <a class="btn btn-default btn-sm active" data-toggle="unkind" data-title="sip2">Si</a>
                        <a class="btn btn-default btn-sm notActive" data-toggle="unkind" data-title="nop2">No</a>
                    </div>
                    <input type="hidden" name="unkind" id="unkind">
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="panel panel-default">
            <div class="panel-heading" role="tab" id="headingFour">
              <h4 class="panel-title">
                <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                </a>
              </h4>
            </div>
            <!-- <div id="collapseFour" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingFour"> -->
            <div class="panel-body" style = "padding-left : 20px; padding-right: 5px;">
                <ul class="nav nav-tabs " style = "">
                    <li class="active"><a data-toggle="tab" href="#grupo">Grupo y Rh</a></li>
                    <li ><a data-toggle="tab" href="#sensibilizada">Sensibilizada</a></li>
                    <li ><a data-toggle="tab" href="#examenes">Exámenes</a></li>
                    <li ><a data-toggle="tab" href="#toxoide">Toxóide tetánico</a></li>
                    <li ><a data-toggle="tab" href="#patologia">Patología durante el embarazo</a></li>
                </ul>

                <div class="tab-content" style = "margin-top : 10px;">
                    <div id="grupo" class="tab-pane fade in active">
                        <div class="row">
                            <div class="form-group">
                                <center>
                                    <div class="form-group" style ="margin-top : 2px;">
                                        <label class="control-label col-xs-3">Grupo y Rh: </label>
                                        <div class="input-group col-xs-8">
                                            <span class="input-group-addon"><i class="fa fa-time"></i></span>
                                            <input id="grupoRH" type="time" class="form-control" name="grupoRH" value="" placeholder="Grupo y Rh">                                        
                                        </div>
                                    </div>
                                </center>
                            </div>
                        </div>    
                    </div>

                    <div id="sensibilizada" class="tab-pane fade in">
                        <div class="row">
                            <div class="form-group">
                                <center>
                                    <div class="input-group">
                                        <div id="radioBtn" class="btn-group">
                                            <a class="btn btn-default btn-sm active" data-toggle="false" data-title="sipi">SI</a>
                                            <a class="btn btn-default btn-sm notActive" data-toggle="false" data-title="nopi">NO</a>
                                        </div>
                                        <input type="hidden" name="false" id="false">
                                    </div>
                                </center>
                            </div>
                        </div>    
                    </div>

                    <div id="examenes" class="tab-pane fade in">
                        <div class="row">
                            <div class="form-group">
                                <center>
                                    <div class="input-group">
                                        <label class="control-label">R.P.R</label>
                                        <div id="radioBtn" class="btn-group">
                                            <a class="btn btn-default btn-sm active" data-toggle="toe" data-title="nr">NR</a>
                                            <a class="btn btn-default btn-sm notActive" data-toggle="toe" data-title="r">R</a>
                                        </div>
                                        <input type="hidden" name="toe" id="toe">
                                    </div><br>
                                    <div class="input-group">
                                        <label class="control-label">V.I.H.</label>
                                        <div id="radioBtn" class="btn-group">
                                            <a class="btn btn-default btn-sm active" data-toggle="test" data-title="pos">Positivo</a>
                                            <a class="btn btn-default btn-sm notActive" data-toggle="test" data-title="neg">Negativo</a>
                                        </div>
                                        <input type="hidden" name="test" id="test">
                                    </div>
                                </center>
                            </div>
                        </div>
                    </div>

                    <div id="toxoide" class="tab-pane fade in">
                        <div class="row">
                            <div class="form-group">
                                <center>
                                    <div class="input-group">
                                        <div id="radioBtn" class="btn-group">
                                            <a class="btn btn-default btn-sm active" data-toggle="swing" data-title="see">SI</a>
                                            <a class="btn btn-default btn-sm notActive" data-toggle="swing" data-title="now">NO</a>
                                        </div>
                                        <input type="hidden" name="swing" id="swing">
                                    </div>
                                </center>
                            </div>
                        </div>
                    </div>
                    
                    <div id="patologia" class="tab-pane fade in">
                        <div class="row">
                            <div class="form-group">
                                <center>
                                    <div class="input-group">
                                        <div id="radioBtn" class="btn-group">
                                            <a class="btn btn-default btn-sm active" data-toggle="nose" data-title="hmm">SI</a>
                                            <a class="btn btn-default btn-sm notActive" data-toggle="nose" data-title="hmmm">NO</a>
                                        </div>
                                        <input type="hidden" name="nose" id="nose">
                                    </div><br>
                                    <div class="form-group">
                                        <label class="control-label col-xs-3">Aguda: </label>
                                        <div class="input-group col-xs-8">
                                            <span class="input-group-addon"><i class="fa fa-pencil-square-o"></i></span>
                                            <input id="aguda" type="text" class="form-control" name="aguda" value="" placeholder="Aguda">                                        
                                        </div><br>
                                        <label class="control-label col-xs-3">Crónica: </label>
                                        <div class="input-group col-xs-8">
                                            <span class="input-group-addon"><i class="fa fa-pencil-square-o"></i></span>
                                            <input id="cronica" type="text" class="form-control" name="cronica" value="" placeholder="Crónica">                                        
                                        </div>
                                    </div>
                                </center>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- </div> -->
        </div>
</div>
<div class="row">
    <div class="col-xs-12">
        <div class="panel panel-default">
            <div class="panel-heading" role="tab" id="headingFour">
              <h4 class="panel-title">
                <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                    DATOS DEL TRABAJO DE PARTO
                </a>
              </h4>
            </div>
            <!-- <div id="collapseFour" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingFour"> -->
            <div class="panel-body" style = "padding-left : 20px; padding-right: 5px;">
                <ul class="nav nav-tabs " style = "">
                    <li class="active"><a data-toggle="tab" href="#comienzo">Comienzo</a></li>
                    <li ><a data-toggle="tab" href="#terminacion">Terminación</a></li>
                    <li ><a data-toggle="tab" href="#presentacion">Presentación</a></li>
                    <li ><a data-toggle="tab" href="#perdidaFetal">Perdida Binestar Fetal</a></li>
                </ul>

                <div class="tab-content" style = "margin-top : 10px;">
                    <div id="comienzo" class="tab-pane fade in active">
                        <div class="row">
                            <div class="form-group">
                                <center>
                                    <div class="input-group">
                                        <div id="radioBtn" class="btn-group">
                                            <a class="btn btn-default btn-sm active" data-toggle="heart" data-title="Es">Espontaneo</a>
                                            <a class="btn btn-default btn-sm notActive" data-toggle="heart" data-title="In">Inducido</a>
                                        </div>
                                        <input type="hidden" name="heart" id="heart">
                                    </div>
                                </center>
                            </div>
                        </div>    
                    </div>

                    <div id="terminacion" class="tab-pane fade in">
                        <div class="row">
                            <div class="form-group">
                                <center>
                                    <div class="input-group">
                                        <div id="radioBtn" class="btn-group">
                                            <a class="btn btn-default btn-sm active" data-toggle="hand" data-title="Va">Vaginal</a>
                                            <a class="btn btn-default btn-sm notActive" data-toggle="hand" data-title="Ce">Cesárea</a>
                                            <a class="btn btn-default btn-sm notActive" data-toggle="hand" data-title="For">Fórceps</a>
                                            <a class="btn btn-default btn-sm notActive" data-toggle="hand" data-title="Vac">Vacuum</a>
                                        </div>
                                        <input type="hidden" name="hand" id="hand">
                                    </div>
                                </center>
                            </div>
                        </div>    
                    </div>

                    <div id="presentacion" class="tab-pane fade in">
                        <div class="row">
                            <div class="form-group">
                                <center>
                                    <div class="input-group">
                                        <div id="radioBtn" class="btn-group">
                                            <a class="btn btn-default btn-sm active" data-toggle="head" data-title="Cef">Cefálica</a>
                                            <a class="btn btn-default btn-sm notActive" data-toggle="head" data-title="tra">Tranversa</a>
                                            <a class="btn btn-default btn-sm notActive" data-toggle="head" data-title="pel">Pélvica</a>
                                            <a class="btn btn-default btn-sm notActive" data-toggle="head" data-title="otra">Otra</a>
                                        </div>
                                        <input type="hidden" name="head" id="head">
                                    </div>
                                </center>
                            </div>
                        </div>
                    </div>

                    <div id="perdidaFetal" class="tab-pane fade in">
                        <div class="row">
                            <div class="form-group">
                                <center>
                                    <div class="input-group">
                                        <div id="radioBtn" class="btn-group">
                                            <a class="btn btn-default btn-sm active" data-toggle="true" data-title="sip">SI</a>
                                            <a class="btn btn-default btn-sm notActive" data-toggle="true" data-title="nop">NO</a>
                                        </div>
                                        <input type="hidden" name="true" id="true">
                                    </div>
                                    <br>
                                    <div class="form-group">
                                        <label class="control-label col-xs-5">Causa de la intervención en caso de cesárea: </label>
                                        <div class="input-group col-xs-6">
                                            <span class="input-group-addon"><i class="fa fa-pencil-square-o"></i></span>
                                            <input id="causa" type="text" class="form-control" name="causa" value="" placeholder="Causa">                                        
                                        </div>
                                    </div>
                                    <br>
                                    <div class="input-group">
                                        <label class="control-label">Placenta   </label>
                                        <div id="radioBtn" class="btn-group">
                                            <a class="btn btn-default btn-sm active" data-toggle="foot" data-title="normal">Normal</a>
                                            <a class="btn btn-default btn-sm notActive" data-toggle="foot" data-title="anormal">Anormal</a>
                                        </div>
                                        <input type="hidden" name="foot" id="foot">
                                    </div>
                                    <br>
                                </center>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-6">
                                <div class="input-group">
                                    <label class="control-label">Placenta: </label>
                                    <div id="radioBtn" class="btn-group">
                                        <a class="btn btn-default btn-sm active" data-toggle="feet" data-title="nor">Normal</a>
                                        <a class="btn btn-default btn-sm notActive" data-toggle="feet" data-title="anor">Anormal</a>
                                    </div>
                                    <input type="hidden" name="feet" id="feet">
                                </div>
                                <br>
                                <div class="form-group">
                                    <label class="control-label col-xs-3">Anormal: </label>
                                    <div class="input-group col-xs-8">
                                        <span class="input-group-addon"><i class="fa fa-pencil-square-o"></i></span>
                                        <input id="anormal" type="text" class="form-control" name="anormal" value="" placeholder="Anormalidad">                                        
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-6">
                                <div class="input-group">
                                    <label class="control-label">Cantidad: </label>
                                    <div id="radioBtn" class="btn-group">
                                        <a class="btn btn-default btn-sm active" data-toggle="finger" data-title="norm">Normal</a>
                                        <a class="btn btn-default btn-sm notActive" data-toggle="finger" data-title="abun">Abundante</a>
                                        <a class="btn btn-default btn-sm notActive" data-toggle="finger" data-title="esc">Escaso</a>
                                    </div>
                                    <input type="hidden" name="finger" id="finger">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- </div> -->
        </div>
    </div>
</div>