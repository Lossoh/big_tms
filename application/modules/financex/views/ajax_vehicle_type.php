	<div>
		<div class="row inline-fields form-group form-md-line-input">
			<div class="col-md-4"><?=lang('site_cash_advance_truck_no')?><span class="text-danger">*</span></div>
			<div class="col-md-1">:</div>
			<div class="col-md-6"><p class="h3">
				<?php 
					if(!empty($driver_lists)){
					foreach($driver_lists as $driver_list){?>
						<input type="hidden" name="site_cash_advance_vehicle_id"  value="<?=$driver_list->vehicle_rowID?>" class="input-sm form-control">
						<input type="hidden" name="site_cash_advance_vehicle_type_id"  value="<?=$driver_list->vehicle_type_rowID?>" class="input-sm form-control">
						<input type="text" name="site_cash_advance_truck_no"  value="<?=$driver_list->police_no?>" class="input-sm form-control" readonly="true">
				<?php }} ?>
		</div>
	</div>
	
	<div>
		<div class="row inline-fields form-group form-md-line-input">
			<div class="col-md-4"><?=lang('site_cash_advance_vehicle_type')?><span class="text-danger">*</span></div>
			<div class="col-md-1">:</div>
			<div class="col-md-6"><p class="h3">
				<?php 
					if(!empty($driver_lists)){
					foreach($driver_lists as $driver_list){?>
								<input type="text" name="site_cash_advance_vehicle_type"  value="<?=$driver_list->vehicle_type_code?>&nbsp;-&nbsp;<?=$driver_list->vehicle_type_name?>" class="input-sm form-control" readonly="true">
				<?php }} ?>
		</div>
	</div>
	
	
	