<div class="modal-dialog">
	<div class="modal-content">
		<div class="modal-header"> <button type="button" class="close" data-dismiss="modal">&times;</button> 
		<h4 class="modal-title"><?=lang('delete_vehicle')?></h4>
		</div><?php
			echo form_open(base_url().'vehicle/view/delete'); ?>
		<div class="modal-body">
		<?php
			if (!empty($vehicle_details)) {
				foreach ($vehicle_details as $key => $vehicle_detail) { ?>

					<input type="hidden" name="row_id" value="<?=$vehicle_detail->rowID?>">				 
					
					<p><?=lang('vehicle_police_no')?><span class="tab"> :</span><b><?=$vehicle_detail->police_no?></b></p>
					<p><?=lang('delete_vehicle_warning')?> </p>
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