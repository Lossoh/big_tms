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
					echo form_open(base_url().'delivery_order/update',$attributes);
					if (!empty($delivery_orders)) {
						foreach ($delivery_orders as $delivery_order) {
				?>

						<div class="row"> 
							<div class="col-xs-6">
								<div class="group">	
								
									<div class="row inline-fields form-group form-md-line-input">
										<div class="col-md-4"><?=lang('delivery_order_no.')?><span class="text-danger">*</span></div>
										<div class="col-md-1">:</div>
										<div class="col-md-6"><p class="h3">
											<input type="hidden"  name="year" value="<?=$delivery_order['year']?>" class="input-sm form-control">
											<input type="hidden"  name="month" value="<?=$delivery_order['month']?>" class="input-sm form-control">
											<input type="hidden"  name="code" value="<?=$delivery_order['code']?>" class="input-sm form-control">
											<input type="text"  name="delivery_order_no"  class="input-sm form-control" value="<?=$delivery_order['do_no']?>" required>
										</div>
									</div>
									
									<div class="row inline-fields form-group form-md-line-input">
										<div class="col-md-4"><?=lang('delivery_order_reg_no')?><span class="text-danger">*</span></div>
										<div class="col-md-1">:</div>
										<div class="col-md-6"><p class="h3">
											<input type="text"  name="delivery_order_reg_no"  class="input-sm form-control" value="<?=$delivery_order['reg_no']?>" required>
										</div>
									</div>
									
									<div class="row inline-fields form-group form-md-line-input">
										<div class="col-md-4"><?=lang('delivery_order_date')?><span class="text-danger">*</span></div>
										<div class="col-md-1">:</div>
										<div class="col-md-6"><p class="h3">
										<input type="text"  name="delivery_order_date"  id="delivery_order_date" class="input-sm form-control" value="<?=$delivery_order['deliver_date']?>" required>
										</div>
									</div>
									
									<div class="row inline-fields form-group form-md-line-input">
										<div class="col-md-4"><?=lang('delivery_order_debtor')?><span class="text-danger">*</span></div>
										<div class="col-md-1">:</div>
										<div class="col-md-6"><p class="h3">
											<input type="text"  name="delivery_order_debtor"  class="input-sm form-control" value="<?=$delivery_order['debtor_code']?>&nbsp;-&nbsp;<?=$delivery_order['debtor_name']?>" readonly="true">
										</div>
									</div>
									
									<div class="row inline-fields form-group form-md-line-input">
										<div class="col-md-4"><?=lang('delivery_order_jo_no')?><span class="text-danger">*</span></div>
										<div class="col-md-1">:</div>
										<div class="col-md-6"><p class="h3">
											<input type="text"  name="delivery_order_jo_no"  class="input-sm form-control" value="<?=$delivery_order['jo_no']?>" readonly="true">
										</div>
									</div>
									
									<div class="row inline-fields form-group form-md-line-input">
										<div class="col-md-4"><?=lang('delivery_order_wo_no')?><span class="text-danger">*</span></div>
										<div class="col-md-1">:</div>
										<div class="col-md-6"><p class="h3">
											<input type="text"  name="delivery_order_wo_no"  class="input-sm form-control" value="<?=$delivery_order['wo_no']?>" readonly="true">
										</div>
									</div>
									
									<div class="row inline-fields form-group form-md-line-input">
										<div class="col-md-4"><?=lang('delivery_order_item')?><span class="text-danger">*</span></div>
										<div class="col-md-1">:</div>
										<div class="col-md-6"><p class="h3">
											<input type="text"  name="delivery_order_item"  class="input-sm form-control" value="<?=$delivery_order['item_code']?>&nbsp;-&nbsp;<?=$delivery_order['item_name']?>" readonly="true">
										</div>
									</div>
									
									
									<div class="row inline-fields form-group form-md-line-input">
										<div class="col-md-4"><?=lang('delivery_order_from')?><span class="text-danger">*</span></div>
										<div class="col-md-1">:</div>
										<div class="col-md-6"><p class="h3">
											<input type="text"  name="delivery_order_from"  class="input-sm form-control" value="<?=$delivery_order['from_code']?>&nbsp;-&nbsp;<?=$delivery_order['from_name']?>" readonly="true">
										</div>
									</div>
									
									<div class="row inline-fields form-group form-md-line-input">
										<div class="col-md-4"><?=lang('delivery_order_to')?><span class="text-danger">*</span></div>
										<div class="col-md-1">:</div>
										<div class="col-md-6"><p class="h3">
											<input type="text"  name="delivery_order_to"  class="input-sm form-control" value="<?=$delivery_order['to_code']?>&nbsp;-&nbsp;<?=$delivery_order['to_name']?>" readonly="true">
										</div>
									</div>
									
								</div>							
							</div>
								
								<div class="col-xs-6 text-left">
									<div class="group">
									
									<div class="row inline-fields form-group form-md-line-input">
										<div class="col-md-4"><?=lang('delivery_order_driver')?><span class="text-danger">*</span></div>
										<div class="col-md-1">:</div>
										<div class="col-md-6"><p class="h3">
											<input type="text"  name="delivery_order_driver"  class="input-sm form-control" value="<?=$delivery_order['driver_code']?>&nbsp;-&nbsp;<?=$delivery_order['driver_name']?>" readonly="true">
										</div>
									</div>
									
									<div class="row inline-fields form-group form-md-line-input">
										<div class="col-md-4"><?=lang('delivery_order_truck_no')?><span class="text-danger">*</span></div>
										<div class="col-md-1">:</div>
										<div class="col-md-6"><p class="h3">
											<input type="text"  name="delivery_order_truck_no"  class="input-sm form-control" value="<?=$delivery_order['police_no']?>" readonly="true">
										</div>
									</div>
									
									<div class="row inline-fields form-group form-md-line-input">
										<div class="col-md-4"><?=lang('delivery_order_vehicle_type')?><span class="text-danger">*</span></div>
										<div class="col-md-1">:</div>
										<div class="col-md-6"><p class="h3">
											<input type="text"  name="delivery_order_vehicle_type"  class="input-sm form-control" value="<?=$delivery_order['vehicle_type_code']?>&nbsp;-&nbsp;<?=$delivery_order['vehicle_type_name'] ?>" readonly="true">
										</div>
									</div>
									<div>
										<div class="row inline-fields form-group form-md-line-input">
										<div class="col-md-4"><?=lang('delivery_order_container')?></div>
										<div class="col-md-1">:</div>
										<div class="col-md-6"><p class="h3">
												<select name="delivery_order_container" id="delivery_order_container" class="form-control">
													<option value ="0">Select</option>
														   <?php
															  if (!empty($containers)) {
															  foreach ($containers as $container) { ?>
															  <option value="<?php echo $container->rowID; ?>" <?php if ($delivery_order['tr_jo_trx_cnt_rowID'] == $container->rowID){echo"selected";}?>><?php echo $container->container_no; ?></option>
															<?php }}?>
												</select>
										</div>
										</div>
									</div>
									
									<div>
										<div class="row inline-fields form-group form-md-line-input">
										<div class="col-md-4"><?=lang('delivery_order_delivered_weight')?><span class="text-danger">*</span></div>
										<div class="col-md-1">:</div>
										<div class="col-md-6"><p class="h3">
												<input type="text" name="delivery_order_delivered_weight"  value="<?=$delivery_order['delivered_weight']?>"" class="input-sm form-control" required>
										</div>
										</div>
									</div>
																		
									<div>
										<div class="row inline-fields form-group form-md-line-input">
										<div class="col-md-4"><?=lang('delivery_order_pod_weight')?></div>
										<div class="col-md-1">:</div>
										<div class="col-md-6"><p class="h3">
												<input type="text" name="delivery_order_pod_weight"  value="<?=$delivery_order['pod_weight']?>" class="input-sm form-control">
										</div>
										</div>
									</div>
									
									<div>
										<div class="row inline-fields form-group form-md-line-input">
										<div class="col-md-4"><?=lang('delivery_order_pod_date')?></div>
										<div class="col-md-1">:</div>
										<div class="col-md-6"><p class="h3">
												<input type="text" name="delivery_order_pod_date"  value="<?=$delivery_order['pod_date']?>" class="input-sm form-control">
										</div>
										</div>
									</div>
									
									</div>
								</div>
							</div>
					<?php }}?>
						
					<div class="line"></div>
						<div>
							<button type="submit" class="btn btn-sm btn-success" value="Save"><i class="fa fa-plus"></i> <?=lang('job_order_save')?></button>
						</div>
					
					</form>
						
				</section>  
			</section> 
		</aside>
	</section> 
</section>



<!-- end -->
