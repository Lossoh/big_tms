<section id="content">
	<section class="hbox stretch">		
		<aside>
			<section class="vbox">
				<header class="header bg-white b-b b-light">
					<p><?=lang('job_orders')?></p>
				</header>
				<section class="scrollable wrapper">
				<?php
					$attributes = array('class' => 'bs-example form-horizontal');
					echo form_open(base_url().'job_order/update',$attributes);
					if (!empty($job_orders)) {
						foreach ($job_orders as $job_order) {
				?>

						<div class="row"> 
							<div class="col-xs-6">
								<div class="group">	
								
									<div class="row inline-fields form-group form-md-line-input">
										<div class="col-md-4"><?=lang('job_order_no')?></div>
										<div class="col-md-1">:</div>
										<div class="col-md-6"><p class="h3">
											<input type="hidden"  name="year" value="<?=$job_order['year']?>" class="input-sm form-control">
											<input type="hidden"  name="month" value="<?=$job_order['month']?>" class="input-sm form-control">
											<input type="hidden"  name="code" value="<?=$job_order['code']?>" class="input-sm form-control">
											<input type="text"  name="job_order_no"  class="input-sm form-control" value="<?=$job_order['jo_no']?>" readonly="true">
										</div>
									</div>
									
									<div class="row inline-fields form-group form-md-line-input">
										<div class="col-md-4"><?=lang('job_order_date')?></div>
										<div class="col-md-1">:</div>
										<div class="col-md-6"><p class="h3">
											<input type="text"  name="job_order_date"  class="input-sm form-control" value="<?=$job_order['jo_date']?>" readonly="true">
										</div>
									</div>
									
									<div class="row inline-fields form-group form-md-line-input">
										<div class="col-md-4"><?=lang('job_order_debtor')?></div>
										<div class="col-md-1">:</div>
										<div class="col-md-6"><p class="h3">
										<input type="text"  name="job_order_debtor"  id="job_order_debtor" class="input-sm form-control" value="<?=$job_order['debtor_code']?>&nbsp;-&nbsp;<?=$job_order['debtor_name']?>" readonly="true">
										</div>
									</div>
									
									<div class="row inline-fields form-group form-md-line-input">
										<div class="col-md-4"><?=lang('job_order_wo_code')?></div>
										<div class="col-md-1">:</div>
										<div class="col-md-6"><p class="h3">
											<input type="text"  name="job_order_wo_code" id="job_order_wo_code" class="input-sm form-control" value="<?=$job_order['wo_no']?>" readonly="true">
										</div>
									</div>
									
									<div class="row inline-fields form-group form-md-line-input">
										<div class="col-md-4"><?=lang('job_order_wo_no_ref')?></div>
										<div class="col-md-1">:</div>
										<div class="col-md-6"><p class="h3">
											<input type="text"  name="job_order_wo_no_ref"  class="input-sm form-control" value="<?=$job_order['ref_no']?>" readonly="true">
										</div>
									</div>
									
									<div class="row inline-fields form-group form-md-line-input">
										<div class="col-md-4"><?=lang('job_order_wo_vessel_no')?></div>
										<div class="col-md-1">:</div>
										<div class="col-md-6"><p class="h3">
											<input type="text"  name="job_order_wo_vessel_no"  class="input-sm form-control" value="<?=$job_order['vessel_no']?>" readonly="true">
										</div>
									</div>
									
									<div class="row inline-fields form-group form-md-line-input">
										<div class="col-md-4"><?=lang('job_order_wo_vessel_name')?></div>
										<div class="col-md-1">:</div>
										<div class="col-md-6"><p class="h3">
											<input type="text"  name="job_order_wo_vessel_name"  class="input-sm form-control" value="<?=$job_order['vessel_name']?>" readonly="true">
										</div>
									</div>
									
									<div class="row inline-fields form-group form-md-line-input">
										<div class="col-md-4"><?=lang('job_order_port_name')?></div>
										<div class="col-md-1">:</div>
										<div class="col-md-6"><p class="h3">
											<input type="text"  name="job_order_port_name"  class="input-sm form-control" value="<?=$job_order['port_code']?>&nbsp;-&nbsp;<?=$job_order['debtor_name']?>" readonly="true">
										</div>
									</div>
									
								</div>							
							</div>
								
								<div class="col-xs-6 text-left">
									<div class="group">
									
									<div>
										<div class="row inline-fields form-group form-md-line-input">
										<div class="col-md-4"><?=lang('job_order_from')?></div>
										<div class="col-md-1">:</div>
										<div class="col-md-6"><p class="h3">
											<input type="text"  name="job_order_from"  class="input-sm form-control" value="<?=$job_order['from_code']?>&nbsp;-&nbsp;<?=$job_order['from_name']?>" readonly="true">
										</div>
										</div>
									</div>
									
									<div>
										<div class="row inline-fields form-group form-md-line-input">
										<div class="col-md-4"><?=lang('job_order_to')?></div>
										<div class="col-md-1">:</div>
										<div class="col-md-6"><p class="h3">
											<input type="text"  name="job_order_to"  class="input-sm form-control" value="<?=$job_order['to_code']?>&nbsp;-&nbsp;<?=$job_order['to_name']?>" readonly="true">
										</div>
										</div>
									</div>
																		
									<div>
										<div class="row inline-fields form-group form-md-line-input">
										<div class="col-md-4"><?=lang('job_order_item')?></div>
										<div class="col-md-1">:</div>
										<div class="col-md-6"><p class="h3">
											<input type="text"  name="job_order_item"  class="input-sm form-control" value="<?=$job_order['item_code']?>&nbsp;-&nbsp;<?=$job_order['item_name']?>" readonly="true">
										</div>
										</div>
									</div>
									
									<div class="row inline-fields form-group form-md-line-input">
										<div class="col-md-4"><?=lang('job_order_wholesale')?></div>
										<div class="col-md-1">:</div>
										<div class="col-md-6"><p class="h3">
											<input type="text"  name="job_order_wholesale"  class="input-sm form-control" value="<?=$job_order['wholesale']?>" readonly="true">
										</div>
									</div>

									<div class="row inline-fields form-group form-md-line-input">
										<div class="col-md-4"><?=lang('job_order_price_amount')?><span class="text-danger">*</span></div>
										<div class="col-md-1">:</div>
										<div class="col-md-6"><p class="h3">
											<input type="text"  name="job_order_price_amount"   value="<?=$job_order['price_amount']?>"  class="input-sm form-control" readonly="true">
										</div>
									</div>
									
									<div class="row inline-fields form-group form-md-line-input">
										<div class="col-md-4">
											<b><?=lang('job_order_container_size')?></b>
										</div>
										<div class="col-md-1">
										</div>
										<div class="col-md-6">
											<b><?=lang('job_order_container_price')?></b>
										</div>
									</div>
									
									<div class="row inline-fields form-group form-md-line-input">
										<div class="col-md-4">
											<b><?=lang('job_order_container_size_20ft')?></b>
										</div>
										<div class="col-md-1">
											:
										</div>
										<div class="col-md-6"><p class="h3">
											<input type="text"  name="job_order_container_size_20ft"   value="<?=$job_order['price_20ft']?>"  class="input-sm form-control" readonly="true">
										</div>
									</div>
									
									<div class="row inline-fields form-group form-md-line-input">
										<div class="col-md-4">
											<b><?=lang('job_order_container_size_40ft')?></b>
										</div>
										<div class="col-md-1">
											:
										</div>
										<div class="col-md-6"><p class="h3">
											<input type="text"  name="job_order_container_size_40ft"   value="<?=$job_order['price_40ft']?>"  class="input-sm form-control" readonly="true">
										</div>
									</div>
									
									<div class="row inline-fields form-group form-md-line-input">
										<div class="col-md-4">
											<b><?=lang('job_order_container_size_45ft')?></b>
										</div>
										<div class="col-md-1">
											:
										</div>
										<div class="col-md-6"><p class="h3">
											<input type="text"  name="job_order_container_size_45ft"   value="<?=$job_order['price_45ftde']?>"  class="input-sm form-control" readonly="true">
										</div>
									</div>
									
								</div>
							</div>
						</div>
						
					<div class="line"></div>
					<div></div>
					
					<div class="row"> 
							<div class="col-xs-6">
								<div class="group">	
									<div class="row inline-fields form-group form-md-line-input">
										<div class="col-md-4">
											<b><?=lang('job_order_container_size')?></b>
										</div>
										<div class="col-md-1"><b>:</b></div>
										<div class="col-md-4"><b><?=lang('job_order_weight')?></b></div>
										<div class="col-md-1"><b>:</b></div>
									</div>
								</div>
							</div>
							
							<div class="col-xs-6 text-left">
									<div class="group">
									<div>
										<div class="row inline-fields form-group form-md-line-input">
											<div class="col-md-4"><b><?=lang('job_order_container')?></b></div>
											<div class="col-md-1"><b>:</b></div>
											<div class="col-md-4"></div>
										</div>
									</div>
									</div>
							</div>
						</div>
						
						<br/>
								
					
					<div class="row"> 
							<div class="col-xs-6">
								<div class="group">	
									<div class="row inline-fields form-group form-md-line-input">
										<div class="col-md-4">
											<select id="container" class="form-control" name="container" >	
												<option value="20FT">20FT</option>
												<option value="40FT">40FT</option>
												<option value="45FT">45FT</option>
											</select>
										</div>
										<div class="col-md-1"></div>
										<div class="col-md-4">
											<input type="text" placeholder="Input Weight" name="job_order_weight_container" class="input-sm form-control">
										</div>
									</div>
								</div>
							</div>
							<div class="col-xs-6 text-left">
									<div class="group">
									<div>
										<div class="row inline-fields form-group form-md-line-input">
											<div class="col-md-4">
												<input type="text" placeholder="Input Container" name="job_order_container" class="input-sm form-control">
											</div>
											<div class="col-md-1"></div>
											<div class="col-md-4">	
												<button type="submit" class="btn btn-sm btn-success"><i class="fa fa-check"></i> <?=lang('save')?></button>
											</div>
										</div>
									</div>
									</div>
							</div>
						</div>
						<div class="line"></div>
						<div></div>
					</form>
				<?php }} ?>
				
					<div class="row"> 
						<div class="col-xs-12">
							<div class="group">	
							<section class="panel panel-default">
							<div class="table-responsive">
								<table id="clients" class="table table-striped table-hover b-t b-light text-sm">
									<thead>
									<tr>
										<th width="14%"><?=lang('job_order_no_container')?> </th>
										<th width="35%"><?=lang('job_order_size_container')?> </th>					
										<th width="35%"><?=lang('job_order_weight_container')?> </th>
										<th><?=lang('actions')?></th>
										
									</tr> 
									</thead>
									<tbody>
									<?php if (!empty($edit_job_orders)) {
									foreach ($edit_job_orders  as $edit_job_order) { ?>	
									<tr>
										<td><?=$edit_job_order['container_no']?></td>
										<td><?=$edit_job_order['size']?></td>
										<td><?=$edit_job_order['weight']?></td>
									    <td>
											<a href="<?=base_url()?>job_order/delete/<?=$edit_job_order['rowID']?>" class="btn btn-default btn-xs" data-toggle="ajaxModal" title="<?=lang('delete')?>"><i class="fa fa-trash-o"></i></a>
										</td>
										
									</tr>
									<?php }} ?>
								</tbody>
								</table>
								</div>
								</section>
							</div>
						</div>
					</div>
						
				</section>  
			</section> 
		</aside>
	</section> 
</section>



<!-- end -->
