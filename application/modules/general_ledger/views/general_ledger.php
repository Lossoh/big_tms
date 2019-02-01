<section id="content">
  <section class="hbox stretch">

      <section class="vbox">
        <header class="header bg-white b-b b-light">
            <div class="row" style="padding-top: 10px;">
                <div class="col-md-6" style="padding-top: 5px;">
                    <p><?=lang('general_ledger')?></p>              
                </div>     
                <div class="col-md-6 text-right">
                   <!--  <a href="#aside" data-toggle="class:show" id="btnFilter" onclick="showFilterText()" style="color: #46b8da;">Show Filter</a> &nbsp; -->
                    <?php
                    if($this->user_profile->get_user_access('Created') == 1){
                    ?>
                        <a  class="btn btn-sm green" onclick="add_general_ledger()"><i class="fa fa-plus"></i> Add <?=lang('general_ledger')?></a>
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
                <ul class="nav nav-tabs" role="tablist">
                    <li role="presentation" class="active"><a href="#gl_active" aria-controls="gl_active" role="tab" data-toggle="tab">ACTIVE <span class="badge" id="badge-active"></span></a></li>
                    <li role="presentation"><a href="#gl_not_active" aria-controls="gl_not_active" role="tab" data-toggle="tab">NOT ACTIVE <span class="badge" id="badge-not-active"></span></a></li>
                    
                    <div class="input-group input-daterange pull-right" style="position: relative;top:0px;right: 14px; display: inline-flex;">
                        <font style="margin: 5px 10px 0px 0px">Filter:</font>
                        <input type="text" name="start_date" id="start_date" class="form-control input-sm start_date" placeholder="<?=lang('start_date')?>" value="<?=date('d-m-Y', strtotime($start_date))?>" style="text-align: center;">
                        <span class="input-group-addon" style="width: 50px;">to</span>
                        <input type="text" name="end_date" id="end_date" class="form-control input-sm end_date" placeholder="<?=lang('end_date')?>" value="<?=date('d-m-Y', strtotime($end_date))?>" style="text-align: center;">
                    </div>
                </ul>
                <div class="tab-content">
                    <div role="tabpanel" class="tab-pane fade in active" id="gl_active">
                          <section class="panel panel-default">
                            <div class="table-responsive"><?php echo validation_errors(); ?>                   
                              <table id="tbl-general-ledger-active" class="table table-striped table-hover b-t b-light text-sm">
                                <thead>
                                  <tr>
                                    <th>Options</th>
                                    <th>Journal No</th>
                                    <th>Journal Date</th>
                                    <th>Journal Type</th>
                                    <th>Reference No</th>
                                    <th>Description</th>
                                    <th>Amount</th>
            
                                    <!-- For Filter -->
                                    <th>start_date</th>
                                    <th>end_date</th>
                                  </tr> 
                                </thead>
                              </table>
                          </div>
                        </section>            
                    </div>
                    <div role="tabpanel" class="tab-pane fade" id="gl_not_active">
                          <section class="panel panel-default">
                            <div class="table-responsive"><?php echo validation_errors(); ?>                   
                              <table id="tbl-general-ledger-not-active" class="table table-striped table-hover b-t b-light text-sm">
                                <thead>
                                  <tr>
                                    <th>No</th>
                                    <th>Journal No</th>
                                    <th>Journal Date</th>
                                    <th>Journal Type</th>
                                    <th>Reference No</th>
                                    <th>Description</th>
                                    <th>Amount</th>
            
                                    <!-- For Filter -->
                                    <th>start_date</th>
                                    <th>end_date</th>
                                  </tr> 
                                </thead>
                              </table>
                          </div>
                        </section>            
                    </div>
                </div>
          </div>
        </div>
      </section>

    </section>

<select id="cash_bank_list" panelHeight="auto" style="display:none;">
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

<select id="creditor_list" panelHeight="auto" style="display:none;">
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

  <!-- Bootstrap modal -->
  <div class="modal fade" id="modal_form" role="dialog" style="overflow-y: scroll;">
  <div class="modal-dialog" style="width:93%;">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h3 class="modal-title"><?=lang('new_general_ledger')?></h3>
      </div>
      <div class="modal-body form">
        <?=form_open('','autocomplete="off" id="form" class="form-horizontal"')?>
        <input type="hidden" id="rowID" name="rowID" value="">
        <input type="hidden" id="verified_status" name="verified_status" value="">
        <input type="hidden" id="user_verified" name="user_verified"/>
        <input type="hidden" id="date_verified" name="date_verified"/>
        <input type="hidden" id="time_verified" name="time_verified"/>
        <input type="hidden" id="journal_no" name="journal_no" value="">
        <input type="hidden" id="user_created" name="user_created"/>
        <input type="hidden" id="date_created" name="date_created"/>
        <input type="hidden" id="time_created" name="time_created"/>
        <div class="form-body">
            <div class="row">
 					  <div class="col-xs-6">
						<div class="group">	
                            <div class="row inline-fields form-group form-md-line-input">
								<div class="col-md-3">GL Date<span class="text-danger">*</span></div>
								<div class="col-md-1">:</div>
								<div class="col-md-3">
                                    <p>
    									<input type="text" class="form-control input-sm text-center tanggal_datetimepicker" size="10" value="<?=date('d-m-Y')?>" id="gl_date" name="gl_date" placeholder="dd-mm-YYYY" required="" />
 								    </p>
                                </div>
							</div>
                            <div class="row inline-fields form-group form-md-line-input">
								<div class="col-md-3">GL Type<span class="text-danger">*</span></div>
								<div class="col-md-1">:</div>
								<div class="col-md-6"><p>
									<select name="gl_type" id="gl_type" class="form-control" onchange="change_gl_type()">
                        				<option value=""><?=lang('select_your_option')?></option>                                    
                        				<option value="general">General</option>
                        				<option value="cash advance">Cash Advance</option>
                        				<option value="realization">Realization</option>
                        				<option value="refund">Refund</option>
                                        <option value="invoice">Invoice</option>
                                        <option value="account receivable">Account Receivable</option>
                                        <option value="account payable">Account Payable</option>
                                        <option value="kontra bon">Kontra Bon</option>
                                        <option value="advance">Advance</option>
                                        <option value="reimburse">Reimburse</option>
                                        <option value="deposit">Deposit</option>
                        				<option value="commission">Commission</option>
                        				<option value="cash in">Cash In</option>                                        
                        				<option value="cash out">Cash Out</option>                                        
                        				<option value="bank in">Bank In</option>                                        
                        				<option value="bank out">Bank Out</option>                                        
                                        <option value="outstanding bank in">Outstanding Bank In</option>                                        
                        				<option value="outstanding bank out">Outstanding Bank Out</option>                                        
                                    </select>
								</p></div>
							</div>	
							<div class="row inline-fields form-group form-md-line-input">
								<div class="col-md-3">Reference No<span class="text-danger">*</span></div>
								<div class="col-md-1">:</div>
								<div class="col-md-5">
									<input type="text" name="reference_no" id="reference_no" class="input-sm form-control" placeholder="Reference No" value="" maxlength="25" />
                                </div>
								<div class="col-md-2">
								    <button type="button" class="btn btn-sm btn-success" title="Search" onclick="search_reference()"><i class="fa fa-search"></i></button>
                                </div>
							</div>		
						</div>
			         </div>
                     <div class="col-xs-1">&nbsp;</div>
			         <div class="col-xs-5">
						<div class="group">	
							<div class="row inline-fields form-group form-md-line-input ap_type_field" style="display: none;">
    							<div class="col-md-3">KB Type<span class="text-danger">*</span></div>
    							<div class="col-md-1">:</div>
    							<div class="col-md-5"><p>
    								<select class="form-control" name="ap_type" id="ap_type" placeholder="<?=lang('select')?>" >
                                      <option value="">- Select Type -</option>
                                      <?php if (!empty($creditor_types)) {
    								  foreach ($creditor_types as $creditor_type) { ?>
    								  <option value="<?php echo $creditor_type->rowID;?>"><?php echo $creditor_type->type_cd.' - '.$creditor_type->descs;?></option>
    								  <?php }} ?>
    			                    </select> 
    							</p></div>
    						</div>
                            <div class="row inline-fields form-group form-md-line-input">
								<div class="col-md-3">Remark<span class="text-danger">*</span></div>
								<div class="col-md-1">:</div>
								<div class="col-md-8"><p>										
                                    <textarea class="form-control gl_remark" id="gl_remark" name="gl_remark" maxlength="255" rows="2" onkeyup="replaceQuotes(this)" placeholder="Remark" ></textarea>
								</p></div>
                                <input type="hidden" name="reference_date" id="reference_date" value="" />
                                <input type="hidden" name="reference_debtor_creditor_id" id="reference_debtor_creditor_id" value="" />
							</div>
                            <div class="row inline-fields form-group form-md-line-input">
								<div class="col-md-3">Total<span class="text-danger">*</span></div>
								<div class="col-md-1">:</div>
								<div class="col-md-4"><p>									
                                    <input type="text" name="trx_amt" id="trx_amt" class="form-control text-right currency" value="0" />
								</p></div>
							</div>
                            <div class="row inline-fields form-group form-md-line-input verify_status">
								<div class="col-md-3">Verify <span class="verified_second"></span></div>
								<div class="col-md-1">:</div>
								<div class="col-md-4">
									<label class="switch">								
    									<input type="checkbox" class="form-control input-sm" id="verified" name="verified" value="1" onclick="click_verify_gl()" />
    									<span></span>
                                    </label>
                                </div>
							</div>
						</div>
					</div>
                </div>
             </div>   
             <p>&nbsp;</p>
             <input  type="hidden" class="form-control" id="total_ap" name="total_ap"  value="0">
             <input  type="hidden" class="form-control" id="base_amt" name="base_amt"  value="0">             
             <input  type="hidden" class="form-control" id="total_diff" name="total_diff"  value="0">             
             
             <input type="hidden" class="form-control" id="do_jo_no" name="do_jo_no" />
             <input  type="hidden" class="form-control" id="jo_year" name="jo_year"  value="">
			 <input  type="hidden" class="form-control" id="jo_month" name="jo_month"  value="">
		 	 <input  type="hidden" class="form-control" id="jo_code" name="jo_code"  value="">
			 <input  type="hidden" class="form-control" id="jo_fare_trip_id" name="jo_fare_trip_id"  value="">
			 <input  type="hidden" class="form-control" id="jo_type" name="jo_type"  value="">
			 <input  type="hidden" class="form-control" id="price_amount" name="price_amount"  value="">
			 <input  type="hidden" class="form-control" id="wholesale" name="wholesale"  value="">
			 <input  type="hidden" class="form-control" id="price_20ft" name="price_20ft"  value="">
			 <input  type="hidden" class="form-control" id="price_40ft" name="price_40ft"  value="">
			 <input  type="hidden" class="form-control" id="price_45ft" name="price_45ft"  value="">
             
             <ul class="nav nav-tabs" role="tablist">
                <li role="presentation" class="active"><a href="#gl_details" aria-controls="gl_details" role="tab" data-toggle="tab">DETAILS </a></li>
                <li role="presentation" class="general_type" style="display: none;"><a href="#gl_documents" aria-controls="gl_documents" role="tab" data-toggle="tab">DOCUMENTS </a></li>
             </ul>
             <div class="tab-content">
                <div role="tabpanel" class="tab-pane fade in active" id="gl_details">
                    <br />
                    <div class="bs-example">
                        <i>*) <b>D</b> : Debitor &nbsp; | &nbsp; <b>C</b> : Creditor</i>
                        <br /><br />
                            <table class="table table-responsive" cellspacing="0" cellpadding="3" id="detail_gl">
                                <tr valign="middle">
                                    <th width="5%">
                                        <input id="tamdet" title="Tambah Baris" type="button" onclick="add_gl_detail()" value="&nbsp;" style="height:30px;width:30px;border;background-image:url('<?= base_url();?>resource/images/plus.png');background-repeat:no-repeat;" />
                                    </th>
                                    <th width="17%">Cash Bank</th>
                                    <th width="9%">D/C Type</th>
                                    <th width="18%">D/C Name</th>
                                    <th width="21%">Description</th>
                                    <th width="15%">Debit</th>
                                    <th width="15%">Credit</th>
                                </tr>
                            </table>
                            <table class="table table-responsive" cellspacing="0" cellpadding="3">
                                <tr height="25">
                					<td align="right" width="80%">Total</td>
                					<td align="left" width="10%">
                                        <input type="text" name="total_debit" id="total_debit" readonly="" class="form-control" value="0" style='text-align:right;height:30px;width:170px;background-color:white;border:solid 1px #ccc;' />
                                    </td>
                                    <td align="left" width="10%">
                                        <input type="text" name="total_credit" id="total_credit" readonly="" class="form-control" value="0" style='text-align:right;height:30px;width:170px;background-color:white;border:solid 1px #ccc;' />
                                    </td>
                				</tr>
                            </table>
                      </div>         
                </div>
                <div role="tabpanel" class="tab-pane fade general_type" style="display: none;" id="gl_documents">
                    <br />
                    <div class="table-responsive"> 
                        <table class="table table-responsive table-striped table-condensed" id="detail_DO">
                            <tr>
                                <th style="width: 5%;">
                                    <input id="tamdet" title="Tambah Baris" type="button" onclick="addNewRow_DeliveryOrder_AP()" value="&nbsp;" style="height:30px;width:30px;border;background-image:url('<?= base_url();?>resource/images/plus.png');background-repeat:no-repeat;" />
                                </th>
                                <th><?=lang('job_order_no')?></th>
                                <th>Container Size</th>
                                <th>Container No</th>
                                <th>Police No</th>
                                <th style="width: 15%;">DO No</th>
                                <th>DO Date</th>
                                <th><?=lang('qty_delivery')?></th>
                                <th><?=lang('receipt_date')?></th>
                                <th><?=lang('qty_receipt')?></th>
                                <th>Amount KB</th>
                            </tr>
                        </table>
                    </div>
                </div>
             </div>
             
          <?=form_close()?>
          </div>
          <div class="modal-footer">
            <button type="button" id="btnSave" onclick="save_general_ledger()" class="btn green">Save</button>
            <button type="button" id="btnVerify" onclick="show_modal_gl_verify()" class="btn green">Verify</button>
            <button type="button" class="btn red" data-dismiss="modal">Cancel</button>
          </div>
        </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
    
    <!-- Modal Verifikasi -->
    <div class="modal fade" id="modal_verifikasi" role="dialog">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h3 class="modal-title"><?=lang('verification')?></h3>
          </div>
          <div class="modal-body form">
            <?=form_open('','autocomplete="off" id="form_verify" class="form-horizontal"')?>
		          <input type="hidden" id="verified_status_second" name="verified_status_second" value="">
                  <div class="row"> 
					<div class="col-xs-12">
						<div class="form-group form-md-line-input">
							<div class="col-md-4"><?=lang('your_password')?> <span class="text-danger">*</span></div>
							<div class="col-md-1">:</div>
							<div class="col-md-7">
                                <input type="hidden" class="form-control" id="queue_id_verify" name="queue_id_verify" required >										
								<input type="password" class="form-control" id="password" name="password" required="" />
							</div>
                        </div>
                    </div>
                </div>
            <?=form_close()?>
          </div>
          <div class="modal-footer">
            <button type="button" onclick="gl_verify_password()" class="btn green"><?=lang('verify')?></button>
            <button type="button" class="btn red" data-dismiss="modal">Cancel</button>
          </div>
        </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
    
  <!-- Modal -->
  <div class="modal fade" id="modalReference" role="dialog" style="overflow-y: scroll;">
    <div class="modal-dialog" style="width:90%;">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title-reference">Select Reference No</h4>
        </div>
        <div class="modal-body">
          <section class="scrollable wrapper">
              <div class="row">
                <div class="col-lg-12">
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
      
    <!-- Modal JO-->
      <div class="modal fade" id="joModal" role="dialog">
        <div class="modal-dialog" style="width:80%;">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              <h4 class="modal-title modal-job-title">Job Order List</h4>
            </div>
            <div class="modal-body">
              <!--<section class="scrollable wrapper">-->
              <div class="row">
               <input type="hidden" id="tag" value="">
                <div class="col-lg-12">
                  <section class="panel panel-default">
                    <div class="table-responsive">
                      <table id="tbl-joborder" class="table table-responsive table-striped">
                        <thead>
                          <tr>
                            <th><?=lang('job_order_no')?></th>
    						<th><?=lang('job_order_debtor')?></th>
                            <th><?=lang('job_order_po_spk_no')?></th>
                            <th>From - To</th>
                            <th>JO Type</th>
                            <th>Price Type</th>
                            <th>Item</th>
                            <th><?=lang('port')?></th>
                            <th><?=lang('vessel_name')?> </th>
    						<th><?=lang('job_order_date')?></th>
                            <th><?=lang('job_order_so_no')?></th>
                            <th><?=lang('vessel_no')?> </th>
                            <th>Year</th>
                            <th>month</th>
                            <th>code</th>
                            <th>fare trip id</th>
                            <th>from id</th>
                            <th>to id</th>
                            <th>Jo Type</th>
                            <th>Price Amount</th>
                            <th>Price Type</th>
                            <th>Price 20 Feet</th>
                            <th>Price 40 Feet</th>
                            <th>Price 45 Feet</th>
                          </tr> 
    					</thead>
    					<tbody>
                          <?php
                          if (!empty($cash_advance_jo)) {
                          foreach ($cash_advance_jo as $rs) { 
                            if($rs->jo_type == '1')
                                $jo_type = "BULK";
                            else if($rs->jo_type == '2')
                                $jo_type = "CONTAINER";
                            else
                                $jo_type = "OTHERS";  
                                
                          ?>
                          <tr style="cursor: pointer;">
    						<td><?=$rs->jo_no?></td>
    						<td><?=$rs->debtor?></td>
                            <td><?=$rs->po_spk_no?></td>
                            <td><?=ucwords(strtolower($rs->from_name)).' - '.ucwords(strtolower($rs->to_name))?></td>
                            <td><?=ucwords(strtolower($jo_type))?></td>
                            <td><?=$rs->wholesale == 1 ? 'All In' : 'Pcs'?></td>
                            <td><?=ucwords(strtolower($rs->item_name))?></td>
                            <td><?=ucwords(strtolower($rs->port_name))?></td>
                            <td><?=ucwords(strtolower($rs->vessel_name))?></td>
    						<td><?=date("d F Y",strtotime($rs->jo_date))?></td>
                            <td><?=$rs->so_no?></td>
                            <td><?=$rs->vessel_no?></td>
                            <td><?=$rs->year?></td>
                            <td><?=$rs->month?></td>
                            <td><?=$rs->code?></td>
                            <td><?=$rs->fare_trip_rowID?></td>
                            <td><?=$rs->destination_from_rowID?></td>
                            <td><?=$rs->destination_to_rowID?></td>
                            <td><?=$rs->jo_type?></td>
                            <td><?=$rs->price_amount?></td>
                            <td><?=$rs->wholesale?></td>
                            <td><?=$rs->price_20ft?></td>
                            <td><?=$rs->price_40ft?></td>
                            <td><?=$rs->price_45ft?></td>
                        </tr>
                        <?php } } ?>
                      </tbody>
                    </table>
                  </div>
                </section>            
              </div>
            </div>
          <!--</section>-->
        </div>
    </div>
    </div>
    </div>
    
