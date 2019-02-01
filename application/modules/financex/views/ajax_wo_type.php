	<div>
		<div class="row inline-fields form-group form-md-line-input">
			<div class="col-md-4"><?=lang('site_cash_advance_wo_no')?><span class="text-danger">*</span></div>
			<div class="col-md-1">:</div>
			<div class="col-md-6"><p class="h3">
				<?php 
					if(!empty($jo_lists)){
					foreach($jo_lists as $jo_list){?>
							<input type="hidden" name="site_cash_advance_jo_year"  value="<?=$jo_list->jo_year?>" class="input-sm form-control">
							<input type="hidden" name="site_cash_advance_jo_month"  value="<?=$jo_list->jo_month?>" class="input-sm form-control">
							<input type="hidden" name="site_cash_advance_jo_code"  value="<?=$jo_list->jo_code?>" class="input-sm form-control">
							<input type="hidden" name="site_cash_advance_jo_from"  value="<?=$jo_list->from_rowID?>" class="input-sm form-control">
							<input type="hidden" name="site_cash_advance_jo_to"  value="<?=$jo_list->to_rowID?>" class="input-sm form-control">
							<input type="hidden" name="site_cash_advance_item_rowID"  value="<?=$jo_list->item_rowID?>" class="input-sm form-control">
							<input type="hidden" name="site_cash_advance_debtor"  value="<?=$jo_list->debtor_rowID?>" class="input-sm form-control" readonly="true">
							<input type="text" name="site_cash_advance_wo_no"  value="<?=$jo_list->tr_wo_trx_hdr_wo_no?>" class="input-sm form-control" readonly="true">
							
				<?php }} ?>
		</div>
	</div>
	
	<div>
		<div class="row inline-fields form-group form-md-line-input">
			<div class="col-md-4"><?=lang('site_cash_advance_debtor')?><span class="text-danger">*</span></div>
			<div class="col-md-1">:</div>
			<div class="col-md-6"><p class="h3">
				<?php 
					if(!empty($jo_lists)){
					foreach($jo_lists as $jo_list){?>
								<input type="text" name="site_cash_advance_debtor"  value="<?=$jo_list->debtor_code?>&nbsp;-&nbsp;<?=$jo_list->debtor_name?>" class="input-sm form-control" readonly="true">
				<?php }} ?>
		</div>
	</div>
	
	<div>
		<div class="row inline-fields form-group form-md-line-input">
			<div class="col-md-4"><?=lang('site_cash_advance_item')?><span class="text-danger">*</span></div>
			<div class="col-md-1">:</div>
			<div class="col-md-6"><p class="h3">
				<?php 
					if(!empty($jo_lists)){
					foreach($jo_lists as $jo_list){?>
								<input type="text" name="site_cash_advance_item"  value="<?=$jo_list->item_code?>&nbsp;-&nbsp;<?=$jo_list->item_name?>" class="input-sm form-control" readonly="true">
				<?php }} ?>
		</div>
	</div>
	
	<div>
		<div class="row inline-fields form-group form-md-line-input">
			<div class="col-md-4"><?=lang('site_cash_advance_from')?><span class="text-danger">*</span></div>
			<div class="col-md-1">:</div>
			<div class="col-md-6"><p class="h3">
				<?php 
					if(!empty($jo_lists)){
					foreach($jo_lists as $jo_list){?>
								<input type="text" name="site_cash_advance_from"  value="<?=$jo_list->from_code?>&nbsp;-&nbsp;<?=$jo_list->from_name?>" class="input-sm form-control" readonly="true">
				<?php }} ?>
		</div>
	</div>
	
	
	
	<div>
		<div class="row inline-fields form-group form-md-line-input">
			<div class="col-md-4"><?=lang('site_cash_advance_to')?><span class="text-danger">*</span></div>
			<div class="col-md-1">:</div>
			<div class="col-md-6"><p class="h3">
				<?php 
					if(!empty($jo_lists)){
					foreach($jo_lists as $jo_list){?>
								<input type="text" name="site_cash_advance_to"  value="<?=$jo_list->to_code?>&nbsp;-&nbsp;<?=$jo_list->to_name?>" class="input-sm form-control" readonly="true">
				<?php }} ?>
		</div>
	</div>
	