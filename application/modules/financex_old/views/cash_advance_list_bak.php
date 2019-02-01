<section id="content">
  <section class="hbox stretch">
 
    <!-- .aside -->
    <!--<aside>-->
      <section class="vbox">
        <header class="header bg-white b-b b-light">
          <a href="<?php echo base_url().'finances/create_cash_advance'; ?>"  class="btn btn-sm green pull-right"><i class="fa fa-plus"></i><?=lang('new')?>  <?=lang('cash_advance')?></a>
          <a href="<?php echo base_url().'finances/print_ca'; ?>"  class="btn btn-sm green pull-right"><i class="fa fa-plus"></i>print</a>
          <p><?=lang('cash_advance_list')?></p>
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
									<li><a href="<?=base_url()?>finances/view_cash_advance/<?=$cash_advance_list['year']?>/<?=$cash_advance_list['month']?>/<?=$cash_advance_list['code']?>"><i class="fa fa-eye"></i>  <?=lang('view_cashadvance_option')?></a></li>
									<?php 
									if($cash_advance_list['advance_allocation']==0){
									?>
										<li><a href="<?=base_url()?>finances/delete_cash_advance/<?=$this->encrypt->encode($cash_advance_list['prefix'])?>/<?=$this->encrypt->encode($cash_advance_list['year'])?>/<?=$this->encrypt->encode($cash_advance_list['month'])?>/<?=$this->encrypt->encode($cash_advance_list['code'])?>" data-toggle="ajaxModal"><i class="fa fa-trash-o"></i>  <?=lang('delete_option')?></a></li>
									<?php }?>
									<?php 
									if($cash_advance_list['advance_balance']>0){

									?>
                                        <li><a  href="javascript:void()" title="<?=lang('update_option')?>" onclick="edit_realization(<?=$cash_advance_list?>)"><i class="fa fa-file-code-o"></i><?=lang('realization_option')?></a></li>
										<li><a href="<?=base_url()?>finances/create_realization_hdr/<?=$this->encrypt->encode($cash_advance_list['prefix'])?>/<?=$this->encrypt->encode($cash_advance_list['year'])?>/<?=$this->encrypt->encode($cash_advance_list['month'])?>/<?=$this->encrypt->encode($cash_advance_list['code'])?>"><i class="fa fa-file-code-o"></i>  <?=lang('realization_option')?></a></li>
										<li><a href="<?=base_url()?>finances/create_refund_hdr"><i class="fa fa-money"></i>  <?=lang('refund_option')?></a></li>
									<?php }?>		

									<li><a href="<?=base_url()?>finances/view_realization_list/<?=$this->encrypt->encode($cash_advance_list['prefix'])?>/<?=$this->encrypt->encode($cash_advance_list['year'])?>/<?=$this->encrypt->encode($cash_advance_list['month'])?>/<?=$this->encrypt->encode($cash_advance_list['code'])?>"><i class="fa  fa-eye"></i>  <?=lang('view_realization_option')?></a></li>
									<li><a href="<?=base_url()?>finances/view_refund_list/<?=$this->encrypt->encode($cash_advance_list['prefix'])?>/<?=$this->encrypt->encode($cash_advance_list['year'])?>/<?=$this->encrypt->encode($cash_advance_list['month'])?>/<?=$this->encrypt->encode($cash_advance_list['code'])?>"><i class="fa  fa-eye"></i><i class="fa  fa-money"></i>  <?=lang('view_refund_option')?></a></li>

									
								</ul>
							  </div>
							</td>					  
							<td><?=$cash_advance_list['advance_no']?></td>
							<td style="width:10%"><?=$cash_advance_list['advance_date']?></td>
							<td><?=$cash_advance_list['debtor_code']?> - <?=$cash_advance_list['debtor_name']?></td>
							<td><?=$cash_advance_list['fare_trip_no']?></td>
							<td style="text-align: right;"><?= number_format($cash_advance_list['advance_amount'],2,$this->config->item('decimal_separator'),$this->config->item('thousand_separator'));?></td>
							<td style="text-align: right;"><?= number_format($cash_advance_list['advance_allocation'],2,$this->config->item('decimal_separator'),$this->config->item('thousand_separator'));?></td>
							<td style="text-align: right;"><?= number_format($cash_advance_list['advance_balance'],2,$this->config->item('decimal_separator'),$this->config->item('thousand_separator'));?></td>
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
 
 
  
 <!-- Bootstrap modal -->
  <div class="modal fade" id="modal_realization" role="dialog">
  <div class="modal-dialog" style="width:1200px;height:200px;">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h3 class="modal-title"></h3>
      </div>
      <section class="scrollable wrapper">
      <div class="modal-body form">
        <form action="#" id="form" class="form-horizontal">
          <div class="form-body">
      				<div class="row"> 
					<div class="col-xs-6">
						<div class="group">	
							<div class="row inline-fields form-group form-md-line-input">
								<div class="col-md-4"><?=lang('date')?><span class="text-danger">*</span></div>
								<div class="col-md-1">:</div>
								<div class="col-md-6"><p>										
									<input  class="input-sm input-s datepicker-input form-control" size="10" type="text" value="<?=date('d-m-Y')?>" id="date" name="date" data-date-format="dd-mm-yyyy" required>
                                    <input type="hidden" id="tag" value="">
								</p></div>
							</div>	
							<div class="row inline-fields form-group form-md-line-input">
								<div class="col-md-4"><?=lang('cash_advance_no')?><span class="text-danger">*</span></div>
								<div class="col-md-1">:</div>
								<div class="col-md-6"><p>
									<input  type="hidden" class="form-control" id="prefix" name="prefix"  value="<?=$cash_advance_detail['prefix']?>">
									<input  type="hidden" class="form-control" id="year" name="year" value="<?=$cash_advance_detail['year']?>">
									<input  type="hidden" class="form-control" id="month" name="month" value="<?=$cash_advance_detail['month']?>">
									<input  type="hidden" class="form-control" id="code" name="code"  value="<?=$cash_advance_detail['code']?>">
									<input  type="hidden" class="form-control" id="counter_costcode" name="counter_costcode"  value="4">
									<input  type="text" class="form-control" id="cash_advance_no" name="cash_advance_no" value="<?=$cash_advance_detail['advance_no']?>" readonly style="font-size:22px;font-weight:900;color: black;">
								</p></div>
																
							</div>
							<div class="row inline-fields form-group form-md-line-input">
								<div class="col-md-4"><?=lang('cash_advance_type')?><span class="text-danger">*</span></div>
								<div class="col-md-1">:</div>
								<div class="col-md-6"><p>
									<input  type="hidden" class="form-control" id="cash_advance_type_id" name="cash_advance_type_id"  value="<?=$cash_advance_detail['advance_type_rowID']?>">
									<input  type="text" class="form-control" id="cash_advance_type" name="cash_advance_type"  value="<?=$cash_advance_detail['advance_name']?>" disabled>
							</p></div>
							</div>	
							<div class="row inline-fields form-group form-md-line-input">
								<div class="col-md-4"><?=lang('fare_trip')?><span class="text-danger">*</span></div>
								<div class="col-md-1">:</div>
								<div class="col-md-6"><p>
									<textarea class="form-control"  maxlength="60" rows="2"  readonly><?=$cash_advance_detail['fare_trip_no']?> (<?=$cash_advance_detail['destination_from_name']?> KE <?=$cash_advance_detail['destination_to_name']?>)</textarea>
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
									<input  type="text" class="form-control" id="cash_advance_amt" name="cash_advance_amt" maxlength="9" style="font-size:22px;font-weight:900;color: black;text-align: right;" value="<?=number_format($cash_advance_detail['advance_amount'], 0, ',', '.')?>" readonly>
								</p></div>																
							</div>
							<div class="row inline-fields form-group form-md-line-input">
								<div class="col-md-4"><?=lang('cash_advance')?> <?=lang('settlement')?> <?=lang('amount')?><span class="text-danger">*</span></div>
								<div class="col-md-1">:</div>
								<div class="col-md-6"><p>
									<input  type="hidden" class="form-control" id="cash_advance_alloc_" name="cash_advance_alloc_" maxlength="9" style="font-size:22px;font-weight:900;color: black;text-align: right;" value="<?=$cash_advance_detail['advance_allocation']?>" readonly>
									<input  type="text" class="form-control" id="cash_advance_alloc" name="cash_advance_alloc" maxlength="9" style="font-size:22px;font-weight:900;color: black;text-align: right;" value="<?=number_format($cash_advance_detail['advance_allocation'], 0, ',', '.')?>" readonly>
								</p></div>																
							</div>
							<div class="row inline-fields form-group form-md-line-input">
								<div class="col-md-4"><?=lang('cash_advance')?> <?=lang('balance')?><span class="text-danger">*</span></div>
								<div class="col-md-1">:</div>
								<div class="col-md-6"><p>
									<input  type="text" class="form-control" id="cash_advance_balance" name="cash_advance_balance" maxlength="9" style="font-size:22px;font-weight:900;color: black;text-align: right;" value="<?=number_format($cash_advance_detail['advance_balance'], 0, ',', '.')?>" readonly>
								</p></div>																
							</div>	
							<div class="row inline-fields form-group form-md-line-input">
								<div class="col-md-4"><?=lang('employee')?>/<?=lang('driver')?><span class="text-danger">*</span></div>
								<div class="col-md-1">:</div>
								<div class="col-md-6"><p>
									<input  type="hidden" class="form-control" id="driver" name="driver"  value="<?=$cash_advance_detail['employee_driver_rowID']?>">
									<input   type="text" class="form-control" id="driver_name" name="driver_name"  value="<?=$cash_advance_detail['debtor_name']?>/<?php echo ($cash_advance_detail['debtor_type'] == 'E') ? 'EMPLOYEE' : 'DRIVER';?>/<?=$cash_advance_detail['id_no']?>" readonly >
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
                          <section class="scrollable wrapper">
                            <table align="center" border="0" style="height:200;"> 
                                <table cellspacing="0" cellpadding="0" style="width:100%;" id="detail_DO">
                                    <tr>
                                        <th class="ganjil"><?=lang('job_order_no')?></th>
                                        <th class="genap"></label></a><?=lang('delivery_order_no')?></th>
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
                          </section>
                        </div>
                        <div id="cost" class="tab-pane fade">
                            <h3>Section B</h3>
                            <p>Vestibulum nec erat eu nulla rhoncus fringilla ut non neque. Vivamus nibh urna, ornare id gravida ut, mollis a magna. Aliquam porttitor condimentum nisi, eu viverra ipsum porta ut. Nam hendrerit bibendum turpis, sed molestie mi fermentum id. Aenean volutpat velit sem. Sed consequat ante in rutrum convallis. Nunc facilisis leo at faucibus adipiscing.</p>
                        </div>
                    </div>
                </div>   
        </form>
          </div>
          </section>  
          <div class="modal-footer">
            <button type="button" id="btnSave" onclick="save()" class="btn green">Save</button>
            <button type="button" class="btn red" data-dismiss="modal">Cancel</button>
          </div>
        </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
  <!-- End Bootstrap modal -->
  
  <!-- Modal JO-->
  <div class="modal fade" id="joModal" role="dialog">
    <div class="modal-dialog" style="width:800px;height:30px;">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Job Order</h4>
        </div>
        <div class="modal-body">
          <section class="scrollable wrapper">
          <div class="row">
            <div class="col-lg-12">
              <section class="panel panel-default">
                <div class="table-responsive"><?php echo validation_errors(); ?>
                  <table id="project2" class="table table-striped table-hover b-t b-light text-sm" cellspacing="0" width="100%" >
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
                    </tr>
                    <?php } } ?>
                  </tbody>
                </table>
              </div>
            </section>            
          </div>
        </div>
      </section>
    </div>
</div>
</div>
</div>

</section>
<a href="#" class="hide nav-off-screen-block" data-toggle="class:nav-off-screen, open" data-target="#nav,html"></a>
</section>