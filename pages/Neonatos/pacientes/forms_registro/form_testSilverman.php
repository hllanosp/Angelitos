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

<table class='table table-bordered table-striped display' cellspacing="0" >
    <thead >
      <tr style="background-color: rgb(71, 58, 147);" >
        <th style= "color: white">Valor</th>
        <th style= "color: white">Grado 0</th>
        <th style= "color: white">Grado 1</th>
        <th style= "color: white">Grado 2</th>
        <th style= "color: white">Total</th>
      </tr>
    </thead>
    <tbody>
        <tr>
            <td> Moviento Toraco - Abdominal </td>
            <td> Rítmicos Regulares </td>
            <td> Torax Inmovil, abdomen en movimiento </td>
            <td> Balanceo (sube y baja) </td>
            <td> <input type="text"></td>
        </tr>
        <tr>
            <td> Tiraje intercostal en la inspiración </td>
            <td> Ausente </td>
            <td> Discreto </td>
            <td> Acentuado y constante </td>
            <td> <input type="text"></td>
        </tr>
        <tr>
            <td> Tiro Xifoide </td>
            <td> Ausente </td>
            <td> Discreto </td>
            <td> Muy marcado </td>
            <td> <input type="text"></td>
        </tr>
        <tr>
            <td> Aleteo Nasal </td>
            <td> Ausente </td>
            <td> Discreto </td>
            <td> Muy marcado </td>
            <td> <input type="text"></td>
        </tr>
        <tr>
            <td> Quejido espiratorio </td>
            <td> Ausente </td>
            <td> Leve inconstante </td>
            <td> Acentuado y constante </td>
            <td> <input type="text"></td>
        </tr>
    </tbody>
</table>

