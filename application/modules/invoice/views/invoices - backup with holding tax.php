<section id="content">
  <section class="hbox stretch">

      <section class="vbox">
        <header class="header bg-white b-b b-light">
          <a  class="btn btn-sm green pull-right" onclick="add_invoice()"><i class="fa fa-plus"></i> <?=lang('new')?> <?=lang('invoices')?></a>
          <p><?=lang('invoice_details')?></p>
        </header>
        <section class="scrollable wrapper">
          <div class="row">
            <div class="col-lg-12">
              <section class="panel panel-default">
                <div class="table-responsive"><?php echo validation_errors(); ?>
                  <table id="tbl-projects" class="table table-striped table-hover b-t b-light text-sm">
                    <thead>
                      <tr>
                        <th><?=lang('options')?></th>
                        <th>Invoice No</th>
						<th>Invoice Date</th>
						<th>Debtor Name</th>
						<th>Remark</th>
                        <th>Base Amount</th>
                        <th>Vat</th>
                        <th>With Holding</th>
                        <th>Total</th>
                      </tr> 
					</thead>
					<tbody>
                      <?php
                      if (!empty($invoices)) {
                      foreach ($invoices as $invoice) { ?>
                      <tr>
                        <td>
							  <div class="btn-group">
								<button class="btn btn-xs btn-default dropdown-toggle" data-toggle="dropdown">
								 <?=lang('options')?>
								<span class="caret"></span>
								</button>
								<ul class="dropdown-menu">
									<!--<li><a  href="javascript:void()" title="<?=lang('update_option')?>" onclick="edit_invoice('<?=$invoice->prefix ?>','<?=$invoice->year ?>','<?=$invoice->month ?>','<?=$invoice->code ?>')"><i class="fa fa-pencil"></i><?=lang('update_option')?></a></li>-->
                                    <li><a  href="javascript:void()" title="<?=lang('delete_option')?>" onclick="delete_invoice('<?=$invoice->prefix ?>','<?=$invoice->year ?>','<?=$invoice->month ?>','<?=$invoice->code ?>')"><i class="fa fa-trash-o"></i> <?=lang('delete_option')?></a></li>
								</ul>
                                
							  </div>
						</td>
						<td><?=$invoice->trx_no?></td>
						<td><?=$invoice->trx_date?></td>
                        <td><?=$invoice->debtor_name?></td>
						<td><?=$invoice->descs?></td>
						<td  style="text-align: right;"><?= number_format($invoice->base_amt,2,$this->config->item('decimal_separator'),$this->config->item('thousand_separator'));?></td>
                        <td  style="text-align: right;"><?= number_format($invoice->tax_amt,2,$this->config->item('decimal_separator'),$this->config->item('thousand_separator'));?></td>
                        <td  style="text-align: right;"><?= number_format($invoice->wth_amt,2,$this->config->item('decimal_separator'),$this->config->item('thousand_separator'));?></td>
                        <td  style="text-align: right;"><?= number_format($invoice->total_amt,2,$this->config->item('decimal_separator'),$this->config->item('thousand_separator'));?></td>
                    </tr>
                    <?php } } ?>
                  </tbody>
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

  <!-- Bootstrap modal -->
  <div class="modal fade" id="modal_form" role="dialog">
  <div class="modal-dialog" style="width:1200px;height:200px;">
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
						<div class="row inline-fields form-group form-md-line-input">
							<div class="col-md-4">Invoice No<span class="text-danger">*</span></div>
							<div class="col-md-1">:</div>
							<div class="col-md-6"><p>										
                                <input type="text"  class="input-sm form-control" value="Auto" name="invoice_no" id="invoice_no" readonly=""   required>
                                <input type="hidden" id="prefix" name="prefix"/>
                                <input type="hidden" id="year" name="year"/>
                                <input type="hidden" id="month" name="month"/>
                                <input type="hidden" id="code" name="code"/>
                                <input type="hidden" id="gl_trx_hdr_prefix" name="gl_trx_hdr_prefix"/>
                                <input type="hidden" id="gl_trx_hdr_year" name="gl_trx_hdr_year"/>
                                <input type="hidden" id="gl_trx_hdr_month" name="gl_trx_hdr_month"/>
                                <input type="hidden" id="gl_trx_hdr_code" name="gl_trx_hdr_code"/>
                                 <input type="hidden" id="gl_trx_hdr_trx_no" name="gl_trx_hdr_trx_no"/>
							</p></div>
						</div>	
						<div class="row inline-fields form-group form-md-line-input">
							<div class="col-md-4">Invoice Date<span class="text-danger">*</span></div>
							<div class="col-md-1">:</div>
							<div class="col-md-6"><p>
								<input type="text" class="datepicker-input form-control"  name="invoice_date" id="invoice_date" value="<?=date('d-m-Y')?>"  data-date-format="dd-mm-yyyy"   required>
							</p></div>
															
						</div>
						<div class="row inline-fields form-group form-md-line-input">
							<div class="col-md-4">Debtor Name<span class="text-danger">*</span></div>
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
							<div class="col-md-4">Invoice Type</div>
							<div class="col-md-1">:</div>
							<div class="col-md-6"><p>
								<select class="form-control" name="invoice_type" id="invoice_type" placeholder="<?=lang('select')?>" >	
                                      <option value="" disabled selected><?=lang('select_your_option')?></option>
                                      <option value="J">By Job Order</option>
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
                                <textarea class="form-control" id="invoice_remark_header" name="invoice_remark_header" maxlength="200" ></textarea>
							</p></div>
						</div>
                        	
						<div class="row inline-fields form-group form-md-line-input" id="job_order">
							<div class="col-md-4">Job Order No</div>
							<div class="col-md-1">:</div>
							<div class="col-md-6"><p>
                                <input type="hidden" id="jo_year" name="jo_year"/>
                                <input type="hidden" id="jo_month" name="jo_month"/>
                                <input type="hidden" id="jo_code" name="jo_code"/>
								<input type="text" onclick="ambil_job_order()" class="input-sm form-control" value="" name="jo_no" id="jo_no" readonly="" style="cursor: pointer;" required>
							</p></div>
															
						</div>

                       <div class="row inline-fields form-group form-md-line-input">
							<div class="col-md-4"></div>
							<div class="col-md-1"></div>
							<div class="col-md-6"><p>										
                                <input type="checkbox" name="cekDa" id="cekDa" value="1"> &nbsp;Not Tax
							</p></div>
						</div>
						
					</div>
				</div>
            </div> 
            <p>&nbsp;</p> 
             <ul class="nav nav-tabs">
                <li id="choose_delivery" class="active"><a data-toggle="tab" href="#delivery_order"><?=lang('delivery_order') ?></a></li>
                <li id="choose_invoice"><a data-toggle="tab" href="#invoice_detail"><?=lang('invoice_details') ?></a></li>
             </ul>
             <div class="tab-content" sty>
                <div id="delivery_order" class="tab-pane">  
                    <br />
                    a
                </div>
                <div id="invoice_detail" class="tab-pane">
                    <br />
                    <table cellspacing="0" cellpadding="0" class="table table-responsive table-striped table-condensed b-t b-light text-sm" style="width:100%;" id="detail_invoice">
                        <tr>
                            <th>
                                <input id="tamdetInvoice" title="Tambah Baris" type="button" onclick="addRowDetailInvoice()" value="&nbsp;" style="height:30px;width:30px;border;background-image:url('<?= base_url();?>resource/images/plus.png');background-repeat:no-repeat;" />
                            </th>
                            <th>Income Name</th>
                            <th>Remark</th>
                            <th>Amount</th>
                            <th>#</th>
                            <th>Base Amount</th>
                            <th>Vat Amount</th>
                            <th>With Holding Tax</th>
                            <th>Sub Total</th>
                        </tr>
                    </table>
                    <div class="form-group form-md-line-input">
						<div class="col-md-10 text-right"><strong>Total Base &nbsp;&nbsp;</strong></div>
						<div class="col-md-2">
        					<input type="text"  name="TotalBase" id="TotalBase" readonly="" class="form-control" style='text-align:right;font-size:15px;font-weight:600;color: black;height:30px;width:170px;background-color:white;border:solid 1px #ccc;' />
        				</div>
                    </div>
                    <div class="form-group form-md-line-input">
						<div class="col-md-10 text-right"><strong>Total VAT &nbsp;&nbsp;</strong></div>
						<div class="col-md-2">
                            <input type="text"  name="TotalVat" id="TotalVat" readonly="" class="form-control" style='text-align:right;font-size:15px;font-weight:600;color: black;height:30px;width:170px;background-color:white;border:solid 1px #ccc;' />     
                        </div>
                    </div>
                    <div class="form-group form-md-line-input">
						<div class="col-md-10 text-right"><strong>Total With Holding &nbsp;&nbsp;</strong></div>
						<div class="col-md-2">
                            <input type="text"  name="TotalWth" id="TotalWth" readonly="" class="form-control" style='text-align:right;font-size:15px;font-weight:600;color: black;height:30px;width:170px;background-color:white;border:solid 1px #ccc;' />
        				</div>
                    </div>
                    <div class="form-group form-md-line-input">
						<div class="col-md-10 text-right"><strong>Grand Total &nbsp;&nbsp;</strong></div>
						<div class="col-md-2">
                            <input type="text"  name="GrandTotal" id="GrandTotal" readonly="" class="form-control" style='text-align:right;font-size:15px;font-weight:600;color: black;height:30px;width:170px;background-color:white;border:solid 1px #ccc;' />
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
            <button type="button" id="btnDelete" onclick="del_invoice()" class="btn green">Delete</button>

          </div>
        </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
    
    
