	<?php 
		if(!empty($wo_lists)){
		foreach($wo_lists as $wo_list){?>
		<div class="row inline-fields form-group form-md-line-input">
			<div class="col-md-4"><?=lang('job_order_wo_no_ref')?>
			</div>
			<div class="col-md-1">:</div>
			<div class="col-md-6">
				<p class="h3">
					<input type="hidden" class="input-sm form-control" name="wo_year" value="<?=$wo_list->year ?>">
					<input type="hidden" class="input-sm form-control" name="wo_code" value="<?=$wo_list->code ?>">
					<input type="text" class="input-sm form-control" value="<?=$wo_list->ref_no ?>">
			</div>
		</div>
		<div class="row inline-fields form-group form-md-line-input">
			<div class="col-md-4"><?=lang('job_order_wo_vessel_no')?>
			</div>
			<div class="col-md-1">:</div>
			<div class="col-md-6">
				<p class="h3">
					<input type="text" class="input-sm form-control" value="<?=$wo_list->vessel_no ?>">
			</div>
		</div>
		<div class="row inline-fields form-group form-md-line-input">
			<div class="col-md-4"><?=lang('job_order_wo_vessel_name')?>
			</div>
			<div class="col-md-1">:</div>
			<div class="col-md-6">
				<p class="h3">
					<input type="text" class="input-sm form-control" value="<?=$wo_list->vessel_name ?>">
			</div>
		</div>
		<div class="row inline-fields form-group form-md-line-input">
			<div class="col-md-4"><?=lang('job_order_port_code')?>
			</div>
			<div class="col-md-1">:</div>
			<div class="col-md-6">
				<p class="h3">
					<input type="text" class="input-sm form-control" value="<?=$wo_list->port_code ?>">
			</div>
		</div>
		<div class="row inline-fields form-group form-md-line-input">
			<div class="col-md-4"><?=lang('job_order_port_name')?>
			</div>
			<div class="col-md-1">:</div>
			<div class="col-md-6">
				<p class="h3">
					<input type="text" class="input-sm form-control" value="<?=$wo_list->port_name ?>">
			</div>
		</div>
		<?php }} ?>
	
	



