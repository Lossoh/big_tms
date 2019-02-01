
<section id="content">
  <section class="hbox stretch">
 
    <!-- .aside -->
    <!--<aside>-->
      <section class="vbox">
        <header class="header bg-white b-b b-light">
            <div class="row" style="padding-top: 10px;">
                <div class="col-md-5">
                    <p class="">Cash Advance (CA) List</p>                    
                </div>     
                <div class="col-md-7">
                    <?=form_open(base_url().'finances/set_filter','autocomplete="off" id="form_period" class="form-horizontal"')?>
                    
                    <div class="input-group input-daterange" style="position: relative;display: inline-flex;">
                        <input type="text" name="start_date" id="start_date" class="form-control input-sm tanggal_datetimepicker" placeholder="<?=lang('start_date')?>" value="<?=date('d-m-Y', strtotime($start_date))?>">
                        <span class="input-group-addon" style="width: 50px;">to</span>
                        <input type="text" name="end_date" id="end_date" class="form-control input-sm tanggal_datetimepicker" placeholder="<?=lang('end_date')?>" value="<?=date('d-m-Y', strtotime($end_date))?>">
                    </div>
                    <button type="submit" class="btn btn-sm btn-info"><i class="fa fa-search"></i> Search</button> &nbsp;
                    <?php
                    if($this->user_profile->get_user_access('Created') == 1){
                    ?>
                    <a  class="btn btn-sm green" onclick="add_cash_advance()"><i class="fa fa-plus"></i> <?=lang('new')?>  <?=lang('cash_advance')?></a>
                    <?php
                    }
                    ?>
                    <?=form_close()?>
                </div>
            </div>
        </header>
        <div class="clearfix"></div>
        <section class="scrollable wrapper" style="margin-top: 12px;">
          <div class="row">
            <div class="col-lg-12">
                <ul class="nav nav-tabs" role="tablist">
                    <li role="presentation" class="active"><a href="#pending" aria-controls="pending" role="tab" data-toggle="tab">PENDING <span class="badge"><?=count($cash_advance_lists)?></span></a></li>
                    <li role="presentation"><a href="#done" aria-controls="done" role="tab" data-toggle="tab">DONE <span class="badge"><?=count($cash_advance_lists_bonus_nol)?></span></a></li>
                </ul>
                <div class="tab-content">
                    <div role="tabpanel" class="tab-pane fade in active" id="pending">
                        <section class="panel panel-default">
                            <div class="table-responsive"><?php echo validation_errors(); ?>
                              <table id="tbl-orders" class="table table-striped table-hover b-t b-light text-sm">
                                <thead>
                                  <tr>
            						<th><?=lang('options')?></th>
                                    <th><?=lang('cash_advance_no')?></th>
            						<th>CA <?=lang('date')?></th>
            						<th><?=lang('driver')?>/<?=lang('employee')?> Name</th>
            						<th><?=lang('fare_trip_code')?></th>
                                    <th width="10%">Police No</th>
            						<th><?=lang('cash_advance_amt')?></th>
            						<th><?=lang('extra_amount')?></th>
            						<th>Addendum</th>
            						<th><?=lang('cash_advance_alloc')?></th>
            						<th><?=lang('balance')?></th>
                                  </tr> 
            					</thead>
            					<tbody>
                                  <?php
                                  if (!empty($cash_advance_lists)) {
                                  foreach ($cash_advance_lists as $cash_advance_list) { 
                                    $total_balance = ($cash_advance_list->advance_amount + $cash_advance_list->advance_extra_amount + $cash_advance_list->pay_over_allocation) - $cash_advance_list->advance_allocation;
                                    $get_memo = $this->finances_model->get_memo_by_advance_no($cash_advance_list->advance_no);
                                  ?>
                                  <tr <?=count($get_memo) > 0 ? 'style="color:#ceb813;font-weight:bold"' : '' ?>>
            						  <td>
            							  <div class="btn-group">
            								<button class="btn btn-xs btn-default dropdown-toggle" data-toggle="dropdown">
            								 <?=lang('options')?>
            								<span class="caret"></span>
            								</button>
            								<ul class="dropdown-menu">
            									<?php
                                                if($this->user_profile->get_user_access('Viewed') == 1){
                                                ?>
                                                    <li><a href="<?=base_url()?>finances/view_cash_advance/<?=$cash_advance_list->rowID?>" title="<?=lang('view_cashadvance_option')?>" ><i class="fa fa-eye"></i> <?=lang('view_cashadvance_option')?></a></li>
                                                <?php
                                                }
                                                ?>
                                                <li><a href="javascript:void()" title="Memo" onclick="memo_ca('<?=$cash_advance_list->advance_no ?>')"><i class="fa fa-sticky-note"></i> Memo</a></li>
                                                <?php
                                                if($this->user_profile->get_user_access('Created') == 1){
                                                ?>
                                                    <li><a href="<?=base_url()?>finances/create_refund_hdr" title="Create <?=lang('refund_option')?>" ><i class="fa fa-money"></i> Create <?=lang('refund_option')?></a></li>
            									<?php
                                                }
                                                
            									if($total_balance > 0){
								                    if($cash_advance_list->trx_no == ''){
								                        if($this->user_profile->get_user_access('Created') == 1){
                                                ?>
                                                            <li><a href="javascript:void()" title="<?=lang('realization_option')?>" onclick="edit_realization('<?=$cash_advance_list->prefix ?>','<?=$cash_advance_list->year ?>','<?=$cash_advance_list->month ?>',<?=$cash_advance_list->code ?>)"><i class="fa fa-usd"></i> <?=lang('realization_option')?></a></li>
            									<?php 
                                                        }
                                                    }
                                                    else{
                                                        if($this->user_profile->get_user_access('PrintLimited') == 1 || $this->user_profile->get_user_access('PrintUnlimited') == 1 || 
                                                            $this->user_profile->get_user_access('PrintOne') == 1 || $this->user_profile->get_user_access('PrintTwo') == 1){
                                                            if($this->user_profile->get_user_access('PrintLimited') == 1){
                                                                if($this->user_profile->get_log_limited_printed($cash_advance_list->trx_no,'Finances->Print Realization') == 0){
                                                ?>
                                                                    <li><a title="<?=lang('view_realization_option')?>" href="<?=base_url()?>finances/view_realization/<?=$this->encrypt->encode($cash_advance_list->trx_no)?>" target="_blank"><i class="fa fa-eye"></i>  <?=lang('view_realization_option')?></a></li>
                                                <?php
                                                                }
                                                            }
                                                            else{
                                                ?>
                    									       <li><a title="<?=lang('view_realization_option')?>" href="<?=base_url()?>finances/view_realization/<?=$this->encrypt->encode($cash_advance_list->trx_no)?>" target="_blank"><i class="fa fa-eye"></i>  <?=lang('view_realization_option')?></a></li>
                    									       <!--<li><a href="<?=base_url()?>finances/view_refund/<?=$this->encrypt->encode($cash_advance_list->prefix)?>/<?=$this->encrypt->encode($cash_advance_list->year)?>/<?=$this->encrypt->encode($cash_advance_list->month)?>/<?=$this->encrypt->encode($cash_advance_list->code)?>" target="_blank"><i class="fa  fa-eye"></i> <?=lang('view_refund_option')?></a></li>-->
                                                <?php
                                                            }
                                                        }
                                                    }
                                                }
                                                else{
                                                    if($this->user_profile->get_user_access('PrintLimited') == 1 || $this->user_profile->get_user_access('PrintUnlimited') == 1 || 
                                                        $this->user_profile->get_user_access('PrintOne') == 1 || $this->user_profile->get_user_access('PrintTwo') == 1){
                                                        if($this->user_profile->get_user_access('PrintLimited') == 1){
                                                            if($this->user_profile->get_log_limited_printed($cash_advance_list->trx_no,'Finances->Print Realization') == 0){
                                                ?>
                                                                <li><a title="<?=lang('view_realization_option')?>" href="<?=base_url()?>finances/view_realization/<?=$this->encrypt->encode($cash_advance_list->trx_no)?>" target="_blank"><i class="fa fa-eye"></i>  <?=lang('view_realization_option')?></a></li>
                                                <?php
                                                            }
                                                        }
                                                        else{
                                                ?>
                    									<li><a title="<?=lang('view_realization_option')?>" href="<?=base_url()?>finances/view_realization/<?=$this->encrypt->encode($cash_advance_list->trx_no)?>" target="_blank"><i class="fa fa-eye"></i>  <?=lang('view_realization_option')?></a></li>
                    									<!--<li><a href="<?=base_url()?>finances/view_refund/<?=$this->encrypt->encode($cash_advance_list->prefix)?>/<?=$this->encrypt->encode($cash_advance_list->year)?>/<?=$this->encrypt->encode($cash_advance_list->month)?>/<?=$this->encrypt->encode($cash_advance_list->code)?>" target="_blank"><i class="fa  fa-eye"></i> <?=lang('view_refund_option')?></a></li>-->
                                                <?php
                                                        }
                                                    }
                                                }
                                                if($this->user_profile->get_user_access('Created') == 1){
                                                ?>
                                                    <li><a href="javascript:void()" title="Cancel Load" onclick="CancelLoad('<?=$cash_advance_list->advance_no ?>')"><i class="fa fa-times"></i> Cancel Load</a></li>
            									<?php
                                                }
                                                $advance_allocation=$cash_advance_list->advance_allocation;
            									if($advance_allocation == 0){
  									                if($this->user_profile->get_user_access('Deleted') == 1){
            									?>
            										  <li><a title="<?=lang('delete_option')?>" href="<?=base_url()?>finances/delete_cash_advance/<?=$this->encrypt->encode($cash_advance_list->prefix)?>/<?=$this->encrypt->encode($cash_advance_list->year)?>/<?=$this->encrypt->encode($cash_advance_list->month)?>/<?=$this->encrypt->encode($cash_advance_list->code)?>" data-toggle="ajaxModal"><i class="fa fa-trash-o"></i>  <?=lang('delete_option')?></a></li>
            									<?php 
                                                    }
                                                }
                                                ?>		
            									
            								</ul>
            							  </div>
            							</td>	
                  			            <td><?=$cash_advance_list->advance_no?></td>
            							<td style="width:10%"><?=date("d-m-Y H:i:s",strtotime($cash_advance_list->advance_date.' '.$cash_advance_list->time_created))?></td>
            							<td><?=$cash_advance_list->debtor_code?> - <?=$cash_advance_list->debtor_name?></td>
            							<td><?=$cash_advance_list->fare_trip_no == '' ? '-' : $cash_advance_list->fare_trip_no?></td>
                                        <td align="center">
                                            <?php
                                            $vehicle = $this->finances_model->get_position_vehicle_by_row_id($cash_advance_list->vehicle_rowID);
                                            $status = '';
                                            $color = '';
                                            if($vehicle->status == '11' && $vehicle->speed > 0 ){
                                                $status = 'Jalan';
                                                $color = "background-color:#5cb85c;";
                                            }
                                            else if($vehicle->status == '11' && $vehicle->speed <= 0 ){
                                                $status = 'Macet/Antri/Parkir';
                                                $color = "background-color:#eac545;";
                                            }
                                            else if($vehicle->status == '01' && $vehicle->speed <= 0 ){
                                                $status = 'Makan AKI';
                                                $color = "background-color:#57b9f8;";
                                            }
                                            else if($vehicle->status == '00' && $vehicle->speed <= 0 ){
                                                $status = 'Berhenti';
                                                $color = "background-color:#f94c4c;";
                                            }
                                            else if($vehicle->status == '10' && $vehicle->speed > 0 ){
                                                $status = 'Check Instalasi ACC & Engine';
                                                $color = "background-color:#000;";
                                            }
                                            else if($vehicle->status == '10' && $vehicle->speed <= 0 ){
                                                $status = 'Mohon diperiksa';
                                                $color = "background-color:#1BDAC5;";
                                            }
                                            else{
                                                $status = 'Data Tidak Tersedia';
                                                $color = "background-color:#B0B0B0;";
                                            }
                                            
                                            if($status != 'Data Tidak Tersedia'){
                                                if(date('Y-m-d',strtotime($vehicle->datetime_gps)) != date('Y-m-d')){
                                                    $status = 'Out Of The Date';
                                                    $color = "background-color:#B0B0B0;";
                                                }
                                            }
                                            
                                            $star = '';
                                            if($cash_advance_list->vehicle_photo == ''){
                                                $star = '*';
                                            }
                                            
                                            $speed = empty($vehicle->speed) ? 0 : $vehicle->speed;
                            
                                            //echo "<a href='javascript:void()' title='".$status."' onclick=\"showPositionVehicle('".$cash_advance_list->police_no."','".$status."','".$vehicle->latitude.",".$vehicle->longitude."','".$vehicle->time_gps."','".$vehicle->latitude."','".$vehicle->longitude."')\">
                                            echo "<a href='javascript:void()' title='".$status."' onclick=\"showDetailPositionVehicle('".$cash_advance_list->vehicle_rowID."')\">
                                                    <span class='badge' style='".$color."'>".$cash_advance_list->police_no.' '.$star."</span></a>
                                                <br>".$speed.' km/h';    
                                            ?>
                                        </td>
            							<td style="text-align: right;"><?= number_format($cash_advance_list->advance_amount,0,$this->config->item('decimal_separator'),$this->config->item('thousand_separator'));?></td>
            							<td style="text-align: right;"><?= number_format($cash_advance_list->advance_extra_amount,0,$this->config->item('decimal_separator'),$this->config->item('thousand_separator'));?></td>
            							<td style="text-align: right;"><?= number_format($cash_advance_list->pay_over_allocation,0,',','.');?></td>
            							<td style="text-align: right;"><?= number_format($cash_advance_list->advance_allocation,0,$this->config->item('decimal_separator'),$this->config->item('thousand_separator'));?></td>
            							<td style="text-align: right;"><?= number_format($total_balance,0,$this->config->item('decimal_separator'),$this->config->item('thousand_separator'));?></td>
                                </tr>
                                <?php } } ?>
                              </tbody>
                            </table>
            
                          </div>
                        </section>  
                    </div>
                    <div role="tabpanel" class="tab-pane fade" id="done">
                        <section class="panel panel-default">
                           <div class="table-responsive"><?php echo validation_errors(); ?>
                              <table id="tbl-ca-bonus" class="table table-striped table-hover b-t b-light text-sm" style="width: 100%;">
                                <thead>
                                  <tr>
            						<th><?=lang('options')?></th>
                                    <th><?=lang('cash_advance_no')?></th>
            						<th><?=lang('date')?></th>
            						<th><?=lang('driver')?>/<?=lang('employee')?> Name</th>
            						<th><?=lang('fare_trip_code')?></th>
            						<th width="10%">Police No</th>
            						<th><?=lang('cash_advance_amt')?></th>
            						<th><?=lang('extra_amount')?></th>
            						<th>Addendum</th>
            						<th><?=lang('cash_advance_alloc')?></th>
            						<th><?=lang('balance')?></th>
                                  </tr> 
            					</thead>
            					<tbody>
                                  <?php
                                  if (!empty($cash_advance_lists_bonus_nol)) {
                                  foreach ($cash_advance_lists_bonus_nol as $cash_advance_list) { 
                                    $total_balance = ($cash_advance_list->advance_amount + $cash_advance_list->advance_extra_amount + $cash_advance_list->pay_over_allocation) - $cash_advance_list->advance_allocation;
                                    $get_memo = $this->finances_model->get_memo_by_advance_no($cash_advance_list->advance_no);
                                  ?>
                                  <tr <?=count($get_memo) > 0 ? 'style="color:#ceb813;font-weight:bold"' : '' ?>>
            						  <td>
            							  <div class="btn-group">
            								<button class="btn btn-xs btn-default dropdown-toggle" data-toggle="dropdown">
            								 <?=lang('options')?>
            								<span class="caret"></span>
            								</button>
            								<ul class="dropdown-menu">
                                                <?php
                                                if($this->user_profile->get_user_access('Viewed') == 1){
                                                ?>
            									   <li><a href="<?=base_url()?>finances/view_cash_advance/<?=$cash_advance_list->rowID?>" title="<?=lang('view_cashadvance_option')?>" ><i class="fa fa-eye"></i> <?=lang('view_cashadvance_option')?></a></li>
                                                <?php
                                                }
                                                ?>
                                                <li><a href="javascript:void()" title="Memo" onclick="memo_ca('<?=$cash_advance_list->advance_no ?>')"><i class="fa fa-sticky-note"></i> Memo</a></li>
                                                <?php
                                                if($this->user_profile->get_user_access('Created') == 1){
                                                ?>
                                                    <li><a href="<?=base_url()?>finances/create_refund_hdr" title="Create <?=lang('refund_option')?>" ><i class="fa fa-money"></i> Create <?=lang('refund_option')?></a></li>
            									<?php
                                                } 
                                                $advance_allocation=$cash_advance_list->advance_allocation;
            									if($advance_allocation == 0){
            									    if($this->user_profile->get_user_access('Deleted') == 1){
                                                ?>
            										  <li><a title="<?=lang('delete_option')?>" href="<?=base_url()?>finances/delete_cash_advance/<?=$this->encrypt->encode($cash_advance_list->prefix)?>/<?=$this->encrypt->encode($cash_advance_list->year)?>/<?=$this->encrypt->encode($cash_advance_list->month)?>/<?=$this->encrypt->encode($cash_advance_list->code)?>" data-toggle="ajaxModal"><i class="fa fa-trash-o"></i>  <?=lang('delete_option')?></a></li>
            									<?php 
                                                    }
                                                }
                                                if($this->user_profile->get_user_access('PrintLimited') == 1 || $this->user_profile->get_user_access('PrintUnlimited') == 1 || 
                                                    $this->user_profile->get_user_access('PrintOne') == 1 || $this->user_profile->get_user_access('PrintTwo') == 1){
                                                    if($this->user_profile->get_user_access('PrintLimited') == 1){
                                                        if($this->user_profile->get_log_limited_printed($cash_advance_list->trx_no,'Finances->Print Realization') == 0){
                                                ?>
                                                            <li><a title="<?=lang('view_realization_option')?>" href="<?=base_url()?>finances/view_realization/<?=$this->encrypt->encode($cash_advance_list->trx_no)?>" target="_blank"><i class="fa fa-eye"></i>  <?=lang('view_realization_option')?></a></li>
                                                <?php
                                                        }
                                                    }
                                                    else{
                                                ?>
            									       <li><a title="<?=lang('view_realization_option')?>" href="<?=base_url()?>finances/view_realization/<?=$this->encrypt->encode($cash_advance_list->trx_no)?>" target="_blank"><i class="fa fa-eye"></i>  <?=lang('view_realization_option')?></a></li>
            									       <!--<li><a href="<?=base_url()?>finances/view_refund/<?=$this->encrypt->encode($cash_advance_list->prefix)?>/<?=$this->encrypt->encode($cash_advance_list->year)?>/<?=$this->encrypt->encode($cash_advance_list->month)?>/<?=$this->encrypt->encode($cash_advance_list->code)?>" target="_blank"><i class="fa  fa-eye"></i> <?=lang('view_refund_option')?></a></li>-->
                                                <?php
                                                    }
                                                }
                                                ?>
            								</ul>
            							  </div>
            							</td>					  
            							<td><?=$cash_advance_list->advance_no?></td>
            							<td style="width:10%"><?=date("d-m-Y H:i:s",strtotime($cash_advance_list->advance_date.' '.$cash_advance_list->time_created))?></td>
            							<td><?=$cash_advance_list->debtor_code?> - <?=$cash_advance_list->debtor_name?></td>
            							<td><?=$cash_advance_list->fare_trip_no == '' ? '-' : $cash_advance_list->fare_trip_no?></td>
            							<td align="center">
                                            <?php
                                            $vehicle = $this->finances_model->get_position_vehicle_by_row_id($cash_advance_list->vehicle_rowID);
                                            $status = '';
                                            $color = '';
                                            if($vehicle->status == '11' && $vehicle->speed > 0 ){
                                                $status = 'Jalan';
                                                $color = "background-color:#5cb85c;";
                                            }
                                            else if($vehicle->status == '11' && $vehicle->speed <= 0 ){
                                                $status = 'Macet/Antri/Parkir';
                                                $color = "background-color:#eac545;";
                                            }
                                            else if($vehicle->status == '01' && $vehicle->speed <= 0 ){
                                                $status = 'Makan AKI';
                                                $color = "background-color:#57b9f8;";
                                            }
                                            else if($vehicle->status == '00' && $vehicle->speed <= 0 ){
                                                $status = 'Berhenti';
                                                $color = "background-color:#f94c4c;";
                                            }
                                            else if($vehicle->status == '10' && $vehicle->speed > 0 ){
                                                $status = 'Check Instalasi ACC & Engine';
                                                $color = "background-color:#000;";
                                            }
                                            else if($vehicle->status == '10' && $vehicle->speed <= 0 ){
                                                $status = 'Mohon diperiksa';
                                                $color = "background-color:#1BDAC5;";
                                            }
                                            else{
                                                $status = 'Data Tidak Tersedia';
                                                $color = "background-color:#B0B0B0;";
                                            }
                                            
                                            if($status != 'Data Tidak Tersedia'){
                                                if(date('Y-m-d',strtotime($vehicle->datetime_gps)) != date('Y-m-d')){
                                                    $status = 'Out Of The Date';
                                                    $color = "background-color:#B0B0B0;";
                                                }
                                            }
                                            
                                            $star = '';
                                            if($cash_advance_list->vehicle_photo == ''){
                                                $star = '*';
                                            }
                                            
                                            $speed = empty($vehicle->speed) ? 0 : $vehicle->speed;
                            
                                            //echo "<a href='javascript:void()' title='".$status."' onclick=\"showPositionVehicle('".$cash_advance_list->police_no."','".$status."','".$vehicle->latitude.",".$vehicle->longitude."','".$vehicle->time_gps."','".$vehicle->latitude."','".$vehicle->longitude."')\">
                                            echo "<a href='javascript:void()' title='".$status."' onclick=\"showDetailPositionVehicle('".$cash_advance_list->vehicle_rowID."')\">
                                                    <span class='badge' style='".$color."'>".$cash_advance_list->police_no.' '.$star."</span></a>
                                                <br>".$speed.' km/h';
                                                                                    
                                            ?>
                                        </td>
            							<td style="text-align: right;"><?= number_format($cash_advance_list->advance_amount,0,$this->config->item('decimal_separator'),$this->config->item('thousand_separator'));?></td>
            							<td style="text-align: right;"><?= number_format($cash_advance_list->advance_extra_amount,0,$this->config->item('decimal_separator'),$this->config->item('thousand_separator'));?></td>
            							<td style="text-align: right;"><?= number_format($cash_advance_list->pay_over_allocation,0,',','.');?></td>
            							<td style="text-align: right;"><?= number_format($cash_advance_list->advance_allocation,0,$this->config->item('decimal_separator'),$this->config->item('thousand_separator'));?></td>
            							<td style="text-align: right;"><?= number_format($total_balance,0,$this->config->item('decimal_separator'),$this->config->item('thousand_separator'));?></td>
                                </tr>
                                <?php } } ?>
                              </tbody>
                            </table>
            
                          </div>
                        </section> 
                    </div>
                </div>
                
                        
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
     <option value="">Select container size</option>
     <option value="20">20 Feet</option>
     <option value="40">40 Feet</option>
     <option value="45">45 Feet</option>
 </select>
  
 <!-- Bootstrap modal -->
  <div class="modal fade" id="modal_realization" role="dialog" style="overflow: scroll;">
  <div class="modal-dialog" style="width:1200px;">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h3 class="modal-title modal-title-realization"></h3>
      </div>
      <!--<section class="scrollable wrapper">-->
      <div class="modal-body form">
        <?=form_open('','autocomplete="off" id="form" class="form-horizontal"')?>

          <div class="form-body">
                <div class="row"> 
					<div class="col-xs-6">
						<div class="group">	
							<div class="row inline-fields form-group form-md-line-input">
								<div class="col-md-4"><?=lang('date')?> <span class="text-danger">*</span></div>
								<div class="col-md-1">:</div>
								<div class="col-md-6"><p>										
									<input  class="input-sm input-s tanggal_datetimepicker form-control" size="10" type="text" value="<?=date('d-m-Y')?>" id="date" name="date" required>
								</p></div>
							</div>	
							<div class="row inline-fields form-group form-md-line-input">
								<div class="col-md-4"><?=lang('cash_advance_no')?> <span class="text-danger">*</span></div>
								<div class="col-md-1">:</div>
								<div class="col-md-6"><p>
									<input  type="text" class="form-control" id="cash_advance_no" name="cash_advance_no" value="" readonly style="font-size:22px;font-weight:900;color: black;">
								</p></div>								
							</div>
							<div class="row inline-fields form-group form-md-line-input">
								<div class="col-md-4"><?=lang('cash_advance_type')?> <span class="text-danger">*</span></div>
								<div class="col-md-1">:</div>
								<div class="col-md-6"><p>
									<input  type="text" class="form-control" id="cash_advance_type" name="cash_advance_type"  value="" readonly="">
							</p></div>
							</div>
                            <div class="row inline-fields form-group form-md-line-input">
								<div class="col-md-4"><?=lang('employee')?>/<?=lang('driver')?> <span class="text-danger">*</span></div>
								<div class="col-md-1">:</div>
								<div class="col-md-6">
                                <p>
									<input  type="text" class="form-control" id="driver_name" name="driver_name"  value="" readonly >
								</p>
                                </div>
							</div>	
							<div class="row inline-fields form-group form-md-line-input">
								<div class="col-md-4"><?=lang('fare_trip')?> <span class="text-danger">*</span></div>
								<div class="col-md-1">:</div>
								<div class="col-md-6"><p>                                    
									<textarea class="form-control" id="remark" name="remark" maxlength="60" rows="2"  readonly></textarea>
								</p></div>
							</div>			
							
						</div>
					</div>
					<div class="col-xs-6">
						<div class="group">	
                            <div class="row inline-fields form-group form-md-line-input">
								<div class="col-md-4"><?=lang('vehicle')?> <span class="text-danger">*</span></div>
								<div class="col-md-1">:</div>
								<div class="col-md-6">
                                <p>
									<input type="text" class="form-control" id="vehicle_no_type" name="vehicle_no_type" value="" readonly>
                                </p>
                                </div>																
							</div>
							<div class="row inline-fields form-group form-md-line-input">
								<div class="col-md-4"><?=lang('cash_advance')?> <?=lang('amount')?> <span class="text-danger">*</span></div>
								<div class="col-md-1">:</div>
								<div class="col-md-6"><p>
									<input  type="text" class="form-control currency" id="cash_advance_amt" name="cash_advance_amt" style="font-size:22px;font-weight:900;color: black;text-align: right;" value="" readonly>
								</p></div>																
							</div>
							<div class="row inline-fields form-group form-md-line-input">
								<div class="col-md-4"><?=lang('cash_advance')?> <?=lang('settlement')?> <?=lang('amount')?> <span class="text-danger">*</span></div>
								<div class="col-md-1">:</div>
								<div class="col-md-6"><p>
									<input  type="text" class="form-control currency" id="cash_advance_alloc" name="cash_advance_alloc" style="font-size:22px;font-weight:900;color: black;text-align: right;" value="" readonly>
								</p></div>																
							</div>
							<div class="row inline-fields form-group form-md-line-input">
								<div class="col-md-4"><?=lang('cash_advance')?> <?=lang('balance')?> <span class="text-danger">*</span></div>
								<div class="col-md-1">:</div>
								<div class="col-md-6"><p>
									<input  type="text" class="form-control currency" id="cash_advance_balance" name="cash_advance_balance" style="font-size:22px;font-weight:900;color: black;text-align: right;" value="" readonly>
								</p></div>																
							</div>	
                            <div class="row inline-fields form-group form-md-line-input">
								<div class="col-md-4">Document</div>
								<div class="col-md-1">:</div>
								<div class="col-md-6">
                                <p>
									<input  type="checkbox" id="doc_sj" name="doc_sj"  value="Yes" style="width: 15px;" checked="" readonly > SJ &nbsp; &nbsp;
									<input  type="checkbox" id="doc_st" name="doc_st"  value="Yes" style="width: 15px;" readonly > ST &nbsp; &nbsp;
									<input  type="checkbox" id="doc_sm" name="doc_sm"  value="Yes" style="width: 15px;" readonly > SM &nbsp; &nbsp;
									<input  type="checkbox" id="doc_sr" name="doc_sr"  value="Yes" style="width: 15px;" readonly > SR
								</p>
                                
							    <input  type="hidden" class="form-control" id="driver" name="driver"  value="">
								
                                <input  type="hidden" class="form-control" id="prefix" name="prefix"  value="">
								<input  type="hidden" class="form-control" id="year" name="year" value="">
								<input  type="hidden" class="form-control" id="month" name="month" value="">
								<input  type="hidden" class="form-control" id="code" name="code"  value="">
								<input  type="hidden" class="form-control" id="counter_costcode" name="counter_costcode"  value="4">
                                <input  type="hidden" class="form-control" id="cash_advance_date" name="cash_advance_date"  value="">

                                <input  type="hidden" class="form-control" id="fare_trip_code" name="fare_trip_code"  value="">
                                <input  type="hidden" class="form-control" id="fare_trip_id" name="fare_trip_id"  value="">
                                <input  type="hidden" class="form-control" id="vehicle_type_id" name="vehicle_type_id"  value="">

								<input  type="hidden" class="form-control currency" id="cash_advance_alloc_" name="cash_advance_alloc_" style="font-size:22px;font-weight:900;color: black;text-align: right;" value="" readonly>
                                <input  type="hidden" class="form-control" id="cash_advance_type_id" name="cash_advance_type_id"  value="">
								<input  type="hidden" class="form-control" id="on_process" name="on_process" readonly>
                                <input type="hidden" name="row_id" id="row_id" value="1" />
                                <input type="hidden" name="row_job_id" id="row_job_id" value="0" />
                                <input type="hidden" name="row_job_id_tmp" id="row_job_id_tmp" value="0" />
                                <input type="hidden" name="row_cost_id_tmp" id="row_cost_id_tmp" />
								
                            	<input  type="hidden" class="form-control" id="vehicle_type" name="vehicle_type"  value="">
								<input  type="hidden" class="form-control" id="jo_type" name="jo_type"  value="">
								<input  type="hidden" class="form-control" id="from_id" name="from_id"  value="">
								<input  type="hidden" class="form-control" id="to_id" name="to_id"  value="">

                                </div>
							</div>									
						</div>	
					</div>		

				</div>
                <br />
            </div>
               <div class="bs-example">
                    <ul class="nav nav-tabs">
                        <li id="choose_delivery" class="active"><a data-toggle="tab" href="#delivery_order"><?=lang('delivery_order') ?></a></li>
                        <li id="choose_cost" ><a data-toggle="tab" href="#cost"><?=lang('cost_code_details') ?></a></li>
                    </ul>
                    <div class="tab-content">
                        <div id="delivery_order" class="tab-pane active">
                        <br />
                          
                            <div class="table-responsive"> 
                                <table class="table table-responsive table-striped table-condensed" id="detail_DO">
                                    <tr>
                                        <th style="width: 5%;">
                                            <input id="tamdet" title="Tambah Baris" type="button" onclick="addRow_DeliveryOrder()" value="&nbsp;" style="height:30px;width:30px;border;background-image:url('<?= base_url();?>resource/images/plus.png');background-repeat:no-repeat;" />
                                        </th>
                                        <th><?=lang('job_order_no')?></th>
                                        <th>Container</th>
                                        <th>Container No</th>
                                        <th><?=lang('delivery_order_no')?></th>
                                        <th><?=lang('delivery_order_date')?></th>
                                        <th><?=lang('qty_delivery')?></th>
                                        <th><?=lang('receipt_date')?></th>
                                        <th><?=lang('qty_receipt')?></th>
                                    </tr>
                                </table>
                            </div>
                          
                        </div>
                        <div id="cost" class="tab-pane">
                            <br />
                              <div class="table-responsive">  
                                <table class="table table-responsive table-striped table-condensed" id="detail_cost">
                                    <tr>
                                        <th style="width: 3%;">
                                            <input id="tamdetcost" title="Tambah Baris" type="button" onclick="addRow_Cost(false)" value="&nbsp;" style="height:30px;width:30px;border;background-image:url('<?= base_url();?>resource/images/plus.png');background-repeat:no-repeat;" />
                                        </th>
                                        <th class="ganjil"><?=lang('cost')?></th>
                                        <th class="genap"><?=lang('description')?></th>
                                        <th class="ganjil"><?=lang('amount')?></th>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
        </form>
            <p>&nbsp;</p>
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
    <div class="modal-dialog" style="width:75%;height:30px;">
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
                        <th><?=lang('job_order_so_no')?></th>
                        <th>From - To</th>
                        <th>JO Type</th>
                        <th>Price Type</th>
                        <th>Item</th>
                        <th><?=lang('port')?></th>
                        <th><?=lang('vessel_name')?> </th>
						<th><?=lang('job_order_date')?></th>
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
                        <td><?=$rs->so_no?></td>
                        <td><?=ucwords(strtolower($rs->from_name)).' - '.ucwords(strtolower($rs->to_name))?></td>
                        <td><?=ucwords(strtolower($jo_type))?></td>
                        <td><?=$rs->wholesale == 1 ? 'All In' : 'Pcs'?></td>
                        <td><?=ucwords(strtolower($rs->item_name))?></td>
                        <td><?=ucwords(strtolower($rs->port_name))?></td>
                        <td><?=ucwords(strtolower($rs->vessel_name))?></td>
						<td><?=date("d F Y",strtotime($rs->jo_date))?></td>
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

