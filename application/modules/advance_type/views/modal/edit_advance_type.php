<div class="modal-dialog">
	<div class="modal-content">
		<div class="modal-header"> <button type="button" class="close" data-dismiss="modal">&times;</button> 
		<h4 class="modal-title"> <?=lang('edit_advance_type')?></h4>
		</div>
		<?php
			$attributes = array('class' => 'bs-example form-horizontal');
			echo form_open(base_url().'advance_type/view/update',$attributes); ?>
			<?php
			if (!empty($advance_type_details)) {
				foreach ($advance_type_details as $advance_type_detail) { ?>
				<div class="modal-body">
					<input type="hidden" name="row_id" value="<?=$advance_type_detail->rowID?>">
					
					<div class="form-group form-md-line-input">
					<label class="col-lg-4 control-label"><?=lang('advance_type_code')?> <span class="text-danger">*</span></label>
					<div class="col-lg-8">
						<input type="text" class="form-control" value="<?=$advance_type_detail->advance_cd?>" name="advance_type_code" readonly="true" required>
					</div>
					</div>
					
					<div class="form-group form-md-line-input">
					<label class="col-lg-4 control-label"><?=lang('advance_type_name')?> <span class="text-danger">*</span></label>
					<div class="col-lg-8">
						<input type="text" class="form-control" value="<?=$advance_type_detail->advance_name?>" name="advance_type_name" autocomplete="off" required>
					</div>
					</div>
					
					<div class="form-group form-md-line-input">
					<label class="col-lg-4 control-label"><?=lang('advance_by_jo')?> <span class="text-danger">*</span></label>
					<div class="col-lg-8">
						<select id="advance_by_jo" class="form-control" name="advance_by_jo" >	
							<option value="0" >Select</option>
							<option value="Y" <?php if ($advance_type_detail->by_jo == 'Y'){echo"selected";}?>>Yes</option>
							<option value="N" <?php if ($advance_type_detail->by_jo == 'N'){echo"selected";}?>>No</option>
						</select>
					</div>
					</div>
					
					<div class="form-group form-md-line-input">
					<label class="col-lg-4 control-label"><?=lang('advance_only_driver')?> <span class="text-danger">*</span></label>
					<div class="col-lg-8">
						<select id="advance_only_driver" class="form-control" name="advance_only_driver" >	
							<option value="0" >Select</option>
							<option value="Y" <?php if ($advance_type_detail->only_driver == 'Y'){echo"selected";}?>>Yes</option>
							<option value="N" <?php if ($advance_type_detail->only_driver == 'N'){echo"selected";}?>>No</option>
						</select>
					</div>
					</div>
					
					<div class="form-group form-md-line-input">
					<label class="col-lg-4 control-label"><?=lang('advance_fare_trip')?> <span class="text-danger">*</span></label>
					<div class="col-lg-8">
						<select id="advance_fare_trip" class="form-control" name="advance_fare_trip" >	
							<option value="0" >Select</option>
							<option value="Y" <?php if ($advance_type_detail->fare_trip == 'Y'){echo"selected";}?>>Yes</option>
							<option value="N" <?php if ($advance_type_detail->fare_trip == 'N'){echo"selected";}?>>No</option>
						</select>
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