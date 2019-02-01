<section id="content">
  <section class="hbox stretch">
 
<!-- .aside -->
<!--<aside>-->
<section class="vbox">
    <header class="header bg-white b-b b-light">
        <div class="pull-right" style="margin-top: 10px;">&nbsp;</div>
        <p class="pull-left"><?=lang('general_ledger_report')?> Report</p>
    </header>
    <section class="scrollable wrapper">
      <div class="row">
        <div class="col-lg-12">
          <div class="panel panel-primary">
            <div class="panel-body">
                
                <select id="creditor_list" panelHeight="auto" style="display:none;">
                	<option value="">All</option>
                    <?php      
                      if (!empty($creditors)) {
                        foreach ($creditors as $creditor) { 
                    ?>
                	       <option value="<?php echo $creditor->rowID; ?>"><?php echo $creditor->creditor_cd; ?>-<?php echo $creditor->creditor_name; ?></option>
                    <?php 
                        }
                      }
                    ?>
                </select>
                
                <select id="debtor_list" panelHeight="auto" style="display:none;">
                	<option value="">All</option>
                	<?php      
                      if (!empty($debtors)) {
                        foreach ($debtors as $debtor) { 
                    ?>
                	       <option value="<?php echo $debtor->rowID; ?>"><?php echo $debtor->type.$debtor->debtor_cd; ?>-<?php echo $debtor->debtor_name; ?></option>
                    <?php 
                        }
                      }
                    ?>
                </select>

                <?=form_open(base_url('general_ledger_report/print_report'),'autocomplete="off" id="form" name="form" class="form-horizontal" target="_blank"')?>
                <div class="form-group form-md-line-input row">
                    <label class="col-md-3 control-label">Date <span class="text-danger">*</span></label>
                    <div class="col-md-3">
                        <div class="input-group input-daterange">
                            <input type="text" name="start_date" id="start_month" class="form-control input-sm" placeholder="<?=lang('start_date')?>" value="<?=date('m-Y')?>">
                            <span class="input-group-addon">to</span>
                            <input type="text" name="end_date" id="end_month" class="form-control input-sm" placeholder="<?=lang('end_date')?>" value="<?=date('m-Y')?>">
                        </div>                    
                    </div>
                </div>
                <div class="form-group form-md-line-input row">
                    <label class="col-md-3 control-label">COA Code <span class="text-danger">*</span></label>
                    <div class="col-md-4">
                        <select class="form-control all_select2" name="coa_id" id="coa_id" >
                            <option value="All">All</option>
                        	<?php
                              if (!empty($coas)) {
                                foreach ($coas as $coa) { 
                            ?>
                        	       <option value="<?php echo $coa->rowID; ?>"><?php echo $coa->acc_cd; ?>-<?php echo $coa->acc_name; ?></option>
                            <?php 
                                }
                              }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="form-group form-md-line-input row">
                    <label class="col-md-3 control-label">Debitor/Creditor Type <span class="text-danger">*</span></label>
                    <div class="col-md-2">
                        <select class="form-control" name="debtor_creditor_type" id="debtor_creditor_type" onchange='change_report_debtor_creditor_type()'>
                            <option value="All">All</option>
                            <option value="D">Debitor</option>
                            <option value="C">Creditor</option>
                        </select>
                    </div>
                </div>
                <div class="form-group form-md-line-input row debtor_creditor_list" style="display: none;">
                    <label class="col-md-3 control-label">Debitor/Creditor Name <span class="text-danger">*</span></label>
                    <div class="col-md-4">
                        <select class="form-control all_select2" name="debtor_creditor_id" id="debtor_creditor_id"></select>
                    </div>
                </div>
                <div class="form-group form-md-line-input row">
                    <label class="col-md-3 control-label">Print Type <span class="text-danger">*</span></label>
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