<!-- Bootstrap modal Cash Advance Create-->
  <div class="modal fade" id="modal_create_ca" role="dialog">
  <div class="modal-dialog" style="width:80%;height:200px;">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h3 class="modal-title modal-job-ca"><?=lang('new')?> <?=lang('cash_advance')?></h3>
      </div>
      <div class="modal-body form">
        <?=form_open('','autocomplete="off" id="form_create_ca" class="form-horizontal"')?>
    				<div class="row"> 
					<div class="col-xs-6">
						<div class="group">	
							<div class="form-group form-md-line-input">
								<div class="col-md-4"><?=lang('date')?> <span class="text-danger">*</span></div>
								<div class="col-md-1">:</div>
								<div class="col-md-7">										
									<input type="text" class="form-control tanggal_datetimepicker" id="date_ca" name="date_ca" value="<?=date('d-m-Y')?>" required >
                                    <input type="hidden" id="advance_no" name="advance_no"/>
								</div>
							</div>	
                            <div class="form-group form-md-line-input">
								<div class="col-md-4"><?=lang('cash_advance_type')?> <span class="text-danger">*</span></div>
								<div class="col-md-1">:</div>
								<div class="col-md-5" style="padding-right: 10px;">
                                    <select class="form-control" id="cash_advance_type2" name="cash_advance_type2" required>
                                        <option value=""><?=lang('select').' '.lang('cash_advance_type');?></option>
									<?php
										if (!empty($cash_advance_types)) {
											foreach ($cash_advance_types as $cash_advance_type) { ?>
											<option value="<?php echo $cash_advance_type->rowID; ?>"><?php echo $cash_advance_type->advance_cd;?> - <?php echo $cash_advance_type->advance_name;?></option>
									<?php }}?>
									</select>
								</div>
								<div class="col-md-2" style="padding-left: 0px;">
								    <a class="btn btn-sm btn-info" id="btn_search_fare_trip" style="display: none;" onclick="search_fare_trip()" title="Search <?=lang('fare_trip')?>"><i class="fa fa-search"></i></a>
                                </div>			
							</div>
                            <div class="form-group form-md-line-input">
								<div class="col-md-4"><?=lang('employee')?>/<?=lang('driver')?> <span class="text-danger">*</span></div>
								<div class="col-md-1">:</div>
								<div class="col-md-5" style="padding-right: 10px;">
                                    <input type="hidden" class="form-control" id="queue_id" name="queue_id" required >
                                    <input type="hidden" class="form-control" id="driver2" name="driver2" required >
                                    <input type="text" class="form-control" id="driver2_tmp" name="driver2_tmp" placeholder="<?=lang('select').' '.lang('employee').'/'.lang('driver');?>" readonly="" required >
								</div>		
                                <div class="col-md-2" style="padding-left: 0px;">
								    <a class="btn btn-sm btn-info" id="btn_search_driver" onclick="search_driver()" title="Search <?=lang('employee')?>/<?=lang('driver')?>"><i class="fa fa-search"></i></a>
                                </div>															
							</div>
							<div class="form-group form-md-line-input">
								<div class="col-md-4"><?=lang('vehicle')?> <span class="text-danger">*</span></div>
								<div class="col-md-1">:</div>
								<div class="col-md-7">
                                    <select class="form-control" id="vehicle" name="vehicle" disabled="" required>
                                        <option value=""><?=lang('select').' '.lang('vehicle');?></option>
									</select>
								</div>
							</div>
							<div class="form-group form-md-line-input">
								<div class="col-md-4"><?=lang('fare_trip')?></div>
								<div class="col-md-1">:</div>
								<div class="col-md-7">
                                    <input type="hidden" class="form-control" id="fare_trip" name="fare_trip" required readonly>
                                    <input type="text" class="form-control" id="fare_trip_tmp" name="fare_trip_tmp" required readonly>
                                </div>
							</div>	
							<div class="form-group form-md-line-input">
								<div class="col-md-4"></div>
								<div class="col-md-1"></div>
								<div class="col-md-7">
									<textarea class="form-control" id="fare_trip_dtl" name="fare_trip_dtl" maxlength="60" rows="2" readonly></textarea>
								</div>
							</div>
						</div>
					</div>
					<div class="col-xs-6">
						<div class="group">	
							<div class="form-group form-md-line-input">
								<div class="col-md-4"><?=lang('vehicle_category')?></div>
								<div class="col-md-1">:</div>
								<div class="col-md-7">
                                    <input type="hidden" class="form-control" id="vehicle_category" name="vehicle_category" required readonly>
                                    <input type="text" class="form-control" id="vehicle_category_tmp" name="vehicle_category_tmp" required readonly>
								</div>
							</div>	
							<div class="form-group form-md-line-input">
								<div class="col-md-4"><?=lang('amount')?> <span class="text-danger">*</span></div>
								<div class="col-md-1">:</div>
								<div class="col-md-7"><p>
									<input  type="text" class="form-control currency" id="amount" name="amount" readonly="" style="font-size:22px;font-weight:900;color: black;text-align: right;" value="0" autocomplete="off" required>
								</p></div>																
							</div>
                            <div class="form-group form-md-line-input">
								<div class="col-md-4"><?=lang('extra_amount')?></div>
								<div class="col-md-1">:</div>
								<div class="col-md-7"><p>
									<input  type="text" class="form-control currency" id="extra_amount" name="extra_amount" style="font-size:22px;font-weight:900;color: black;text-align: right;" value="0" autocomplete="off" required>
								</p></div>																
							</div>
                            <div class="form-group form-md-line-input">
								<div class="col-md-4"><?=lang('barcode')?></div>
								<div class="col-md-1">:</div>
								<div class="col-md-7"><p>
									<input type="text" class="form-control" id="barcode_no" name="barcode_no" maxlength="6" autocomplete="off" required>
								</p></div>																
							</div>
							<div class="form-group form-md-line-input">
								<div class="col-md-4"><?=lang('description')?></div>
								<div class="col-md-1">:</div>
								<div class="col-md-7"><p>
									<textarea class="form-control" id="cash_advance_desc" name="cash_advance_desc" maxlength="255" rows="2"></textarea>
								</p></div>																
							</div>										
						</div>	
					</div>		
				</div>

                        
        </form>
          </div>
          <div class="modal-footer">
            <button type="button" id="btnVerifyCashAdvance" onclick="show_modal_verify()" class="btn green" style="display: none;"><?=lang('verify')?></button>
            <button type="button" id="btnSaveCashAdvance" onclick="save_cash_advance()" class="btn green">Save</button>
            <button type="button" class="btn red" data-dismiss="modal">Cancel</button>
          </div>
        </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
    
    <!-- Modal List Fare Trip -->
    <div class="modal fade" id="modal_fare_trip" role="dialog">
      <div class="modal-dialog" style="width:85%;height:200px;">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h3 class="modal-title modal-title-faretrip"><?=lang('select').' '.lang('fare_trip')?></h3>
          </div>
          <div class="modal-body form">
            <table id="tbl-fare_trip" class="table table-responsive table-striped table-condensed table-hover" style="width: 100%;"></table>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn red" data-dismiss="modal">Cancel</button>
          </div>
        </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
    
    <!-- Modal List Employee/Driver Queue -->
    <div class="modal fade" id="modal_driver" role="dialog">
      <div class="modal-dialog" style="width:75%;height:200px;">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h3 class="modal-title modal-title-queue"><?=lang('queue').' '.lang('driver')?></h3>
          </div>
          <div class="modal-body form">
            <table id="tbl-driver" class="table table-responsive table-striped table-condensed table-hover" style="width: 100%;">
                <thead>
                    <th>No</th>
                    <th><?=lang('debtor_cd')?></th>
                    <th><?=lang('debtor_name')?> </th>
					<th><?=lang('debtor_pob')?> </th>
					<th><?=lang('debtor_dob')?> </th>
                    <th><?=lang('debtor_id_type')?></th>
                    <th><?=lang('debtor_id_number')?> </th>
                    <th><?=lang('absent_status')?> </th>
                    <th>Photo</th>
                </thead>
                <tbody>
                <?php
                if(count($drivers) > 0){
                    $no = 1;
                    foreach($drivers as $driver){
                        $class_id = '';
                        
                        if ($driver->id_type == 'S'){
                            $class_id = 'SIM';
                        }
                        else if ($driver->id_type == 'K'){
                            $class_id = 'KTP';
                        }else if ($driver->id_type == 'P'){
                            $class_id = 'Passport';
                        } 
                        
                        if($driver->already == ''){
                            $already = '<span class="label label-success">'.lang('not_yet').'</span>';
                        }
                        else{
                            $already = '<span class="label label-warning">'.lang('already').'</span>';
                        }
                                
                        $get_vehicle = $this->vehicle_model->get_by_id_debtor($driver->rowID);	 
                        
                        if ($driver->type == 'D'){
                ?>
                        <tr style="cursor:pointer">
                            <td onclick="get_driver('<?=$driver->queue_id?>','<?=$driver->rowID?>','<?=$driver->debtor_name?>','<?=$get_vehicle->rowID?>','<?=$driver->already?>')"><?=$no++?>.</td>
                            <td onclick="get_driver('<?=$driver->queue_id?>','<?=$driver->rowID?>','<?=$driver->debtor_name?>','<?=$get_vehicle->rowID?>','<?=$driver->already?>')"><?=$driver->type.$driver->debtor_cd?></td>
                            <td onclick="get_driver('<?=$driver->queue_id?>','<?=$driver->rowID?>','<?=$driver->debtor_name?>','<?=$get_vehicle->rowID?>','<?=$driver->already?>')"><?=$driver->debtor_name?></td>
    						<td onclick="get_driver('<?=$driver->queue_id?>','<?=$driver->rowID?>','<?=$driver->debtor_name?>','<?=$get_vehicle->rowID?>','<?=$driver->already?>')"><?=$driver->pob == '' ? '-' : strtoupper($driver->pob)?></td>
    						<td onclick="get_driver('<?=$driver->queue_id?>','<?=$driver->rowID?>','<?=$driver->debtor_name?>','<?=$get_vehicle->rowID?>','<?=$driver->already?>')"><?=date("d F Y",strtotime($driver->dob))?></td>
                            <td onclick="get_driver('<?=$driver->queue_id?>','<?=$driver->rowID?>','<?=$driver->debtor_name?>','<?=$get_vehicle->rowID?>','<?=$driver->already?>')"><?=$class_id?></td>
                            <td onclick="get_driver('<?=$driver->queue_id?>','<?=$driver->rowID?>','<?=$driver->debtor_name?>','<?=$get_vehicle->rowID?>','<?=$driver->already?>')"><?=$driver->id_no?></td>
                            <td onclick="get_driver('<?=$driver->queue_id?>','<?=$driver->rowID?>','<?=$driver->debtor_name?>','<?=$get_vehicle->rowID?>','<?=$driver->already?>')" class="text-center"><?=$already?></td>
                            <td>
                                <?php
                                if($driver->debtor_photo != '')
                                    echo '<button class="btn btn-sm btn-success" onclick="show_photo_ca(\''.$driver->debtor_photo.'\',\''.$driver->debtor_name.'\')"><i class="fa fa-image"></i> View Photo</button>';
                                else
                                    echo 'No Photo';
                                ?>
                            </td>
                        </tr>
                <?php   
                        }
                    }
                }                
                ?>
                </tbody>
            </table>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn red" data-dismiss="modal">Cancel</button>
          </div>
        </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
    
    <!-- Modal List Employee/Driver -->
    <div class="modal fade" id="modal_employee_driver" role="dialog">
      <div class="modal-dialog" style="width:75%;height:200px;">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h3 class="modal-title modal-title-employee"><?=lang('select').' '.lang('employee').'/'.lang('driver')?></h3>
          </div>
          <div class="modal-body form">
            <table id="tbl-employee-driver" class="table table-responsive table-striped table-condensed table-hover" style="width: 100%;">
                <thead>
                    <th>No</th>
                    <th><?=lang('debtor_cd')?></th>
                    <th><?=lang('debtor_name')?> </th>
                    <th><?=lang('employee').'/'.lang('driver')?></th>
					<th><?=lang('debtor_pob')?> </th>
					<th><?=lang('debtor_dob')?> </th>
                    <th><?=lang('debtor_id_type')?></th>
                    <th><?=lang('debtor_id_number')?></th>
                    <th>Photo</th>
                </thead>
                <tbody>
                <?php
                if(count($debtors) > 0){
                    $no = 1;
                    foreach($debtors as $debtor){
                        $class_debtor = '';
                        $class_id = '';
                        
                        if ($debtor->type == 'D'){
                            $class_debtor = 'Driver';
                        }
                        else if ($debtor->type == 'C'){
                            $class_debtor = 'Company';
                        }else if ($debtor->type == 'E'){
                            $class_debtor = 'Employee';
                        }
                        
                        if ($debtor->id_type == 'S'){
                            $class_id = 'SIM';
                        }
                        else if ($debtor->id_type == 'K'){
                            $class_id = 'KTP';
                        }else if ($debtor->id_type == 'P'){
                            $class_id = 'Passport';
                        } 
                                
                        $get_vehicle = $this->vehicle_model->get_by_id_debtor($debtor->rowID);	 
                        
                        if ($debtor->type != 'C'){
                ?>
                        <tr style="cursor:pointer">
                            <td onclick="get_driver('','<?=$debtor->rowID?>','<?=$debtor->debtor_name?>','<?=$get_vehicle->rowID?>','')" ><?=$no++?>.</td>
                            <td onclick="get_driver('','<?=$debtor->rowID?>','<?=$debtor->debtor_name?>','<?=$get_vehicle->rowID?>','')" ><?=$debtor->type.$debtor->debtor_cd?></td>
                            <td onclick="get_driver('','<?=$debtor->rowID?>','<?=$debtor->debtor_name?>','<?=$get_vehicle->rowID?>','')" ><?=$debtor->debtor_name?></td>
                            <td onclick="get_driver('','<?=$debtor->rowID?>','<?=$debtor->debtor_name?>','<?=$get_vehicle->rowID?>','')" ><?=$class_debtor?></td>
    						<td onclick="get_driver('','<?=$debtor->rowID?>','<?=$debtor->debtor_name?>','<?=$get_vehicle->rowID?>','')" ><?=strtoupper($debtor->pob)?></td>
    						<td onclick="get_driver('','<?=$debtor->rowID?>','<?=$debtor->debtor_name?>','<?=$get_vehicle->rowID?>','')" ><?=date("d F Y",strtotime($debtor->dob))?></td>
                            <td onclick="get_driver('','<?=$debtor->rowID?>','<?=$debtor->debtor_name?>','<?=$get_vehicle->rowID?>','')" ><?=$class_id?></td>
                            <td onclick="get_driver('','<?=$debtor->rowID?>','<?=$debtor->debtor_name?>','<?=$get_vehicle->rowID?>','')" ><?=$debtor->id_no?></td>
                            <td>
                                <?php
                                if($debtor->debtor_photo != '')
                                    echo '<button class="btn btn-sm btn-success" onclick="show_photo_ca(\''.$debtor->debtor_photo.'\',\''.$debtor->debtor_name.'\')"><i class="fa fa-image"></i> View Photo</button>';
                                else
                                    echo 'No Photo';
                                ?>
                            </td>
                        </tr>
                <?php   
                        }
                    }
                }                
                ?>
                </tbody>
            </table>
          </div>
          <div class="modal-footer">
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
            <button type="button" onclick="verify_password()" class="btn green"><?=lang('verify')?></button>
            <button type="button" class="btn red" data-dismiss="modal">Cancel</button>
          </div>
        </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
    
    <!-- Modal Memo -->
    <div class="modal fade" id="modal_memo" role="dialog">
      <div class="modal-dialog" style="width:50%;height:200px;">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h3 class="modal-title modal-title-memo">Memo <span id="memo_ca_no"></span></h3>
          </div>
          <div class="modal-body form">
            <?php
            if($this->user_profile->get_user_access('Created') == 1){
            ?>
                <?=form_open('','autocomplete="off" id="form_memo" class="form-horizontal"')?>
      				<div class="row"> 
    					<div class="col-md-12">
    						<div class="form-group form-md-line-input">
    							<div class="col-md-4"><b>Description<span class="text-danger">*</span></b></div>
                            </div>
                        </div>
                    </div>
      				<div class="row"> 
    					<div class="col-md-12">
    						<div class="form-group form-md-line-input">
    							<div class="col-md-12">
                                    <input type="hidden" class="form-control" id="memo_advance_no" name="memo_advance_no" required >										
    								<textarea class="form-control" name="memo_description" id="memo_description" maxlength="255" rows="3"></textarea>
    							</div>
                            </div>
                        </div>
                    </div>
      				<div class="row"> 
    					<div class="col-md-12 text-right">
                            <button type="button" onclick="create_memo()" class="btn green">Create Memo</button>
                        </div>
                    </div>
                <?=form_close()?>
                
                <hr />
            <?php
            }
            ?>
            <table id="tbl-memo" class="table table-responsive table-striped table-condensed table-hover" style="width: 100%;"></table>
            
          </div>
          <div class="modal-footer">
            <button type="button" class="btn red" data-dismiss="modal">Close</button>
          </div>
        </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
    
    <div class="modal fade" id="modal_view_photo" role="dialog">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h3 class="modal-title-view-photo">View Photo</h3>
          </div>
          <div class="modal-body">
            <div class="row">
                <div class="col-md-12 ">
                    <div class="text-center" id="driver_name_photo" style="font-weight: bold;"></div>
                    <br />
                    <div class="text-center">
                        <img id="personal_photo" class="img-responsive img-thumbnail" width="80%" alt="<?=lang('personal_photo')?>" />
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

