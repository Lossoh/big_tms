<section id="content">
	<section class="hbox stretch">		
		<aside>
			<section class="vbox">
				<header class="header bg-white b-b b-light">
					<p><?=lang('add_site_cash_advance')?></p>
				</header>
				<section class="scrollable wrapper">
					<form method="post" action="<?=base_url().'site_cash_advance/create'?>"  class="bs-example form-horizontal"  id="myform" />

						<div class="row"> 
							<div class="col-xs-6">
								<div class="group">	
									
									<div class="row inline-fields form-group form-md-line-input">
										<div class="col-md-4"><?=lang('site_cash_advance_date')?><span class="text-danger">*</span></div>
										<div class="col-md-1">:</div>
										<div class="col-md-6"><p class="h3">
											<input type="text" name="site_cash_advance_date"  value="<?=date('Y')?>-<?=date('m')?>-<?=date('d')?>" class="input-sm form-control" required>
										</div>
									</div>
																		
									<div class="row inline-fields form-group form-md-line-input">
										<div class="col-md-4"><?=lang('site_cash_advance_cat')?><span class="text-danger">*</span></div>
										<div class="col-md-1">:</div>
										<div class="col-md-6"><p class="h3">
											<select name="site_cash_advance_cat" id="site_cash_advance_cat" class="form-control" required>
												<option value="0">Select</option>
												   <?php
													  if (!empty($advance_types)) {
													  foreach ($advance_types as $advance_type) { ?>
													  <option value="<?php echo $advance_type->rowID; ?>"><?php echo $advance_type->advance_cd; ?>&nbsp;-&nbsp;<?php echo $advance_type->advance_name; ?></option>
													<?php }}?>
											</select>
										</div>
									</div>
									
									
									
									<div id="site_jo">
										<div class="row inline-fields form-group form-md-line-input">
											<div class="col-md-4"><?=lang('site_cash_advance_jo')?></div>
											<div class="col-md-1">:</div>
											<div class="col-md-6"><p class="h3">
												<input type="text" name="site_cash_advance_jo" id="site_cash_advance_jo" class="input-sm form-control" readonly="true" >
												<input type="hidden" name="site_cash_advance_jo_year" id="site_cash_advance_jo_year" class="input-sm form-control" readonly="true" >
												<input type="hidden" name="site_cash_advance_jo_month" id="site_cash_advance_jo_month" class="input-sm form-control" readonly="true" >
												<input type="hidden" name="site_cash_advance_jo_code" id="site_cash_advance_jo_code" class="input-sm form-control" readonly="true" >
											</div>
										</div>
									</div>
										
										
										<div class="row inline-fields form-group form-md-line-input">
											<div class="col-md-4"><?=lang('site_cash_advance_wo')?></div>
											<div class="col-md-1">:</div>
											<div class="col-md-6"><p class="h3">
												<input type="text" name="site_cash_advance_wo" id="site_cash_advance_wo" class="input-sm form-control" readonly="true" >
											</div>
										</div>
										
										<div class="row inline-fields form-group form-md-line-input">
											<div class="col-md-4"><?=lang('site_cash_advance_debtor')?></div>
											<div class="col-md-1">:</div>
											<div class="col-md-6"><p class="h3">
												<input type="hidden" name="site_cash_advance_debtor_id" id="site_cash_advance_debtor_id" class="input-sm form-control" >
												<input type="text" name="site_cash_advance_debtor" id="site_cash_advance_debtor" class="input-sm form-control" readonly="true" >
											</div>
											
										</div>
										
										<div class="row inline-fields form-group form-md-line-input">
											<div class="col-md-4"><?=lang('site_cash_advance_vessel')?></div>
											<div class="col-md-1">:</div>
											<div class="col-md-6"><p class="h3">
												<input type="text" name="site_cash_advance_vessel" id="site_cash_advance_vessel" class="input-sm form-control" readonly="true" >
											</div>
											<div class="col-md-1">
											</div>
										</div>
										
										<div class="row inline-fields form-group form-md-line-input">
											<div class="col-md-4"><?=lang('site_cash_advance_item')?></div>
											<div class="col-md-1">:</div>
											<div class="col-md-6"><p class="h3">
												<input type="hidden" name="site_cash_advance_item_id" id="site_cash_advance_item_id" class="input-sm form-control" >
												<input type="text" name="site_cash_advance_item" id="site_cash_advance_item" class="input-sm form-control" readonly="true" >
											</div>
										</div>
										
										<div class="row inline-fields form-group form-md-line-input">
											<div class="col-md-4"><?=lang('site_cash_advance_from')?></div>
											<div class="col-md-1">:</div>
											<div class="col-md-6"><p class="h3">
												<input type="hidden" name="site_cash_advance_from_id" id="site_cash_advance_from_id" class="input-sm form-control" >
												<input type="text" name="site_cash_advance_from" id="site_cash_advance_from" class="input-sm form-control" readonly="true" >
											</div>
										</div>
										
										<div class="row inline-fields form-group form-md-line-input">
											<div class="col-md-4"><?=lang('site_cash_advance_to')?></div>
											<div class="col-md-1">:</div>
											<div class="col-md-6"><p class="h3">
												<input type="hidden" name="site_cash_advance_to_id" id="site_cash_advance_to_id" class="input-sm form-control" >
												<input type="text" name="site_cash_advance_to" id="site_cash_advance_to" class="input-sm form-control" readonly="true" >
											</div>
										</div>
									
									<div id="site_cash_advance_by_jo">
									</div>
									
									<div id="tombol_add_jo">
									<div class="row inline-fields form-group form-md-line-input">
											<div class="col-md-4"></div>
											<div class="col-md-1"></div>
											<div class="col-md-6"><p class="h3">
												<?php 
															$atribut_popup=array('width'=>'800',
																				'height'=>'400',
																				'scrollbars'=>'yes',
																				'status' =>'no',
																				'resizable' =>'no',
																				'screenx'=>'100',
																				'screeny'=>'30'
																				
																				);
														
															echo anchor_popup(base_url().'site_cash_advance/add_job_order','<span class="btn btn-sm green pull-left" id="tes">Add Job Order </span>',$atribut_popup); 
												?>
											</div>
									</div>
									</div>
									
									
								</div>							
							</div>
								
								<div class="col-xs-6 text-left">
									<div class="group">
									
									<div>
										<div class="row inline-fields form-group form-md-line-input">
										<div class="col-md-4"><?=lang('site_cash_advance_driveremployee')?><span class="text-danger">*</span></div>
										<div class="col-md-1">:</div>
										<div class="col-md-6"><p class="h3">
											<select name="site_cash_advance_driveremployee" id="site_cash_advance_driveremployee" class="form-control" required>
											<option value ="0">Select</option>
												   <?php
													  if (!empty($driveremployees)) {
													  foreach ($driveremployees as $driveremployee) { ?>
													  <option value="<?php echo $driveremployee->rowID; ?>"><?php echo $driveremployee->debtor_cd; ?>&nbsp;-&nbsp;<?php echo $driveremployee->debtor_name; ?></option>
													<?php }}?>
											</select>
										</div>
									</div>
									
									<div id="site_cash_advance_vehicle_type">
									</div>
									
									<div id="site_cash_advance_amount1">
										<div class="row inline-fields form-group form-md-line-input">
											<div class="col-md-4"><?=lang('site_cash_advance_amount')?><span class="text-danger">*</span></div>
											<div class="col-md-1">:</div>
											<div class="col-md-6"><p class="h3">
												<input type="text" name="site_cash_advance_amount" name="site_cash_advance_amount" class="input-sm form-control"  >
											</div>
											</div>
										</div>
									</div>
									
									<div class="row inline-fields form-group form-md-line-input">
										<div class="col-md-4"><?=lang('site_cash_advance_description')?><span class="text-danger">*</span></div>
										<div class="col-md-1">:</div>
										<div class="col-md-6"><p class="h3">
											<input type="text" name="site_cash_advance_description" name="site_cash_advance_description" class="input-sm form-control"  >
										</div>
										</div>
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
