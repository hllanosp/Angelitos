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
    <div class="col-xs-4">
        <div class="form-group">
            <label class="control-label">Fecha Nacimiento</label>
            <div class="input-group " >
                <span class="input-group-addon"><i class="fa fa-date"></i></span>
                <input id="telefono" type="date" class="form-control input-xs" name="telefono" value="" placeholder="Teléfono">                                        
            </div>
        </div> 


         <div class="form-group" style ="margin-top : 2px;">
            <label class="control-label">Hora</label>
            <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-time"></i></span>
                <input id="telefono" type="time" class="form-control" name="telefono" value="" placeholder="Teléfono">                                        
            </div>
        </div>
    </div>
    <div class="col-xs-4 col-xs-offset-1" >
        <div class="form-group">
            <label for="funny" class="control-label">Nacimiento</label>
            <div class="input-group">
                <div id="radioBtn" class="btn-group">
                    <a class="btn btn-default btn-sm active" data-toggle="funny" data-title="M">Simple</a>
                    <a class="btn btn-default btn-sm notActive" data-toggle="funny" data-title="D">Gemelar</a>
                </div>
                <input type="hidden" name="funny" id="funny">
            </div>
        </div>
        <div class="form-group">
            <div class="input-group">
                <div id="radioBtn" class="btn-group">
                    <a class="btn btn-default btn-sm notActive" data-toggle="funny" data-title="O"> Multiple</a>
                    <a class="btn btn-default btn-sm notActive" data-toggle="funny" data-title="F">ND/ND</a>
                </div>
                <input type="hidden" name="funny" id="funny">
            </div>
        </div>
    </div>
    <div class="col-xs-3">
        <div class="form-group" style ="margin-top : 2px;">
            <label class="control-label">Orden Nacimiento</label>
            <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-time"></i></span>
                <input id="orden?nacimiento" type="num" class="form-control" name="orden" value="" placeholder="orden">                                        
            </div>
        </div>
    </div>
</div>
<!-- fin row -->

<div class="row">
    <div class="col-xs-8 " >
        <div class="form-group">
            <label for="funnya" class="control-label">Cordon</label>
            <div class="input-group">
                <div id="radioBtn" class="btn-group">
                    <a class="btn btn-default btn-sm active" data-toggle="funnya" data-title="M">Normal</a>
                    <a class="btn btn-default btn-sm notActive" data-toggle="funnya" data-title="D">SI</a>
                    <a class="btn btn-default btn-sm notActive" data-toggle="funnya" data-title="O"> NO</a>
                    <a class="btn btn-default btn-sm notActive" data-toggle="funnya" data-title="F">circular</a>
                    <a class="btn btn-default btn-sm notActive" data-toggle="funnya" data-title="g">Prolapso</a>
                    <a class="btn btn-default btn-sm notActive" data-toggle="funnya" data-title="h">Nudos</a>
                    <a class="btn btn-default btn-sm notActive" data-toggle="funnya" data-title="i">ND/ND</a>
                </div>
                <input type="hidden" name="funnya" id="funnya">
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group" style ="margin-top : 2px;">
                    
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-time"></i></span>
                        <input id="telefono" type="text" class="form-control" name="telefono" value="" placeholder="relacion vasos">                                        
                    </div>
                </div>
        </div>
    </div>

    <div class="col-xs-4  " >
        <div class="form-group">
            <label for="funnya" class="control-label">Tiempo Ligadura</label>
            <div class="input-group">
                <div id="radioBtn" class="btn-group">
                    <a class="btn btn-default btn-sm active" data-toggle="funnyaaa" data-title="Mf">>90 seg</a>
                    <a class="btn btn-default btn-sm notActive" data-toggle="funnyaaa" data-title="Dd">< 90 seg</a>
                  
                    
                </div>
                <input type="hidden" name="funnyaaa" id="funnya">
            </div>
        </div>
        <div class="form-group">
            <label for="a" class="control-label">Muestra de sangre Cordon</label>
            <div class="input-group">
                <div id="radioBtn" class="btn-group">
                    <a class="btn btn-default btn-sm active" data-toggle="a" data-title="Mf">SI</a>
                    <a class="btn btn-default btn-sm notActive" data-toggle="a" data-title="Dd">NO</a>
                  
                    
                </div>
                <input type="hidden" name="a" id="funnya">
            </div>
        </div>
    </div>
