<div class="form-group">
            <label for="asd" class="control-label col-xs-5">Reingreso</label>
            <div class="input-group col-xs-5">
                <div id="radioBtn" class="btn-group">
                    <a class="btn btn-primary btn-sm active" data-toggle="asd" data-title="Yasd">Si</a>
                    <a class="btn btn-danger btn-sm notActive" data-toggle="asd" data-title="Nasd">No</a>
                    <a class="btn btn-default btn-sm notActive" data-toggle="asd" data-title="Nasdd">ND/ND</a>
                </div>
                <input type="hidden" name="asd" id="asd">
            </div>
</div>
<div class="panel panel-default">
    <div class="panel-body" style ="padding-left : 25px; padding-right: 25px;">
        <div class="row">
    <div class="col-xs-7">
        <div class="row">
            <div class="col-xs-3">
                <div class="form-group">
                    <label class="control-label">Dia</label>
                    <select class = "form-control"name="mes">
                        <?php
                        for ($i=1; $i<=31; $i++) {
                            if ($i == date('j'))
                                echo '<option value="'.$i.'" selected>'.$i.'</option>';
                            else
                                echo '<option value="'.$i.'">'.$i.'</option>';
                        }
                        ?>
                    </select>
                </div>
            </div>
            <div class="col-xs-3">
                <div class="form-group">
                    <label class="control-label">Mes</label>
                    <select class = "form-control"name="mes">
                        <?php
                        for ($i=1; $i<=12; $i++) {
                            if ($i == date('m'))
                                echo '<option value="'.$i.'" selected>'.$i.'</option>';
                            else
                                echo '<option value="'.$i.'">'.$i.'</option>';
                        }
                        ?>
                    </select>
                </div>
            </div>
            <div class="col-xs-3">
                <div class="form-group">
                    <label class="control-label">año</label>
                    <select name="ano" class = "form-control" >
                        <?php
                        for($i=date('o'); $i>=1910; $i--){
                            if ($i == date('o'))
                                echo '<option value="'.$i.'" selected>'.$i.'</option>';
                            else
                                echo '<option value="'.$i.'">'.$i.'</option>';
                        }
                        ?>
                    </select>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xs-5">
       <div class="row">
            <div class="col-xs-6">
                <div class="form-group">
                    <label class="control-label">Horas</label>
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-clock-o"></i></span>
                        <input id="direccion" type="num" class="form-control" name="direccion" value="" placeholder="horas">                                        
                    </div>
                </div>
            </div>
            <div class="col-xs-6">
                <div class="form-group">
                    <label class="control-label">Minutos</label>
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-clock-o"></i></span>
                        <input id="telefono" type="num" class="form-control" name="telefono" value="" placeholder="minutos">                                        
                    </div>
                </div>
            </div>
           
        </div> 
    </div>
</div>
    </div>
</div>
<div class="panel panel-default">
    <div class="panel-body" style ="padding-left : 25px; padding-right: 25px;">
        <div class="col-xs-5 col-xs-offset-1">
            <label class="control-label">
                Edad
            </label>
        </div>
        <div class="col-xs-4 col-xs-offset-2">
            <label class="control-label">
               EG al nacer
            </label>
        </div>
        <div class="row">
    <div class="col-xs-7">
        <div class="row">
            <div class="col-xs-3">
                <div class="form-group">
                    <label class="control-label">Dias</label>
                    <select class = "form-control"name="mes">
                        <?php
                        for ($i=1; $i<=12; $i++) {
                            if ($i == date('m'))
                                echo '<option value="'.$i.'" selected>'.$i.'</option>';
                            else
                                echo '<option value="'.$i.'">'.$i.'</option>';
                        }
                        ?>
                    </select>
                </div>
            </div>
            <div class="col-xs-4">
                <div class="form-group">
                    <label class="control-label">Horas</label>
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-clock-o"></i></span>
                        <input id="direccion" type="num" class="form-control" name="direccion" value="" placeholder="horas">                                        
                    </div>
                </div>
            </div>
           
        </div>
    </div>
    <div class="col-xs-5">
       <div class="row">
            <div class="col-xs-6">
                <div class="form-group">
                    <label class="control-label">Semanas</label>
                    <div class="input-group">
                        <span class="input-group-addon"><i class=""></i></span>
                        <input id="direccion" type="num" class="form-control" name="direccion" value="" placeholder="semanas">                                        
                    </div>
                </div>
            </div>
            <div class="col-xs-6">
                <div class="form-group">
                    <label class="control-label">Dias</label>
                    <div class="input-group">
                        <span class="input-group-addon"><i class=""></i></span>
                        <input id="telefono" type="num" class="form-control" name="telefono" value="" placeholder="dias">                                        
                    </div>
                </div>
            </div>
           
        </div> 
    </div>
</div>
    </div>
</div>

