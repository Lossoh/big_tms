<section id="content">
	<section class="hbox stretch">		
		<aside>
			<section class="vbox">
				<header class="header bg-white b-b b-light">
					<p><?=lang('driver_edit')?></p>
				</header>
				<section class="scrollable wrapper">
				<?php
					$attributes = array('class' => 'bs-example form-horizontal');
					echo form_open(base_url().'driver/view/update',$attributes);
					if (!empty($driver_details)) {
						foreach ($driver_details as $driver_detail) {
				?>

						<div class="row"> 
							<h4 class="subheader text-muted">&ensp;&ensp;<?=lang('data_driver')?>&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;<?=lang('driver_bank_account_no1')?></h4>
							<br>
							<div class="col-xs-6">
								<div class="group">	
									
									<div class="row inline-fields form-group form-md-line-input">
										<div class="col-md-4"><?=lang('driver_code')?><span class="text-danger">*</span></div>
										<div class="col-md-1">:</div>
										<div class="col-md-6"><p class="h3">
											<input type="hidden"  name="row_id" value="<?=$driver_detail->rowID?>" class="input-sm form-control">
											<input type="text"  name="driver_code" value="<?=$driver_detail->debtor_cd?>" class="input-sm form-control" readonly="true">
										</diV>
									</div>
									
									<div class="row inline-fields form-group form-md-line-input">
										<div class="col-md-4"><?=lang('driver_id_type')?><span class="text-danger">*</span></div>
										<div class="col-md-1">:</div>
										<div class="col-md-6"><p class="h3">
										<select id="driver_id_type" class="form-control" name="driver_id_type">	
											<option value="K" <?php if ($driver_detail->id_type == 'K'){echo"selected";} else {echo"";} ?>>KTP</option>
											<option value="S" <?php if ($driver_detail->id_type == 'S'){echo"selected";} else {echo"";} ?>>SIM</option>
											<option value="P" <?php if ($driver_detail->id_type == 'P'){echo"selected";} else {echo"";} ?>>Passport</option>
										</select> 										
										</div>
									</div>
									
									<div class="row inline-fields form-group form-md-line-input">
										<div id="driver_id_number" >
										<div class="col-md-4"><?=lang('driver_id_number')?><span class="text-danger">*</span></div>
										<div class="col-md-1">:</div>
										<div class="col-md-6"><p class="h3">
											<input type="text" placeholder="Input ID Number" name="driver_id_number"  value="<?=$driver_detail->id_no?>" class="input-sm form-control">
										</div>
										</diV>
									</div>
									
									<div class="row inline-fields form-group form-md-line-input">
										<div class="col-md-4"><?=lang('driv_name')?><span class="text-danger">*</span></div>
										<div class="col-md-1">:</div>
										<div class="col-md-6"><p class="h3">
											<input type="text" placeholder="Input Driver Name" name="driver_name"  value="<?=$driver_detail->debtor_name?>" class="input-sm form-control" >
										</div>
									</div>
									
									<div class="row inline-fields form-group form-md-line-input">
										<div class="col-md-4"><?=lang('driver_address')?></div>
										<div class="col-md-1">:</div>
										<div class="col-md-6"><p class="h3">
											<input type="text" placeholder="Input Driver Address" name="driver_address1" value="<?=$driver_detail->address1?>" class="input-sm form-control" >
										</div>
									</div>
									
									<div class="row inline-fields form-group form-md-line-input">
										<div class="col-md-4"></div>
										<div class="col-md-1"></div>
										<div class="col-md-6"><p class="h3">
											<input type="text" placeholder="Input Driver Address" name="driver_address2" value="<?=$driver_detail->address2?>" class="input-sm form-control" >
										</div>
									</div>
									
									<div class="row inline-fields form-group form-md-line-input">
										<div class="col-md-4"></div>
										<div class="col-md-1"></div>
										<div class="col-md-6"><p class="h3">
											<input type="text" placeholder="Input Driver Address" name="driver_address3" value="<?=$driver_detail->address3?>" class="input-sm form-control" >
										</div>
									</div>
									
									<div class="row inline-fields form-group form-md-line-input">
										<div class="col-md-4"><?=lang('driver_postal_code')?></div>
										<div class="col-md-1">:</div>
										<div class="col-md-6"><p class="h3">
											<input type="text" placeholder="Input Postal Code" name="driver_postal_code" value="<?=$driver_detail->post_cd?>" class="input-sm form-control" >
										</div>
									</div>
									
									<div class="row inline-fields form-group form-md-line-input">
										<div class="col-md-4"><?=lang('driver_email')?></div>
										<div class="col-md-1">:</div>
										<div class="col-md-6"><p class="h3">
											<input type="text" placeholder="Input E-Mail" name="driver_email" value="<?=$driver_detail->email?>" class="input-sm form-control" >
										</div>
									</div>
									
									<div class="row inline-fields form-group form-md-line-input">
										<div class="col-md-4"><?=lang('driver_phone1')?></div>
										<div class="col-md-1">:</div>
										<div class="col-md-6"><p class="h3">
											<input type="text" placeholder="Input Driver Phone 1" name="driver_phone1" value="<?=$driver_detail->telp_no1?>" class="input-sm form-control" >
										</div>
									</div>
									
									<div class="row inline-fields form-group form-md-line-input">
										<div class="col-md-4"><?=lang('driver_phone2')?></div>
										<div class="col-md-1">:</div>
										<div class="col-md-6"><p class="h3">
											<input type="text" placeholder="Input Driver Phone 2" name="driver_phone2"  value="<?=$driver_detail->telp_no2?>" class="input-sm form-control" >
										</div>
									</div>
									
									<div class="row inline-fields form-group form-md-line-input">
											<div class="col-md-4"><?=lang('driver_hp1')?></div>
											<div class="col-md-1">:</div>
											<div class="col-md-6"><p class="h3">
												<input type="text" placeholder="Input Hand Phone 1" name="driver_hp1" value="<?=$driver_detail->hp_no1?>" class="input-sm form-control" >
											</div>
									</div>
									
									<div class="row inline-fields form-group form-md-line-input">
										<div class="col-md-4"><?=lang('driver_gender')?></div>
										<div class="col-md-1">:</div>
										<div class="col-md-6"><p class="h3">
										<select id="driver_gender" class="form-control" name="driver_gender" >	
											<option value="M" <?php if ($driver_detail->sex == 'M'){echo"selected";} else {echo"";}?>>Male</option>
											<option value="F"  <?php if ($driver_detail->sex == 'F'){echo"selected";} else {echo"";}?>>Female</option>
										</select> 										
										</div>
									</div>
									
									<div class="row inline-fields form-group form-md-line-input">
										<div class="col-md-4"><?=lang('driver_pob')?></div>
										<div class="col-md-1">:</div>
										<div class="col-md-6"><p class="h3">
											<input type="text" placeholder="Input Driver POB" name="driver_pob" value="<?=$driver_detail->pob?>"class="input-sm form-control" >
										</div>
									</div>
									
									<div class="row inline-fields form-group form-md-line-input">
										<div id="debtor_dob" >
											<div class="col-md-4"><?=lang('driver_dob')?></div>
											<div class="col-md-1">:</div>
											<div class="col-md-6"><p class="h3">
												<input type="text" placeholder="yyyy-mm-dd" name="driver_dob" value="<?=$driver_detail->dob?>" class="input-sm form-control" >
											</div>
										</div>
									</div>
									
									<div class="row inline-fields form-group form-md-line-input">
										<div class="col-md-4"><?=lang('driver_driving_license')?></div>
										<div class="col-md-1">:</div>
										<div class="col-md-6"><p class="h3">
										<select id="driver_driving_license" class="form-control" name="driver_driving_license"  value="<?=$driver_detail->driving_license?>" >	
											<option value="A" <?php if ($driver_detail->driving_license == 'A'){echo"selected";} else {echo"";}?>>A</option>
											<option value="B1" <?php if ($driver_detail->driving_license == 'B1'){echo"selected";} else {echo"";}?>>B1</option>
											<option value="B2" <?php if ($driver_detail->driving_license == 'B2'){echo"selected";} else {echo"";}?>>B2</option>
											<option value="C" <?php if ($driver_detail->driving_license == 'C'){echo"selected";} else {echo"";}?>>C</option>
										</select> 										
										</div>
									</div>
									
									<div class="row inline-fields form-group form-md-line-input">
										<div id="debtor_dob" >
											<div class="col-md-4"><?=lang('driver_driving_license_no')?></div>
											<div class="col-md-1">:</div>
											<div class="col-md-6"><p class="h3">
												<input type="text"  placeholder="Input No Driving License" name="driver_driving_license_no" class="input-sm form-control"  value="<?=$driver_detail->driving_license_no?>" >
											</div>
										</div>
									</div>
									
									<div class="row inline-fields form-group form-md-line-input">
										<div class="col-md-4"><?=lang('driver_driving_license_expired')?></div>
										<div class="col-md-1">:</div>
										<div class="col-md-6"><p class="h3">
											<input type="text"  placeholder="Input Expired Driving expired" name="driver_driving_license_expired" class="input-sm form-control"  value="<?=$driver_detail->driving_license_expired?>">
										</div>
									</div>

							
									<h4 class="subheader text-muted"><?=lang('driver_tax_registered')?></h4>
									<br>
									
									<div class="row inline-fields form-group form-md-line-input">
										<div class="col-md-4"><?=lang('driver_npwp')?></div>
										<div class="col-md-1">:</div>
										<div class="col-md-6"><p class="h3">
											<input type="text" placeholder="Input NPWP" name="driver_npwp"  class="input-sm form-control" value="<?=$driver_detail->npwp_no?>">
										</div>
									</div>
									
									<div class="row inline-fields form-group form-md-line-input">
										<div class="col-md-4"><?=lang('driver_npwp_registered')?></div>
										<div class="col-md-1">:</div>
										<div class="col-md-6"><p class="h3">
											<input type="text" placeholder="Input Registered Date" name="driver_npwp_registered"  class="input-sm form-control" class="input-sm form-control" value="<?=$driver_detail->reg_date?>" >
										</div>
									</div>
									
									<div class="row inline-fields form-group form-md-line-input">
										<div class="col-md-4"><?=lang('driver_name_npwp')?></div>
										<div class="col-md-1">:</div>
										<div class="col-md-6"><p class="h3">
											<input type="text" placeholder="Input NPWP Name" name="driver_npwp_name"  class="input-sm form-control" value="<?=$driver_detail->npwp_name?>" >
										</div>
									</div>
									
									<div class="row inline-fields form-group form-md-line-input">
										<div class="col-md-4"><?=lang('driver_npwp_address')?></div>
										<div class="col-md-1">:</div>
										<div class="col-md-6"><p class="h3">
											<input type="text" placeholder="Input NPWP Address" name="driver_npwp_address1"  class="input-sm form-control" value="<?=$driver_detail->npwp_address1?>">
										</div>
									</div>
									
									<div class="row inline-fields form-group form-md-line-input">
										<div class="col-md-4"></div>
										<div class="col-md-1"></div>
										<div class="col-md-6"><p class="h3">
											<input type="text" placeholder="Input NPWP Address" name="driver_npwp_address2"  class="input-sm form-control" value="<?=$driver_detail->npwp_address2?>">
										</div>
									</div>
									<div class="row inline-fields form-group form-md-line-input">
										<div class="col-md-4"></div>
										<div class="col-md-1"></div>
										<div class="col-md-6"><p class="h3">
											<input type="text" placeholder="Input NPWP Address" name="driver_npwp_address3" class="input-sm form-control" value="<?=$driver_detail->npwp_address3?>">
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
												<input type="text" placeholder="Input Bank Account" name="driver_bank_account"  class="input-sm form-control" value="<?=$driver_detail->bank_acc1?>">
											</div>
										</div>
										
										<div class="row inline-fields form-group form-md-line-input">
											<div class="col-md-4"><?=lang('driver_bank_account_name')?></div>
											<div class="col-md-1">:</div>
											<div class="col-md-6"><p class="h3">
												<input type="text" placeholder="Input Bank Account Name" name="driver_bank_account_name"  class="input-sm form-control" value="<?=$driver_detail->bank_acc_name1?>">
											</div>
										</div>

										<div class="row inline-fields form-group form-md-line-input">
											<div class="col-md-4"><?=lang('driver_bank_account_bank')?></div>
											<div class="col-md-1">:</div>
											<div class="col-md-6"><p class="h3">
												<input type="text" placeholder="Input Bank Account Bank" name="driver_bank_account_bank"  class="input-sm form-control" value="<?=$driver_detail->bank_name1?>" >
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
														<option value="<?php echo $debtor->rowID;?>" <?php if ($debtor->rowID==$driver_detail->debtor_type_rowID) {echo"selected";}else {echo"";} ?>><?php echo $debtor->type_cd;?>&nbsp;-&nbsp;<?php echo $debtor->name;?></option>
													 <?php }} ?>
												</select> 
											</div>
										</div>
										
										<div class="row inline-fields form-group form-md-line-input">
											
											<div id="driver_name">
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
				<?php }} ?>
				</section>  
			</section> 
		</aside>
	</section> 
</section>



<!-- end -->
