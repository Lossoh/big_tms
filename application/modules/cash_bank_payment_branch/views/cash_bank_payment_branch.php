<section id="content">
  <section class="hbox stretch">

      <section class="vbox">
        <header class="header bg-white b-b b-light">
            <div class="row" style="padding-top: 10px;">
                <div class="col-md-6" style="padding-top: 5px;">
                    <p>Cash Bank Payment (Branch)</p>              
                </div>     
                <div class="col-md-6 text-right">
                   <!--  <a href="#aside" data-toggle="class:show" id="btnFilter" onclick="showFilterText()" style="color: #46b8da;">Show Filter</a> &nbsp; -->
                    <?php
                    if($this->user_profile->get_user_access('Created') == 1){
                    ?>
                        <a  class="btn btn-sm green" onclick="add_cash_bank_payment()"><i class="fa fa-plus"></i> Add Cash Bank Payment</a>
                    <?php
                    }
                    if($this->user_profile->get_user_access('PrintLimited') == 1 || $this->user_profile->get_user_access('PrintUnlimited') == 1 || 
                        $this->user_profile->get_user_access('PrintOne') == 1 || $this->user_profile->get_user_access('PrintTwo') == 1){
                    ?>
                        <a  class="btn btn-sm red" onclick="cash_bank_payment_pdf_branch()"><i class="fa fa-file-pdf-o"></i> Print PDF</a>
                        <a  class="btn btn-sm btn-success" onclick="cash_bank_payment_excel_branch()"><i class="fa fa-file-excel-o"></i> Print Excel</a>
                    <?php
                    }
                    ?>
                </div>
            </div>
        </header>
        <div class="clearfix"></div> 
        <section class="scrollable wrapper">
          <div class="row">
            <div class="col-lg-12">
              <section class="panel panel-default">
                <div class="table-responsive"><?php echo validation_errors(); ?>

                  <div class="input-group input-daterange pull-right" style="position: relative;top:10px;right: 14px; display: inline-flex;">
                      <font style="margin: 5px 10px 0px 0px">Filter:</font>
                      <input type="text" name="start_date" id="start_date" class="form-control input-sm start_date" placeholder="<?=lang('start_date')?>" value="<?=date('d-m-Y', strtotime($start_date))?>" style="text-align: center;">
                      <span class="input-group-addon" style="width: 50px;">to</span>
                      <input type="text" name="end_date" id="end_date" class="form-control input-sm end_date" placeholder="<?=lang('end_date')?>" value="<?=date('d-m-Y', strtotime($end_date))?>" style="text-align: center;">
                  </div>
                  <br><br>
                  
                  <table id="tbl-cashbank-branch" class="table table-striped table-hover b-t b-light text-sm">
                    <thead>
                      <tr>
                        <th>Options</th>
                        <th>Payment/Receive No</th>
                        <th>Payment/Receive Date</th>
                        <th>Type</th>
                        <th>Cash/Bank</th>
                        <th>Reference No</th>
                        <th>Remark</th>
                        <th>Payment To/Receive From</th>
                        <th>Amount (Rp)</th>

                        <!-- For Filter by Ajax Server Side -->
                        <th>start_date</th>
                        <th>end_date</th>
                      </tr> 
                    </thead>
                  </table>
              </div>
            </section>            
          </div>
        </div>
      </section>

    </section>


<select id="cb_payment" panelHeight="auto" style="display:none;">
    <option value="cash">Cash</option>
</select>

<select id="cb_pay_to" panelHeight="auto" style="display:none;">
	<?php
      $get_dep = $this->cash_bank_payment_branch_model->get_by_id_table('sa_dep',$this->session->userdata('dep_rowID'));  
      
      if (!empty($coas)) {
        foreach ($coas as $coa) { 
            if($coa->rowID == $get_dep->cash_gl_rowID){
    ?>
	       <option value="<?php echo $coa->rowID; ?>"><?php echo $coa->acc_cd; ?>-<?php echo $coa->acc_name; ?></option>
    <?php 
            }
        }
      }
    ?>