<div class="modal fade" id="modal_show_detail_position" role="dialog">
  <div class="modal-dialog" style="width:50%;">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h3 class="modal-title-show-position">Detail Position</h3>
      </div>
      <div class="modal-body">
        <div class="row">
            <div class="col-md-12">
                <p id="detail_position"></p>            
                <div id="map" style="width: 100%;height: 400px;background-color: grey;"></div>
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

<script language="javascript">
$(document).ready(function(){
   $.getScript("https://maps.googleapis.com/maps/api/js?v=3.exp&key=AIzaSyAGqAXbPVg8hBkOqq5aX3tvh5Doryc-AnY&callback=loadMap", function() {
        // No code here
   });  
});

function showDetailPositionVehicle(vehicle_id)
{   
    var police_no = '';
    var status = '';
    var position = '';
    var gpstime = '';
    var latitude = '';
    var longitude = '';
    var url = '';
    
    $.ajax({
        url:'<?php echo base_url(); ?>finances/get_data_vehicle_position',
		type: "POST",
        data: 'vehicle_id='+vehicle_id+'&<?=$this->security->get_csrf_token_name()?>='+'<?=$this->security->get_csrf_hash()?>',
        dataType:"JSON",
		success: function(data_vehicle){
            police_no = data_vehicle.police_no;
            status = data_vehicle.status;
            position = data_vehicle.position;
            gpstime = data_vehicle.time_gps;
            latitude = data_vehicle.latitude;
            longitude = data_vehicle.longitude;
            
            url = "http://maps.googleapis.com/maps/api/geocode/json?latlng=" + position + "&sensor=false";
            
            var adress = '';
            $.getJSON(url, function (data) {
                if(data.results[0] != null){
                    adress = data.results[0].formatted_address;
                    $('#detail_position').html("<b>Police No</b> : " + police_no + "<br><b>Status</b> : " + status + "<br><b>Time</b> : " + gpstime + "<br><b>Position</b> : " + adress);
                    
                    $('#modal_show_detail_position').modal('show');    
                    loadMap(latitude,longitude);
                }
                else{
                    sweetAlert('<?=lang('information')?>','No Data Detail');   
                }    
            });
        }
    });

    
    return true;   
}

