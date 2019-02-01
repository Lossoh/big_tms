<section id="content">
  <section class="hbox stretch">
 
<!-- .aside -->
<!--<aside>-->
<section class="vbox">
    <header class="header bg-white b-b b-light">
        <div class="pull-right" style="margin-top: 10px;">&nbsp;</div>
        <p class="pull-left"><?=lang('receivable_employee')?> Reports</p>
    </header>
    <section class="scrollable wrapper">
      <div class="row">
        <div class="col-lg-12">
          <div class="panel panel-primary">
            <div class="panel-body">
                <?=form_open(base_url('receivable_employee/print_report'),'autocomplete="off" id="form" name="form" class="form-horizontal" target="_blank"')?>
                <div class="form-group form-md-line-input row">
                    <label class="col-md-3 control-label">Employee Type <span class="text-danger">*</span></label>
                    <div class="col-md-4">
                        <select class="form-control" name="employee_type" id="employee_type" required="">
                            <option value="">- Select Type -</option>
                            <option value="E">Employee</option>
                            <option value="D">Driver</option>
                        </select>
                    </div>
                </div>
                <div class="form-group form-md-line-input row">
                    <label class="col-md-3 control-label">Employee/Driver Name <span class="text-danger">*</span></label>
                    <div class="col-md-4">
                        <select class="form-control all_select2" name="debtor_id" id="debtor_id" required=""></select>
                    </div>
                </div>
                <div class="form-group form-md-line-input row">
                    <label class="col-md-3 control-label">Until <?=lang('date')?> <span class="text-danger">*</span></label>
                    <div class="col-md-4">
                        <input type="text" class="form-control input-sm pull-left tanggal_datetimepicker" value="<?=date('d-m-Y')?>" name="until_date" id="until_date" placeholder="dd-mm-yyyy" style="text-align: center;width:30%" required>
                    </div>
                </div>
                <br />
                <div class="form-group form-md-line-input row">
                    <label class="col-md-3 control-label">&nbsp;</label>
                    <div class="col-md-4">
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