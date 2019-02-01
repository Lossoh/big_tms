<div class="modal-dialog">
	<div class="modal-content">
		<div class="modal-header"> <button type="button" class="close" data-dismiss="modal">&times;</button> 
		<h4 class="modal-title"> <?=lang('edit_cost_code')?></h4>
		</div>
		<?php
			$attributes = array('class' => 'bs-example form-horizontal');
			echo form_open(base_url().'vehicle_category/view/update',$attributes); ?>
			<?php
			if (!empty($vehicle_category_details)) {
				foreach ($vehicle_category_details as $vehicle_category_detail) { ?>
				<div class="modal-body">
					<input type="hidden" name="row_id" value="<?=$vehicle_category_detail->rowID?>">
					
					<div class="form-group form-md-line-input">
					<label class="col-lg-4 control-label"><?=lang('vehicle_category_code')?> <span class="text-danger">*</span></label>
					<div class="col-lg-8">
						<input type="text" class="form-control" value="<?=$vehicle_category_detail->type_cd?>" name="vehicle_category_code" readonly="true">
					</div>
					</div>
					
					<div class="form-group form-md-line-input">
					<label class="col-lg-4 control-label"><?=lang('vehicle_category_name')?> <span class="text-danger">*</span></label>
					<div class="col-lg-8">
						<input type="text" class="form-control" value="<?=$vehicle_category_detail->type_name?>" name="vehicle_category_name" autocomplete="off" required>
					</div>
					</div>
					<div class="form-group form-md-line-input">
					<label class="col-lg-4 control-label"><?=lang('vehicle_category_weight')?></label>
					<div class="col-lg-8">
						<input type="text" class="form-control" value="<?=$vehicle_category_detail->weight?>" name="vehicle_category_weight" autocomplete="off">
					</div>
					</div>
					<div class="form-group form-md-line-input">
					<label class="col-lg-4 control-label"><?=lang('vehicle_category_max_weight')?></label>
					<div class="col-lg-8">
						<input type="text" class="form-control" value="<?=$vehicle_category_detail->max_weight?>" name="vehicle_category_max_weight" autocomplete="off">
					</div>
					</div>
					<div class="form-group form-md-line-input">
					<label class="col-lg-4 control-label"><?=lang('vehicle_category_min_weight')?></label>
					<div class="col-lg-8">
						<input type="text" class="form-control" value="<?=$vehicle_category_detail->min_weight?>" name="vehicle_category_min_weight" autocomplete="off">
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