<div class="modal-dialog">
	<div class="modal-content">
		<div class="modal-header"> <button type="button" class="close" data-dismiss="modal">&times;</button> 
		<h4 class="modal-title"><?=lang('edit')?> <?=lang('department')?></h4>
		</div>
		<?php
			$attributes = array('class' => 'bs-example form-horizontal');
			echo form_open(base_url().'department/view/update',$attributes); ?>
			<?php
			if (!empty($department_details)) {
				foreach ($department_details as $department) { ?>
				<div class="modal-body">
					<input type="hidden" name="row_id" value="<?=$department->rowID?>">		
				 
					<div class="form-group form-md-line-input">
					<label class="col-lg-4 control-label"><?=lang('department_cd')?> <span class="text-danger">*</span></label>
					<div class="col-lg-8">
						<input type="text" class="form-control" value="<?=$department->dep_cd?>" name="department_code" readonly="true" required>
					</div>
					</div>
					<div class="form-group form-md-line-input">
					<label class="col-lg-4 control-label"><?=lang('department_name')?> <span class="text-danger">*</span></label>
					<div class="col-lg-8">
						<input type="text" class="form-control" value="<?=$department->dep_name?>" name="department_name" autocomplete="off" required>
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