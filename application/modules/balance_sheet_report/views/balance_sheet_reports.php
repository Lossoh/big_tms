<section id="content">
  <section class="hbox stretch">
 
<!-- .aside -->
<!--<aside>-->
<section class="vbox">
    <header class="header bg-white b-b b-light">
        <div class="pull-right" style="margin-top: 10px;">&nbsp;</div>
        <p class="pull-left"><?=lang('balance_sheet_report')?> Report</p>
    </header>
    <section class="scrollable wrapper">
      <div class="row">
        <div class="col-lg-12">
          <div class="panel panel-primary">
            <div class="panel-body">          
                <?=form_open(base_url('balance_sheet_report/print_report'),'autocomplete="off" id="form" name="form" class="form-horizontal" target="_blank"')?>
                <div class="form-group form-md-line-input row">
                    <label class="col-md-3 control-label">Report Type<span class="text-danger">*</span></label>
                    <div class="col-md-4">
                        <select class="form-control" name="report_type" id="report_type" onchange="report_type_balance()">
                            <option value="Neraca Scontro">Neraca Scontro</option>
                            <option value="Neraca T">Neraca T</option>
                            <option value="Profit and Loss">Profit and Loss</option>
                            <option value="Changes in Capital">Changes in Capital</option>
                        </select>
                    </div>
                </div>
                <div class="form-group form-md-line-input row" id="time_type_field">
                    <label class="col-md-3 control-label">Time Type<span class="text-danger">*</span></label>
                    <div class="col-md-4">
                        <select class="form-control" name="time_type" id="time_type" onchange="time_type_balance()">
                            <option value="monthly">Monthly</option>
                            <option value="yearly">Yearly</option>
                        </select>
                    </div>
                </div>
                <div class="form-group form-md-line-input row" id="period_month_year">
                    <label class="col-md-3 control-label">Period<span class="text-danger">*</span></label>
                    <div class="col-md-2">
                        <input type="text" name="period" id="month_year" class="form-control input-sm text-center" value="<?=date('m-Y')?>">                  
                    </div>
                </div>
                <div class="form-group form-md-line-input row" id="period_month_year_profit" style="display: none;">
                    <label class="col-md-3 control-label">Period<span class="text-danger">*</span></label>
                    <div class="col-md-3">
                        <div class="input-group input-daterange">
                            <input type="text" name="start_date" id="start_month" class="form-control input-sm" placeholder="<?=lang('start_date')?>" value="<?=date('m-Y')?>">
                            <span class="input-group-addon">to</span>
                            <input type="text" name="end_date" id="end_month" class="form-control input-sm" placeholder="<?=lang('end_date')?>" value="<?=date('m-Y')?>">
                        </div>                    
                    </div>
                </div>
                <div class="form-group form-md-line-input row" id="print_type_field">
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