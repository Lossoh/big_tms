<section id="content">
	<section class="hbox stretch">		
		<aside>
			<section class="vbox">
				<header class="header bg-white b-b b-light">
					<p><?=lang('add_delivery_order')?></p>
				</header>
				<section class="scrollable wrapper">
				<?php
					$attributes = array('class' => 'bs-example form-horizontal');
					echo form_open(base_url().'delivery_order/create',$attributes); ?>

						<div class="row"> 
							<div class="col-xs-6">
								<div class="group">	
								
									<div class="row inline-fields form-group form-md-line-input">
										<div class="col-md-4"><?=lang('delivery_order_no.')?><span class="text-danger">*</span></div>
										<div class="col-md-1">:</div>
										<div class="col-md-6"><p class="h3">
											<input type="text" name="delivery_order_no" class="input-sm form-control" required>
										</div>
									</div>
									
									<div class="row inline-fields form-group form-md-line-input">
										<div class="col-md-4"><?=lang('delivery_order_reg_no')?><span class="text-danger">*</span></div>
										<div class="col-md-1">:</div>
										<div class="col-md-6"><p class="h3">
											<input type="text" name="delivery_order_reg_no" class="input-sm form-control" required>
										</div>
									</div>
									
									<div class="row inline-fields form-group form-md-line-input">
										<div class="col-md-4"><?=lang('delivery_order_date')?><span class="text-danger">*</span></div>
										<div class="col-md-1">:</div>
										<div class="col-md-6"><p class="h3">
											<input type="text" name="delivery_order_date"  value="<?=date('Y')?>-<?=date('m')?>-<?=date('d')?>" class="input-sm form-control" required>
										</div>
									</div>
																		
									<div class="row inline-fields form-group form-md-line-input">
										<div class="col-md-4"><?=lang('delivery_order_debtor')?><span class="text-danger">*</span></div>
										<div class="col-md-1">:</div>
										<div class="col-md-6"><p class="h3">
											<select name="delivery_order_debtor" id="delivery_order_debtor" class="form-control" required>
												   <?php
													  if (!empty($debtors)) {
													  foreach ($debtors as $debtor) { ?>
													  <option value="<?php echo $debtor->rowID; ?>"><?php echo $debtor->debtor_cd; ?>&nbsp;-&nbsp;<?php echo $debtor->debtor_name; ?></option>
													<?php }}?>
											</select>
										</div>
									</div>
									
									<div class="row inline-fields form-group form-md-line-input">
										<div class="col-md-4"><?=lang('delivery_order_jo_no')?><span class="text-danger">*</span></div>
										<div class="col-md-1">:</div>
										<div class="col-md-6"><p class="h3">
											<select name="delivery_order_jo_no" id="delivery_order_jo_no" class="form-control" required>
											</select>
										</div>
									</div>
									
									<div id="delivery_order_wo_no">
									</div>
									
									<div>
										<div class="row inline-fields form-group form-md-line-input">
										<div class="col-md-4"><?=lang('delivery_order_driver')?><span class="text-danger">*</span></div>
										<div class="col-md-1">:</div>
										<div class="col-md-6"><p class="h3">
											<select name="delivery_order_driver" id="delivery_order_driver" class="form-control" required>
											<option value ="0">Select</option>
												   <?php
													  if (!empty($drivers)) {
													  foreach ($drivers as $driver) { ?>
													  <option value="<?php echo $driver->rowID; ?>"><?php echo $driver->debtor_cd; ?>&nbsp;-&nbsp;<?php echo $driver->debtor_name; ?></option>
													<?php }}?>
											</select>
										</div>
										</div>
									</div>
									
									<div id="delivery_order_vehicle_type">
									</div>
									
								</div>							
							</div>
								
								<div class="col-xs-6 text-left">
									<div class="group">
									
										<div class="row inline-fields form-group form-md-line-input">
										<div class="col-md-4"><?=lang('delivery_order_container')?></div>
										<div class="col-md-1">:</div>
										<div class="col-md-6">
											<p class="h3">
												<select name="delivery_order_container" id="delivery_order_container" class="form-control">
													<option value ="0">Select</option>
														   <?php
															  if (!empty($containers)) {
															  foreach ($containers as $container) { ?>
															  <option value="<?php echo $container->rowID; ?>"><?php echo $container->container_no; ?></option>
															<?php }}?>
												</select>
										</div>
										</div>
										
										<div class="row inline-fields form-group form-md-line-input">
											<div class="col-md-4"><?=lang('delivery_order_delivered_weight')?><span class="text-danger">*</span></div>
											<div class="col-md-1">:</div>
											<div class="col-md-6"><p class="h3">
												<input type="text" name="delivery_order_delivered_weight"  class="input-sm form-control" required>
											</div>
										</div>
										
										<div class="row inline-fields form-group form-md-line-input">
											<div class="col-md-4"><?=lang('delivery_order_pod_weight')?></div>
											<div class="col-md-1">:</div>
											<div class="col-md-6"><p class="h3">
												<input type="text" name="delivery_order_pod_weight" class="input-sm form-control">
											</div>
										</div>
										
										<div class="row inline-fields form-group form-md-line-input">
											<div class="col-md-4"><?=lang('delivery_order_pod_date')?></div>
											<div class="col-md-1">:</div>
											<div class="col-md-6"><p class="h3">
												<input type="text" name="delivery_order_pod_date"  value="<?=date('Y')?>-<?=date('m')?>-<?=date('d')?>" class="input-sm form-control">
											</div>
										</div>
										
										
									</div>
								</div>
								
							</div>
						</div>
						
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