<div class="modal fade" id="modal_select_do_api" role="dialog">
  <div class="modal-dialog" style="width:90%;">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h3 class="modal-title-select-do">Select DO</h3>
      </div>
      <div class="modal-body">
        <div class="row">
            <div class="col-md-12">
                <input type="hidden" name="row_do_api" id="row_do_api" value="" />
                <!--<div id="view_data_do">&nbsp;</div>-->
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="panel-title">
                            <div class="row">
                                <div class="col-md-2">
                                    <input class="form-control input-sm tanggal_datetimepicker" value="<?=date('d-m-Y')?>" name="do_date_api" id="do_date_api" placeholder="dd-mm-yyyy" style="text-align:center;" required="" type="text">
                                </div>
                                <div class="col-md-1" style="padding-left: 0px;">
                                    <button type="button" class="btn btn-sm btn-info" onclick="filterDO()"><i class="fa fa-search"></i> Search</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="panel-body">
                        <div class="table-responsive">
                          <table id="tbl-data-do" class="table table-responsive table-striped" width="100%"></table>
                        </div>                            
                    </div>
                </div>            
            </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn red" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

 <select id="ContType" panelHeight="auto" style="display:none;">
     <option value="" disabled="">Select container size</option>
     <option value="20">20 Fit</option>
     <option value="40">40 Fit</option>
     <option value="45">45 Fit</option>
 </select>

