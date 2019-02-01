<div class="modal-dialog">
	<div class="modal-content">
		<div class="modal-header"> <button type="button" class="close" data-dismiss="modal">&times;</button> 
		<h4 class="modal-title"> <?=lang('edit_ap_type')?></h4>
		</div>
		<?php
			$attributes = array('class' => 'bs-example form-horizontal');
			echo form_open(base_url().'ap_type/view/update',$attributes); ?>
			<?php
			if (!empty($ap_type_details)) {
				foreach ($ap_type_details as $ap_type_detail) { ?>
				<div class="modal-body">
					<input type="hidden" name="row_id" value="<?=$ap_type_detail->rowID?>">
					
					<div class="form-group form-md-line-input">
					<label class="col-lg-4 control-label"><?=lang('ap_type_code')?> <span class="text-danger">*</span></label>
					<div class="col-lg-8">
						<input type="text" class="form-control" value="<?=$ap_type_detail->ap_type_cd?>" name="ap_type_code" readonly="true" required>
					</div>
					</div>
					
					<div class="form-group form-md-line-input">
					<label class="col-lg-4 control-label"><?=lang('ap_type_name')?> <span class="text-danger">*</span></label>
					<div class="col-lg-8">
						<input type="text" class="form-control" value="<?=$ap_type_detail->ap_type_name?>" name="ap_type_name" autocomplete="off" required>
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