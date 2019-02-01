<section id="content">
	<section class="hbox stretch">		
		<aside>
			<section class="vbox">
				<header class="header bg-white b-b b-light">
					<p><?=lang('debtor_edit')?></p>
				</header>
				<section class="scrollable wrapper">
				<?php
					$attributes = array('class' => 'bs-example form-horizontal');
					echo form_open(base_url().'debtor/view/update',$attributes);
					if (!empty($debtor_details)) {
						foreach ($debtor_details as $debtor_detail) {
				?>

						<div class="row"> 
							<h4 class="subheader text-muted">&ensp;&ensp;<?=lang('debtor_data_customer')?>&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;<?=lang('debt_bank_account_no1')?></h4>
							<br>
							<div class="col-xs-6">
								<div class="group">	
									
									<div class="row inline-fields form-group form-md-line-input">
										<div class="col-md-4"><?=lang('debtor_code')?><span class="text-danger">*</span></div>
										<div class="col-md-1">:</div>
										<div class="col-md-6"><p class="h3">
											<input type="hidden"  name="row_id" value="<?=$debtor_detail->rowID?>" class="input-sm form-control">
											<input type="text"  name="debtor_code" value="<?=$debtor_detail->debtor_cd?>" class="input-sm form-control" readonly="true">
										</diV>
									</div>
									
									<div class="row inline-fields form-group form-md-line-input">
										<div class="col-md-4"><?=lang('debtor_type')?><span class="text-danger">*</span></div>
										<div class="col-md-1">:</div>
										<div class="col-md-6"><p class="h3">
											<input type="text" placeholder="Input ID Number" name="debtor_id_number" value="<?=$debtor_detail->type?>" class="input-sm form-control" readonly="true">
										</div>
									</div>

									
									<div class="row inline-fields form-group form-md-line-input">
										<div class="col-md-4"><?=lang('debtor_category')?><span class="text-danger">*</span></div>
										<div class="col-md-1">:</div>
										<div >&nbsp;&nbsp;&nbsp										
											<input type="checkbox"  name="debtor_category" id="debtor_company" value="C" <?php if ($debtor_detail->class == 'C'){echo"checked";} else {echo"";}?>>Company&nbsp;
											<input type="checkbox"  name="debtor_category" value="I" <?php if ($debtor_detail->class == 'I'){echo"checked";} else {echo"";}?>>Individu <br/><br/>
										</div>
									</div>
									
									<div class="row inline-fields form-group form-md-line-input">
										<div class="col-md-4"><?=lang('debtor_id_type')?><span class="text-danger">*</span></div>
										<div class="col-md-1">:</div>
										<div class="col-md-6"><p class="h3">
										<select id="debtor_id_type" class="form-control" name="debtor_id_type" value="<?php $debtor_detail->id_type;?>">	
											<option value="K" <?php if ($debtor_detail->id_type == 'K'){echo"selected";} else {echo"";}?>>KTP</option>
											<option value="S" <?php if ($debtor_detail->id_type == 'S'){echo"selected";} else {echo"";}?>>SIM</option>
											<option value="P" <?php if ($debtor_detail->id_type == 'P'){echo"selected";} else {echo"";}?>>Passport</option>
										</select> 										
										</div>
									</div>
									
									<div class="row inline-fields form-group form-md-line-input">
										<div class="col-md-4"><?=lang('debtor_id_number')?><span class="text-danger">*</span></div>
										<div class="col-md-1">:</div>
										<div class="col-md-6"><p class="h3">
											<input type="text" placeholder="Input ID Number" name="debtor_id_number" value="<?=$debtor_detail->type?>" class="input-sm form-control">
										</div>
									</div>
									
									
									<div class="row inline-fields form-group form-md-line-input">
										<div class="col-md-4"><?=lang('debtor_id_number')?><span class="text-danger">*</span></div>
										<div class="col-md-1">:</div>
										<div class="col-md-6"><p class="h3">
											<input type="text" placeholder="Input ID Number" name="debtor_id_number" value="<?=$debtor_detail->id_no?>" class="input-sm form-control">
										</div>
									</div>
									
									<div class="row inline-fields form-group form-md-line-input">
										<div class="col-md-4"><?=lang('debtor_name')?><span class="text-danger">*</span></div>
										<div class="col-md-1">:</div>
										<div class="col-md-6"><p class="h3">
											<input type="text" placeholder="Input Debtor Name" name="debtor_name" value="<?=$debtor_detail->debtor_name?>" class="input-sm form-control" >
										</div>
									</div>
									
									<div class="row inline-fields form-group form-md-line-input">
										<div class="col-md-4"><?=lang('debtor_address')?></div>
										<div class="col-md-1">:</div>
										<div class="col-md-6"><p class="h3">
											<input type="text" placeholder="Input Debtor Address" name="debtor_address1" value="<?=$debtor_detail->address1?>" class="input-sm form-control" >
										</div>
									</div>
									
									<div class="row inline-fields form-group form-md-line-input">
										<div class="col-md-4"></div>
										<div class="col-md-1"></div>
										<div class="col-md-6"><p class="h3">
											<input type="text" placeholder="Input Debtor Address" name="debtor_address2" value="<?=$debtor_detail->address2?>" class="input-sm form-control" >
										</div>
									</div>
									
									<div class="row inline-fields form-group form-md-line-input">
										<div class="col-md-4"></div>
										<div class="col-md-1"></div>
										<div class="col-md-6"><p class="h3">
											<input type="text" placeholder="Input Debtor Address" name="debtor_address3" value="<?=$debtor_detail->address3?>" class="input-sm form-control" >
										</div>
									</div>
									
									<div class="row inline-fields form-group form-md-line-input">
										<div class="col-md-4"><?=lang('debtor_postal_code')?></div>
										<div class="col-md-1">:</div>
										<div class="col-md-6"><p class="h3">
											<input type="text" placeholder="Input Postal Code" name="debtor_postal_code" value="<?=$debtor_detail->post_cd?>" class="input-sm form-control" >
										</div>
									</div>
									
									<div class="row inline-fields form-group form-md-line-input">
										<div class="col-md-4"><?=lang('debtor_phone1')?></div>
										<div class="col-md-1">:</div>
										<div class="col-md-6"><p class="h3">
											<input type="text" placeholder="Input Debtor Phone 1" name="debtor_phone1" value="<?=$debtor_detail->telp_no1?>" class="input-sm form-control" >
										</div>
									</div>
									
									<div class="row inline-fields form-group form-md-line-input">
										<div class="col-md-4"><?=lang('debtor_phone2')?></div>
										<div class="col-md-1">:</div>
										<div class="col-md-6"><p class="h3">
											<input type="text" placeholder="Input Debtor Phone 2" name="debtor_phone2" value="<?=$debtor_detail->telp_no2?>" class="input-sm form-control" >
										</div>
									</div>
									
									<div class="row inline-fields form-group form-md-line-input">
										<div class="col-md-4"><?=lang('debtor_fax1')?></div>
										<div class="col-md-1">:</div>
										<div class="col-md-6"><p class="h3">
											<input type="text" placeholder="Input Debtor Fax 1" name="debtor_fax1" value="<?=$debtor_detail->fax_no1?>" class="input-sm form-control" >
										</div>
									</div>
									
									<div class="row inline-fields form-group form-md-line-input">
										<div class="col-md-4"><?=lang('debtor_fax2')?></div>
										<div class="col-md-1">:</div>
										<div class="col-md-6"><p class="h3">
											<input type="text" placeholder="Input Debtor Fax 2" name="debtor_fax2" value="<?=$debtor_detail->fax_no2?>" class="input-sm form-control" >
										</div>
									</div>
									
									<div class="row inline-fields form-group form-md-line-input">
										<div class="col-md-4"><?=lang('debtor_contact')?></div>
										<div class="col-md-1">:</div>
										<div class="col-md-6"><p class="h3">
											<input type="text" placeholder="Input Contact Person" name="debtor_contact" value="<?=$debtor_detail->contact_prs?>" class="input-sm form-control" >
										</div>
									</div>
									
									<div class="row inline-fields form-group form-md-line-input">
										<div class="col-md-4"><?=lang('debtor_website')?></div>
										<div class="col-md-1">:</div>
										<div class="col-md-6"><p class="h3">
											<input type="text" placeholder="Input Website" name="debtor_website" value="<?=$debtor_detail->website?>" class="input-sm form-control" >
										</div>
									</div>
									
									<div class="row inline-fields form-group form-md-line-input">
										<div class="col-md-4"><?=lang('debtor_email')?></div>
										<div class="col-md-1">:</div>
										<div class="col-md-6"><p class="h3">
											<input type="text" placeholder="Input E-Mail" name="debtor_email" value="<?=$debtor_detail->email?>" class="input-sm form-control" >
										</div>
									</div>
									
									<div class="row inline-fields form-group form-md-line-input">
											<div class="col-md-4"><?=lang('debtor_hp1')?></div>
											<div class="col-md-1">:</div>
											<div class="col-md-6"><p class="h3">
												<input type="text" placeholder="Input Hand Phone 1" name="debtor_hp1" value="<?=$debtor_detail->hp_no1?>" class="input-sm form-control" >
											</div>
									</div>
									
									<div class="row inline-fields form-group form-md-line-input">
											<div class="col-md-4"><?=lang('debtor_hp2')?></div>
											<div class="col-md-1">:</div>
											<div class="col-md-6"><p class="h3">
												<input type="text" placeholder="Input Hand Phone 2" name="debtor_hp2" value="<?=$debtor_detail->hp_no2?>" class="input-sm form-control" >
											</div>
									</div>
									
									<div class="row inline-fields form-group form-md-line-input">
										<div class="col-md-4"><?=lang('debtor_gender')?></div>
										<div class="col-md-1">:</div>
										<div class="col-md-6"><p class="h3">
										<select id="debtor_gender" class="form-control" name="debtor_gender" >	
											<option value="M" <?php if ($debtor_detail->sex == 'M'){echo"selected";} else {echo"";}?>>Male</option>
											<option value="F" <?php if ($debtor_detail->sex == 'F'){echo"selected";} else {echo"";}?>>Female</option>
										</select> 										
										</div>
									</div>
									
									<div class="row inline-fields form-group form-md-line-input">
											<div class="col-md-4"><?=lang('debtor_pob')?></div>
											<div class="col-md-1">:</div>
											<div class="col-md-6"><p class="h3">
												<input type="text" placeholder="Input POB" name="debtor_pob" value="<?=$debtor_detail->pob?>" class="input-sm form-control" >
											</div>
									</div>
									
									<div class="row inline-fields form-group form-md-line-input">
											<div class="col-md-4"><?=lang('debtor_dob')?></div>
											<div class="col-md-1">:</div>
											<div class="col-md-6"><p class="h3">
												<input type="text" placeholder="Input Debtor DOB" name="debtor_dob" value="<?=$debtor_detail->dob?>" class="input-sm form-control" >
											</div>
									</div>
							
									<h4 class="subheader text-muted"><?=lang('debt_tax_registered')?></h4>
									<br>
									
									<div class="row inline-fields form-group form-md-line-input">
										<div class="col-md-4"><?=lang('debtor_npwp')?></div>
										<div class="col-md-1">:</div>
										<div class="col-md-6"><p class="h3">
											<input type="text" placeholder="Input NPWP" name="debtor_npwp" value="<?=$debtor_detail->npwp_no?>" class="input-sm form-control" >
										</div>
									</div>
									
									<div class="row inline-fields form-group form-md-line-input">
										<div class="col-md-4"><?=lang('debtor_npwp_registered')?></div>
										<div class="col-md-1">:</div>
										<div class="col-md-6"><p class="h3">
											<input type="text" placeholder="Input Registered Date" name="debtor_npwp_registered" value="<?=$debtor_detail->reg_date?>" class="input-sm form-control" >
										</div>
									</div>
									
									<div class="row inline-fields form-group form-md-line-input">
										<div class="col-md-4"><?=lang('debtor_name_npwp')?></div>
										<div class="col-md-1">:</div>
										<div class="col-md-6"><p class="h3">
											<input type="text" placeholder="Input NPWP Name" name="debtor_npwp_name" value="<?=$debtor_detail->npwp_name?>" class="input-sm form-control" >
										</div>
									</div>
									
									<div class="row inline-fields form-group form-md-line-input">
										<div class="col-md-4"><?=lang('debtor_npwp_address')?></div>
										<div class="col-md-1">:</div>
										<div class="col-md-6"><p class="h3">
											<input type="text" placeholder="Input NPWP Address" name="debtor_npwp_address1" value="<?=$debtor_detail->npwp_address1?>" class="input-sm form-control">
										</div>
									</div>
									
									<div class="row inline-fields form-group form-md-line-input">
										<div class="col-md-4"></div>
										<div class="col-md-1"></div>
										<div class="col-md-6"><p class="h3">
											<input type="text" placeholder="Input NPWP Address" name="debtor_npwp_address2" value="<?=$debtor_detail->npwp_address2?>" class="input-sm form-control">
										</div>
									</div>
									<div class="row inline-fields form-group form-md-line-input">
										<div class="col-md-4"></div>
										<div class="col-md-1"></div>
										<div class="col-md-6"><p class="h3">
											<input type="text" placeholder="Input NPWP Address" name="debtor_npwp_address3" value="<?=$debtor_detail->npwp_address3?>" class="input-sm form-control" >
										</div>
									</div>
								</div>							
							</div>
								
								<div class="col-xs-6 text-left">
									<div class="group">
									
										<div class="row inline-fields form-group form-md-line-input">
											<div class="col-md-4"><?=lang('debtor_bank_account_no1')?></div>
											<div class="col-md-1">:</div>
											<div class="col-md-6"><p class="h3">
												<input type="text" placeholder="Input Bank Account No. 1" name="debtor_bank_account_no1" value="<?=$debtor_detail->bank_acc1?>" class="input-sm form-control">
											</div>
										</div>
										
										<div class="row inline-fields form-group form-md-line-input">
											<div class="col-md-4"><?=lang('debtor_bank_account_name1')?></div>
											<div class="col-md-1">:</div>
											<div class="col-md-6"><p class="h3">
												<input type="text" placeholder="Input Bank Account Name 1" name="debtor_bank_account_name1" value="<?=$debtor_detail->bank_acc_name1?>" class="input-sm form-control">
											</div>
										</div>

										<div class="row inline-fields form-group form-md-line-input">
											<div class="col-md-4"><?=lang('debtor_bank_account_bank1')?></div>
											<div class="col-md-1">:</div>
											<div class="col-md-6"><p class="h3">
												<input type="text" placeholder="Input Bank Account Bank 1" name="debtor_bank_account_bank1" value="<?=$debtor_detail->bank_name1?>" class="input-sm form-control" >
											</div>
										</div>
																				
										<h4 class="subheader text-muted"><?=lang('debt_bank_account_no2')?></h4>
										<br>
										
										<div class="row inline-fields form-group form-md-line-input">
											<div class="col-md-4"><?=lang('debtor_bank_account_no2')?></div>
											<div class="col-md-1">:</div>
											<div class="col-md-6"><p class="h3">
												<input type="text" placeholder="Input Bank Account No. 2" name="debtor_bank_account_no2" value="<?=$debtor_detail->bank_acc2?>" class="input-sm form-control">
											</div>
										</div>
										
										<div class="row inline-fields form-group form-md-line-input">
											<div class="col-md-4"><?=lang('debtor_bank_account_name2')?></div>
											<div class="col-md-1">:</div>
											<div class="col-md-6"><p class="h3">
												<input type="text" placeholder="Input Bank Account Name 2" name="debtor_bank_account_name2" value="<?=$debtor_detail->bank_acc_name2?>" class="input-sm form-control">
											</div>
										</div>
										
										<div class="row inline-fields form-group form-md-line-input">
											<div class="col-md-4"><?=lang('debtor_bank_account_bank2')?></div>
											<div class="col-md-1">:</div>
											<div class="col-md-6"><p class="h3">
												<input type="text" placeholder="Input Bank Account Bank 2" name="debtor_bank_account_bank2" value="<?=$debtor_detail->bank_name2?>" class="input-sm form-control">
											</div>
										</div>
										
										<h4 class="subheader text-muted"><?=lang('debt_type')?></h4>
										<br>

										<div class="row inline-fields form-group form-md-line-input">
											<div class="col-md-4"><?=lang('debtor_code')?></div>
											<div class="col-md-1">:</div>
											<div class="col-md-6"><p class="h3">
												<select class="form-control" name="debtor_code" id="debtor_code" >	
												 <?php if (!empty($debtors)) {
												  foreach ($debtors as $debtor) { ?>
												  <option value="<?php echo $debtor->rowID;?>" <?php if ($debtor->rowID==$debtor_detail->type_cd) {echo"selected";}else {echo"";} ?>><?php echo $debtor->type_cd;?></option>
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
				<?php }} ?>
				</section>  
			</section> 
		</aside>
	</section> 
</section>



<!-- end -->
