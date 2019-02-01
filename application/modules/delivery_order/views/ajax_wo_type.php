	<div>
		<div class="row inline-fields form-group form-md-line-input">
			<div class="col-md-4"><?=lang('delivery_order_wo_no')?><span class="text-danger">*</span></div>
			<div class="col-md-1">:</div>
			<div class="col-md-6"><p class="h3">
				<?php 
					if(!empty($wo_lists)){
					foreach($wo_lists as $wo_list){?>
							<input type="hidden" name="delivery_order_jo_year"  value="<?=$wo_list->jo_year?>" class="input-sm form-control">
							<input type="hidden" name="delivery_order_jo_month"  value="<?=$wo_list->jo_month?>" class="input-sm form-control">
							<input type="hidden" name="delivery_order_jo_code"  value="<?=$wo_list->jo_code?>" class="input-sm form-control">
							<input type="hidden" name="delivery_order_jo_from"  value="<?=$wo_list->from_rowID?>" class="input-sm form-control">
							<input type="hidden" name="delivery_order_jo_to"  value="<?=$wo_list->to_rowID?>" class="input-sm form-control">
							<input type="hidden" name="delivery_order_item_rowID"  value="<?=$wo_list->item_rowID?>" class="input-sm form-control">
							<input type="text" name="delivery_order_wo_no"  value="<?=$wo_list->tr_wo_trx_hdr_wo_no?>" class="input-sm form-control" readonly="true">
				<?php }} ?>
		</div>
	</div>
	
	<div>
		<div class="row inline-fields form-group form-md-line-input">
			<div class="col-md-4"><?=lang('delivery_order_item')?><span class="text-danger">*</span></div>
			<div class="col-md-1">:</div>
			<div class="col-md-6"><p class="h3">
				<?php 
					if(!empty($wo_lists)){
					foreach($wo_lists as $wo_list){?>
								<input type="text" name="delivery_order_item"  value="<?=$wo_list->item_code?>&nbsp;-&nbsp;<?=$wo_list->item_name?>" class="input-sm form-control" readonly="true">
				<?php }} ?>
		</div>
	</div>
	
	<div>
		<div class="row inline-fields form-group form-md-line-input">
			<div class="col-md-4"><?=lang('delivery_order_from')?><span class="text-danger">*</span></div>
			<div class="col-md-1">:</div>
			<div class="col-md-6"><p class="h3">
				<?php 
					if(!empty($wo_lists)){
					foreach($wo_lists as $wo_list){?>
								<input type="text" name="delivery_order_from"  value="<?=$wo_list->from_code?>&nbsp;-&nbsp;<?=$wo_list->from_name?>" class="input-sm form-control" readonly="true">
				<?php }} ?>
		</div>
	</div>
	
	<div>
		<div class="row inline-fields form-group form-md-line-input">
			<div class="col-md-4"><?=lang('delivery_order_to')?><span class="text-danger">*</span></div>
			<div class="col-md-1">:</div>
			<div class="col-md-6"><p class="h3">
				<?php 
					if(!empty($wo_lists)){
					foreach($wo_lists as $wo_list){?>
								<input type="text" name="delivery_order_to"  value="<?=$wo_list->to_code?>&nbsp;-&nbsp;<?=$wo_list->to_name?>" class="input-sm form-control" readonly="true">
				<?php }} ?>
		</div>
	</div>
	