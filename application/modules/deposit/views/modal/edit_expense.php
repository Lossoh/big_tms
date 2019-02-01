<div class="modal-dialog">
	<div class="modal-content">
		<div class="modal-header"> <button type="button" class="close" data-dismiss="modal">&times;</button> 
		<h4 class="modal-title"> <?=lang('edit_expenses')?></h4>
		</div>
		<?php
			$attributes = array('class' => 'bs-example form-horizontal');
			echo form_open(base_url().'expense/view/update',$attributes); ?>
			<?php
			if (!empty($expense_details)) {
				foreach ($expense_details as $expense_detail) { ?>
				<div class="modal-body">
					<input type="hidden" name="row_id" value="<?=$expense_detail->rowID?>">
					
					<div class="form-group form-md-line-input">
					<label class="col-lg-4 control-label"><?=lang('expenses_type')?> <span class="text-danger">*</span></label>
					<div class="col-lg-8">
						<select name="expense_type" class="form-control" id="expense_type" readonly="true" required>
							<option value="H" <?php if ($expense_detail->type == H){echo"selected";} ?>>Header</option>
							<option value="D" <?php if ($expense_detail->type == D){echo"selected";} ?>>Detail</option>
						</select>
					</div>
					</div>
					
					<div class="form-group form-md-line-input">
					<label class="col-lg-4 control-label"><?=lang('expenses_code')?> <span class="text-danger">*</span></label>
					<div class="col-lg-8">
						<input type="text" class="form-control" value="<?=$expense_detail->expense_cd?>" name="expense_code" readonly="true" required>
					</div>
					</div>
					
					<div class="form-group form-md-line-input">
					<label class="col-lg-4 control-label"><?=lang('expenses_name')?> <span class="text-danger">*</span></label>
					<div class="col-lg-8">
						<input type="text" class="form-control" value="<?=$expense_detail->descs?>" name="expenses_name" autocomplete="off" required>
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