function showPositionVehicle(police_no,status,position,gpstime,latitude,longitude)
{    
    var url = "http://maps.googleapis.com/maps/api/geocode/json?latlng=" + position + "&sensor=false";
    var adress = '';
    $.getJSON(url, function (data) {
        if(data.results[0] != null){
            adress = data.results[0].formatted_address;
            $('#detail_position').html("<b>Police No</b> : " + police_no + "<br><b>Status</b> : " + status + "<br><b>Time</b> : " + gpstime + "<br><b>Position</b> : " + adress);
            
            $('#modal_show_detail_position').modal('show');    
            loadMap(latitude,longitude);
        }
        else{
            sweetAlert('<?=lang('information')?>','No Data Detail');   
        }    
    });
    
    return true;   
}

function loadMap(lati,longi) {
  
    if(typeof(lati) == 'undefined' && typeof(longi) == 'undefined'){
        var latitude = parseFloat(0);
        var longitude = parseFloat(0);
    }
    else{
        var latitude = parseFloat(lati);
        var longitude = parseFloat(longi);
    }
     
    map = new google.maps.Map(document.getElementById('map'), {
        zoom: 15,
        center: {lat: latitude, lng: longitude},
        mapTypeId: google.maps.MapTypeId.ROADMAP
    });

    var myLatlng = new google.maps.LatLng(latitude, longitude);
    
    var marker = new google.maps.Marker({
        position: myLatlng,
        map: map,
        title: 'Vehicle Position'
    });

    $('#modal_show_detail_position').on('shown.bs.modal', function () {
        var center = map.getCenter();
        google.maps.event.trigger(map, "resize");
        map.setCenter(center);
    });
}
</script>

</section>
<a href="#" class="hide nav-off-screen-block" data-toggle="class:nav-off-screen, open" data-target="#nav,html"></a>
</section>