</section>
<a href="#" class="hide nav-off-screen-block" data-toggle="class:nav-off-screen, open" data-target="#nav,html"></a>
</section>

<!-- /.aside -->
<aside class="aside-xxl bg-white b-l hide" id="aside">
    <section class="vbox">
		<section class="scrollable wrapper">
            <?=form_open(base_url().'general_ledger/set_filter','autocomplete="off" id="form_period" class="form-horizontal"')?>                    
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
        
        // Table Active
        var table_general_ledger = $('#tbl-general-ledger-active').DataTable({
            processing: true,
            serverSide: true,
            sDom: "<'row'<'col-sm-6'l><'col-sm-6'f>r>t<'row'<'col-sm-6'i><'col-sm-6'p>>",
            sPaginationType: "full_numbers",
            ajax: {
                url: "<?= base_url() ?>general_ledger/fetch_data",
                type: 'POST',
                data: {'<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>' }
            },
            columns: [
                {
                    "data": "dropdown_option", "orderable": false, "searchable": false, "className" : "text-center"
                },
                {
                    "data": "journal_no"
                },
                {
                    "data": "journal_date"
                },
                {
                    "data": "journal_type"
                },
                {
                    "data": "ref_no"
                },
                {
                    "data": "descs"
                },
                {
                    "data": "trx_amt", "className" : "text-right"
                },
                {
                    "data": "start_date", "bVisible" : false
                },
                {
                    "data": "end_date", "bVisible" : false
                }
            ],
            order: [0, "DESC"],
            iDisplayLength: 25,
            "infoCallback": function( settings, start, end, max, total, pre ) {
                $('#badge-active').empty().append(total);
                return "Showing " + start + " to " + end + " of " + total + " entries" + ((total !== max) ? " (filtered from " + max + " total entries)" : "");
            }
        });

        $('.dataTables_filter input').unbind().keyup(function() {
            var value = $(this).val();
            if (value.length > 2) {
                table_general_ledger.search(value).draw();
            } 
            if (value.length == 0) {
                table_general_ledger.search(value).draw();
            } 
        });
        $(".start_date").on("dp.change", function (e) {
            var start_date = $("#start_date").val();
            table_general_ledger.columns(7).search(start_date).draw();
            $("#start_date").blur();
        });
        $(".end_date").on("dp.change", function (e) {
            var end_date = $("#end_date").val();
            table_general_ledger.columns(8).search(end_date).draw();
            $("#end_date").blur();
        });
        
        // Table Not Active
        
        var table_general_ledger_not_active = $('#tbl-general-ledger-not-active').DataTable({
            processing: true,
            serverSide: true,
            sDom: "<'row'<'col-sm-6'l><'col-sm-6'f>r>t<'row'<'col-sm-6'i><'col-sm-6'p>>",
            sPaginationType: "full_numbers",
            ajax: {
                url: "<?= base_url() ?>general_ledger/fetch_data_not_active",
                type: 'POST',
                data: {'<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>' }
            },
            columns: [
                {
                    "data": "no"
                },
                {
                    "data": "journal_no"
                },
                {
                    "data": "journal_date"
                },
                {
                    "data": "journal_type"
                },
                {
                    "data": "ref_no"
                },
                {
                    "data": "descs"
                },
                {
                    "data": "trx_amt", "className" : "text-right"
                },
                {
                    "data": "start_date", "bVisible" : false
                },
                {
                    "data": "end_date", "bVisible" : false
                }
            ],
            order: [0, "DESC"],
            iDisplayLength: 25,
            "infoCallback": function( settings, start, end, max, total, pre ) {
                $('#badge-not-active').empty().append(total);
                return "Showing " + start + " to " + end + " of " + total + " entries" + ((total !== max) ? " (filtered from " + max + " total entries)" : "");
            }
        });

        $('.dataTables_filter input').unbind().keyup(function() {
            var value = $(this).val();
            if (value.length > 2) {
                table_general_ledger_not_active.search(value).draw();
            } 
            if (value.length == 0) {
                table_general_ledger_not_active.search(value).draw();
            } 
        });
        $(".start_date").on("dp.change", function (e) {
            var start_date = $("#start_date").val();
            table_general_ledger_not_active.columns(7).search(start_date).draw();
            $("#start_date").blur();
        });
        $(".end_date").on("dp.change", function (e) {
            var end_date = $("#end_date").val();
            table_general_ledger_not_active.columns(8).search(end_date).draw();
            $("#end_date").blur();
        });
    });