<div class="row">
    <center>
        <label class="control-label">TOTAL</label>
    </center>
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
                    <li class="active"><a data-toggle="tab" href="#panel1">Pulmones</a></li>
                    <li><a data-toggle="tab" href="#panel2">Cardio vascular</a></li>
                    <li><a data-toggle="tab" href="#panel3">Abdomen</a></li>
                    <li><a data-toggle="tab" href="#panel4">Cordón umbilical</a></li>
                    <li><a data-toggle="tab" href="#panel5">Genito Urinario/Ano</a></li>
                    <li><a data-toggle="tab" href="#panel6">Permeabilidad rectal</a></li>
                    <li><a data-toggle="tab" href="#panel7">Columna y extremidades</a></li>
                    <li><a data-toggle="tab" href="#panel8">Maneobra de ortolani</a></li>
                </ul>

                <div class="tab-content" style = "margin-top : 10px;">
                    <div id="panel1" class="tab-pane fade in active">
                        <div class="row">
                            <div class="col-xs-6">
                                <div class="input-group">
                                    <div id="radioBtn" class="btn-group">
                                        <a class="btn btn-default btn-sm active" data-toggle="lovely" data-title="s1">Normal</a>
                                        <a class="btn btn-default btn-sm notActive" data-toggle="lovely" data-title="s2">Anormal</a>
                                        <a class="btn btn-default btn-sm notActive" data-toggle="lovely" data-title="s3">ND/ND</a>
                                    </div>
                                    <input type="hidden" name="lovely" id="lovely">
                                </div>
                            </div>
                            <div class="col-xs-6">
                                <input type="text" placeholder="Especifique">
                            </div>
                        </div>    
                    </div>
                    <div id="panel2" class="tab-pane fade in">
                        <div class="row">
                            <div class="col-xs-6">
                                <div class="input-group">
                                    <div id="radioBtn" class="btn-group">
                                        <a class="btn btn-default btn-sm active" data-toggle="lovely2" data-title="s12">Normal</a>
                                        <a class="btn btn-default btn-sm notActive" data-toggle="lovely2" data-title="s22">Anormal</a>
                                        <a class="btn btn-default btn-sm notActive" data-toggle="lovely2" data-title="s32">ND/ND</a>
                                    </div>
                                    <input type="hidden" name="lovely2" id="lovely2">
                                </div>
                            </div>
                            <div class="col-xs-6">
                                <input type="text" placeholder="Especifique">
                            </div>
                        </div>    
                    </div>
                    <div id="panel3" class="tab-pane fade in">
                        <div class="row">
                            <div class="col-xs-6">
                                <div class="input-group">
                                    <div id="radioBtn" class="btn-group">
                                        <a class="btn btn-default btn-sm active" data-toggle="lovely3" data-title="s13">Normal</a>
                                        <a class="btn btn-default btn-sm notActive" data-toggle="lovely3" data-title="s23">Anormal</a>
                                        <a class="btn btn-default btn-sm notActive" data-toggle="lovely3" data-title="s33">ND/ND</a>
                                    </div>
                                    <input type="hidden" name="lovely3" id="lovely3">
                                </div>
                            </div>
                            <div class="col-xs-6">
                                <input type="text" placeholder="Especifique">
                            </div>
                        </div>    
                    </div>
                    <div id="panel4" class="tab-pane fade in">
                        <div class="row">
                            <div class="col-xs-6">
                                <div class="input-group">
                                    <div id="radioBtn" class="btn-group">
                                        <a class="btn btn-default btn-sm active" data-toggle="lovely4" data-title="s14">Normal</a>
                                        <a class="btn btn-default btn-sm notActive" data-toggle="lovely4" data-title="s24">Anormal</a>
                                        <a class="btn btn-default btn-sm notActive" data-toggle="lovely4" data-title="s34">ND/ND</a>
                                    </div>
                                    <input type="hidden" name="lovely4" id="lovely4">
                                </div>
                            </div>
                            <div class="col-xs-6">
                                <input type="text" placeholder="Especifique">
                            </div>
                        </div>    
                    </div>
                    <div id="panel5" class="tab-pane fade in">
                        <div class="row">
                            <div class="col-xs-6">
                                <div class="input-group">
                                    <div id="radioBtn" class="btn-group">
                                        <a class="btn btn-default btn-sm active" data-toggle="lovely5" data-title="s15">Normal</a>
                                        <a class="btn btn-default btn-sm notActive" data-toggle="lovely5" data-title="s25">Anormal</a>
                                        <a class="btn btn-default btn-sm notActive" data-toggle="lovely5" data-title="s35">ND/ND</a>
                                    </div>
                                    <input type="hidden" name="lovely5" id="lovely5">
                                </div>
                            </div>
                            <div class="col-xs-6">
                                <input type="text" placeholder="Especifique">
                            </div>
                        </div>    
                    </div>
                    <div id="panel6" class="tab-pane fade in">
                        <div class="row">
                            <div class="col-xs-6">
                                <div class="input-group">
                                    <div id="radioBtn" class="btn-group">
                                        <a class="btn btn-default btn-sm active" data-toggle="lovely6" data-title="s16">Normal</a>
                                        <a class="btn btn-default btn-sm notActive" data-toggle="lovely6" data-title="s26">Anormal</a>
                                        <a class="btn btn-default btn-sm notActive" data-toggle="lovely6" data-title="s36">ND/ND</a>
                                    </div>
                                    <input type="hidden" name="lovely6" id="lovely6">
                                </div>
                            </div>
                            <div class="col-xs-6">
                                <input type="text" placeholder="Especifique">
                            </div>
                        </div>    
                    </div>
                    <div id="panel7" class="tab-pane fade in">
                        <div class="row">
                            <div class="col-xs-6">
                                <div class="input-group">
                                    <div id="radioBtn" class="btn-group">
                                        <a class="btn btn-default btn-sm active" data-toggle="lovely7" data-title="s17">Normal</a>
                                        <a class="btn btn-default btn-sm notActive" data-toggle="lovely7" data-title="s27">Anormal</a>
                                        <a class="btn btn-default btn-sm notActive" data-toggle="lovely7" data-title="s37">ND/ND</a>
                                    </div>
                                    <input type="hidden" name="lovely7" id="lovely7">
                                </div>
                            </div>
                            <div class="col-xs-6">
                                <input type="text" placeholder="Especifique">
                            </div>
                        </div>    
                    </div>
                    <div id="panel8" class="tab-pane fade in">
                        <div class="row">
                            <div class="input-group">
                                <div id="radioBtn" class="btn-group">
                                    <a class="btn btn-default btn-sm active" data-toggle="lovely8" data-title="s18">Negativa</a>
                                    <a class="btn btn-default btn-sm notActive" data-toggle="lovely8" data-title="s28">Positiva</a>
                                    <a class="btn btn-default btn-sm notActive" data-toggle="lovely8" data-title="s38">Bilateral</a>
                                    <a class="btn btn-default btn-sm notActive" data-toggle="lovely8" data-title="s48">Derecha</a>
                                    <a class="btn btn-default btn-sm notActive" data-toggle="lovely8" data-title="s58">Izquierda</a>
                                    <a class="btn btn-default btn-sm notActive" data-toggle="lovely8" data-title="s68">ND/ND</a>
                                </div>
                                <input type="hidden" name="lovely8" id="lovely8">
                            </div>
                        </div>    
                    </div>
                </div>
            </div>
        <!-- </div> -->
        </div> 