<!-- Modal JO-->
  <div class="modal fade" id="joModal" role="dialog">
    <div class="modal-dialog" style="width:1000px;height:30px;">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Job Order List</h4>
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
                        <th><?=lang('trip_type')?></th>
                      </tr> 
					</thead>
					<tbody>
                      <?php
                      if (!empty($cash_advance_jo)) {
                      foreach ($cash_advance_jo as $rs) { 
                        if($rs->jo_type == '1')
                            $trip_type = "BULK";
                        else if($rs->jo_type == '2')
                            $trip_type = "CONTAINER";
                        else
                            $trip_type = "OTHERS";    
                      ?>
                      <tr style="cursor: pointer;">
						<td><?=$rs->jo_no?></td>
						<td><?=date("d F Y",strtotime($rs->jo_date))?></td>
						<td><?=$rs->debtor?></td>
                        <td><?=$rs->po_spk_no?></td>
                        <td><?=$rs->so_no?></td>
                        <td><?=$rs->vessel_no?></td>
                        <td><?=$rs->vessel_name?></td>
                        <td><?=$rs->port_name?></td>
                        <td><?=$rs->fare_trip_cd?></td>
                        <td><?=$rs->year?></td>
                        <td><?=$rs->month?></td>
                        <td><?=$rs->code?></td>
                        <td><?=$trip_type?></td>
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


<!-- Modal JO-->
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

    
</section>
<a href="#" class="hide nav-off-screen-block" data-toggle="class:nav-off-screen, open" data-target="#nav,html"></a>
</section>