$(function() {
    
    // $.ajax({
    //     type: "POST",
    //     url : "<?php echo base_url(); ?>api.php",
    // 	data: 'type=get_data_do&do_date=<?=date('d-m-Y')?>&<?=$this->security->get_csrf_token_name()?>='+'<?=$this->security->get_csrf_hash()?>',
    //     dataType:"JSON",
    //     cache:false,
    //     success: function(result){
            
    //         $('#tbl-data-do').html('');

    //         var isi_table = '<thead>'+
    //                             '<th>No</th>' +
    //             				'<th><?=lang('delivery_order_no')?></th>' +
    //             				'<th>Driver Name</th>' +
    //             				'<th>Police No</th>' +
    //             				'<th>Vessel Name</th>' +
    //             				'<th><?=lang('delivery_order_date')?> </th>' +
    //             				'<th><?=lang('qty_delivery')?> </th>' +
    //             				'<th><?=lang('receipt_date')?> </th>' +
    //             				'<th><?=lang('qty_receipt')?> </th>' +
    //                         '</thead>';
                
    //         var no = 1;
    //         $.each(result, function(key, data) {	
                
	// 			isi_table += '<tr onclick="get_data_do(\''+data.do_no+'\',\''+data.str_do_date+'\',\''+
    //                                                         data.qty_deliver+'\',\''+data.str_receipt_date+'\',\''+
    //                                                         data.qty_receipt+'\')" style="cursor:pointer">'+
    //                             '<td>'+no+'</td>' +
    //                             '<td>'+data.do_no+'</td>' +
    //                             '<td>'+data.driver_name+'</td>' +
    //                             '<td>'+data.police_no+'</td>' +
    //                             '<td>'+data.vessel_name+'</td>' +
    //     						'<td>'+data.str_do_date+'</td>' +
    //     						'<td>'+data.qty_deliver+'</td>' +
    //     						'<td>'+data.str_receipt_date+'</td>' +  
    //     						'<td>'+data.qty_receipt+'</td>' +  
    //                          '</tr>';
	// 		     no++;
    //         });  
            
                      
    //         $('#tbl-data-do').append(isi_table);   
               
    //         $('#tbl-data-do').DataTable().destroy();
    //         $('#tbl-data-do').dataTable({
    //     		"bProcessing": true,
    //             "sDom": "<'row'<'col-sm-6'l><'col-sm-6'f>r>t<'row'<'col-sm-6'i><'col-sm-6'p>>",
    //             "sPaginationType": "full_numbers",
    //     	});
            
    //     },
    // 	error: function(xhr, status, error) {
    // 		document.write(xhr.responseText);
    // 	}
    // }); 
    
});

</script>