	<?php 
		if(!empty($coa_lists)){
		foreach($coa_lists as $coa_list){?>
		<div class="col-md-4">
			<?=lang('debt_type_name')?>
		</div>
		<div class="col-md-1">:</div>
		<div class="col-md-6">
		<p class="h3">
			<input type="text" class="input-sm form-control" value="<?=$coa_list->acc_cd; ?>">
		</div>
		<?php }} ?>
	
	



