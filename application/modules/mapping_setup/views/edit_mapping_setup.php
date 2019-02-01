<section id="content">
	<section class="hbox stretch">		
		<aside>
			<section class="vbox">
				<header class="header bg-white b-b b-light">
					<p><?=lang('edit_mapping_setup')?></p>
				</header>
				<section class="scrollable wrapper">
				<?php
					$attributes = array('class' => 'bs-example form-horizontal');
					echo form_open(base_url().'mapping_setup/update',$attributes);
					if (!empty($mapping_setup_details)) {
						foreach ($mapping_setup_details as $mapping_setup_detail) {
				?>

						<div class="row"> 
							<h4 class="subheader text-muted">&ensp;&ensp;<?=lang('mapping_setup_default_setting')?>&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;<?=lang('mapping_setup_prefix_number')?></h4>
							<br>
							<div class="col-xs-6">
								<div class="group">	
									
									<div class="row inline-fields form-group form-md-line-input">
										<div class="col-md-4"><?=lang('mapping_setup_trans_acc')?><span class="text-danger">*</span></div>
										<div class="col-md-1">:</div>
										<div class="col-md-6"><p class="h3">
											<input type="hidden"  name="row_id" value="<?=$mapping_setup_detail['rowID']?>" class="input-sm form-control">
											<select name="mapping_setup_trans_acc" class="form-control" required>
											<option value ="0">Select</option>
												   <?php
													  if (!empty($gl_coas)) {
													  foreach ($gl_coas as $gl_coa) { ?>
													  <option value="<?php echo $gl_coa->rowID; ?>" <?php if ($mapping_setup_detail['gl_coaID_trans_acc'] == $gl_coa->rowID){echo"selected";} ?>><?php echo $gl_coa->acc_cd; ?>&nbsp;-&nbsp;<?php echo $gl_coa->acc_name;?></option>
													<?php }}?>
											</select>
										</diV>
									</div>
									
									<div class="row inline-fields form-group form-md-line-input">
										<div class="col-md-4"><?=lang('mapping_setup_cash_opr_acc')?><span class="text-danger">*</span></div>
										<div class="col-md-1">:</div>
										<div class="col-md-6"><p class="h3">
											<select name="mapping_setup_cash_opr_acc" class="form-control" required>
											<option value ="0">Select</option>
												   <?php
													  if (!empty($gl_coas)) {
													  foreach ($gl_coas as $gl_coa) { ?>
													  <option value="<?php echo $gl_coa->rowID; ?>" <?php if ($mapping_setup_detail['gl_coaID_cash_opr_acc'] == $gl_coa->rowID){echo"selected";} ?>><?php echo $gl_coa->acc_cd; ?>&nbsp;-&nbsp;<?php echo $gl_coa->acc_name;?></option>
													<?php }}?>
											</select>
										</div>
									</div>
									
									<div class="row inline-fields form-group form-md-line-input">
										<div class="col-md-4"><?=lang('mapping_setup_bank_receipt_acc')?><span class="text-danger">*</span></div>
										<div class="col-md-1">:</div>
										<div class="col-md-6"><p class="h3">
											<select name="mapping_setup_bank_receipt_acc" class="form-control" required>
											<option value ="0">Select</option>
												   <?php
													  if (!empty($gl_coas)) {
													  foreach ($gl_coas as $gl_coa) { ?>
													  <option value="<?php echo $gl_coa->rowID; ?>" <?php if ($mapping_setup_detail['gl_coaID_bank_receipt_acc'] == $gl_coa->rowID){echo"selected";} ?>><?php echo $gl_coa->acc_cd; ?>&nbsp;-&nbsp;<?php echo $gl_coa->acc_name; ?></option>
													<?php }}?>
											</select>
										</div>
									</div>
									
									<div class="row inline-fields form-group form-md-line-input">
										<div class="col-md-4"><?=lang('mapping_setup_bank_payment_acc')?><span class="text-danger">*</span></div>
										<div class="col-md-1">:</div>
										<div class="col-md-6"><p class="h3">
											<select name="mapping_setup_bank_payment_acc" class="form-control" required>
											<option value ="0">Select</option>
												   <?php
													  if (!empty($gl_coas)) {
													  foreach ($gl_coas as $gl_coa) { ?>
													  <option value="<?php echo $gl_coa->rowID; ?>" <?php if ($mapping_setup_detail['gl_coaID_bank_payment_acc'] == $gl_coa->rowID){echo"selected";} ?>><?php echo $gl_coa->acc_cd; ?>&nbsp;-&nbsp;<?php echo $gl_coa->acc_name; ?></option>
													<?php }}?>
											</select>
										</div>
									</div>
									
									<div class="row inline-fields form-group form-md-line-input">
										<div class="col-md-4"><?=lang('mapping_setup_cash_adv')?><span class="text-danger">*</span></div>
										<div class="col-md-1">:</div>
										<div class="col-md-6"><p class="h3">
											<select name="mapping_setup_cash_adv" class="form-control" required>
											<option value ="0">Select</option>
												   <?php
													  if (!empty($employees)) {
													  foreach ($employees as $employee) { ?>
													  <option value="<?php echo $employee->rowID; ?>" <?php if ($mapping_setup_detail['employeeID_cash_adv'] == $employee->rowID){echo"selected";} ?>><?php echo $employee->employee_cd; ?>&nbsp;-&nbsp;<?php echo $employee->employee_name; ?></option>
													<?php }}?>
											</select>
										</div>
									</div>
									
									<div class="row inline-fields form-group form-md-line-input">
										<div class="col-md-4"><?=lang('mapping_setup_default_uom')?><span class="text-danger">*</span></div>
										<div class="col-md-1">:</div>
										<div class="col-md-6"><p class="h3">
											<select name="mapping_setup_default_uom" class="form-control" required>
											<option value ="0">Select</option>
												   <?php
													  if (!empty($uoms)) {
													  foreach ($uoms as $uom) { ?>
													  <option value="<?php echo $uom->rowID; ?>" <?php if ($mapping_setup_detail['uomID_uom'] == $uom->rowID){echo"selected";} ?>><?php echo $uom->uom_cd; ?>&nbsp;-&nbsp;<?php echo $uom->descs; ?></option>
													<?php }}?>
											</select>
										</div>
									</div>
									
									<div class="row inline-fields form-group form-md-line-input">
										<div class="col-md-4"><?=lang('mapping_setup_cogs_journal_to')?><span class="text-danger">*</span></div>
										<div class="col-md-1">:</div>
										<div class="col-md-6"><p class="h3">
											<select name="mapping_setup_cogs_journal_to" class="form-control" required>
											<option value ="0">Select</option>
												  <option value="E" <?php if ($mapping_setup_detail['cogs_journal_to'] == "E"){echo"selected";} ?>>Expense</option>
												  <option value="W" <?php if ($mapping_setup_detail['cogs_journal_to'] == "W"){echo"selected";} ?>>WIP</option>
													
											</select>
										</div>
									</div>
									
								</div>							
							</div>
								
								<div class="col-xs-6 text-left">
									<div class="group">
									
										<div class="row inline-fields form-group form-md-line-input">
										<div class="col-md-4"><?=lang('mapping_setup_general_journal')?></div>
										<div class="col-md-1">:</div>
										<div class="col-md-6"><p class="h3">
												<input type="text" placeholder="Input General Journal" name="mapping_setup_general_journal" value="<?=$mapping_setup_detail['general_jrn']?>" class="input-sm form-control">
											</div>
										</div>
										
										<div class="row inline-fields form-group form-md-line-input">
										<div class="col-md-4"><?=lang('mapping_setup_memorial_journal')?></div>
										<div class="col-md-1">:</div>
										<div class="col-md-6"><p class="h3">
												<input type="text" placeholder="Input Memorial Journal" name="mapping_setup_memorial_journal" value="<?=$mapping_setup_detail['memorial_jrn']?>" class="input-sm form-control">
											</div>
										</div>

										<div class="row inline-fields form-group form-md-line-input">
										<div class="col-md-4"><?=lang('mapping_setup_bank_receipt')?></div>
										<div class="col-md-1">:</div>
										<div class="col-md-6"><p class="h3">
												<input type="text" placeholder="Input Bank Receipt" name="mapping_setup_bank_receipt" value="<?=$mapping_setup_detail['bank_rcp']?>" class="input-sm form-control">
											</div>
										</div>
										
										<div class="row inline-fields form-group form-md-line-input">
										<div class="col-md-4"><?=lang('mapping_setup_bank_payment')?></div>
										<div class="col-md-1">:</div>
										<div class="col-md-6"><p class="h3">
												<input type="text" placeholder="Input Bank Payment" name="mapping_setup_bank_payment" value="<?=$mapping_setup_detail['bank_pay']?>" class="input-sm form-control">
											</div>
										</div>
										
										<div class="row inline-fields form-group form-md-line-input">
										<div class="col-md-4"><?=lang('mapping_setup_cash_receipt')?></div>
										<div class="col-md-1">:</div>
										<div class="col-md-6"><p class="h3">
												<input type="text" placeholder="Input Cash Receipt" name="mapping_setup_cash_receipt" value="<?=$mapping_setup_detail['cash_rcp']?>" class="input-sm form-control">
											</div>
										</div>
										
										<div class="row inline-fields form-group form-md-line-input">
										<div class="col-md-4"><?=lang('mapping_setup_cash_payment')?></div>
										<div class="col-md-1">:</div>
										<div class="col-md-6"><p class="h3">
												<input type="text" placeholder="Input Cash Payment" name="mapping_setup_cash_payment" value="<?=$mapping_setup_detail['cash_pay']?>" class="input-sm form-control">
										</div>
										</div>
										
										<div class="row inline-fields form-group form-md-line-input">
										<div class="col-md-4"><?=lang('mapping_setup_wo')?></div>
										<div class="col-md-1">:</div>
										<div class="col-md-6"><p class="h3">
												<input type="text" placeholder="Input Work Order" name="mapping_setup_wo" value="<?=$mapping_setup_detail['wo']?>" class="input-sm form-control">
										</div>
										</div>
										
										<div class="row inline-fields form-group form-md-line-input">
										<div class="col-md-4"><?=lang('mapping_setup_po')?></div>
										<div class="col-md-1">:</div>
										<div class="col-md-6"><p class="h3">
												<input type="text" placeholder="Input Purchase Order" name="mapping_setup_po" value="<?=$mapping_setup_detail['po']?>" class="input-sm form-control">
										</div>
										</div>
										
										<div class="row inline-fields form-group form-md-line-input">
										<div class="col-md-4"><?=lang('mapping_setup_co')?></div>
										<div class="col-md-1">:</div>
										<div class="col-md-6"><p class="h3">
												<input type="text" placeholder="Input Confirmation Order" name="mapping_setup_co" value="<?=$mapping_setup_detail['co']?>" class="input-sm form-control">
										</div>
										</div>
										
										<div class="row inline-fields form-group form-md-line-input">
										<div class="col-md-4"><?=lang('mapping_setup_jo')?></div>
										<div class="col-md-1">:</div>
										<div class="col-md-6"><p class="h3">
												<input type="text" placeholder="Input Job Order" name="mapping_setup_jo" value="<?=$mapping_setup_detail['jo']?>" class="input-sm form-control">
										</div>
										</div>
										
										<div class="row inline-fields form-group form-md-line-input">
										<div class="col-md-4"><?=lang('mapping_setup_do')?></div>
										<div class="col-md-1">:</div>
										<div class="col-md-6"><p class="h3">
												<input type="text" placeholder="Input Delivery Order" name="mapping_setup_do" value="<?=$mapping_setup_detail['do']?>" class="input-sm form-control">
										</div>
										</div>
										
										<div class="row inline-fields form-group form-md-line-input">
										<div class="col-md-4"><?=lang('mapping_setup_pod')?></div>
										<div class="col-md-1">:</div>
										<div class="col-md-6"><p class="h3">
												<input type="text" placeholder="Input Prove of Delivery" name="mapping_setup_pod" value="<?=$mapping_setup_detail['pod']?>" class="input-sm form-control">
										</div>
										</div>
										
										<div class="row inline-fields form-group form-md-line-input">
										<div class="col-md-4"><?=lang('mapping_setup_cab')?></div>
										<div class="col-md-1">:</div>
										<div class="col-md-6"><p class="h3">
												<input type="text" placeholder="Input Cash Advance Budget" name="mapping_setup_cab" value="<?=$mapping_setup_detail['cash_adv_bgt']?>" class="input-sm form-control">
										</div>
										</div>
										
										<div class="row inline-fields form-group form-md-line-input">
										<div class="col-md-4"><?=lang('mapping_setup_caa')?></div>
										<div class="col-md-1">:</div>
										<div class="col-md-6"><p class="h3">
												<input type="text" placeholder="Input Cash Advance Approval" name="mapping_setup_caa" value="<?=$mapping_setup_detail['cash_adv_apv']?>" class="input-sm form-control">
										</div>
										</div>
										
										<div class="row inline-fields form-group form-md-line-input">
										<div class="col-md-4"><?=lang('mapping_setup_cas')?></div>
										<div class="col-md-1">:</div>
										<div class="col-md-6"><p class="h3">
												<input type="text" placeholder="Input Cash Advance Seattlement" name="mapping_setup_cas" value="<?=$mapping_setup_detail['cash_adv_stl']?>" class="input-sm form-control">
										</div>
										</div>
										
										<div class="row inline-fields form-group form-md-line-input">
										<div class="col-md-4"><?=lang('mapping_setup_cjo')?></div>
										<div class="col-md-1">:</div>
										<div class="col-md-6"><p class="h3">
												<input type="text" placeholder="Input Closing JO" name="mapping_setup_cjo" value="<?=$mapping_setup_detail['closing_jo']?>" class="input-sm form-control">
										</div>
										</div>
										
										<div class="row inline-fields form-group form-md-line-input">
										<div class="col-md-4"><?=lang('mapping_setup_ca')?></div>
										<div class="col-md-1">:</div>
										<div class="col-md-6"><p class="h3">
												<input type="text" placeholder="Input Customer Advance" name="mapping_setup_ca" value="<?=$mapping_setup_detail['cst_adv']?>" class="input-sm form-control">
										</div>
										</div>
										
										<div class="row inline-fields form-group form-md-line-input">
										<div class="col-md-4"><?=lang('mapping_setup_ai')?></div>
										<div class="col-md-1">:</div>
										<div class="col-md-6"><p class="h3">
												<input type="text" placeholder="Input AR Invoice" name="mapping_setup_ai" value="<?=$mapping_setup_detail['ar_inv']?>" class="input-sm form-control">
										</div>
										</div>
										
										<div class="row inline-fields form-group form-md-line-input">
										<div class="col-md-4"><?=lang('mapping_setup_api')?></div>
										<div class="col-md-1">:</div>
										<div class="col-md-6"><p class="h3">
												<input type="text" placeholder="Input AP Invoice" name="mapping_setup_api" value="<?=$mapping_setup_detail['ap_inv']?>" class="input-sm form-control">
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
