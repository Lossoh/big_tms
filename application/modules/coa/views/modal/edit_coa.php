<div class="modal-dialog">
	<div class="modal-content">
		<div class="modal-header"> <button type="button" class="close" data-dismiss="modal">&times;</button> 
		<h4 class="modal-title"> <?=lang('coa')?></h4>
		</div>
		<?php
			$attributes = array('class' => 'bs-example form-horizontal');
			echo form_open(base_url().'coa/view/update',$attributes); ?>
			<?php
			if (!empty($coa_details)) {
				foreach ($coa_details as $coa) { ?>
				<div class="modal-body">
					<input type="hidden" name="row_id" value="<?=$coa->rowID?>">
					
					<div class="form-group form-md-line-input">
					<label class="col-lg-4 control-label"><?=lang('coa_type')?> <span class="text-danger">*</span></label>
					<div class="col-lg-8">
						<select name="coa_type" class="form-control" id="coa_type" readonly="true" required>
							<option value="H" <?php if ($coa->acc_type == H){echo"selected";} ?>>Header</option>
							<option value="D" <?php if ($coa->acc_type == D){echo"selected";} ?>>Detail</option>
						</select>
					</div>
					</div>
					
					<div class="form-group form-md-line-input">
					<label class="col-lg-4 control-label"><?=lang('coa_code')?> <span class="text-danger">*</span></label>
					<div class="col-lg-8">
						<input type="text" class="form-control" value="<?=$coa->acc_cd?>" name="coa_code" readonly="true" required>
					</div>
					</div>
					
					<div class="form-group form-md-line-input">
					<label class="col-lg-4 control-label"><?=lang('coa_name')?> <span class="text-danger">*</span></label>
					<div class="col-lg-8">
						<input type="text" class="form-control" value="<?=$coa->acc_name?>" name="department_name" autocomplete="off" required>
					</div>
					</div>
					
					<div class="form-group form-md-line-input">
						<label class="col-lg-4 control-label"><?=lang('coa_cb')?></label>
						<input type="checkbox" name="coa_cb"  value="<?php if (checked){echo "Y";} else {echo "N";}?>" <?php if($coa->is_cb == Y){echo "checked";} else {echo "";} ?>> &nbsp;
						<label><?=lang('coa_vatin')?></label> &nbsp; 
						<input type="checkbox" name="coa_vatin"  value="<?php if (checked){echo "Y";} else {echo "N";}?>" <?php if($coa->is_vat_in == Y){echo "checked";} else {echo "";} ?>> &nbsp;
						<label><?=lang('coa_vatout')?></label> &nbsp; 
						<input type="checkbox"  name="coa_vatout" value="<?php if (checked){echo "Y";} else {echo "N";}?>" <?php if($coa->is_vat_out == Y){echo "checked";} else {echo "";} ?>>
					</div>
					
					<div class="form-group form-md-line-input">
						<label class="col-lg-4 control-label"><?=lang('coa_transition')?></label>
						<input type="checkbox" name="coa_transition"  value="<?php if (checked){echo "Y";} else {echo "N";}?>" <?php if($coa->is_cb == Y){echo "checked";} else {echo "";} ?>> &nbsp;
						<label><?=lang('coa_active')?></label> &nbsp; 
						<input type="checkbox"  name="coa_active" value="<?php if (checked){echo "Y";} else {echo "N";}?>" <?php if($coa->active == Y){echo "checked";} else {echo "";} ?>> 
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