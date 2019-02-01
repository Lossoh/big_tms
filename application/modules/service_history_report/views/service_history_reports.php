<section id="content">
  <section class="hbox stretch">
 
<!-- .aside -->
<!--<aside>-->
<section class="vbox">
    <header class="header bg-white b-b b-light">
        <div class="pull-right" style="margin-top: 10px;">&nbsp;</div>
        <p class="pull-left"><?=lang('service_history_report')?></p>
    </header>
    <section class="scrollable wrapper">
      <div class="row">
        <div class="col-lg-12">
          <div class="panel panel-primary">
            <div class="panel-body">
                <?=form_open(base_url('service_history_report/print_report'),'autocomplete="off" id="form" name="form" class="form-horizontal" target="_blank"')?>
                <div class="form-group form-md-line-input row">
                    <label class="col-md-3 control-label">Period<span class="text-danger">*</span></label>
                    <div class="col-md-3">
                        <div class="input-group input-daterange">
                            <input type="text" name="start_date" id="start_date" class="form-control input-sm" placeholder="<?=lang('start_date')?>" value="<?=date('01-m-Y')?>">
                            <span class="input-group-addon">to</span>
                            <input type="text" name="end_date" id="end_date" class="form-control input-sm" placeholder="<?=lang('end_date')?>" value="<?=date('t-m-Y')?>">
                        </div>                    
                    </div>
                </div>                
                <div class="form-group form-md-line-input row">
                    <label class="col-md-3 control-label">Police No<span class="text-danger">*</span></label>
                    <div class="col-md-2">
                        <select class="form-control all_select2" name="police_no" id="police_no" >
                            <option value="all">All</option>
							<?php
							foreach($vehicles as $row){
								echo '<option value="'.$row->rowID.'">'.$row->police_no.'</option>';
							}
							?>
                        </select>
                    </div>
                </div>
                <div class="form-group form-md-line-input row">
                    <label class="col-md-3 control-label">SPK Type<span class="text-danger">*</span></label>
                    <div class="col-md-2">
                        <select class="form-control" name="print_type" id="print_type" >
                            <option value="finish">Finish</option>
							<option value="progress">Progress</option>
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