</div>
<div class="row">
    <center>
        <label class="control-label">NEUROLÓGICO</label>
    </center>
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
                    <li class="active"><a data-toggle="tab" href="#panel11">ACTITUD/MOTILIDAD</a></li>
                    <li><a data-toggle="tab" href="#panel21">SUCCIÓN</a></li>
                    <li><a data-toggle="tab" href="#panel31">TONO</a></li>
                    <li><a data-toggle="tab" href="#panel41">MORO</a></li>
                    <li><a data-toggle="tab" href="#panel51">MALFORMACIONES CONGENITAS</a></li>
                </ul>

                <div class="tab-content" style = "margin-top : 10px;">
                    <div id="panel11" class="tab-pane fade in active">
                        <div class="row">
                            <div class="input-group">
                                <div id="radioBtn" class="btn-group">
                                    <a class="btn btn-default btn-sm active" data-toggle="lovely11" data-title="s111">Normal</a>
                                    <a class="btn btn-default btn-sm notActive" data-toggle="lovely11" data-title="s211">Anormal</a>
                                    <a class="btn btn-default btn-sm notActive" data-toggle="lovely11" data-title="s311">ND/ND</a>
                                </div>
                                <input type="hidden" name="lovely" id="lovely11">
                            </div>
                        </div>    
                    </div>
                    <div id="panel21" class="tab-pane fade in">
                        <div class="row">
                            <div class="input-group">
                                <div id="radioBtn" class="btn-group">
                                    <a class="btn btn-default btn-sm active" data-toggle="lovely21" data-title="s1211">Normal</a>
                                    <a class="btn btn-default btn-sm notActive" data-toggle="lovely21" data-title="s2211">Anormal</a>
                                    <a class="btn btn-default btn-sm notActive" data-toggle="lovely21" data-title="s3211">ND/ND</a>
                                </div>
                                <input type="hidden" name="lovely21" id="lovely21">
                            </div>
                        </div>    
                    </div>
                    <div id="panel31" class="tab-pane fade in">
                        <div class="row">
                            <div class="input-group">
                                <div id="radioBtn" class="btn-group">
                                    <a class="btn btn-default btn-sm active" data-toggle="lovely31" data-title="s1311">Normal</a>
                                    <a class="btn btn-default btn-sm notActive" data-toggle="lovely31" data-title="s2311">Anormal</a>
                                    <a class="btn btn-default btn-sm notActive" data-toggle="lovely31" data-title="s3311">ND/ND</a>
                                </div>
                                <input type="hidden" name="lovely31" id="lovely31">
                            </div>
                        </div>    
                    </div>
                    <div id="panel41" class="tab-pane fade in">
                        <div class="row">
                            <div class="input-group">
                                <div id="radioBtn" class="btn-group">
                                    <a class="btn btn-default btn-sm active" data-toggle="lovely41" data-title="s1411">Completo</a>
                                    <a class="btn btn-default btn-sm notActive" data-toggle="lovely41" data-title="s2411">Incompleto</a>
                                    <a class="btn btn-default btn-sm notActive" data-toggle="lovely41" data-title="s3411">Ausente</a>
                                    <a class="btn btn-default btn-sm notActive" data-toggle="lovely41" data-title="s3411">ND/ND</a>
                                </div>
                                <input type="hidden" name="lovely41" id="lovely41">
                            </div>
                        </div>    
                    </div>
                    <div id="panel51" class="tab-pane fade in">
                        <div class="row">
                            <div class="col-xs-6">
                                <div class="input-group">
                                    <div id="radioBtn" class="btn-group">
                                        <a class="btn btn-default btn-sm active" data-toggle="lovely51" data-title="s1511">SI</a>
                                        <a class="btn btn-default btn-sm notActive" data-toggle="lovely51" data-title="s2511">NO</a>
                                        <a class="btn btn-default btn-sm notActive" data-toggle="lovely51" data-title="s3511">ND/ND</a>
                                    </div>
                                    <input type="hidden" name="lovely51" id="lovely51">
                                </div>
                            </div>
                            <div class="col-xs-6">
                                <input type="text" placeholder="Especifique">
                            </div>
                        </div>    
                    </div>
                </div>
            </div>
        <!-- </div> -->
        </div> 
</div>
<div class="row">
    <div class="col-xs-6">
        <center>
            <label class="control-label">IMPRESION DIAGNÓSTICA</label>
        </center>
        <div class="col-xs-6">
            <label class="control-label">
                1
            </label>
            <input type="text" placeholder="Primera impresion">
        </div>
        <div class="col-xs-6">
            <label class="control-label">
                2
            </label>
            <input type="text" placeholder="Segunda impresion">
        </div>
        <div class="col-xs-6">
            <label class="control-label">
                3
            </label>
            <input type="text" placeholder="Tercera impresion">
        </div>
        <div class="col-xs-6">
            <label class="control-label">
                4
            </label>
            <input type="text" placeholder="Cuarta impresion">
        </div>
    </div>
    <div class="col-xs-6">
        <center>
            <label class="control-label">OBSERVACIONES</label>
            <textarea></textarea>
        </center>
    </div>
</div>
<div class="row">
    <div class="col-xs-6">
        <label class="control-label">
            Nombre de la persona que la atendió
        </label>
        <input type="text" placeholder="Nombre responsable">
    </div>
    <div class="col-xs-6">
        <label class="control-label">
            Firma y código
        </label>
        <input type="text" placeholder="Firma y código">
    </div>
</div>