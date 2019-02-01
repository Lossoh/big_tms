<div class="modal-dialog">
	<div class="modal-content">
		<div class="modal-header"> <button type="button" class="close" data-dismiss="modal">&times;</button> 
		<h4 class="modal-title"> <?=lang('edit_cost_code')?></h4>
		</div>
		<?php
			$attributes = array('class' => 'bs-example form-horizontal');
			echo form_open(base_url().'cost_code/view/update',$attributes); ?>
			<?php
			if (!empty($cost_code_details)) {
				foreach ($cost_code_details as $cost_code_detail) { ?>
				<div class="modal-body">
					<input type="hidden" name="row_id" value="<?=$cost_code_detail->rowID?>">
					
					<div class="form-group form-md-line-input">
					<label class="col-lg-4 control-label"><?=lang('cost_code_type')?> <span class="text-danger">*</span></label>
					<div class="col-lg-8">
						<select name="cost_code_type" class="form-control" id="cost_code_type" readonly="true">
							<option value="H" <?php if ($cost_code_detail->type == H){echo"selected";} ?>>Header</option>
							<option value="D" <?php if ($cost_code_detail->type == D){echo"selected";} ?>>Detail</option>
						</select>
					</div>
					</div>
					
					<div class="form-group form-md-line-input">
					<label class="col-lg-4 control-label"><?=lang('cost_code_code')?> <span class="text-danger">*</span></label>
					<div class="col-lg-8">
						<input type="text" class="form-control" value="<?=$cost_code_detail->cost_cd?>" name="cost_code_code" readonly="true" required>
					</div>
					</div>
					
					<div class="form-group form-md-line-input">
					<label class="col-lg-4 control-label"><?=lang('cost_code_name')?> <span class="text-danger">*</span></label>
					<div class="col-lg-8">
						<input type="text" class="form-control" value="<?=$cost_code_detail->descs?>" name="cost_code_name" autocomplete="off" required>
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