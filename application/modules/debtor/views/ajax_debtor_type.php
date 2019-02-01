	<?php 
		if(!empty($debtor_lists)){
		foreach($debtor_lists as $debtor_list){?>
		<div class="col-md-4">
			<?=lang('debt_type_name')?>
		</div>
		<div class="col-md-1">:</div>
		<div class="col-md-6">
		<p class="h3">
			<input type="text" class="input-sm form-control" value="<?=$debtor_list->name; ?>">
		</div>
		<?php }} ?>
	
	