</select>

  <!-- Bootstrap modal -->
  <div class="modal fade" id="modal_form" role="dialog" style="overflow-y: scroll;">
  <div class="modal-dialog" style="width:900px;">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h3 class="modal-title">Cash and Bank (C & B) <span class="type">Payment</span></h3>
      </div>
      <div class="modal-body form">
        <?=form_open('','autocomplete="off" id="form" class="form-horizontal"')?>
        <input type="hidden" name="rowID" value="">
        <input type="hidden" id="user_created" name="user_created"/>
        <input type="hidden" id="date_created" name="date_created"/>
        <input type="hidden" id="time_created" name="time_created"/>
        <div class="form-body">
            <div class="row">
 					  <div class="col-xs-6">
						<div class="group">	
                            <div class="row inline-fields form-group form-md-line-input">
								<div class="col-md-4">Payment/Receive<span class="text-danger">*</span></div>
								<div class="col-md-1">:</div>
								<div class="col-md-6"><p>
									<select name="payment_type" id="payment_type" class="form-control">
                        				<option value="P">Payment</option>
                        				<option value="R">Receive</option>
                        			</select>
								</p></div>
							</div>
							<div class="row inline-fields form-group form-md-line-input" id="cash_bank_account" style="display: none;">
								<div class="col-md-4">Cash & Bank Account<span class="text-danger">*</span></div>
								<div class="col-md-1">:</div>
								<div class="col-md-6"><p>
                                    <select name="cb_acc" id="cb_acc" class="form-control" required>
                                          <?php
                                          $get_dep = $this->cash_bank_payment_branch_model->get_by_id_table('sa_dep',$this->session->userdata('dep_rowID'));  
      
                                          if (!empty($coas)) {
                                            foreach ($coas as $coa) { 
                                                if($coa->rowID == $get_dep->cash_gl_rowID){
                                          ?>
                    					  <option value="<?php echo $coa->rowID; ?>"><?php echo $coa->acc_cd; ?>-<?php echo $coa->acc_name; ?></option>
                    					  
                    			         <?php 
                                                }
                                            }
                                          }
                                         ?>
   			                        </select>
							     </p></div>
							</div>	
							<div class="row inline-fields form-group form-md-line-input">
								<div class="col-md-4"><span class="type">Payment</span> Type<span class="text-danger">*</span></div>
								<div class="col-md-1">:</div>
								<div class="col-md-6"><p>
									<select name="cb_trx_type" class="form-control" id="cb_trx_type" required >
                        				<option value=""><?=lang('select_your_option')?></option>
                        				<option value="general">General</option>
                                        <option value="cash_advance">Cash Advance</option>
                        			</select>
                                    <input type="hidden" name="advance_invoice_type" id="advance_invoice_type" value="" />
								</p></div>
							</div>		
                            <div class="row inline-fields form-group form-md-line-input" id="field_employee_type">
								<div class="col-md-4">Employee Type<span class="text-danger">*</span></div>
								<div class="col-md-1">:</div>
								<div class="col-md-6"><p>
                                    <select name="employee_type" id="employee_type_cb" class="form-control" required="" onchange="change_employee_type_cb()" >
                                        <option value="O">Other</option>
                                        <option value="D">Driver</option>
                                        <option value="E">Employee</option>
                                    </select>
								</p></div>
							</div>	
							<div class="row inline-fields form-group form-md-line-input">
								<div class="col-md-4"><span class="type">Payment</span> <span class="to_from">To</span><span class="text-danger">*</span></div>
								<div class="col-md-1">:</div>
								<div class="col-md-6"><p>
                                    <select name="debtor_creditor" id="debtor_creditor" class="form-control" required="" >
                                        <option value=""><?=lang('select_your_option')?></option>
                                    </select>
									<input type="text" name="debtor_creditor_note" id="debtor_creditor_note" class="input-sm form-control" style="text-align: left;display:none" placeholder="Debtor/Creditor Note" value="" />
								</p></div>
							</div>
						</div>
					</div>
                    
			         <div class="col-xs-6">
						<div class="group">
                            <div class="row inline-fields form-group form-md-line-input">
								<div class="col-md-4"><span class="type">Payment</span> Date<span class="text-danger">*</span></div>
								<div class="col-md-1">:</div>
								<div class="col-md-6">
                                    <p>
    									<input class="input-sm input-s form-control" size="10" type="text" value="<?=date('d-m-Y')?>" id="cb_payment_date" name="cb_payment_date" readonly="" required="" />
    									<input class="input-sm input-s form-control" size="10" type="text" value="<?=date('d-m-Y')?>" id="cb_payment_date_tmp" name="cb_payment_date_tmp" readonly="" /> 
                                        <input type="hidden" class="input-sm form-control" value="" name="cb_payment_no" id="cb_payment_no" readonly="">
                                        <input type="hidden" id="prefix" name="prefix"/>
                                        <input type="hidden" id="year" name="year"/>
                                        <input type="hidden" id="month" name="month"/>
                                        <input type="hidden" id="code" name="code"/>
 								    </p>
                                </div>
							</div>	
							<div class="row inline-fields form-group form-md-line-input">
								<div class="col-md-4">Amount<span class="text-danger">*</span></div>
								<div class="col-md-1">:</div>
								<div class="col-md-6"><p>
									<input type="text" name="cb_amount" id="cb_amount" class="input-sm form-control currency" Readonly style="text-align: right;" value="0" required>
								</p>
                                </div>
							</div>	
							<div class="row inline-fields form-group form-md-line-input">
								<div class="col-md-4">Remark<span class="text-danger">*</span></div>
								<div class="col-md-1">:</div>
								<div class="col-md-6"><p>										
                                    <textarea class="form-control" id="cb_remark" name="cb_remark" maxlength="200" rows="2" onkeyup="replaceQuotes(this)"></textarea>
								</p></div>
							</div>
						</div>
					</div>
                </div>
             </div>   
             <p>&nbsp;</p>
              <div class="bs-example"> 
                    <ul class="nav nav-tabs">
                        <li class="active" id="choose_payment"><a data-toggle="tab" href="#payment_detail"><span class="type">Payment</span> Details</a></li>
                        <li id="choose_detail"><a data-toggle="tab" id="choose_cb_detail" href="#cb_detail">Cash & Bank Details</a></li>
                        <li id="choose_deduction"><a data-toggle="tab" href="#deduction_detail">Deduction Details</a></li>
                    </ul>
                    <div class="tab-content">
                        <div id="payment_detail" class="tab-pane fade in active">
                            <br />
                            <table class="table table-responsive" cellspacing="0" cellpadding="3" id="detail_cb_payment">
                                <tr>
                                    <th class="genap" width="5%">
                                        <input id="tamdet" title="Tambah Baris" type="button" onclick="addRow_cb_detail_payment()" value="&nbsp;" style="height:30px;width:30px;border;background-image:url('<?= base_url();?>resource/images/plus.png');background-repeat:no-repeat;" />
                                    </th>
                                    <th class="ganjil" width="8%">No</th>
                                    <th class="genap" width="21%">Reference No</th>
                                    <th class="ganjil" width="21%">Description</th>
                                    <th class="genap" width="20%">Reference Amount</th>
                                    <th class="ganjil" width="20%">Amount</th>
                                </tr>
                            </table>
                            <table class="table table-responsive" cellspacing="0" cellpadding="3">
                                <tr height="25">
                					<td align="right" >Total&nbsp&nbsp</td>
                					<td align="left" width="20%"><input type="text"  name="TotalPayment" id="TotalPayment" readonly="" class="form-control" style='text-align:right;height:30px;width:170px;background-color:white;border:solid 1px #ccc;'   /></td>
                				</tr>
                            </table>
                        
                        </div>
                        
                        <div id="cb_detail" class="tab-pane fade">
                            <br />
                            <table class="table table-responsive" cellspacing="0" cellpadding="3" id="detail_cb_giro">
                                <tr>
                                    <th class="genap" width="5%">
                                        <input id="addDetailGiro" title="Tambah Baris" type="button" onclick="addRow_cb_detail_giro()" value="&nbsp;" style="height:30px;width:30px;border;background-image:url('<?= base_url();?>resource/images/plus.png');background-repeat:no-repeat;" />
                                    </th>
                                    <th class="ganjil" width="15%"><span class="type">Payment</span> Method</th>
                                    <th class="genap" width="25%"><span class="to_from_cash_bank">From</span> Cash bank</th>
                                    <th class="ganjil" width="20%">Cheque/Giro No</th>
                                    <th class="genap" width="15%">Date</th>
                                    <th class="ganjil" width="20%">Amount</th>
                                </tr>
                              </table>
                              <table class="table table-responsive" cellpadding="3" cellspacing="0" >
                                <tr height="25">
                					<td align="right">Total&nbsp&nbsp</td>
                					<td align="left" width="20%"><input type="text"  name="TotalGiro" id="TotalGiro" readonly="" class="form-control" style='text-align:right;height:30px;width:170px;background-color:white;border:solid 1px #ccc;'   /></td>
                				</tr>
                              </table>
                        </div>
                        <div id="deduction_detail" class="tab-pane fade">
                            <br />
                        </div>
                    </div>
              </div>         
              
        </form>
          </div>
          <div class="modal-footer">
            <button type="button" id="btnSave" onclick="simpan_cash_bank_payment()" class="btn green">Save</button>
            <button type="button" class="btn red" data-dismiss="modal">Cancel</button>
          </div>
        </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
    
    
  <!-- Modal -->
  <div class="modal fade" id="modalAdvanceInvoice" role="dialog" style="overflow-y: scroll;">
    <div class="modal-dialog" style="width:1000px;">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Select No Advance/Invoice</h4>
        </div>
        <div class="modal-body">
          <section class="scrollable wrapper">
              <div class="row">
                <div class="col-lg-12">
                  <input type="hidden" name="row_payment" id="row_payment" />
                  <section class="panel panel-default">
                    <div class="table-responsive" id="data_advance_invoice">Data not available</div>
                  </section>            
                </div>
              </div>
          </section>
        
        </div>
        <div class="modal-footer">
            <button type="button" class="btn red" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>    
  
