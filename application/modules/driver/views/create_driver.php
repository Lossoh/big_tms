<section id="content">
	<section class="hbox stretch">		
		<aside>
			<section class="vbox">
				<header class="header bg-white b-b b-light">
					<p><?=lang('driver_add')?></p>
				</header>
				<section class="scrollable wrapper">
				<?php
					$attributes = array('class' => 'bs-example form-horizontal');
					echo form_open(base_url().'driver/create',$attributes); ?>

						<div class="row"> 
							<h4 class="subheader text-muted">&ensp;&ensp;<?=lang('data_driver')?>&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;<?=lang('driver_bank_account_no1')?></h4>
							<br>
							<div class="col-xs-6">
								<div class="group">

									
									<div class="row inline-fields form-group form-md-line-input">
										<div id="driver_id_type" >
										<div class="col-md-4"><?=lang('driver_id_type')?><span class="text-danger">*</span></div>
										<div class="col-md-1">:</div>
										<div class="col-md-6"><p class="h3">
										<select id="driver_id_type" class="form-control" name="driver_id_type">	
											<option value="K">KTP</option>
											<option value="S">SIM</option>
											<option value="P">Passport</option>
										</select> 										
										</div>
										</div>
									</div>
									
									<div class="row inline-fields form-group form-md-line-input">
										<div id="driver_id_number" >
										<div class="col-md-4"><?=lang('driver_id_number')?><span class="text-danger">*</span></div>
										<div class="col-md-1">:</div>
										<div class="col-md-6"><p class="h3">
											<input type="text" placeholder="Input ID Number" name="driver_id_number"  class="input-sm form-control">
										</div>
										</diV>
									</div>
									
									<div class="row inline-fields form-group form-md-line-input">
										<div class="col-md-4"><?=lang('driv_name')?><span class="text-danger">*</span></div>
										<div class="col-md-1">:</div>
										<div class="col-md-6"><p class="h3">
											<input type="text" placeholder="Input Driver Name" name="driver_name"  class="input-sm form-control" >
										</div>
									</div>

									
									
									<div class="row inline-fields form-group form-md-line-input">
										<div class="col-md-4"><?=lang('driver_address')?></div>
										<div class="col-md-1">:</div>
										<div class="col-md-6"><p class="h3">
											<input type="text" placeholder="Input Driver Address" name="driver_address1" value="<?=$driver_address1?>" class="input-sm form-control" >
										</div>
									</div>
									
									<div class="row inline-fields form-group form-md-line-input">
										<div class="col-md-4"></div>
										<div class="col-md-1"></div>
										<div class="col-md-6"><p class="h3">
											<input type="text" placeholder="Input Driver Address" name="driver_address2" value="<?=$driver_address2?>" class="input-sm form-control" >
										</div>
									</div>
									
									<div class="row inline-fields form-group form-md-line-input">
										<div class="col-md-4"></div>
										<div class="col-md-1"></div>
										<div class="col-md-6"><p class="h3">
											<input type="text" placeholder="Input Driver Address" name="driver_address3" value="<?=$debtor_address3?>" class="input-sm form-control" >
										</div>
									</div>
									
									<div class="row inline-fields form-group form-md-line-input">
										<div class="col-md-4"><?=lang('driver_postal_code')?></div>
										<div class="col-md-1">:</div>
										<div class="col-md-6"><p class="h3">
											<input type="text" placeholder="Input Postal Code" name="driver_postal_code"  class="input-sm form-control" >
										</div>
									</div>
									
									<div class="row inline-fields form-group form-md-line-input">
										<div class="col-md-4"><?=lang('driver_email')?></div>
										<div class="col-md-1">:</div>
										<div class="col-md-6"><p class="h3">
											<input type="text" placeholder="Input E-Mail" name="driver_email" class="input-sm form-control" >
										</div>
									</div>
									
									<div class="row inline-fields form-group form-md-line-input">
										<div class="col-md-4"><?=lang('driver_phone1')?></div>
										<div class="col-md-1">:</div>
										<div class="col-md-6"><p class="h3">
											<input type="text" placeholder="Input Driver Phone 1" name="driver_phone1" value="<?=$driver_phone1?>" class="input-sm form-control" >
										</div>
									</div>
									
									<div class="row inline-fields form-group form-md-line-input">
										<div class="col-md-4"><?=lang('driver_phone2')?></div>
										<div class="col-md-1">:</div>
										<div class="col-md-6"><p class="h3">
											<input type="text" placeholder="Input Driver Phone 2" name="driver_phone2"  class="input-sm form-control" >
										</div>
									</div>
									
									<div class="row inline-fields form-group form-md-line-input">
										<div id="debtor_hp1" >
											<div class="col-md-4"><?=lang('driver_hp1')?></div>
											<div class="col-md-1">:</div>
											<div class="col-md-6"><p class="h3">
												<input type="text" placeholder="Input Hand Phone 1" name="driver_hp1" value="<?=$driver_hp1?>" class="input-sm form-control" >
											</div>
										</div>
									</div>
									
									<div class="row inline-fields form-group form-md-line-input">
										<div id="debtor_hp2" >
											<div class="col-md-4"><?=lang('driver_hp2')?></div>
											<div class="col-md-1">:</div>
											<div class="col-md-6"><p class="h3">
												<input type="text" placeholder="Input Hand Phone 2" name="driver_hp2" value="<?=$driver_hp2?>" class="input-sm form-control" >
											</div>
										</div>
									</div>
									
									<div class="row inline-fields form-group form-md-line-input">
										<div class="col-md-4"><?=lang('driver_gender')?></div>
										<div class="col-md-1">:</div>
										<div class="col-md-6"><p class="h3">
										<select id="driver_gender" class="form-control" name="driver_gender" >	
											<option value="M">Male</option>
											<option value="F">Female</option>
										</select> 										
										</div>
									</div>

									<div class="row inline-fields form-group form-md-line-input">
										<div class="col-md-4"><?=lang('driver_pob')?></div>
										<div class="col-md-1">:</div>
										<div class="col-md-6"><p class="h3">
											<input type="text" placeholder="Input Driver POB" name="driver_pob" class="input-sm form-control" >
										</div>
									</div>
									
									<div class="row inline-fields form-group form-md-line-input">
										<div id="debtor_dob" >
											<div class="col-md-4"><?=lang('driver_dob')?></div>
											<div class="col-md-1">:</div>
											<div class="col-md-6"><p class="h3">
												<input type="text" placeholder="yyyy-mm-dd" name="driver_dob" class="input-sm form-control" >
											</div>
										</div>
									</div>
									
									<div class="row inline-fields form-group form-md-line-input">
										<div class="col-md-4"><?=lang('driver_driving_license')?></div>
										<div class="col-md-1">:</div>
										<div class="col-md-6"><p class="h3">
										<select id="driver_driving_license" class="form-control" name="driver_driving_license" >	
											<option value="A">A</option>
											<option value="B1">B1</option>
											<option value="B2">B2</option>
											<option value="C">C</option>
										</select> 										
										</div>
									</div>
									
									<div class="row inline-fields form-group form-md-line-input">
										<div id="debtor_dob" >
											<div class="col-md-4"><?=lang('driver_driving_license_no')?></div>
											<div class="col-md-1">:</div>
											<div class="col-md-6"><p class="h3">
												<input type="text"  placeholder="Input No Driving License" name="driver_driving_license_no" class="input-sm form-control" >
											</div>
										</div>
									</div>
									
									<div class="row inline-fields form-group form-md-line-input">
										<div id="debtor_dob" >
											<div class="col-md-4"><?=lang('driver_driving_license_expired')?></div>
											<div class="col-md-1">:</div>
											<div class="col-md-6"><p class="h3">
												<input type="text"  placeholder="Input Expired Driving License" name="driver_driving_license_expired" class="input-sm form-control" >
											</div>
										</div>
									</div>
							
									<h4 class="subheader text-muted"><?=lang('driver_tax_registered')?></h4>
									<br>
									
									<div class="row inline-fields form-group form-md-line-input">
										<div class="col-md-4"><?=lang('driver_npwp')?></div>
										<div class="col-md-1">:</div>
										<div class="col-md-6"><p class="h3">
											<input type="text" placeholder="Input NPWP" name="driver_npwp" value="<?=$driver_npwp?>" class="input-sm form-control" >
										</div>
									</div>
									
									<div class="row inline-fields form-group form-md-line-input">
										<div class="col-md-4"><?=lang('driver_npwp_registered')?></div>
										<div class="col-md-1">:</div>
										<div class="col-md-6"><p class="h3">
											<input type="text" placeholder="Input Registered Date" name="driver_npwp_registered"  class="input-sm form-control" >
										</div>
									</div>
									
									<div class="row inline-fields form-group form-md-line-input">
										<div class="col-md-4"><?=lang('driver_name_npwp')?></div>
										<div class="col-md-1">:</div>
										<div class="col-md-6"><p class="h3">
											<input type="text" placeholder="Input NPWP Name" name="driver_npwp_name" value="<?=$driver_npwp_name?>" class="input-sm form-control" >
										</div>
									</div>
									
									<div class="row inline-fields form-group form-md-line-input">
										<div class="col-md-4"><?=lang('driver_npwp_address')?></div>
										<div class="col-md-1">:</div>
										<div class="col-md-6"><p class="h3">
											<input type="text" placeholder="Input NPWP Address" name="driver_npwp_address1"  class="input-sm form-control">
										</div>
									</div>
									
									<div class="row inline-fields form-group form-md-line-input">
										<div class="col-md-4"></div>
										<div class="col-md-1"></div>
										<div class="col-md-6"><p class="h3">
											<input type="text" placeholder="Input NPWP Address" name="driver_npwp_address2"  class="input-sm form-control">
										</div>
									</div>
									<div class="row inline-fields form-group form-md-line-input">
										<div class="col-md-4"></div>
										<div class="col-md-1"></div>
										<div class="col-md-6"><p class="h3">
											<input type="text" placeholder="Input NPWP Address" name="driver_npwp_address3" class="input-sm form-control" >
										</div>
									</div>
								</div>							
							</div>
								
								<div class="col-xs-6 text-left">
									<div class="group">
									
										<div class="row inline-fields form-group form-md-line-input">
											<div class="col-md-4"><?=lang('driver_bank_account_no')?></div>
											<div class="col-md-1">:</div>
											<div class="col-md-6"><p class="h3">
												<input type="text" placeholder="Input Bank Account" name="driver_bank_account"  class="input-sm form-control">
											</div>
										</div>
										
										<div class="row inline-fields form-group form-md-line-input">
											<div class="col-md-4"><?=lang('driver_bank_account_name')?></div>
											<div class="col-md-1">:</div>
											<div class="col-md-6"><p class="h3">
												<input type="text" placeholder="Input Bank Account Name" name="driver_bank_account_name"  class="input-sm form-control">
											</div>
										</div>

										<div class="row inline-fields form-group form-md-line-input">
											<div class="col-md-4"><?=lang('driver_bank_account_bank')?></div>
											<div class="col-md-1">:</div>
											<div class="col-md-6"><p class="h3">
												<input type="text" placeholder="Input Bank Account Bank" name="driver_bank_account_bank"  class="input-sm form-control" >
											</div>
										</div>
																				
										<h4 class="subheader text-muted"><?=lang('debt_type')?></h4>
										<br>

										<div class="row inline-fields form-group form-md-line-input">
											<div class="col-md-4"><?=lang('driver_code')?></div>
											<div class="col-md-1">:</div>
											<div class="col-md-6"><p class="h3">
												<select class="form-control" name="driver_code" id="driver_code" >	
													 <?php if (!empty($debtors)) {
													  foreach ($debtors as $debtor) { ?>
													  <option value="<?php echo $debtor->rowID;?>"><?php echo $debtor->type_cd;?>&nbsp;-&nbsp;<?php echo $debtor->name;?></option>
													 <?php }} ?>
												</select> 
											</div>
										</div>
										
										<div class="row inline-fields form-group form-md-line-input">
											
											<div id="debtor_type_name">
											</div>
										</div>
										
									</div>
								</div>
							</div>
						</div>
				
					<div class="line"></div>
					<div>
						<button type="submit" class="btn btn-sm btn-success" value="Save"><i class="fa fa-plus"></i> <?=lang('debtor_save')?></button>
					</div>
					</form>
					
				</section>  
			</section> 
		</aside>
	</section> 
</section>



<!-- end -->
