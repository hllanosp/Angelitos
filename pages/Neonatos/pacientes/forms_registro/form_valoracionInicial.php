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


<div class="panel panel-default">
    <!-- <div class="panel-heading" role = "tab" id ="">

        
    </div> -->
    <div class="panel-body" style ="padding-left : 20px; padding-right: 5px;">
        <div class="row"  style = "margin:auto;">
            <div class="col-xs-4">
                <div class="form-group" style ="margin-top : 2px;">
                    <!-- <label class="control-label">Orden Nacimiento</label> -->
                    <div class="input-group">
                        <span class="input-group-addon"><i class=""></i></span>
                        <input id="orden_nacimiento" type="num" class="form-control" name="orden" value="" placeholder="To rectal">                                        
                    </div>
                </div>
                

            </div>
            <div class="col-xs-4">
                <div class="form-group" style ="margin-top : 2px;">
                    <!-- <label class="control-label">Orden Nacimiento</label> -->
                    <div class="input-group">
                        <span class="input-group-addon"><i class=""></i></span>
                        <input id="orden_nacimiento" type="num" class="form-control" name="orden" value="" placeholder="FC">                                        
                    </div>
                </div>
            </div>
            <div class="col-xs-4">
                <div class="form-group" style ="margin-top : 2px;">
                    <!-- <label class="control-label">Orden Nacimiento</label> -->
                    <div class="input-group">
                        <span class="input-group-addon"><i class=""></i></span>
                        <input id="orden_nacimiento" type="num" class="form-control" name="orden" value="" placeholder="FR">                                        
                    </div>
                </div>
            </div>
        </div>
        
        <div class="row"  style = "margin:auto;">
                    <div class="col-xs-4">
                        <div class="form-group" style ="margin-top : 2px;">
                            <!-- <label class="control-label">Orden Nacimiento</label> -->
                            <div class="input-group">
                                <span class="input-group-addon"><i class=""></i></span>
                                <input id="orden_nacimiento" type="num" class="form-control" name="orden" value="" placeholder="P/A ">                                        
                            </div>
                        </div>
                        <div class="form-group" style ="margin-top : 2px;">
                            <!-- <label class="control-label">Orden Nacimiento</label> -->
                            <div class="input-group">
                                <span class="input-group-addon"><i class=""></i></span>
                                <input id="orden_nacimiento" type="num" class="form-control" name="orden" value="" placeholder="FI02">                                        
                            </div>
                        </div>

                    </div>

                    <div class="col-xs-4">
                        <div class="form-group" style ="margin-top : 2px;">
                            <!-- <label class="control-label">Orden Nacimiento</label> -->
                            <div class="input-group">
                                <span class="input-group-addon"><i class=""></i></span>
                                <input id="orden_nacimiento" type="num" class="form-control" name="orden" value="" placeholder="Glucometria">                                        
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-4">
                        <div class="form-group" style ="margin-top : 2px;">
                            <!-- <label class="control-label">Orden Nacimiento</label> -->
                            <div class="input-group">
                                <span class="input-group-addon"><i class=""></i></span>
                                <input id="orden_nacimiento" type="num" class="form-control" name="orden" value="" placeholder="So2">                                        
                            </div>
                        </div>
                    </div>
                </div>


        <div class="row"  style = "margin:auto;">
            <div class="col-xs-4">
                
            </div>
            <div class="col-xs-4">
                
            </div>
            <div class="col-xs-4">
                
            </div>
        </div>

    </div>
</div>

<div class="panel panel-default" >
    <!-- <div class="panel-heading" role="tab" id="headingTwo">
      <h4 class="panel-title">
        <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
          
        </a>
      </h4>
    </div> -->
    <!-- <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo"> -->
    <div class="panel-body" style ="padding-left : 20px; padding-right: 5px;">
        <div class="row" style = "margin:auto;">
            <div class="col-xs-4" >
                <div class="form-group">
                    <label for="g" class="control-label"> Cianocis</label>
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
                    <label for="gg" class="control-label">Ictericia</label>
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
                    <label for="x" class="control-label">Diurecis</label>
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

        <div class="row" style = "margin:auto;">
            <div class="col-xs-4" >
                <div class="form-group">
                    <label for="g" class="control-label"> Palidez</label>
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
                    <label for="gg" class="control-label">SDR</label>
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
                    <label for="x" class="control-label">Meconio</label>
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

<div class="panel panel-default">
    <!-- <div class="panel-heading">
        
    </div> -->
    <div class="panel-body">
        <div class="row" style = "margin:auto;">
            <div class="col-xs-12" >
                <div class="form-group">
                    <label for="g" class="control-label"> Estado de Conciencia</label>
                    <div class="input-group">
                        <div id="radioBtn" class="btn-group">
                            <a class="btn btn-default btn-sm active" data-toggle="g" data-title="M">Alerta</a>
                            <a class="btn btn-default btn-sm notActive" data-toggle="g" data-title="D">Irritable</a>
                            <a class="btn btn-default btn-sm notActive" data-toggle="g" data-title="D">Letargico</a>
                            <a class="btn btn-default btn-sm notActive" data-toggle="g" data-title="D">Coma</a>
                            <a class="btn btn-default btn-sm notActive" data-toggle="g" data-title="D">ND/ND</a>
                         
                        </div>
                        <input type="hidden" name="funnya" id="g">
                    </div>
                </div>
                
            </div>
        </div>
    </div>
</div>
