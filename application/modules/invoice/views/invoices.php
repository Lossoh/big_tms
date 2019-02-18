<section id="content">
  <section class="hbox stretch">

      <section class="vbox">
        <header class="header bg-white b-b b-light">
            <div class="row" style="padding-top: 10px;">
                <div class="col-md-6" style="padding-top: 5px;">
                    <p><?=lang('invoice_details')?></p>              
                </div>     
                <div class="col-md-6 text-right">
                    <!-- <a href="#aside" data-toggle="class:show" id="btnFilter" onclick="showFilterText()" style="color: #46b8da;">Show Filter</a> &nbsp; -->
                    <?php
                    if($this->user_profile->get_user_access('Created') == 1){
                    ?>
                        <a  class="btn btn-sm green" onclick="add_invoice()"><i class="fa fa-plus"></i> <?=lang('new')?> <?=lang('invoices')?></a>
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

                    <table id="tbl-invoice-new" class="table table-striped table-hover b-t b-light text-sm">
                        <thead>
                          <tr>
                            <th><?=lang('options')?></th>
                            <th>Invoice No</th>
                            <th>Invoice Date</th>
                            <th>Debtor Name</th>
                            <th>Remark</th>
                            <th>Base Amount</th>
                            <th>Vat</th>
                            <th>Total</th>

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
      </section>

    </section>

<select id="income" panelHeight="auto" style="display:none;">
     <option value="" disabled selected><?=lang('select_your_option')?></option>
	 <?php if (!empty($income)) {
	  foreach ($income as $rs) { ?>
	  <option value="<?php echo $rs->rowID;?>"><?php echo $rs->income_cd.' - '.$rs->descs;?></option>
	 <?php }} ?>
</select>

<select id="cmbWth" name="cmbWth" panelHeight="auto" style="display:none;">
     <option value="" disabled selected><?=lang('select_your_option')?></option>
	 <?php if (!empty($wthHolding)) {
	  foreach ($wthHolding as $rs) { ?>
	  <option value="<?php echo $rs->rowID;?>"><?php echo $rs->wth_rate.' % '.$rs->descs;?></option>
	 <?php }} ?>
</select>

<select id="ContType" panelHeight="auto" style="display:none;">
    <option value="" disabled="">Select container size</option>
    <option value="20">20 Feet</option>
    <option value="40">40 Feet</option>
    <option value="45">45 Feet</option>
</select>

  <!-- Bootstrap modal -->
  <div class="modal fade" id="modal_form" role="dialog" style="overflow: scroll;">
  <div class="modal-dialog" style="width:1200px;">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h3 class="modal-title">Add Invoice</h3>
      </div>
      <div class="modal-body form">
        <?=form_open('','autocomplete="off" id="form" class="form-horizontal"')?>
        <input type="hidden" name="rowID" value="">
        <div class="form-body">
            <div class="row">  
                <div class="col-xs-6">
					<div class="group">	
						<div class="row inline-fields form-group form-md-line-input" style="display:none;">
							<div class="col-md-4">Invoice No<span class="text-danger">*</span></div>
							<div class="col-md-1">:</div>
							<div class="col-md-6"><p>										
                                <input type="text" class="input-sm form-control" name="invoice_no" id="invoice_no" readonly="" required>
                                <input type="hidden" id="row_id" name="row_id"/>
                                <input type="hidden" id="prefix" name="prefix"/>
                                <input type="hidden" id="year" name="year"/>
                                <input type="hidden" id="month" name="month"/>
                                <input type="hidden" id="code" name="code"/>
                                <input type="hidden" id="gl_trx_hdr_prefix" name="gl_trx_hdr_prefix"/>
                                <input type="hidden" id="gl_trx_hdr_year" name="gl_trx_hdr_year"/>
                                <input type="hidden" id="gl_trx_hdr_month" name="gl_trx_hdr_month"/>
                                <input type="hidden" id="gl_trx_hdr_code" name="gl_trx_hdr_code"/>
                                <input type="hidden" id="gl_trx_hdr_trx_no" name="gl_trx_hdr_trx_no"/>
                                <input type="hidden" id="debtor_id_tmp" name="debtor_id_tmp"/>
                                <input type="hidden" id="user_created" name="user_created"/>
                                <input type="hidden" id="date_created" name="date_created"/>
                                <input type="hidden" id="time_created" name="time_created"/>
                                <input type="hidden" id="received_date_val" name="received_date_val"/>
                                <input type="hidden" id="received_no_val" name="received_no_val"/>
                                <input type="hidden" id="due_date_val" name="due_date_val"/>
							</p></div>
						</div>	
						<div class="row inline-fields form-group form-md-line-input">
							<div class="col-md-4">Invoice Date <span class="text-danger">*</span></div>
							<div class="col-md-1">:</div>
							<div class="col-md-4"><p>
                                <?php
                                $readonly = '';
                                if(date('d') <= 5){
                                    $readonly = '';    
                                }
                                else{
                                    $readonly = 'readonly=""';
                                }
                                ?>
								<input type="text" class="form-control text-center tanggal_datetimepicker"  name="invoice_date" id="invoice_date" value="<?=date('d-m-Y')?>" required="" <?=$readonly?> />
								<input type="text" class="form-control" name="invoice_date_tmp" id="invoice_date_tmp" value="<?=date('d-m-Y')?>" style="display: none;" readonly="" required="" />
							</p></div>
															
						</div>
						<div class="row inline-fields form-group form-md-line-input">
							<div class="col-md-4">Debtor Name <span class="text-danger">*</span></div>
							<div class="col-md-1">:</div>
							<div class="col-md-6"><p>
                                    <select class="form-control" name="debtor_id" id="debtor_id" placeholder="<?=lang('select')?>" >	
                                         <option value="" disabled selected><?=lang('select_your_option')?></option>
        								 <?php if (!empty($debtor)) {
        								  foreach ($debtor as $rs) { ?>
        								  <option value="<?php echo $rs->rowID;?>"><?php echo $rs->debtor_cd.' - '.$rs->debtor_name;?></option>
        								 <?php }} ?>
			                        </select> 
						     </p></div>
						</div>	
						<div class="row inline-fields form-group form-md-line-input">
							<div class="col-md-4">Invoice Type <span class="text-danger">*</span></div>
							<div class="col-md-1">:</div>
							<div class="col-md-6"><p>
								<select class="form-control" name="invoice_type" id="invoice_type" placeholder="<?=lang('select')?>" >	
                                    <option value="" disabled selected><?=lang('select_your_option')?></option>
                                    <option value="J">By Job Order</option>
                                    <option value="A">By Account Payable</option>
                                    <option value="M">Manual</option>
			                    </select> 
							</p></div>
						</div>			
						
					</div>
				</div>  
            
                <div class="col-xs-6">
					<div class="group">	
						<div class="row inline-fields form-group form-md-line-input">
							<div class="col-md-4">Remark</div>
							<div class="col-md-1">:</div>
							<div class="col-md-6"><p>										
                                <textarea class="form-control" id="invoice_remark_header" name="invoice_remark_header" maxlength="255" onkeyup="replaceQuotes(this)"></textarea>
							</p></div>
						</div>
                        	
						<div class="row inline-fields form-group form-md-line-input" id="job_order">
							<div class="col-md-4">Job Order No <span class="text-danger">*</span></div>
							<div class="col-md-1">:</div>
							<div class="col-md-6"><p>
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
                                
                        		<input type="hidden" class="form-control" value="" name="ap_no" id="ap_no" readonly="" style="cursor: pointer;background-color: #fff;" placeholder="Select Account Payable" required>
								<input type="text" class="form-control" value="" name="jo_no" id="jo_no" readonly="" style="cursor: pointer;background-color: #fff;" placeholder="Select Job Order" required>
							</p></div>		
                            <div class="col-md-1" style="padding-left: 0px;"><button type="button" id="btnEmptyDO" class="btn btn-sm yellow" title="Empty DO" onclick="empty_do_invoice()" style="display: none;"><i class="fa fa-times"></i></button></div>													
						</div>
                        <div class="row inline-fields form-group form-md-line-input">
							<div class="col-md-4"></div>
							<div class="col-md-1"></div>
							<div class="col-md-6"><p>										
                                <div style="display: none;"><input type="checkbox" name="cekDa" id="cekDa" value="1" /> &nbsp;Non Tax</div>
                                <input type="checkbox" name="cekDa_tmp" id="cekDa_tmp" value="1" /> &nbsp;Non Tax
							</p></div>
						</div>
						
					</div>
				</div>
            </div> 
            <p>&nbsp;</p> 
             <ul class="nav nav-tabs">
                <li id="choose_delivery" class="active"><a data-toggle="tab" href="#delivery_order">JO Details</a></li>
                <!-- <li id="choose_invoice"><a data-toggle="tab" href="#invoice_detail"><?=lang('invoice_details') ?></a></li> -->
             </ul>
             <div class="tab-content">
                <div id="delivery_order" class="tab-pane">  
                    <br />
                    <div id="data_do"></div> 
                    <div id="data_do_manual" class="table-responsive" style="display: none;"> 
                        <table class="table table-responsive table-striped table-condensed" id="detail_DO">
                            <tr>
                                <th style="width: 5%;">
                                    <input id="tamdet" title="Tambah Baris" type="button" onclick="addNewRow_DeliveryOrder_AP_For_Invoice()" value="&nbsp;" style="height:30px;width:30px;border;background-image:url('<?= base_url();?>resource/images/plus.png');background-repeat:no-repeat;" />
                                </th>
                                <th><?=lang('job_order_no')?></th>
                                <th>Container Size</th>
                                <th>Container No</th>
                                <th>Police No</th>
                                <th>DO No</th>
                                <th>DO Date</th>
                                <th><?=lang('qty_delivery')?></th>
                                <th><?=lang('receipt_date')?></th>
                                <th><?=lang('qty_receipt')?></th>
                                <th>Amount</th>
                            </tr>
                        </table>
                    </div>
                </div>
                <div id="invoice_detail" class="tab-pane">
                    <br />
                    <table id="detail_invoice" cellspacing="0" cellpadding="0" class="table table-responsive table-striped table-condensed b-t b-light text-sm" style="width:100%;">
                        <tr>
                            <th width="3%">
                                <input id="tamdetInvoice" title="Tambah Baris" type="button" onclick="addRowDetailInvoice()" value="&nbsp;" style="height:30px;width:30px;border;background-image:url('<?= base_url();?>resource/images/plus.png');background-repeat:no-repeat;" />
                            </th>
                            <th width="15%">Income Name</th>
                            <th>Description</th>
                            <th width="10%">Amount</th>
                            <th width="3%">Tax</th>
                            <th width="13%">Base Amount</th>
                            <th width="13%">Vat Amount</th>
                            <!--<th>With Holding Tax</th>-->
                            <th width="15%">Sub Total</th>
                        </tr>
                    </table>
                    <div class="form-group form-md-line-input">
						<div class="col-md-10 text-right"><strong>Total Base &nbsp;&nbsp;</strong></div>
						<div class="col-md-2">
                            <div class="input-group">
                              <span class="input-group-addon" id="basic-addon1">Rp</span>
                              <input type="text"  name="TotalBase" id="TotalBase" value="0" readonly="" class="form-control" style='text-align:right;font-size:15px;font-weight:600;color: black;height:30px;background-color:white;border:solid 1px #ccc;' />
                            </div>
        				</div>
                    </div>
                    <div class="form-group form-md-line-input">
						<div class="col-md-10 text-right"><strong>Total VAT &nbsp;&nbsp;</strong></div>
						<div class="col-md-2">
                            <div class="input-group">
                              <span class="input-group-addon" id="basic-addon1">Rp</span>
                              <input type="text"  name="TotalVat" id="TotalVat" value="0" readonly="" class="form-control" style='text-align:right;font-size:15px;font-weight:600;color: black;height:30px;background-color:white;border:solid 1px #ccc;' />     
                            </div>
                        </div>
                    </div>
                    <!--<div class="form-group form-md-line-input">
						<div class="col-md-10 text-right"><strong>Total With Holding &nbsp;&nbsp;</strong></div>
						<div class="col-md-2">
                            <input type="text"  name="TotalWth" id="TotalWth" value="0" readonly="" class="form-control" style='text-align:right;font-size:15px;font-weight:600;color: black;height:30px;background-color:white;border:solid 1px #ccc;' />
        				</div>
                    </div>-->
                    <div class="form-group form-md-line-input">
						<div class="col-md-10 text-right"><strong>Grand Total &nbsp;&nbsp;</strong></div>
						<div class="col-md-2">
                            <div class="input-group">
                              <span class="input-group-addon" id="basic-addon1">Rp</span>
                              <input type="text"  name="GrandTotal" id="GrandTotal" value="0" readonly="" class="form-control" style='text-align:right;font-size:15px;font-weight:600;color: black;height:30px;background-color:white;border:solid 1px #ccc;' />
                            </div>
                        </div>
                    </div>
                </div>
             </div>
        </div>
        </form>
        <p>&nbsp;</p>
          </div>
          <div class="modal-footer">
            <button type="button" id="btnCancel" class="btn red" data-dismiss="modal">Cancel</button>
            <button type="button" id="btnSave" onclick="save_invoice()" class="btn green">Save</button>
            <button type="button" id="btnUpdate" onclick="update_invoice()" class="btn green">Update</button>
            <button type="button" id="btnDelete" onclick="del_invoice()" class="btn green">Delete</button>
          </div>
        </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
    
    
<!-- Modal JO -->
  <div class="modal fade" id="joModal" role="dialog">
    <div class="modal-dialog" style="width:920px;height:30px;">
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
                  <table id="tbl-joborder" class="table table-responsive table-striped b-t b-light text-sm">
                    <thead>
                      <tr>
                        <th><?=lang('job_order_no')?></th>
						<th><?=lang('job_order_debtor')?></th>
                        <th><?=lang('job_order_po_spk_no')?></th>
                        <th>From - To</th>
                        <th>JO Type</th>
                        <th>Price Type</th>
                        <th>Cargo</th>
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
<!-- Modal JO -->

<!-- Modal AP -->
  <div class="modal fade" id="apModal" role="dialog">
    <div class="modal-dialog" style="width:53%;height:30px;">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title modal-title-ap">Account Payable (AP) List</h4>
        </div>
        <div class="modal-body">
          <!--<section class="scrollable wrapper">-->
          <div class="row">
           <input type="hidden" id="tag" value="">
            <div class="col-lg-12">
              <section class="panel panel-default">
                <div class="table-responsive">
                  <table id="tbl-ap" class="table table-responsive table-striped b-t b-light text-sm">
                    <thead>
                      <tr>
                        <th>AP No</th>
						<th>AP Date</th>
						<th>Supplier Name</th>
						<th>Invoice No</th>
                        <th>Base Total (Rp)</th>
                        <th>Total AP (Rp)</th>
                        <th>Total Difference (Rp)</th>
                      </tr> 
					</thead>
					<tbody>
                      <?php
                      if (!empty($data_ap)) {
                      foreach ($data_ap as $ap) { 
                          
                      ?>
                      <tr style="cursor: pointer;">
						<td><?=$ap->trx_no?></td>
						<td><?=date("d F Y",strtotime($ap->trx_date))?></td>
                        <td><?=strtoupper($ap->creditor_name)?></td>
						<td><?=strtoupper($ap->ref_no)?></td>
                        <td style="text-align: right;"><?= number_format($ap->base_amt,0,$this->config->item('decimal_separator'),$this->config->item('thousand_separator'));?></td>
                        <td style="text-align: right;"><?= number_format($ap->total_ap,0,$this->config->item('decimal_separator'),$this->config->item('thousand_separator'));?></td>
                        <td style="text-align: right;"><?= number_format($ap->total_diff,0,$this->config->item('decimal_separator'),$this->config->item('thousand_separator'));?></td>
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
<!-- Modal AP -->

  <div class="modal fade" id="joMod" role="dialog">
    <div class="modal-dialog" style="width:1000px;height:30px;">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Job Order List</h4>
        </div>
        <div class="modal-body">
          <div class="row">
           <input type="hidden" id="tag" value="">
            <div class="col-lg-12">
              <section class="panel panel-default">
                <div class="table-responsive">
                  <table id="tbl-joborder2" class="table table-striped table-hover b-t b-light text-sm">
                    <thead>
                      <tr>
                        <th><?=lang('job_order_no')?></th>
						<th><?=lang('job_order_date')?></th>
						<th><?=lang('job_order_debtor')?></th>
                        <th><?=lang('job_order_po_spk_no')?></th>
                        <th><?=lang('job_order_so_no')?></th>
                        <th><?=lang('vessel_no')?> </th>
                        <th><?=lang('vessel_name')?> </th>
                        <th><?=lang('port')?></th>
                        <th><?=lang('fare_trip_code')?></th>
                        <th>Year</th>
                        <th>month</th>
                        <th>code</th>
                      </tr> 
					</thead>
                </table>
              </div>
            </section>            
          </div>
        </div>
    </div>
</div>
</div>
</div>

  <div class="modal fade" id="modal_receipt" role="dialog">
    <div class="modal-dialog" style="width:50%;">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title-invoice-receipt">Invoice Receipt</h4>
        </div>
        <div class="modal-body">
            <?=form_open('','autocomplete="off" id="form_invoice_receipt" class="form-horizontal"')?>        
            <input type="hidden" name="invoice_receipt_no" id="invoice_receipt_no" />            
            <div class="row inline-fields form-group form-md-line-input">
				<div class="col-md-3">Received Date<span class="text-danger">*</span></div>
				<div class="col-md-3"><p>
					<input type="text" class="form-control text-center tanggal_datetimepicker"  name="received_date" id="received_date" value="<?=date('d-m-Y')?>" required="" />
				</p></div>						
			</div>
            <div class="row inline-fields form-group form-md-line-input">
				<div class="col-md-3">Nomor<span class="text-danger">*</span></div>
				<div class="col-md-4"><p>
					<input type="text" class="form-control"  name="received_no" id="received_no" value="" maxlength="25" required="" />
				</p></div>						
			</div>
            <div class="row inline-fields form-group form-md-line-input">
				<div class="col-md-3">Due Date<span class="text-danger">*</span></div>
				<div class="col-md-3"><p>
					<input type="text" class="form-control text-center tanggal_datetimepicker"  name="due_date" id="due_date" value="<?=date('d-m-Y')?>" required="" />
				</p></div>						
			</div>
            <?=form_close()?>
        </div>
        <div class="modal-footer">
            <button type="button" id="btnCancel" class="btn red" data-dismiss="modal">Close</button>
            <button type="button" id="btnSave" onclick="save_invoice_receipt()" class="btn green">Save</button>
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

<script type="text/javascript">
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

</section>
<a href="#" class="hide nav-off-screen-block" data-toggle="class:nav-off-screen, open" data-target="#nav,html"></a>
</section>

<!-- /.aside -->
<aside class="aside-xxl bg-white b-l hide" id="aside">
    <section class="vbox">
		<section class="scrollable wrapper">
            <?=form_open(base_url().'invoice/set_filter','autocomplete="off" id="form_period" class="form-horizontal"')?>                    
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
        
        var table_invoice = $('#tbl-invoice-new').DataTable({
            processing: true,
            serverSide: true,
            sDom: "<'row'<'col-sm-6'l><'col-sm-6'f>r>t<'row'<'col-sm-6'i><'col-sm-6'p>>",
            sPaginationType: "full_numbers",
            ajax: {
                url: "<?= base_url() ?>invoice/fetch_data",
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
                    "data": "debtor"
                },
                {
                    "data": "descs"
                },
                {
                    "data": "base_amt", "className": "text-right"
                },
                {
                    "data": "tax_amt", "className": "text-right"
                },
                {
                    "data": "total_amt", "className": "text-right"
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
                table_invoice.search(value).draw();
            } 
            if (value.length == 0) {
                table_invoice.search(value).draw();
            } 
        });
        $(".start_date").on("dp.change", function (e) {
            var start_date = $("#start_date").val();
            table_invoice.columns(8).search(start_date).draw();
            $("#start_date").blur();
        });
        $(".end_date").on("dp.change", function (e) {
            var end_date = $("#end_date").val();
            table_invoice.columns(9).search(end_date).draw();
            $("#end_date").blur();
        });
    });
</script>