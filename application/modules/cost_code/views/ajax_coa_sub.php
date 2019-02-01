<div class="form-group form-md-line-input">
	<label><?=lang('coa_sub')?> <span class="text-danger">*</span></label>
		<select name="coa_sub" class="form-control" id="coa_sub" required>				
			<?php
				if(isset($coa_lists)){
					foreach($coa_lists as $coa_list){
			?>
				<option value="<?=$coa_list->acc_cd?>"><?=$coa_list->acc_cd?>-<?=$coa_list->acc_name?></option>
			<?php}}
			?>			
		</select>
</div>