</div>

<!-- acordion group -->
<div class="row">
   <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
        <div class="panel panel-default">
            <div class="panel-heading" role="tab" id="headingOne">
              <h4 class="panel-title">
                <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                  
                </a>
              </h4>
            </div>
            <div class="panel-body" style ="padding-left : 20px; padding-right: 5px;">
               
                Puntuacion de APGAR
            </div>
        </div>
        <div class="panel panel-default" >
            <div class="panel-heading" role="tab" id="headingTwo">
              <h4 class="panel-title">
                <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                  
                </a>
              </h4>
            </div>
            <!-- <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo"> -->
                <div class="panel-body" style ="padding-left : 20px; padding-right: 5px;">
                    <div class="row">
                    <div class="col-xs-4" >
                        <div class="form-group">
                            <label for="g" class="control-label">Reanimacion Neonatal</label>
                            <div class="input-group">
                                <div id="radioBtn" class="btn-group">
                                    <a class="btn btn-default btn-sm active" data-toggle="g" data-title="M">SI</a>
                                    <a class="btn btn-default btn-sm notActive" data-toggle="g" data-title="D">NO</a>
                                    <a class="btn btn-default btn-sm notActive" data-toggle="g" data-title="D">ND/ND</a>
                                 
                                </div>
                                <input type="hidden" name="funnya" id="g">
                            </div>
                        </div>
                        
                    </div>

                    <div class="col-xs-4" >
                        <div class="form-group">
                            <label for="gg" class="control-label">Reanimacion Exito?</label>
                            <div class="input-group">
                                <div id="radioBtn" class="btn-group">
                                    <a class="btn btn-default btn-sm active" data-toggle="gg" data-title="M">SI</a>
                                    <a class="btn btn-default btn-sm notActive" data-toggle="gg" data-title="D">NO</a>
                                    <a class="btn btn-default btn-sm notActive" data-toggle="gg" data-title="D">ND/ND</a>
                                </div>
                                <input type="hidden" name="funnya" id="gg">
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-xs-4  " >
                        <div class="form-group">
                            <label for="x" class="control-label">Aspiracion con perilla</label>
                            <div class="input-group">
                                <div id="radioBtn" class="btn-group">
                                    <a class="btn btn-default btn-sm active" data-toggle="x" data-title="x">SI</a>
                                    <a class="btn btn-default btn-sm notActive" data-toggle="x" data-title="x">NO</a>
                                    <a class="btn btn-default btn-sm notActive" data-toggle="x" data-title="x">ND/ND</a>
                                </div>
                                <input type="hidden" name="funnyaaa" id="x">
                            </div>
                        </div>
                        
                        
                    </div>
                </div>
                <div class="row">
                    <div class="form-group">
                                <label for="a" class="control-label col-lg-6">Aspiracion Endotraqueal</label>

                                <div class="input-group">
                                <div id="radioBtn" class="btn-group">
                                    <a class="btn btn-default btn-sm active" data-toggle="a" data-title="a">SI</a>
                                    <a class="btn btn-default btn-sm notActive" data-toggle="a" data-title="a">NO</a>
                                    <a class="btn btn-default btn-sm notActive" data-toggle="a" data-title="a">ND/ND</a>
                                 
                                </div>
                                <input type="hidden" name="a" id="a">
                            </div>
                        </div>
                </div>
                </div>
            <!-- </div> -->
        </div>    
        <div class="panel panel-default">
            <div class="panel-heading" role="tab" id="headingThree">
              <h4 class="panel-title">
                <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                  
                </a>
              </h4>
            </div>
            <!-- <div id="collapseThree" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree"> -->
                <div class="panel-body" style = "padding-left : 20px; padding-right: 5px;">
                    <ul class="nav nav-tabs " style = "">
                      <li class="active"><a data-toggle="tab" href="#menu1">(30seg)<i class = "glyphicon glyphicon-arrow-right"></i></a></li>
                      <li><a data-toggle="tab" href="#menu2">apnea o FC < 100 (30seg)<i class = "glyphicon glyphicon-arrow-right"></i></a></li>
                      <li><a data-toggle="tab" href="#menu3">FC < 60 (30seg)<i class = "glyphicon glyphicon-arrow-right"></i></a></li>
                      <li><a data-toggle="tab" href="#menu4">FC < 60</a></li>
                    </ul>

                    <div class="tab-content" style = "margin-top : 10px;">
                      <div id="menu1" class="tab-pane fade in active">
                        <div class="row">
                            <div></div>
                            <div class="col-xs-6">
                                <div class="form-group">
                                        <label for="a" class="control-label col-lg-4">calor</label>

                                        <div class="input-group">
                                        <div id="radioBtn" class="btn-group">
                                            <a class="btn btn-default btn-sm active" data-toggle="a" data-title="a">SI</a>
                                            <a class="btn btn-default btn-sm notActive" data-toggle="a" data-title="a">NO</a>
                                            <a class="btn btn-default btn-sm notActive" data-toggle="a" data-title="a">ND/ND</a>
                                         
                                        </div>
                                        <input type="hidden" name="a" id="a">
                                    </div>
                                </div>
                                <div class="form-group">
                                        <label for="cp1" class="control-label col-lg-4">Posicionar</label>

                                        <div class="input-group">
                                        <div id="radioBtn" class="btn-group">
                                            <a class="btn btn-default btn-sm active" data-toggle="gg" data-title="M">SI</a>
                                            <a class="btn btn-default btn-sm notActive" data-toggle="gg" data-title="D">NO</a>
                                            <a class="btn btn-default btn-sm notActive" data-toggle="gg" data-title="D">ND/ND</a>
                                        </div>
                                        <input type="hidden" name="funnya" id="gg">
                                    </div>
                                </div>
                                
                            </div>

                            <div class="col-xs-6">
                                <div class="form-group">
                                        <label for="aa" class="control-label col-lg-4">secar</label>

                                        <div class="input-group">
                                        <div id="radioBtn" class="btn-group">
                                            <a class="btn btn-default btn-sm active" data-toggle="aa" data-title="aa">SI</a>
                                            <a class="btn btn-default btn-sm notActive" data-toggle="aa" data-title="aa">NO</a>
                                             <a class="btn btn-default btn-sm notActive" data-toggle="aa" data-title="aa">ND/ND</a>
                                        </div>
                                        <input type="hidden" name="aa" id="aa">
                                    </div>
                                </div>
                                <div class="form-group">
                                        <label for="a" class="control-label col-lg-4">oxigeno</label>

                                        <div class="input-group">
                                        <div id="radioBtn" class="btn-group">
                                            <a class="btn btn-default btn-sm active" data-toggle="a" data-title="a">SI</a>
                                            <a class="btn btn-default btn-sm notActive" data-toggle="a" data-title="a">NO</a>
                                            <a class="btn btn-default btn-sm notActive" data-toggle="a" data-title="a">ND/ND</a>
                                        </div>
                                        <input type="hidden" name="a" id="a">
                                    </div>
                                </div>
                          
                            </div>
                          
                        </div>
                      </div>
                      <div id="menu2" class="tab-pane fade">
                        
                        <div class="row">
                            <div class="col-xs-7">
                                <div class="form-group">
                                    <label for="a" class="control-label col-lg-4">Ventilacion a Presion positiva</label>

                                    <div class="input-group">
                                        <div id="radioBtn" class="btn-group">
                                            <a class="btn btn-default btn-sm active" data-toggle="a" data-title="a">SI</a>
                                            <a class="btn btn-default btn-sm notActive" data-toggle="a" data-title="a">NO</a>
                                            <a class="btn btn-default btn-sm notActive" data-toggle="a" data-title="a">ND/ND</a>
                                         
                                        </div>
                                        <input type="hidden" name="a" id="a">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="cp1" class="control-label col-lg-4">Posicionar</label>

                                    <div class="input-group">
                                        <div id="radioBtn" class="btn-group">
                                            <a class="btn btn-default btn-sm active" data-toggle="gg" data-title="M">SI</a>
                                            <a class="btn btn-default btn-sm notActive" data-toggle="gg" data-title="D">NO</a>
                                            <a class="btn btn-default btn-sm notActive" data-toggle="gg" data-title="D">ND/ND</a>
                                        </div>
                                        <input type="hidden" name="funnya" id="gg">
                                    </div>
                                </div>
                                
                            </div>
                            <div class="col-xs-4  " >
                                <div class="form-group">
                                   <div class="checkbox">
                                        <label class="control-label col-lg-4">
                                            <input type="checkbox" value="">
                                            Mascara 
                                        </label>
                                    </div>
                                </div>
                                <div class="form-group">
                                       <div class="checkbox">
                                    <label class="control-label col-lg-4">
                                        <input type="checkbox" value="">
                                        TET 
                                    </label>
                                </div>
                                </div>
                                 
                            </div>
                        </div>
                      </div>
                      <div id="menu3" class="tab-pane fade">
                        <div class="form-group">
                            <label for="a" class="control-label col-lg-4">masaje cardiaco</label>

                            <div class="input-group">
                            <div id="radioBtn" class="btn-group">
                                <a class="btn btn-default btn-sm active" data-toggle="a" data-title="a">SI</a>
                                <a class="btn btn-default btn-sm notActive" data-toggle="a" data-title="a">NO</a>
                                <a class="btn btn-default btn-sm notActive" data-toggle="a" data-title="a">ND/ND</a>
                            </div>
                            <input type="hidden" name="a" id="a">
                            </div>
                        </div>
                      </div>
                      <div id="menu4" class="tab-pane fade">
                        <div class="row">
                            <div class="col-xs-4" >
                                <div class="form-group">
                                    <label for="g" class="control-label">Drogas</label>
                                    <div class="input-group">
                                        <div id="radioBtn" class="btn-group">
                                            <a class="btn btn-default btn-sm active" data-toggle="g" data-title="M">SI</a>
                                            <a class="btn btn-default btn-sm notActive" data-toggle="g" data-title="D">NO</a>
                                            <a class="btn btn-default btn-sm notActive" data-toggle="g" data-title="D">ND/ND</a>
                                         
                                        </div>
                                        <input type="hidden" name="funnya" id="g">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="gg" class="control-label">Expansores</label>
                                    <div class="input-group">
                                        <div id="radioBtn" class="btn-group">
                                            <a class="btn btn-default btn-sm active" data-toggle="gg" data-title="M">SI</a>
                                            <a class="btn btn-default btn-sm notActive" data-toggle="gg" data-title="D">NO</a>
                                            <a class="btn btn-default btn-sm notActive" data-toggle="gg" data-title="D">ND/ND</a>
                                        </div>
                                        <input type="hidden" name="funnya" id="gg">
                                    </div>
                                </div>
                                
                            </div>

                            <div class="col-xs-4" >
                                <div class="form-group">
                                    <label for="gg" class="control-label">Adredalina</label>
                                    <div class="input-group">
                                        <div id="radioBtn" class="btn-group">
                                            <a class="btn btn-default btn-sm active" data-toggle="gg" data-title="M">SI</a>
                                            <a class="btn btn-default btn-sm notActive" data-toggle="gg" data-title="D">NO</a>
                                            <a class="btn btn-default btn-sm notActive" data-toggle="gg" data-title="D">ND/ND</a>
                                        </div>
                                        <input type="hidden" name="funnya" id="gg">
                                    </div>
                                </div>
                                <div class="form-group" style ="margin-top : 2px;">
                                    <label class="control-label">otros</label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-time"></i></span>
                                        <input id="telefono" type="text" class="form-control" name="telefono" value="" placeholder="Otras">                                        
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-xs-4  " >
                                <div class="form-group">
                                    <label for="x" class="control-label">Naloxona</label>
                                    <div class="input-group">
                                        <div id="radioBtn" class="btn-group">
                                            <a class="btn btn-default btn-sm active" data-toggle="x" data-title="x">SI</a>
                                            <a class="btn btn-default btn-sm notActive" data-toggle="x" data-title="x">NO</a>
                                            <a class="btn btn-default btn-sm notActive" data-toggle="x" data-title="x">ND/ND</a>
                                        </div>
                                        <input type="hidden" name="funnyaaa" id="x">
                                    </div>
                                </div>
                                
                                
                            </div>
                        </div>
                        
                      </div>
                    </div>
                </div>
            <!-- </div> -->

        </div> 
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
                      <li class="active"><a data-toggle="tab" href="#panel4_1">APEGO PRECOZ</a></li>
                      <li><a data-toggle="tab" href="#panel4_2">HIGUIENE</a></li>
                      <li><a data-toggle="tab" href="#panel4_3">PROFILAXIS</a></li>
                      <li><a data-toggle="tab" href="#panel4_4">VITAMINA K</a></li>
                    </ul>

                    <div class="tab-content" style = "margin-top : 10px;">
                        <div id="panel4_1" class="tab-pane fade in active">
                            <div class="row">
                                <div class="form-group">
                                    <label for="a" class="control-label col-lg-4">Apego</label>
                                    <div class="input-group">
                                        <div id="radioBtn" class="btn-group">
                                            <a class="btn btn-default btn-sm active" data-toggle="a" data-title="a">SI</a>
                                            <a class="btn btn-default btn-sm notActive" data-toggle="a" data-title="a">NO</a>
                                            <a class="btn btn-default btn-sm notActive" data-toggle="a" data-title="a">ND/ND</a>
                                         
                                        </div>
                                        <input type="hidden" name="a" id="a">
                                    </div>
                                </div>
                            </div>    
                          </div>

                          <div id="panel4_2" class="tab-pane fade">
                            <div class="row">
                                <div class="form-group">
                                    <label for="a" class="control-label col-lg-4">Metodo</label>

                                    <div class="input-group">
                                    <div id="radioBtn" class="btn-group">
                                        <a class="btn btn-default btn-sm active" data-toggle="a" data-title="a">Aseo</a>
                                        <a class="btn btn-default btn-sm notActive" data-toggle="a" data-title="a">Baño</a>
                                        <a class="btn btn-default btn-sm notActive" data-toggle="a" data-title="a">ND/ND</a>
                                    </div>
                                    <input type="hidden" name="a" id="a">
                                    </div>
                                </div>
                            </div>
                          </div>

                          <div id="panel4_3" class="tab-pane fade">
                            <div class="row">
                                <div class="col-xs-6">
                                    <div class="form-group">
                                        <label for="a" class="control-label col-lg-4">Oftalmica</label>

                                        <div class="input-group">
                                        <div id="radioBtn" class="btn-group">
                                            <a class="btn btn-default btn-sm active" data-toggle="a" data-title="a">SI</a>
                                            <a class="btn btn-default btn-sm notActive" data-toggle="a" data-title="a">NO</a>
                                            <a class="btn btn-default btn-sm notActive" data-toggle="a" data-title="a">ND/ND</a>
                                        </div>
                                        <input type="hidden" name="a" id="a">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-6">
                                    <div class="form-group">
                                        <label for="a" class="control-label col-lg-4">Umbilical</label>

                                        <div class="input-group">
                                        <div id="radioBtn" class="btn-group">
                                            <a class="btn btn-default btn-sm active" data-toggle="a" data-title="a">SI</a>
                                            <a class="btn btn-default btn-sm notActive" data-toggle="a" data-title="a">NO</a>
                                            <a class="btn btn-default btn-sm notActive" data-toggle="a" data-title="a">ND/ND</a>
                                        </div>
                                        <input type="hidden" name="a" id="a">
                                        </div>
                                    </div>
                                </div>
                            </div>
                          </div>
                          <div id="panel4_4" class="tab-pane fade">
                            <div class="row">
                               <div class="form-group">
                                    <label for="a" class="control-label col-lg-4">Vitamina K</label>

                                    <div class="input-group">
                                    <div id="radioBtn" class="btn-group">
                                        <a class="btn btn-default btn-sm active" data-toggle="a" data-title="a">SI</a>
                                        <a class="btn btn-default btn-sm notActive" data-toggle="a" data-title="a">NO</a>
                                        <a class="btn btn-default btn-sm notActive" data-toggle="a" data-title="a">ND/ND</a>
                                    </div>
                                    <input type="hidden" name="a" id="a">
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
