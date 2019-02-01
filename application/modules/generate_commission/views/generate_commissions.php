<section id="content">
  <section class="hbox stretch">
 
<!-- .aside -->
<!--<aside>-->
<section class="vbox">
    <header class="header bg-white b-b b-light">
        <div class="pull-right" style="margin-top: 10px;">
            <a class="btn btn-sm btn-dark" href="<?=base_url()?>generate_commission"><i class="fa fa-arrow-left"></i> <?=lang('back')?></a>
        </div>
      <p class="pull-left"><?=lang('generate_commissions')?> (Comm)</p>
    </header>
    <section class="scrollable wrapper">
      <div class="row">
        <div class="col-lg-12">
          <div class="panel panel-primary">
            <div class="panel-heading">
                <div class="panel-title">Generate By Periode</div>
            </div>
            <div class="panel-body">
                <?=form_open('','autocomplete="off" id="form" class="form-horizontal"')?>
                <div class="form-group form-md-line-input row">
                    <label class="col-md-2 control-label">Until <?=lang('date')?><span class="text-danger">*</span></label>
                    <div class="col-md-3">
                        <input type="text" class="form-control input-sm pull-left tanggal_datetimepicker" value="<?=date('d-m-Y')?>" name="until_date" id="until_date" placeholder="dd-mm-yyyy" style="text-align: center;width:50%" required>
                        <button type="button" class="btn btn-sm btn-success" id="btngenerate" onclick="generate_commission()" style="margin-left:10px;"><i class="fa fa-refresh"></i> Generate</button>
                    </div>
                    <label class="col-md-1 control-label">Period<span class="text-danger">*</span></label>
                    <div class="col-md-1">
                        <select class="form-control input-sm" name="period" id="period" required>
                            <?php
                                for($i=1;$i<=24;$i++){
                                    echo '<option value="'.$i.'">'.$i.'</option>';
                                }
                            ?>
                        </select>
                    </div>
                    <div class="col-md-5 text-right" id="save_cancel_loan" style="display: none;">
                        <button type="button" class="btn btn-sm green" id="btnSaveLoan" onclick="save_loan()"><i class="fa fa-save"></i> Save</button>
                        <button type="button" class="btn btn-sm yellow" id="btnCancelLoan" onclick="cancel_loan()"><i class="fa fa-times"></i> Cancel</button>
                    </div>
                </div>
                
                <p>&nbsp;</p>
                
                <div id="data_commission">&nbsp;</div>
                
                <?=form_close()?>
            </div>
          </div>            
        </div>
      </div>
    </section>

</section>
  <!--</aside>-->
  
<!-- Bootstrap modal -->
<div class="modal fade" id="modal_select_loan" role="dialog">
  <div class="modal-dialog" style="width: 80%;">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h3 class="modal-title">Select Loan</h3>
      </div>
      <div class="modal-body form">
        <?=form_open('','autocomplete="off" id="form_loan" class="form-horizontal"')?>
            <input type="hidden" name="row" id="row" />
            <input type="hidden" name="loan_debtorID" id="loan_debtorID" />
            <input type="hidden" name="max_loan_debtor" id="max_loan_debtor" />
            <div class="col-md-6 text-right">&nbsp;</div>
            <div class="col-md-6 text-right">
                <div class="row">
                    <label class="col-md-6">Max loan (Rp)</label>
                    <label class="col-md-6"><b><span id="nilai_max_loan">0</span></b></label>
                </div>
                <div class="row" style="color:#c00">
                    <label class="col-md-6">Loan (Rp)</label>
                    <label class="col-md-6"><b><span id="nilai_loan">0</span></b></label>
                </div>
            </div>
            <p>&nbsp;</p>
            <div id="data_loan">&nbsp;</div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" id="btnGetLoan" onclick="get_loan()" class="btn green">Select</button>
        <button type="button" class="btn red" data-dismiss="modal">Cancel</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<div class="modal fade" id="modal_detail_commission" role="dialog">
  <div class="modal-dialog" style="width: 85%;">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h3 class="modal-title">Detail Commission</h3>
      </div>
      <div class="modal-body form">
        <table id="tbl-detail-commission" class="table table-responsive table-striped table-condensed" width="100%"></table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn red" data-dismiss="modal">Close</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

</section>
<a href="#" class="hide nav-off-screen-block" data-toggle="class:nav-off-screen, open" data-target="#nav,html"></a>
</section>