</section>
<a href="#" class="hide nav-off-screen-block" data-toggle="class:nav-off-screen, open" data-target="#nav,html"></a>
</section>

<!-- /.aside -->
<aside class="aside-xxl bg-white b-l hide" id="aside">
    <section class="vbox">
		<section class="scrollable wrapper">
            <?=form_open(base_url().'cash_bank_payment_branch/set_filter','autocomplete="off" id="form_period" class="form-horizontal"')?>                    
            <div class="row">
                <div class="col-md-9">
                    <div class="input-group input-daterange" style="position: relative;display: inline-flex;">
                        <input type="text" name="start_date" id="start_date" class="form-control input-sm tanggal_datetimepicker" placeholder="<?=lang('start_date')?>" value="<?=date('d-m-Y', strtotime($start_date))?>">
                        <span class="input-group-addon" style="width: 50px;">to</span>
                        <input type="text" name="end_date" id="end_date" class="form-control input-sm tanggal_datetimepicker" placeholder="<?=lang('end_date')?>" value="<?=date('d-m-Y', strtotime($end_date))?>">
                    </div>
                </div>
                <div class="col-md-3">
                    <button type="submit" class="btn btn-sm btn-info"><i class="fa fa-filter"></i> Filter</button>
                </div>
            </div>
            <?=form_close()?>
        </section>
	</section>   
