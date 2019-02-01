<section id="content">
	<section class="hbox stretch">		
		<aside>
			<section class="vbox">
				<header class="header bg-white b-b b-light">
					<p><?=lang('add_site_cash_advance')?></p>
				</header>
				<section class="scrollable wrapper">
					<?php 
					if (!empty($site_cash_advances)) {
						foreach ($site_cash_advances as $site_cash_advance) { ?>
						<div class="row"> 
							<div class="col-xs-6">
								<div class="group">
									<?php //echo"<pre>";print_r($site_cash_advance); die(); ?>
									<div class="row inline-fields form-group form-md-line-input">
										<div class="col-md-4"><?=lang('site_cash_advance_no')?><span class="text-danger">*</span></div>
										<div class="col-md-1">:</div>
										<div class="col-md-6"><p class="h3">
											<input type="text" name="site_cash_advance_no"  value="<?=$site_cash_advance['advance_no']?>" class="input-sm form-control" readonly="true">
										</div>
									</div>
									
									<div class="row inline-fields form-group form-md-line-input">
										<div class="col-md-4"><?=lang('site_cash_advance_date')?><span class="text-danger">*</span></div>
										<div class="col-md-1">:</div>
										<div class="col-md-6"><p class="h3">
											<input type="text" name="site_cash_advance_date"  value="<?=$site_cash_advance['advance_date']?>" class="input-sm form-control" readonly="true">
										</div>
									</div>
																		
									<div class="row inline-fields form-group form-md-line-input">
										<div class="col-md-4"><?=lang('site_cash_advance_cat')?><span class="text-danger">*</span></div>
										<div class="col-md-1">:</div>
										<div class="col-md-6"><p class="h3">
											<input type="text" name="site_cash_advance_cat"  value="<?=$site_cash_advance['advance_code']?>&nbsp;-&nbsp;<?=$site_cash_advance['advance_name']?>" class="input-sm form-control" readonly="true" >
										</div>
									</div>
									
									
									
									<div id="site_jo">
										<div class="row inline-fields form-group form-md-line-input">
											<div class="col-md-4"><?=lang('site_cash_advance_jo')?></div>
											<div class="col-md-1">:</div>
											<div class="col-md-6"><p class="h3">
												<input type="text" name="site_cash_advance_jo_code" id="site_cash_advance_jo_code" value="<?=$site_cash_advance['jo_no']?>" class="input-sm form-control" readonly="true" >
											</div>
										</div>
									</div>
										
										
										<div class="row inline-fields form-group form-md-line-input">
											<div class="col-md-4"><?=lang('site_cash_advance_wo')?></div>
											<div class="col-md-1">:</div>
											<div class="col-md-6"><p class="h3">
												<input type="text" name="site_cash_advance_wo" id="site_cash_advance_wo" class="input-sm form-control" value="<?=$site_cash_advance['wo_no']?>" readonly="true" >
											</div>
										</div>
										
										<div class="row inline-fields form-group form-md-line-input">
											<div class="col-md-4"><?=lang('site_cash_advance_debtor')?></div>
											<div class="col-md-1">:</div>
											<div class="col-md-6"><p class="h3">
												<input type="text" name="site_cash_advance_debtor" id="site_cash_advance_debtor" class="input-sm form-control" value="<?=$site_cash_advance['debtor_code']?>&nbsp;-&nbsp;<?=$site_cash_advance['debtor_name']?>" readonly="true" >
											</div>
											
										</div>
										
										<div class="row inline-fields form-group form-md-line-input">
											<div class="col-md-4"><?=lang('site_cash_advance_vessel')?></div>
											<div class="col-md-1">:</div>
											<div class="col-md-6"><p class="h3">
												<input type="text" name="site_cash_advance_vessel" id="site_cash_advance_vessel" class="input-sm form-control" value="<?=$site_cash_advance['vessel_no']?>&nbsp;-&nbsp;<?=$site_cash_advance['vessel_name']?>" readonly="true" >
											</div>
											<div class="col-md-1">
											</div>
										</div>
										
										<div class="row inline-fields form-group form-md-line-input">
											<div class="col-md-4"><?=lang('site_cash_advance_item')?></div>
											<div class="col-md-1">:</div>
											<div class="col-md-6"><p class="h3">
												<input type="text" name="site_cash_advance_item" id="site_cash_advance_item" class="input-sm form-control" value="<?=$site_cash_advance['item_code']?>&nbsp;-&nbsp;<?=$site_cash_advance['item_name']?>" readonly="true" >
											</div>
										</div>
										
										<div class="row inline-fields form-group form-md-line-input">
											<div class="col-md-4"><?=lang('site_cash_advance_from')?></div>
											<div class="col-md-1">:</div>
											<div class="col-md-6"><p class="h3">
												<input type="text" name="site_cash_advance_from" id="site_cash_advance_from" class="input-sm form-control" value="<?=$site_cash_advance['from_code']?>&nbsp;-&nbsp;<?=$site_cash_advance['from_name']?>" readonly="true" >
											</div>
										</div>
										
										<div class="row inline-fields form-group form-md-line-input">
											<div class="col-md-4"><?=lang('site_cash_advance_to')?></div>
											<div class="col-md-1">:</div>
											<div class="col-md-6"><p class="h3">
												<input type="text" name="site_cash_advance_to" id="site_cash_advance_to" class="input-sm form-control" value="<?=$site_cash_advance['to_code']?>&nbsp;-&nbsp;<?=$site_cash_advance['to_name']?>" readonly="true" >
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
											<input type="text" name="site_cash_advance_driveremployee" id="site_cash_advance_driveremployee" class="input-sm form-control" value="<?=$site_cash_advance['employee_driver_code']?>&nbsp;-&nbsp;<?=$site_cash_advance['employee_driver_name']?>" readonly="true" >
										</div>
									</div>
									
									<div>
										<div class="row inline-fields form-group form-md-line-input">
										<div class="col-md-4"><?=lang('site_cash_advance_truck_no')?><span class="text-danger">*</span></div>
										<div class="col-md-1">:</div>
										<div class="col-md-6"><p class="h3">
											<input type="text" name="site_cash_advance_truck_no" id="site_cash_advance_truck_no" class="input-sm form-control" value="<?=$site_cash_advance['police_no']?>" readonly="true" >
										</div>
									</div>
									
									<div>
										<div class="row inline-fields form-group form-md-line-input">
										<div class="col-md-4"><?=lang('site_cash_advance_vehicle_type')?><span class="text-danger">*</span></div>
										<div class="col-md-1">:</div>
										<div class="col-md-6"><p class="h3">
											<input type="text" name="site_cash_advance_vehicle_type" id="site_cash_advance_vehicle_type" class="input-sm form-control" value="<?=$site_cash_advance['vehicle_code']?>&nbsp;-&nbsp;<?=$site_cash_advance['vehicle_name']?>"" readonly="true" >
										</div>
									</div>
									
									<div id="site_cash_advance_amount1">
										<div class="row inline-fields form-group form-md-line-input">
											<div class="col-md-4"><?=lang('site_cash_advance_amount')?><span class="text-danger">*</span></div>
											<div class="col-md-1">:</div>
											<div class="col-md-6"><p class="h3">
												<input type="text" name="site_cash_advance_amount" name="site_cash_advance_amount" 
																								value="<?php 
																									$advance_amount=$site_cash_advance['advance_amt']; 
																									echo  number_format($advance_amount,0,',','.')?>" 
																									class="input-sm form-control" readonly="true" >
											</div>
											</div>
										</div>
									</div>
									
									<div class="row inline-fields form-group form-md-line-input">
										<div class="col-md-4"><?=lang('site_cash_advance_description')?><span class="text-danger">*</span></div>
										<div class="col-md-1">:</div>
										<div class="col-md-6"><p class="h3">
											<input type="text" name="site_cash_advance_description" name="site_cash_advance_description" value="<?=$site_cash_advance['description']?>" class="input-sm form-control" readonly="true" >
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
						<a href="<?=base_url()?>/site_cash_advance"> <button type="submit" class="btn btn-sm btn-success" value="Back"><i class="fa fa-plus"></i> <?=lang('job_order_back')?> </button></a>
					</div>
					</form>
					<?php } } ?>
				</section>  
			</section> 
		</aside>
	</section> 
</section>



<!-- end -->
