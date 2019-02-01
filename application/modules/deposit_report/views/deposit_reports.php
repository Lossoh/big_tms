<section id="content">
  <section class="hbox stretch">
 
<!-- .aside -->
<!--<aside>-->
<section class="vbox">
    <header class="header bg-white b-b b-light">
        <div class="pull-right" style="margin-top: 10px;">&nbsp;</div>
        <p class="pull-left"><?=lang('deposit_report')?></p>
    </header>
    <section class="scrollable wrapper">
      <div class="row">
        <div class="col-lg-12">
          <div class="panel panel-primary">
            <div class="panel-body">
                <?=form_open(base_url('deposit_report/print_report'),'autocomplete="off" id="form" name="form" class="form-horizontal" target="_blank"')?>
                <div class="form-group form-md-line-input row">
                    <label class="col-md-3 control-label">Periode<span class="text-danger">*</span></label>
                    <div class="col-md-2">
                        <div class="input-group input-daterange">
                            <select class="form-control input-sm" name="start_period" id="start_period" required>
                                <?php
                                    for($i=1;$i<=24;$i++){
                                        echo '<option value="'.$i.'">'.$i.'</option>';
                                    }
                                ?>
                            </select>
                            <span class="input-group-addon">to</span>
                            <select class="form-control input-sm" name="end_period" id="end_period" required>
                                <?php
                                    for($i=1;$i<=24;$i++){
                                        echo '<option value="'.$i.'">'.$i.'</option>';
                                    }
                                ?>
                            </select>
                        </div>                    
                    </div>
                </div>    
                <div class="form-group form-md-line-input row">
                    <label class="col-md-3 control-label">Year<span class="text-danger">*</span></label>
                    <div class="col-md-2">
                        <select class="form-control" name="year" id="year" >
                        <?php
                            $year = date('Y');
                            for($i=$year;$i>=2016;$i--){
                                echo '<option value="'.$i.'">'.$i.'</option>';
                            }
                        ?>
                        </select>
                    </div>
                </div>
                <div class="form-group form-md-line-input row">
                    <label class="col-md-3 control-label">Print Type<span class="text-danger">*</span></label>
                    <div class="col-md-2">
                        <select class="form-control" name="print_type" id="print_type" >
                            <option value="pdf">PDF</option>
                            <option value="excel">Excel</option>
                        </select>
                    </div>
                </div>
                <br />
                <div class="form-group form-md-line-input row">
                    <label class="col-md-3 control-label">&nbsp;</label>
                    <div class="col-md-3">
                        <button type="submit" class="btn btn-sm green" form="form"><i class="fa fa-print"></i> Print</button>
                        <button type="reset" class="btn btn-sm btn-default" ><i class="fa fa-times"></i> Reset</button>
                    </div>
                </div>                
                <p>&nbsp;</p>
                
                <?=form_close()?>
            </div>
          </div>            
        </div>
      </div>
    </section>

</section>
  <!--</aside>-->
  
</section>
<a href="#" class="hide nav-off-screen-block" data-toggle="class:nav-off-screen, open" data-target="#nav,html"></a>
</section>