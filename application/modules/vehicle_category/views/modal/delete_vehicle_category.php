<div class="modal-dialog">
	<div class="modal-content">
		<div class="modal-header"> <button type="button" class="close" data-dismiss="modal">&times;</button> 
		<h4 class="modal-title"><?=lang('delete_vehicle_category')?></h4>
		</div><?php
			echo form_open(base_url().'vehicle_category/view/delete'); ?>
		<div class="modal-body">
		<?php
			if (!empty($vehicle_category_details)) {
				foreach ($vehicle_category_details as $key => $vehicle_category_detail) { ?>

					<input type="hidden" name="row_id" value="<?=$vehicle_category_detail->rowID?>">				 
					
					<p><?=lang('vehicle_category_code')?><span class="tab"> :</span><b><?=$vehicle_category_detail->type_cd?></b></p>
					<p><?=lang('vehicle_category_name')?><span class="tab"> :</span><b><?=$vehicle_category_detail->type_name?></b></p>
					<p><?=lang('delete_vehicle_category_warning')?> </p>
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