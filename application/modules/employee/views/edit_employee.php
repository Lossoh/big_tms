<section id="content">
	<section class="hbox stretch">		
		<aside>
			<section class="vbox">
				<header class="header bg-white b-b b-light">
					<p><?=lang('employee_edit')?></p>
				</header>
				<section class="scrollable wrapper">
				<?php
					$attributes = array('class' => 'bs-example form-horizontal');
					echo form_open(base_url().'employee/view/update',$attributes);
					if (!empty($employee_details)) {
						foreach ($employee_details as $employee_detail) {
				?>

						<div class="row"> 
							<h4 class="subheader text-muted">&ensp;&ensp;<?=lang('data_employee')?>&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;<?=lang('employee_bank_account_no1')?></h4>
							<br>
							<div class="col-xs-6">
								<div class="group">	
									
									<div class="row inline-fields form-group form-md-line-input">
										<div class="col-md-4"><?=lang('employee_code')?><span class="text-danger">*</span></div>
										<div class="col-md-1">:</div>
										<div class="col-md-6"><p class="h3">
											<input type="hidden"  name="row_id" value="<?=$employee_detail->rowID?>" class="input-sm form-control">
											<input type="text"  name="employee_code" value="<?=$employee_detail->debtor_cd?>" class="input-sm form-control" readonly="true">
										</diV>
									</div>
									
									<div class="row inline-fields form-group form-md-line-input">
										<div class="col-md-4"><?=lang('employee_id_type')?><span class="text-danger">*</span></div>
										<div class="col-md-1">:</div>
										<div class="col-md-6"><p class="h3">
										<select id="employee_id_type" class="form-control" name="employee_id_type">	
											<option value="K" <?php if ($employee_detail->id_type == 'K'){echo"selected";} else {echo"";} ?>>KTP</option>
											<option value="S" <?php if ($employee_detail->id_type == 'S'){echo"selected";} else {echo"";} ?>>SIM</option>
											<option value="P" <?php if ($employee_detail->id_type == 'P'){echo"selected";} else {echo"";} ?>>Passport</option>
										</select> 										
										</div>
									</div>
									
									<div class="row inline-fields form-group form-md-line-input">
										<div id="employee_id_number" >
										<div class="col-md-4"><?=lang('employee_id_number')?><span class="text-danger">*</span></div>
										<div class="col-md-1">:</div>
										<div class="col-md-6"><p class="h3">
											<input type="text" placeholder="Input ID Number" name="employee_id_number"  value="<?=$employee_detail->id_no?>" class="input-sm form-control">
										</div>
										</diV>
									</div>
									
									<div class="row inline-fields form-group form-md-line-input">
										<div class="col-md-4"><?=lang('driv_name')?><span class="text-danger">*</span></div>
										<div class="col-md-1">:</div>
										<div class="col-md-6"><p class="h3">
											<input type="text" placeholder="Input employee Name" name="employee_name"  value="<?=$employee_detail->debtor_name?>" class="input-sm form-control" >
										</div>
									</div>
									
									<div class="row inline-fields form-group form-md-line-input">
										<div class="col-md-4"><?=lang('employee_address')?></div>
										<div class="col-md-1">:</div>
										<div class="col-md-6"><p class="h3">
											<input type="text" placeholder="Input employee Address" name="employee_address1" value="<?=$employee_detail->address1?>" class="input-sm form-control" >
										</div>
									</div>
									
									<div class="row inline-fields form-group form-md-line-input">
										<div class="col-md-4"></div>
										<div class="col-md-1"></div>
										<div class="col-md-6"><p class="h3">
											<input type="text" placeholder="Input employee Address" name="employee_address2" value="<?=$employee_detail->address2?>" class="input-sm form-control" >
										</div>
									</div>
									
									<div class="row inline-fields form-group form-md-line-input">
										<div class="col-md-4"></div>
										<div class="col-md-1"></div>
										<div class="col-md-6"><p class="h3">
											<input type="text" placeholder="Input employee Address" name="employee_address3" value="<?=$employee_detail->address3?>" class="input-sm form-control" >
										</div>
									</div>
									
									<div class="row inline-fields form-group form-md-line-input">
										<div class="col-md-4"><?=lang('employee_postal_code')?></div>
										<div class="col-md-1">:</div>
										<div class="col-md-6"><p class="h3">
											<input type="text" placeholder="Input Postal Code" name="employee_postal_code" value="<?=$employee_detail->post_cd?>" class="input-sm form-control" >
										</div>
									</div>
									
									<div class="row inline-fields form-group form-md-line-input">
										<div class="col-md-4"><?=lang('employee_email')?></div>
										<div class="col-md-1">:</div>
										<div class="col-md-6"><p class="h3">
											<input type="text" placeholder="Input E-Mail" name="employee_email" value="<?=$employee_detail->email?>" class="input-sm form-control" >
										</div>
									</div>
									
									<div class="row inline-fields form-group form-md-line-input">
										<div class="col-md-4"><?=lang('employee_phone1')?></div>
										<div class="col-md-1">:</div>
										<div class="col-md-6"><p class="h3">
											<input type="text" placeholder="Input employee Phone 1" name="employee_phone1" value="<?=$employee_detail->telp_no1?>" class="input-sm form-control" >
										</div>
									</div>
									
									<div class="row inline-fields form-group form-md-line-input">
										<div class="col-md-4"><?=lang('employee_phone2')?></div>
										<div class="col-md-1">:</div>
										<div class="col-md-6"><p class="h3">
											<input type="text" placeholder="Input employee Phone 2" name="employee_phone2"  value="<?=$employee_detail->telp_no2?>" class="input-sm form-control" >
										</div>
									</div>
									
									<div class="row inline-fields form-group form-md-line-input">
											<div class="col-md-4"><?=lang('employee_hp1')?></div>
											<div class="col-md-1">:</div>
											<div class="col-md-6"><p class="h3">
												<input type="text" placeholder="Input Hand Phone 1" name="employee_hp1" value="<?=$employee_detail->hp_no1?>" class="input-sm form-control" >
											</div>
									</div>
									
									<div class="row inline-fields form-group form-md-line-input">
										<div class="col-md-4"><?=lang('employee_gender')?></div>
										<div class="col-md-1">:</div>
										<div class="col-md-6"><p class="h3">
										<select id="employee_gender" class="form-control" name="employee_gender" >	
											<option value="M" <?php if ($employee_detail->sex == 'M'){echo"selected";} else {echo"";}?>>Male</option>
											<option value="F"  <?php if ($employee_detail->sex == 'F'){echo"selected";} else {echo"";}?>>Female</option>
										</select> 										
										</div>
									</div>
									
									<div class="row inline-fields form-group form-md-line-input">
										<div class="col-md-4"><?=lang('employee_pob')?></div>
										<div class="col-md-1">:</div>
										<div class="col-md-6"><p class="h3">
											<input type="text" placeholder="Input employee POB" name="employee_pob" value="<?=$employee_detail->pob?>"class="input-sm form-control" >
										</div>
									</div>
									
									<div class="row inline-fields form-group form-md-line-input">
										<div id="debtor_dob" >
											<div class="col-md-4"><?=lang('employee_dob')?></div>
											<div class="col-md-1">:</div>
											<div class="col-md-6"><p class="h3">
												<input type="text" placeholder="yyyy-mm-dd" name="employee_dob" value="<?=$employee_detail->dob?>" class="input-sm form-control" >
											</div>
										</div>
									</div>
									
									<div class="row inline-fields form-group form-md-line-input">
										<div class="col-md-4"><?=lang('employee_driving_license')?></div>
										<div class="col-md-1">:</div>
										<div class="col-md-6"><p class="h3">
										<select id="employee_driving_license" class="form-control" name="employee_driving_license"  value="<?=$employee_detail->driving_license?>" >	
											<option value="A" <?php if ($employee_detail->driving_license == 'A'){echo"selected";} else {echo"";}?>>A</option>
											<option value="B1" <?php if ($employee_detail->driving_license == 'B1'){echo"selected";} else {echo"";}?>>B1</option>
											<option value="B2" <?php if ($employee_detail->driving_license == 'B2'){echo"selected";} else {echo"";}?>>B2</option>
											<option value="C" <?php if ($employee_detail->driving_license == 'C'){echo"selected";} else {echo"";}?>>C</option>
										</select> 										
										</div>
									</div>
									
									<div class="row inline-fields form-group form-md-line-input">
										<div id="debtor_dob" >
											<div class="col-md-4"><?=lang('employee_driving_license_no')?></div>
											<div class="col-md-1">:</div>
											<div class="col-md-6"><p class="h3">
												<input type="text"  placeholder="Input No Driving License" name="employee_driving_license_no" class="input-sm form-control"  value="<?=$employee_detail->driving_license_no?>" >
											</div>
										</div>
									</div>
									
									<div class="row inline-fields form-group form-md-line-input">
										<div class="col-md-4"><?=lang('employee_driving_license_expired')?></div>
										<div class="col-md-1">:</div>
										<div class="col-md-6"><p class="h3">
											<input type="text"  placeholder="Input Expired Driving expired" name="employee_driving_license_expired" class="input-sm form-control"  value="<?=$employee_detail->driving_license_expired?>">
										</div>
									</div>

							
									<h4 class="subheader text-muted"><?=lang('employee_tax_registered')?></h4>
									<br>
									
									<div class="row inline-fields form-group form-md-line-input">
										<div class="col-md-4"><?=lang('employee_npwp')?></div>
										<div class="col-md-1">:</div>
										<div class="col-md-6"><p class="h3">
											<input type="text" placeholder="Input NPWP" name="employee_npwp"  class="input-sm form-control" value="<?=$employee_detail->npwp_no?>">
										</div>
									</div>
									
									<div class="row inline-fields form-group form-md-line-input">
										<div class="col-md-4"><?=lang('employee_npwp_registered')?></div>
										<div class="col-md-1">:</div>
										<div class="col-md-6"><p class="h3">
											<input type="text" placeholder="Input Registered Date" name="employee_npwp_registered"  class="input-sm form-control" class="input-sm form-control" value="<?=$employee_detail->reg_date?>" >
										</div>
									</div>
									
									<div class="row inline-fields form-group form-md-line-input">
										<div class="col-md-4"><?=lang('employee_name_npwp')?></div>
										<div class="col-md-1">:</div>
										<div class="col-md-6"><p class="h3">
											<input type="text" placeholder="Input NPWP Name" name="employee_npwp_name"  class="input-sm form-control" value="<?=$employee_detail->npwp_name?>" >
										</div>
									</div>
									
									<div class="row inline-fields form-group form-md-line-input">
										<div class="col-md-4"><?=lang('employee_npwp_address')?></div>
										<div class="col-md-1">:</div>
										<div class="col-md-6"><p class="h3">
											<input type="text" placeholder="Input NPWP Address" name="employee_npwp_address1"  class="input-sm form-control" value="<?=$employee_detail->npwp_address1?>">
										</div>
									</div>
									
									<div class="row inline-fields form-group form-md-line-input">
										<div class="col-md-4"></div>
										<div class="col-md-1"></div>
										<div class="col-md-6"><p class="h3">
											<input type="text" placeholder="Input NPWP Address" name="employee_npwp_address2"  class="input-sm form-control" value="<?=$employee_detail->npwp_address2?>">
										</div>
									</div>
									<div class="row inline-fields form-group form-md-line-input">
										<div class="col-md-4"></div>
										<div class="col-md-1"></div>
										<div class="col-md-6"><p class="h3">
											<input type="text" placeholder="Input NPWP Address" name="employee_npwp_address3" class="input-sm form-control" value="<?=$employee_detail->npwp_address3?>">
										</div>
									</div>
								</div>							
							</div>
								
								<div class="col-xs-6 text-left">
									<div class="group">
									
										<div class="row inline-fields form-group form-md-line-input">
											<div class="col-md-4"><?=lang('employee_bank_account_no')?></div>
											<div class="col-md-1">:</div>
											<div class="col-md-6"><p class="h3">
												<input type="text" placeholder="Input Bank Account" name="employee_bank_account"  class="input-sm form-control" value="<?=$employee_detail->bank_acc?>">
											</div>
										</div>
										
										<div class="row inline-fields form-group form-md-line-input">
											<div class="col-md-4"><?=lang('employee_bank_account_name')?></div>
											<div class="col-md-1">:</div>
											<div class="col-md-6"><p class="h3">
												<input type="text" placeholder="Input Bank Account Name" name="employee_bank_account_name"  class="input-sm form-control" value="<?=$employee_detail->bank_acc_name?>">
											</div>
										</div>

										<div class="row inline-fields form-group form-md-line-input">
											<div class="col-md-4"><?=lang('employee_bank_account_bank')?></div>
											<div class="col-md-1">:</div>
											<div class="col-md-6"><p class="h3">
												<input type="text" placeholder="Input Bank Account Bank" name="employee_bank_account_bank"  class="input-sm form-control" value="<?=$employee_detail->bank_name?>" >
											</div>
										</div>
																				
										<h4 class="subheader text-muted"><?=lang('debt_type')?></h4>
										<br>

										<div class="row inline-fields form-group form-md-line-input">
											<div class="col-md-4"><?=lang('employee_code')?></div>
											<div class="col-md-1">:</div>
											<div class="col-md-6"><p class="h3">
												<select class="form-control" name="employee_code" id="employee_code" >	
													 <?php if (!empty($debtors)) {
													  foreach ($debtors as $debtor) { ?>
														<option value="<?php echo $debtor->rowID;?>" <?php if ($debtor->rowID==$employee_detail->debtor_type_rowID) {echo"selected";}else {echo"";} ?>><?php echo $debtor->type_cd;?>&nbsp;-&nbsp;<?php echo $debtor->name;?></option>
													 <?php }} ?>
												</select> 
											</div>
										</div>
										
										<div class="row inline-fields form-group form-md-line-input">
											
											<div id="employee_name">
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
