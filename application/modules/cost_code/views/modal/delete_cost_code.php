<div class="modal-dialog">
	<div class="modal-content">
		<div class="modal-header"> <button type="button" class="close" data-dismiss="modal">&times;</button> 
		<h4 class="modal-title"><?=lang('delete_cost_code')?></h4>
		</div><?php
			echo form_open(base_url().'cost_code/view/delete'); ?>
		<div class="modal-body">
		<?php
			if (!empty($cost_code_details)) {
				foreach ($cost_code_details as $key => $cost_code_detail) { ?>

					<input type="hidden" name="row_id" value="<?=$cost_code_detail->rowID?>">				 
					
					<p><?=lang('cost_code_code')?><span class="tab"> :</span><b><?=$cost_code_detail->cost_cd?></b></p>
					<p><?=lang('cost_code_name')?><span class="tab"> :</span><b><?=$cost_code_detail->descs?></b></p>
					<p><?=lang('delete_cost_code_warning')?> </p>
		<?php }}?>
		</div>
		<div class="modal-footer"> <a href="#" class="btn btn-default" data-dismiss="modal"><?=lang('close')?></a>
			<button type="submit" class="btn red"><?=lang('delete_button')?></button>
		</form>
	</div>
</div>
<!-- /.modal-content -->
</div>
<!-- /.modal-dialog -->