</aside>
<!-- /.aside -->
<script type="text/javascript">
$(function() {
    $('.start_date, .end_date').datetimepicker({
        format: 'DD-MM-YYYY',
        showTodayButton:true
    });

    var table_cash_bank_payment = $('#tbl-cashbank-branch').DataTable({
        processing: true,
        serverSide: true,
        sDom: "<'row'<'col-sm-6'l><'col-sm-6'f>r>t<'row'<'col-sm-6'i><'col-sm-6'p>>",
        sPaginationType: "full_numbers",
        ajax: {
            url: "<?= base_url() ?>cash_bank_payment_branch/fetch_data",
            type: 'POST',
            data: {'<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>' }
        },
        columns: [
            {
                "data": "dropdown_option", "orderable": false, "searchable": false
            },
            {
                "data": "trx_no"
            },
            {
                "data": "trx_date"
            },
            {
                "data": "payment_type"
            },
            {
                "data": "cash_bank"
            },
            {
                "data": "advance_invoice_trx_no"
            },
            {
                "data": "descs"
            },
            {
                "data": "nama_pay_to"
            },
            {
                "data": "trx_amt", "className": "text-right"
            },
            {
                "data": "start_date", "bVisible" : false
            },
            {
                "data": "end_date", "bVisible" : false
            }
        ],
        order: [0, "DESC"],
        iDisplayLength: 25
    });
    
    $('.dataTables_filter input').unbind().keyup(function() {
        var value = $(this).val();
        if (value.length > 2) {
            table_cash_bank_payment.search(value).draw();
        } 
        if (value.length == 0) {
            table_cash_bank_payment.search(value).draw();
        } 
    });
     $(".start_date").on("dp.change", function (e) {
        var start_date = $("#start_date").val();
        table_cash_bank_payment.columns(9).search(start_date).draw();
        $("#start_date").blur();
    });
    $(".end_date").on("dp.change", function (e) {
        var end_date = $("#end_date").val();
        table_cash_bank_payment.columns(10).search(end_date).draw();
        $("#end_date").blur();
    });
    
});
</script>