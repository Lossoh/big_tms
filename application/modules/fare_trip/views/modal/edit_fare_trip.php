<div class="modal-dialog">
	<div class="modal-content">
		<div class="modal-header"> <button type="button" class="close" data-dismiss="modal">&times;</button> 
		<h4 class="modal-title"> <?=lang('edit_fare_trip')?></h4>
		</div>
		<?php
			$attributes = array('class' => 'bs-example form-horizontal');
			echo form_open(base_url().'fare_trip/view/update',$attributes); ?>
			<?php
			if (!empty($fare_trip_details)) {
				foreach ($fare_trip_details as $fare_trip_detail) { ?>
				<div class="modal-body">
					<input type="hidden" name="row_id" value="<?=$fare_trip_detail['rowID']?>">
					
					<div class="form-group form-md-line-input">
						<label class="col-lg-4 control-label"><?=lang('fare_trip_effective_date')?></label>
						<div class="col-lg-8">
							<input type="text" name="fare_trip_effective_date" value="<?=$fare_trip_detail['effective_date']?>" placeholder="yyyy-mm-dd" autocomplete="off" class="input-sm form-control" required>
						</div>
					</div>
					
					<div class="form-group form-md-line-input">
						<label class="col-lg-4 control-label"><?=lang('fare_trip_vehicle_type')?> <span class="text-danger">*</span></label>
						<div class="col-lg-8">
							<select name="fare_trip_vehicle_type" class="form-control" required>
							<option value ="0">Select</option>
								   <?php
									  if (!empty($vehicle_types)) {
									  foreach ($vehicle_types as $vehicle_type) { ?>
									  <option value="<?php echo $vehicle_type->rowID; ?>" <?php if ($fare_trip_detail['vehicle_type_rowID'] == $vehicle_type->rowID){echo"selected";} ?>><?php echo $vehicle_type->type_cd; ?>&nbsp;-&nbsp;<?php echo $vehicle_type->type_name; ?></option>
									<?php }}?>
							</select>
						</div>
					</div>
					
					<div class="form-group form-md-line-input">
						<label class="col-lg-4 control-label"><?=lang('fare_trip_destination_from')?> <span class="text-danger">*</span></label>
						<div class="col-lg-8">
							<select name="fare_trip_destination_from" class="form-control" required>
							<option value ="0">Select</option>
								   <?php
									  if (!empty($destination_froms)) {
									  foreach ($destination_froms as $destination_from) { ?>
									  <option value="<?php echo $destination_from->rowID; ?>" <?php if ($fare_trip_detail['destination_from_rowID'] == $destination_from->rowID){echo"selected";} ?>><?php echo $destination_from->from_cd; ?>&nbsp;-&nbsp;<?php echo $destination_from->decs; ?></option>
									<?php }}?>
							</select>
						</div>
					</div>
					
					<div class="form-group form-md-line-input">
						<label class="col-lg-4 control-label"><?=lang('fare_trip_destination_to')?> <span class="text-danger">*</span></label>
						<div class="col-lg-8">
							<select name="fare_trip_destination_to" class="form-control" required>
							<option value ="0">Select</option>
								   <?php
									  if (!empty($destination_froms)) {
									  foreach ($destination_froms as $destination_from) { ?>
									  <option value="<?php echo $destination_from->rowID; ?>" <?php if ($fare_trip_detail['destination_to_rowID'] == $destination_from->rowID){echo"selected";} ?>><?php echo $destination_from->from_cd; ?>&nbsp;-&nbsp;<?php echo $destination_from->decs; ?></option>
									<?php }}?>
							</select>
						</div>
					</div>
					
					<div class="form-group form-md-line-input">
						<label class="col-lg-4 control-label"><?=lang('fare_trip_distance')?> <span class="text-danger">*</span></label>
						<div class="col-lg-8">
							<input type="text" name="fare_trip_distance" placeholder="Input Distance" value="<?=$fare_trip_detail['distance']?>" autocomplete="off" class="input-sm form-control" required>
						</div>
					</div>
					
					<div class="form-group form-md-line-input">
						<label class="col-lg-4 control-label"><?=lang('fare_trip_rate')?></label>
						<div class="col-lg-8">
							<input type="text" name="fare_trip_rate" placeholder="Input Fare Trip Rate" value="<?=$fare_trip_detail['fare_trip_rate']?>" autocomplete="off" class="input-sm form-control">
						</div>
					</div>
					
					<div class="form-group form-md-line-input">
						<label class="col-lg-4 control-label"><?=lang('fare_trip_fuel_rate')?></label>
						<div class="col-lg-8">
							<input type="text" name="fare_trip_fuel_rate" placeholder="Input Fuel Rate" value="<?=$fare_trip_detail['fuel_rate']?>" autocomplete="off" class="input-sm form-control">
						</div>
					</div>

					<div class="form-group form-md-line-input">
						<label class="col-lg-4 control-label"><?=lang('fare_trip_tol_rate')?></label>
						<div class="col-lg-8">
							<input type="text" name="fare_trip_tol_rate" placeholder="Input Toll Rate" value="<?=$fare_trip_detail['tol_rate']?>" autocomplete="off" class="input-sm form-control">
						</div>
					</div>
					
					<div class="form-group form-md-line-input">
						<label class="col-lg-4 control-label"><?=lang('fare_trip_load_rate')?></label>
						<div class="col-lg-8">
							<input type="text" name="fare_trip_load_rate" placeholder="Input Load Rate" value="<?=$fare_trip_detail['load_rate']?>" autocomplete="off" class="input-sm form-control">
						</div>
					</div>
					
					<div class="form-group form-md-line-input">
						<label class="col-lg-4 control-label"><?=lang('fare_trip_unload_rate')?></label>
						<div class="col-lg-8">
							<input type="text" name="fare_trip_unload_rate" placeholder="Input Unload Rate" value="<?=$fare_trip_detail['unload_rate']?>" autocomplete="off" class="input-sm form-control">
						</div>
					</div>
					
					<div class="form-group form-md-line-input">
						<label class="col-lg-4 control-label"><?=lang('fare_trip_others_rate')?></label>
						<div class="col-lg-8">
							<input type="text" name="fare_trip_others_rate" placeholder="Input Others Rate" value="<?=$fare_trip_detail['other_rate']?>" autocomplete="off" class="input-sm form-control">
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