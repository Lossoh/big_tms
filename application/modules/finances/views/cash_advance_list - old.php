
      
<section id="content">
  <section class="hbox stretch">
 
    <!-- .aside -->
    <!--<aside>-->
      <section class="vbox">
        <header class="header bg-white b-b b-light">
            <div class="pull-right" style="margin-top: 10px;">
              <!--<a href="<?php echo base_url().'finances/create_cash_advance'; ?>"  class="btn btn-sm green"> <i class="fa fa-plus"></i><?=lang('new')?>  <?=lang('cash_advance')?></a>
              <a href="<?php echo base_url().'finances/print_ca'; ?>"  class="btn btn-sm green pull-right"><i class="fa fa-plus"></i>print</a>-->
              <a  class="btn btn-sm green" onclick="add_cash_advance()"><i class="fa fa-plus"></i> <?=lang('new')?>  <?=lang('cash_advance')?></a>
            </div>
            <p class="pull-left"><?=lang('cash_advance_list')?></p>
        </header>
        <section class="scrollable wrapper">
          <div class="row">
            <div class="col-lg-12">
              <section class="panel panel-default">
                <div class="table-responsive"><?php echo validation_errors(); ?>
                  <table id="tbl-orders" class="table table-striped table-hover b-t b-light text-sm">
                    <thead>
                      <tr>
						<th><?=lang('options')?></th>
                        <th><?=lang('cash_advance_no')?></th>
						<th><?=lang('date')?></th>
						<th><?=lang('driver')?>/<?=lang('employee')?> Name</th>
						<th><?=lang('fare_trip_no')?></th>
						<th><?=lang('cash_advance_amt')?></th>
						<th><?=lang('cash_advance_alloc')?></th>
						<th><?=lang('balance')?></th>
                      </tr> 
					</thead>
					<tbody>
                      <?php
                      if (!empty($cash_advance_lists)) {
                      foreach ($cash_advance_lists as $cash_advance_list) { ?>
                      <tr>
						  <td>
							  <div class="btn-group">
								<button class="btn btn-xs btn-default dropdown-toggle" data-toggle="dropdown">
								 <?=lang('options')?>
								<span class="caret"></span>
								</button>
								<ul class="dropdown-menu">
									<li><a href="<?=base_url()?>finances/view_cash_advance/<?=$cash_advance_list->year?>/<?=$cash_advance_list->month ?>/<?=$cash_advance_list->code ?>"><i class="fa fa-eye"></i>  <?=lang('view_cashadvance_option')?></a></li>
									<?php 
                                    $advance_allocation=$cash_advance_list->advance_allocation;
									if($advance_allocation == 0){
									?>
										<li><a href="<?=base_url()?>finances/delete_cash_advance/<?=$this->encrypt->encode($cash_advance_list->prefix)?>/<?=$this->encrypt->encode($cash_advance_list->years)?>/<?=$this->encrypt->encode($cash_advance_list->month)?>/<?=$this->encrypt->encode($cash_advance_list->code)?>" data-toggle="ajaxModal"><i class="fa fa-trash-o"></i>  <?=lang('delete_option')?></a></li>
									<?php }?>
									<?php 
                                    $advance_balance=$cash_advance_list->advance_balance;
									if($advance_balance > 0){

									?>
                                        <li><a  href="javascript:void()" title="<?=lang('update_option')?>" onclick="edit_realization('<?=$cash_advance_list->prefix ?>','<?=$cash_advance_list->year ?>','<?=$cash_advance_list->month ?>',<?=$cash_advance_list->code ?>)"><i class="fa fa-file-code-o"></i> <?=lang('realization_option')?></a></li>
										<!--<li><a href="<?=base_url()?>finances/create_realization_hdr/<?=$this->encrypt->encode($cash_advance_list->prefix)?>/<?=$this->encrypt->encode($cash_advance_list->year)?>/<?=$this->encrypt->encode($cash_advance_list->month)?>/<?=$this->encrypt->encode($cash_advance_list->code)?>"><i class="fa fa-file-code-o"></i>  <?=lang('realization_option')?></a></li>-->
										<li><a href="<?=base_url()?>finances/create_refund_hdr"><i class="fa fa-money"></i>  <?=lang('refund_option')?></a></li>
									<?php }?>		

									<li><a href="<?=base_url()?>finances/view_realization_list/<?=$this->encrypt->encode($cash_advance_list->prefix)?>/<?=$this->encrypt->encode($cash_advance_list->year)?>/<?=$this->encrypt->encode($cash_advance_list->month)?>/<?=$this->encrypt->encode($cash_advance_list->code)?>"><i class="fa  fa-eye"></i>  <?=lang('view_realization_option')?></a></li>
									<li><a href="<?=base_url()?>finances/view_refund_list/<?=$this->encrypt->encode($cash_advance_list->prefix)?>/<?=$this->encrypt->encode($cash_advance_list->year)?>/<?=$this->encrypt->encode($cash_advance_list->month)?>/<?=$this->encrypt->encode($cash_advance_list->code)?>"><i class="fa  fa-eye"></i><i class="fa  fa-money"></i>  <?=lang('view_refund_option')?></a></li>

									
								</ul>
							  </div>
							</td>					  
							<td><?=$cash_advance_list->advance_no?></td>
							<td style="width:10%"><?=$cash_advance_list->advance_date?></td>
							<td><?=$cash_advance_list->debtor_code?> - <?=$cash_advance_list->debtor_name?></td>
							<td><?=$cash_advance_list->fare_trip_no?></td>
							<td style="text-align: right;"><?= number_format($cash_advance_list->advance_amount,2,$this->config->item('decimal_separator'),$this->config->item('thousand_separator'));?></td>
							<td style="text-align: right;"><?= number_format($cash_advance_list->advance_allocation,2,$this->config->item('decimal_separator'),$this->config->item('thousand_separator'));?></td>
							<td style="text-align: right;"><?= number_format($cash_advance_list->advance_balance,2,$this->config->item('decimal_separator'),$this->config->item('thousand_separator'));?></td>
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
 <!-- </aside>-->
  <!-- /.aside -->
 
 <select id="cost_code" panelHeight="auto" style="display:none;">
     <option value=" " disabled selected><?=lang('select_your_option')?></option>
	 <?php if (!empty($cost)) {
	  foreach ($cost as $rs) { ?>
	  <option value="<?php echo $rs->rowID;?>"><?php echo $rs->cost_cd.' - '.$rs->descs;?></option>
	 <?php }} ?>
 </select>
 
 <select id="ContType" panelHeight="auto" style="display:none;">
     <option value=" " disabled selected><?=lang('select_your_option')?></option>
     <option value="20">20 Fit</option>
     <option value="40">40 Fit</option>
     <option value="45">45 Fit</option>
 </select>
  
 <!-- Bootstrap modal -->
  <div class="modal fade" id="modal_realization" role="dialog">
  <div class="modal-dialog" style="width:1200px;height:200px;">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h3 class="modal-title"></h3>
      </div>
      <!--<section class="scrollable wrapper">-->
      <div class="modal-body form">
        <?=form_open('','autocomplete="off" id="form" class="form-horizontal"')?>

          <div class="form-body">
      				<div class="row"> 
					<div class="col-xs-6">
						<div class="group">	
							<div class="row inline-fields form-group form-md-line-input">
								<div class="col-md-4"><?=lang('date')?><span class="text-danger">*</span></div>
								<div class="col-md-1">:</div>
								<div class="col-md-6"><p>										
									<input  class="input-sm input-s datepicker-input form-control" size="10" type="text" value="<?=date('d-m-Y')?>" id="date" name="date" data-date-format="dd-mm-yyyy" required>
								</p></div>
							</div>	
							<div class="row inline-fields form-group form-md-line-input">
								<div class="col-md-4"><?=lang('cash_advance_no')?><span class="text-danger">*</span></div>
								<div class="col-md-1">:</div>
								<div class="col-md-6"><p>
									<input  type="hidden" class="form-control" id="prefix" name="prefix"  value="">
									<input  type="hidden" class="form-control" id="year" name="year" value="">
									<input  type="hidden" class="form-control" id="month" name="month" value="">
									<input  type="hidden" class="form-control" id="code" name="code"  value="">
									<input  type="hidden" class="form-control" id="counter_costcode" name="counter_costcode"  value="4">
                                    <input  type="hidden" class="form-control" id="cash_advance_date" name="cash_advance_date"  value="">
									<input  type="text" class="form-control" id="cash_advance_no" name="cash_advance_no" value="" readonly style="font-size:22px;font-weight:900;color: black;">
								</p></div>
																
							</div>
							<div class="row inline-fields form-group form-md-line-input">
								<div class="col-md-4"><?=lang('cash_advance_type')?><span class="text-danger">*</span></div>
								<div class="col-md-1">:</div>
								<div class="col-md-6"><p>
									<input  type="hidden" class="form-control" id="cash_advance_type_id" name="cash_advance_type_id"  value="">
									<input  type="text" class="form-control" id="cash_advance_type" name="cash_advance_type"  value="" readonly="">
							</p></div>
							</div>	
							<div class="row inline-fields form-group form-md-line-input">
								<div class="col-md-4"><?=lang('fare_trip')?><span class="text-danger">*</span></div>
								<div class="col-md-1">:</div>
								<div class="col-md-6"><p>
                                    <input  type="hidden" class="form-control" id="fare_trip_code" name="fare_trip_code"  value="">
                                    <input  type="hidden" class="form-control" id="fare_trip_id" name="fare_trip_id"  value="">
                                    <input  type="hidden" class="form-control" id="vehicle_type_id" name="vehicle_type_id"  value="">
                                    
									<textarea class="form-control" id="remark" name="remark" maxlength="60" rows="2"  readonly></textarea>
								</p></div>
							</div>			
							
						</div>
					</div>
					<div class="col-xs-6">
						<div class="group">	
							<div class="row inline-fields form-group form-md-line-input">
								<div class="col-md-4"><?=lang('cash_advance')?> <?=lang('amount')?><span class="text-danger">*</span></div>
								<div class="col-md-1">:</div>
								<div class="col-md-6"><p>
									<input  type="text" class="form-control" id="cash_advance_amt" name="cash_advance_amt" maxlength="9" style="font-size:22px;font-weight:900;color: black;text-align: right;" value="" readonly>
								</p></div>																
							</div>
							<div class="row inline-fields form-group form-md-line-input">
								<div class="col-md-4"><?=lang('cash_advance')?> <?=lang('settlement')?> <?=lang('amount')?><span class="text-danger">*</span></div>
								<div class="col-md-1">:</div>
								<div class="col-md-6"><p>
									<input  type="hidden" class="form-control" id="cash_advance_alloc_" name="cash_advance_alloc_" maxlength="9" style="font-size:22px;font-weight:900;color: black;text-align: right;" value="" readonly>
									<input  type="text" class="form-control" id="cash_advance_alloc" name="cash_advance_alloc" maxlength="9" style="font-size:22px;font-weight:900;color: black;text-align: right;" value="" readonly>
								</p></div>																
							</div>
							<div class="row inline-fields form-group form-md-line-input">
								<div class="col-md-4"><?=lang('cash_advance')?> <?=lang('balance')?><span class="text-danger">*</span></div>
								<div class="col-md-1">:</div>
								<div class="col-md-6"><p>
									<input  type="text" class="form-control" id="cash_advance_balance" name="cash_advance_balance" maxlength="9" style="font-size:22px;font-weight:900;color: black;text-align: right;" value="" readonly>
								</p></div>																
							</div>	
							<div class="row inline-fields form-group form-md-line-input">
								<div class="col-md-4"><?=lang('employee')?>/<?=lang('driver')?><span class="text-danger">*</span></div>
								<div class="col-md-1">:</div>
								<div class="col-md-6"><p>
									<input  type="hidden"  class="form-control" id="driver" name="driver"  value="">
									<input  type="text" onclick="tes()"  class="form-control" id="driver_name" name="driver_name"  value="" readonly >
								</p></div>
							</div>									
						</div>	
					</div>		

				</div>
            </div>
               <div class="bs-example">
                    <ul class="nav nav-tabs">
                        <li class="active"><a data-toggle="tab" href="#delivery_order"><?=lang('delivery_order') ?></a></li>
                        <li><a data-toggle="tab" href="#cost"><?=lang('cost_code_details') ?></a></li>
                    </ul>
                    <div class="tab-content">
                        <div id="delivery_order" class="tab-pane fade in active">
                        <br />
                          
                            <table align="center" border="0" style="height:200;"> 
                                <table cellspacing="0" cellpadding="0" style="width:100%;" id="detail_DO">
                                    <tr>
                                        <th class="ganjil"><?=lang('job_order_no')?></th>
                                        <th class="genap">Container</th>
                                        <th class="ganjil">Container No</th>
                                        <th class="genap"><?=lang('delivery_order_no')?></th>
                                        <th class="ganjil"><?=lang('delivery_order_date')?></th>
                                        <th class="genap"><?=lang('qty_delivery')?></th>
                                        <th class="ganjil"><?=lang('qty_receipt')?></th>
                                        <th class="genap"><?=lang('receipt_date')?></th>
                                        <th
                                        <input id="tamdet" title="Tambah Baris" type="button" onclick="addRow_DeliveryOrder()" value="&nbsp;" style="height:30px;width:30px;border;background-image:url('<?= base_url();?>resource/images/plus.png');background-repeat:no-repeat;" />
                                        </th>
                                    </tr>
                                </table>
                            </table>
                          
                        </div>
                        <div id="cost" class="tab-pane fade">
                        <br />
                        <p>
                        <a href="<?=base_url()?>finances/fare_trip_list" data-toggle="ajaxModal" title="<?=lang('fare_trip')?>" class="btn btn-info" role="button"><span class="glyphicon glyphicon-search"></span> Fare Trip List</a>
                        </p>
                         <table align="center" border="0" style="height:200;"> 
                                <table cellspacing="0" cellpadding="0" style="width:100%;" id="detail_cost">
                                    <tr>
                                        <th class="ganjil"><?=lang('cost')?></th>
                                        <th class="genap"><?=lang('description')?></th>
                                        <th class="ganjil"><?=lang('amount')?></th>
                                        <th>
                                        <input id="tamdetcost" title="Tambah Baris" type="button" onclick="addRow_Cost()" value="&nbsp;" style="height:30px;width:30px;border;background-image:url('<?= base_url();?>resource/images/plus.png');background-repeat:no-repeat;" />
                                        </th>
                                    </tr>
                                </table>
                            </table>
                        </div>
                    </div>
                </div>
        </form>
          </div>
          <!--</section>-->  
          <div class="modal-footer">
            <!--<input type="hidden" id="tag" value="">-->
            <button type="button" id="btnSave" onclick="save_cash_advance_realization()" class="btn green">Save</button>
            <button type="button" class="btn red" data-dismiss="modal">Cancel</button>
          </div>
        </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
  <!-- End Bootstrap modal -->
  
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
                  <table id="tbl-joborder" class="table table-striped table-hover b-t b-light text-sm">
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
                        <th>fare trip id</th>
                      </tr> 
					</thead>
					<tbody>
                      <?php
                      if (!empty($cash_advance_jo)) {
                      foreach ($cash_advance_jo as $rs) { ?>
                      <tr>
						<td><?=$rs->jo_no?></td>
						<td><?=$rs->jo_date?></td>
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
                        <td><?=$rs->fare_trip_rowID?></td>
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


<!-- Bootstrap modal Cash Advance Create-->
  <div class="modal fade" id="modal_create_ca" role="dialog">
  <div class="modal-dialog" style="width:1000px;height:200px;">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h3 class="modal-title"><?=lang('new')?> <?=lang('cash_advance')?></h3>
      </div>
      <div class="modal-body form">
        <?=form_open('','autocomplete="off" id="form_create_ca" class="form-horizontal"')?>
    				<div class="row"> 
					<div class="col-xs-6">
						<div class="group">	
							<div class="row inline-fields form-group form-md-line-input">
								<div class="col-md-4"><?=lang('date')?><span class="text-danger">*</span></div>
								<div class="col-md-1">:</div>
								<div class="col-md-6"><p>										
									<input type="text" class="datepicker-input form-control" id="date_ca" name="date_ca" value="<?=date('d-m-Y')?>"  data-date-format="dd-mm-yyyy" required readonly>
                                    <input type="hidden" id="advance_no" name="advance_no"/>
								</p></div>
							</div>	
							<div class="row inline-fields form-group form-md-line-input">
								<div class="col-md-4"><?=lang('cash_advance_type')?><span class="text-danger">*</span></div>
								<div class="col-md-1">:</div>
								<div class="col-md-6"><p>
                                    <select class="form-control" id="cash_advance_type2" name="cash_advance_type2"  required>
									<option value ="0"><?=lang('select')?><?=lang('cash_advance_type')?></option>
									<?php
										if (!empty($cash_advance_types)) {
											foreach ($cash_advance_types as $cash_advance_type) { ?>
											<option value="<?php echo $cash_advance_type->rowID; ?><?php echo $cash_advance_type->fare_trip; ?>"><?php echo $cash_advance_type->advance_cd;?> - <?php echo $cash_advance_type->advance_name;?></option>
									<?php }}?>
									</select>
								</p></div>
																
							</div>
							<div class="row inline-fields form-group form-md-line-input">
								<div class="col-md-4"><?=lang('fare_trip')?><span class="text-danger">*</span></div>
								<div class="col-md-1">:</div>
								<div class="col-md-6"><p>
									<select  class="form-control" id="fare_trip" name="fare_trip"  required>
									<option value ="0"><?=lang('select')?><?=lang('fare_trip')?></option>
									<?php
										if (!empty($fare_trips)) {
											foreach ($fare_trips as $fare_trip) { ?>
											<option value="<?php echo $fare_trip->rowID;?>"><?php echo $fare_trip->fare_trip_cd;?></option>
									<?php }}?>
									</select>
							</p></div>
							</div>	
							<div class="row inline-fields form-group form-md-line-input">
								<div class="col-md-4"></div>
								<div class="col-md-1"></div>
								<div class="col-md-6"><p>
									<textarea class="form-control"  id="fare_trip_dtl" name="fare_trip_dtl" maxlength="60" rows="2" readonly></textarea>
								</p></div>
							</div>
							<div class="row inline-fields form-group form-md-line-input">
								<div class="col-md-4"><?=lang('vehicle')?><span class="text-danger">*</span></div>
								<div class="col-md-1">:</div>
								<div class="col-md-6"><p>
									<select  class="form-control all_select2" id="vehicle" name="vehicle"  required>
									<option value ="0"><?=lang('select')?><?=lang('vehicle')?></option>
									<?php
										if (!empty($vehicles)) {
											foreach ($vehicles as $vehicle) { ?>
											<option value="<?php echo $vehicle->rowID;?>"><?php echo $vehicle->police_no;?></option>
									<?php }}?>
									</select>	
								</p></div>
							</div>	
							<div class="row inline-fields form-group form-md-line-input">
								<div class="col-md-4"><?=lang('vehicle_category')?><span class="text-danger">*</span></div>
								<div class="col-md-1">:</div>
								<div class="col-md-6"><p>
									<select  class="form-control all_select2" id="vehicle_category" name="vehicle_category"  required>
									<option value ="0"><?=lang('select')?><?=lang('vehicle_category')?></option>
									</select>
								</p></div>
							</div>			
							
						</div>
					</div>
					<div class="col-xs-6">
						<div class="group">	
							<div class="row inline-fields form-group form-md-line-input">
								<div class="col-md-4"><?=lang('employee')?>/<?=lang('driver')?><span class="text-danger">*</span></div>
								<div class="col-md-1">:</div>
								<div class="col-md-6"><p>
								    <select  class="form-control" id="driver2" name="driver2"  required>
									<option value ="0"><?=lang('select')?><?=lang('employee')?>/<?=lang('driver')?></option>
									</select>
								</p></div>																
							</div>
							<div class="row inline-fields form-group form-md-line-input">
								<div class="col-md-4"><?=lang('amount')?><span class="text-danger">*</span></div>
								<div class="col-md-1">:</div>
								<div class="col-md-6"><p>
									<input  type="text" class="form-control" id="amount" name="amount" maxlength="10" readonly="" onKeyPress="return isNumberKey(event)"  onClick="if(this.value!='0'&&this.value!=''){this.value=number_format(this.value,0,'','','deformat');}else{if(this.value==''){this.value='';}}" onBlur="if(this.value!='0'&&this.value!=''&&this.value.indexOf('.') ==-1){this.value=number_format(this.value,0,',','.','format');}else{if(this.value.indexOf('.')>0){}else{}}" style="font-size:22px;font-weight:900;color: black;text-align: right;" value="0" autocomplete="off" required>
								</p></div>																
							</div>
                            <div class="row inline-fields form-group form-md-line-input">
								<div class="col-md-4"><?=lang('extra_amount')?><span class="text-danger">*</span></div>
								<div class="col-md-1">:</div>
								<div class="col-md-6"><p>
									<input  type="text" class="form-control" id="extra_amount" name="extra_amount" maxlength="10" onKeyPress="return isNumberKey(event)"  onClick="if(this.value!='0'&&this.value!=''){this.value=number_format(this.value,0,'','','deformat');}else{if(this.value==''){this.value='';}}" onBlur="if(this.value!='0'&&this.value!=''&&this.value.indexOf('.') ==-1){this.value=number_format(this.value,0,',','.','format');}else{if(this.value.indexOf('.')>0){}else{}}" style="font-size:22px;font-weight:900;color: black;text-align: right;" value="0" autocomplete="off" required>
								</p></div>																
							</div>
							<div class="row inline-fields form-group form-md-line-input">
								<div class="col-md-4"><?=lang('description')?><span class="text-danger">*</span></div>
								<div class="col-md-1">:</div>
								<div class="col-md-6"><p>
									<textarea class="form-control"  id="cash_advance_desc" name="cash_advance_desc" maxlength="255" rows="5"></textarea>
								</p></div>																
							</div>										
						</div>	
					</div>		
				</div>

                        
        </form>
          </div>
          <div class="modal-footer">
            <button type="button" id="btnSave" onclick="save_cash_advance()" class="btn green">Save</button>
            <button type="button" class="btn red" data-dismiss="modal">Cancel</button>
          </div>
        </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->



</section>
<a href="#" class="hide nav-off-screen-block" data-toggle="class:nav-off-screen, open" data-target="#nav,html"></a>
</section>