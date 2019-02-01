<div class="modal-dialog">
	<div class="modal-content">
		<div class="modal-header"> <button type="button" class="close" data-dismiss="modal">&times;</button> 
		<h4 class="modal-title"><?=lang('edit_debtortype')?></h4>
		</div>
		<?php
			$attributes = array('class' => 'bs-example form-horizontal');
			echo form_open(base_url().'debtor_type/view/update',$attributes); ?>
			<?php
			if (!empty($debtor_type_details)) {
				foreach ($debtor_type_details as $debtor_type_detail) { ?>
				<div class="modal-body">
					<input type="hidden" name="row_id" value="<?=$debtor_type_detail->rowID?>">		
				 
					<div class="form-group form-md-line-input">
					<label class="col-lg-4 control-label"><?=lang('debtortype_type_cd')?> <span class="text-danger">*</span></label>
					<div class="col-lg-8">
						<input type="text" class="form-control" value="<?=$debtor_type_detail->type_cd?>" name="debtortype_type_cd" readonly="true" required>
					</div>
					</div>
					
					<div class="form-group form-md-line-input">
					<label class="col-lg-4 control-label"><?=lang('debtortype_name')?> <span class="text-danger">*</span></label>
					<div class="col-lg-8">
						<input type="text" class="form-control" value="<?=$debtor_type_detail->name?>" name="debtortype_name" autocomplete="off" required>
					</div>
					</div>
					
					<div class="form-group form-md-line-input">
					<label class="col-lg-4 control-label"><?=lang('debtortype_receivable_acc')?> <span class="text-danger">*</span></label>
					<div class="col-lg-8">
						<select name="debtortype_receivable_acc" class="form-control" required>
							   <?php
								  if (!empty($coas)) {
								  foreach ($coas as $coa) { ?>
								  <option value="<?php echo $coa->acc_cd; ?>" <?php if($coa->acc_cd==$debtor_type_detail->receivable_acc){echo "selected";} ?>><?php echo $coa->acc_cd; ?>-<?php echo $coa->acc_name; ?></option>
								  
								<?php }}?>
						</select>
					</div>
					</div>
					
					<div class="form-group form-md-line-input">
					<label class="col-lg-4 control-label"><?=lang('debtortype_advance_acc')?> <span class="text-danger">*</span></label>
					<div class="col-lg-8">
						<select name="debtortype_advance_acc" class="form-control" required>
							   <?php
								  if (!empty($coas)) {
								  foreach ($coas as $coa) { ?>
								  <option value="<?php echo $coa->acc_cd; ?>" <?php if($coa->acc_cd==$debtor_type_detail->advance_acc){echo "selected";} ?>><?php echo $coa->acc_cd; ?>-<?php echo $coa->acc_name; ?></option>
								  
								<?php }}?>
						</select>
					</div>
					</div>
					
					<div class="form-group form-md-line-input">
					<label class="col-lg-4 control-label"><?=lang('debtortype_deposit_acc')?> <span class="text-danger">*</span></label>
					<div class="col-lg-8">
						<select name="debtortype_deposit_acc" class="form-control" required>
							   <?php
								  if (!empty($coas)) {
								  foreach ($coas as $coa) { ?>
								  <option value="<?php echo $coa->acc_cd; ?>" <?php if($coa->acc_cd==$debtor_type_detail->deposit_acc){echo "selected";} ?>><?php echo $coa->acc_cd; ?>-<?php echo $coa->acc_name; ?></option>
								  
								<?php }}?>
						</select>
					</div>
					</div>
					
					<div class="form-group form-md-line-input">
					<label class="col-lg-4 control-label"><?=lang('debtortype_rounding_acc')?> <span class="text-danger">*</span></label>
					<div class="col-lg-8">
						<select name="debtortype_rounding_acc" class="form-control" required>
							<option value ="0">Select</option>
							   <?php
								  if (!empty($coas)) {
								  foreach ($coas as $coa) { ?>
								  <option value="<?php echo $coa->acc_cd; ?>" <?php if($coa->acc_cd==$debtor_type_detail->rounding_acc){echo "selected";} ?>><?php echo $coa->acc_cd; ?>-<?php echo $coa->acc_name; ?></option>
								  
								<?php }}?>
						</select>
					</div>
					</div>
					
					<div class="form-group form-md-line-input">
					<label class="col-lg-4 control-label"><?=lang('debtortype_adm_acc')?> <span class="text-danger">*</span></label>
					<div class="col-lg-8">
						<select name="debtortype_adm_acc" class="form-control" required>
							<option value ="0">Select</option>
							   <?php
								  if (!empty($coas)) {
								  foreach ($coas as $coa) { ?>
								  <option value="<?php echo $coa->acc_cd; ?>" <?php if($coa->acc_cd==$debtor_type_detail->adm_acc){echo "selected";} ?>><?php echo $coa->acc_cd; ?>-<?php echo $coa->acc_name; ?></option>
								  
								<?php }}?>
						</select>
					</div>
					</div>


				</div>
				<div class="modal-footer"> <a href="#" class="btn btn-default" data-dismiss="modal"><?=lang('close')?></a> 
				<button type="submit" class="btn green"><?=lang('save_changes')?></button>
				</form>
				<?php }} ?>
				</div>
	</div>
	<!-- /.modal-content -->
</div>
<!-- /.modal-dialog -->