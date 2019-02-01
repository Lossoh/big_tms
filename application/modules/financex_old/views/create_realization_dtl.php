<section id="content">
	<section class="hbox stretch">		
		<aside>
			<section class="vbox">

				<header class="header bg-white b-b b-light">
					<p class="h4"><?=lang('realization')?>  <?=lang('detail')?> <?=lang('view')?>  </p>
				</header>
				<section class="scrollable wrapper">
				<?php
								
					$attributes = array('class' => 'bs-example form-horizontal', 'onsubmit'=>'return realization_onsubmit()');
					echo form_open(base_url().'finances/create_realization_hdr',$attributes); 
		
				
                    if (!empty($realization_details)) {
						foreach ($realization_details as $realization_detail) { 
				?>
				<div class="row"> 
					<div class="col-xs-6">
						<div class="group">
							<div class="row inline-fields form-group form-md-line-input">
								<div class="col-md-4"><?=lang('site')?> / <?=lang('company')?></div>
								<div class="col-md-1">:</div>
								<div class="col-md-6"><p style="font-size:14px;font-weight:700;color: black;text-align: left;">
									<?=$realization_detail['dep_name']?> / <?=$this->config->item('comp_cd')?>
								</p></div>																
							</div>						
							<div class="row inline-fields form-group form-md-line-input">
								<div class="col-md-4"><?=lang('realization_no')?></div>
								<div class="col-md-1">:</div>
								<div class="col-md-6"><p style="font-size:14px;font-weight:700;color: black;text-align: left;">
									<?=$realization_detail['alloc_no']?>
								</p></div>																
							</div>	
							<div class="row inline-fields form-group form-md-line-input">
								<div class="col-md-4"><?=lang('date')?></div>
								<div class="col-md-1">:</div>
								<div class="col-md-6"><p style="font-size:14px;font-weight:700;color: black;text-align: left;">										
									<?=date('d M Y', strtotime($realization_detail['alloc_date']))?>
								</p></div>
							</div>	
							<div class="row inline-fields form-group form-md-line-input">
								<div class="col-md-4"><?=lang('cash_advance_no')?></div>
								<div class="col-md-1">:</div>
								<div class="col-md-6"><p style="font-size:14px;font-weight:700;color: black;text-align: left;">

									<?=$realization_detail['advance_no']?>
								</p></div>
																
							</div>
							<div class="row inline-fields form-group form-md-line-input">
								<div class="col-md-4"><?=lang('cash_advance_type')?></div>
								<div class="col-md-1">:</div>
								<div class="col-md-6"><p style="font-size:14px;font-weight:700;color: black;text-align: left;">									
									<?=$realization_detail['advance_name']?>
							</p></div>
							</div>	
							<div class="row inline-fields form-group form-md-line-input">
								<div class="col-md-4"><?=lang('fare_trip')?></div>
								<div class="col-md-1">:</div>
								<div class="col-md-6"><p style="font-size:14px;font-weight:700;color: black;text-align: left;">
									<textarea class="form-control"  maxlength="60" rows="2"  readonly><?=$realization_detail['fare_trip_no']?> (<?=$realization_detail['destination_from_name']?> KE <?=$realization_detail['destination_to_name']?>)</textarea>
								</p></div>
							</div>			
							
						</div>
					</div>
					<div class="col-xs-6">
						<div class="group">	
							<div class="row inline-fields form-group form-md-line-input">
								<div class="col-md-4"><?=lang('cash_advance')?> <?=lang('amount')?></div>
								<div class="col-md-1">:</div>
								<div class="col-md-6"><p style="font-size:14px;font-weight:700;color: black;text-align: right;">
									<?=number_format($realization_detail['advance_amount'],0,$this->config->item('decimal_separator'),$this->config->item('thousand_separator'));?>
								</p></div>																
							</div>
							<div class="row inline-fields form-group form-md-line-input">
								<div class="col-md-4"><?=lang('realization')?> <?=lang('amount')?></div>
								<div class="col-md-1">:</div>
								<div class="col-md-6"><p style="font-size:14px;font-weight:700;color: black;text-align: right;">
									<?=number_format($realization_detail['advance_allocation'],0,$this->config->item('decimal_separator'),$this->config->item('thousand_separator'));?>
									
								</p></div>																
							</div>
							<div class="row inline-fields form-group form-md-line-input">
								<div class="col-md-4"><?=lang('cash_advance')?> <?=lang('balance')?></div>
								<div class="col-md-1">:</div>
								<div class="col-md-6"><p style="font-size:14px;font-weight:700;color: black;text-align: right;">
									<?=number_format($realization_detail['advance_balance'],0,$this->config->item('decimal_separator'),$this->config->item('thousand_separator'));?>
								</p></div>																
							</div>	
							<div class="row inline-fields form-group form-md-line-input">
								<div class="col-md-4"><?=lang('employee')?>/<?=lang('driver')?></div>
								<div class="col-md-1">:</div>
								<div class="col-md-7"><p style="font-size:14px;font-weight:700;color: black;text-align: left;">									
									<?=$realization_detail['debtor_name']?>  /  <?php echo ($realization_detail['debtor_type'] == 'E') ? 'EMPLOYEE' : 'DRIVER';?>  /  <?=$realization_detail['id_no']?>
								</p></div>
							</div>
							<div class="row inline-fields form-group form-md-line-input">
								<div class="col-md-4"><?=lang('vehicle_police_no')?>/<?=lang('vehicle_category')?></div>
								<div class="col-md-1">:</div>
								<div class="col-md-7"><p style="font-size:14px;font-weight:700;color: black;text-align: left;">									
									<?=$realization_detail['police_no']?> / <?=$realization_detail['type_name']?>
								</p></div>
							</div>							
							
							<div class="row inline-fields form-group form-md-line-input">
								<div class="col-md-4"><?=lang('description')?></div>
								<div class="col-md-1">:</div>
								<div class="col-md-7"><p>
									<textarea class="form-control"  maxlength="60" rows="2"  readonly><?=$realization_detail['bdescription']?></textarea>
								</p></div>
							</div>										
						</div>	
					</div>		

				</div>	
					  <?php }}?>
			
				<legend><?=lang('delivery_order')?> <?=lang('details')?><a href="<?=base_url()?>finances/create_delivery_order/<?=$this->uri->segment(3)?>/<?=$this->uri->segment(4)?>/<?=$this->uri->segment(5)?>/<?=$this->uri->segment(6)?>" data-toggle="ajaxModal"  class="btn btn-info pull-right" role="button"><span class="glyphicon glyphicon-plus"></span><?=lang('new')?> <?=lang('delivery_order')?></a></legend>
				<table id="tbl-jo" class="table table-striped table-hover b-t b-light text-sm">
				<thead>
					<tr>						
						<th class="col-md-5"><?=lang('job_order_no')?></th>
						<th class="col-md-4"><?=lang('delivery_order_no')?></th>			
						<th class="col-md-2"><?=lang('delivery_order_date')?></th>
						<th class="col-md-1"><?=lang('delivery_order_netto')?></th>
						<th class="col-md-1"><?=lang('receipt_order_date')?></th>
						<th class="col-md-1"><?=lang('receipt_order_netto')?></th>
						<th class="col-md-1"><?=lang('short_over_netto')?></th>
					</tr>
				</thead>
				<tbody>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
				</tbody>
				</table>
				<p> 
					<button type="button" class="addmore">+ Add Cost Code</button>
				</p>

				<div class="line"></div>				
				<div>
					<button type="submit" class="btn_cleartable green  btn-sm"><i class="fa fa-plus"></i>   <?=lang('save')?></button><button type="button" class="btn_cleartable red btn-sm pull-right" onclick="history.go(0);"><i class="fa fa-refresh"></i>   <?=lang('refresh')?></button><button type="button" class="btn_cleartable  yellow btn-sm pull-right" onclick="history.back();"><i class="fa fa-undo"></i>   <?=lang('back')?></button>
				</div>
				</form>					
				</section>  
			</section> 
		</aside>
	</section> 
</section>