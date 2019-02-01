<div class="modal-dialog">
	<div class="modal-content">
		<div class="modal-header"> <button type="button" class="close" data-dismiss="modal">&times;</button> 
		<h4 class="modal-title"> <?=lang('edit_cost_code')?></h4>
		</div>
		<?php
			$attributes = array('class' => 'bs-example form-horizontal');
			echo form_open(base_url().'vehicle/view/update',$attributes); ?>
			<?php
			if (!empty($vehicle_details)) {
				foreach ($vehicle_details as $vehicle_detail) { ?>
				<div class="modal-body">
					<input type="hidden" name="row_id" value="<?=$vehicle_detail->rowID?>">
					
					<div class="form-group form-md-line-input">
						<label class="col-lg-4 control-label"><?=lang('vehicle_police_no')?></label>
						<div class="col-lg-8">
							<input type="text" class="form-control" value="<?=$vehicle_detail->police_no?>" name="vehicle_police_no" readonly="true">
						</div>
					</div>
					
					<div class="form-group form-md-line-input">
						<label class="col-lg-4 control-label"><?=lang('vehicle_code')?> <span class="text-danger">*</span></label>
						<div class="col-lg-8">
							<select name="vehicle_code" class="form-control" required>
							<option value ="0">Select</option>
								   <?php
									  if (!empty($vehicle_types)) {
									  foreach ($vehicle_types as $vehicle_type) { ?>
									  <option value="<?php echo $vehicle_type->rowID; ?>" <?php if ($vehicle_detail->vehicle_type_rowID == $vehicle_type->rowID){echo"selected";} ?>><?php echo $vehicle_type->type_cd; ?>-<?php echo $vehicle_type->type_name; ?></option>
									<?php }}?>
							</select>
						</div>
					</div>
					
					<div class="form-group form-md-line-input">
						<label class="col-lg-4 control-label"><?=lang('vehicle_head_truck')?> <span class="text-danger">*</span></label>
						<div class="col-lg-8">
							<select name="vehicle_head_truck" class="form-control" required>
								<option value ="0">Select</option>
								<option value="Y" <?php if ($vehicle_detail->head_truck == "Y"){echo"selected";} ?>>Yes</option>
								<option value="N" <?php if ($vehicle_detail->head_truck == "N"){echo"selected";} ?>>No</option>
							</select>
						</div>
					</div>
					
					<div class="form-group form-md-line-input">
						<label class="col-lg-4 control-label"><?=lang('vehicle_gps')?></label>
						<div class="col-lg-8">
							<input type="text" class="form-control" value="<?=$vehicle_detail->gps_no?>" name="vehicle_gps">
						</div>
					</div>
					
					<div class="form-group form-md-line-input">
						<label class="col-lg-4 control-label"><?=lang('vehicle_driver')?></label>
						<div class="col-lg-8">
						<select name="vehicle_driver" class="form-control" required>
						<option value ="0">Select</option>
							   <?php
								  if (!empty($drivers)) {
								  foreach ($drivers as $driver) { ?>
								  <option value="<?php echo $driver->rowID; ?>" <?php if ($vehicle_detail->debtor_rowID == $driver->rowID){echo"selected";} ?> ><?php echo $driver->debtor_cd; ?>&nbsp;-&nbsp;<?php echo $driver->debtor_name; ?></option>
								  
								<?php }}?>
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