<div class="modal-dialog">
	<div class="modal-content">
		<div class="modal-header"> <button type="button" class="close" data-dismiss="modal">&times;</button> 
		<h4 class="modal-title"><?=lang('delete_destination_to')?></h4>
		</div><?php
			echo form_open(base_url().'destination_to/view/delete'); ?>
		<div class="modal-body">
		<?php
			if (!empty($destination_to_details)) {
				foreach ($destination_to_details as $key => $destination_to_detail) { ?>

					<input type="hidden" name="row_id" value="<?=$destination_to_detail->rowID?>">				 
					
					<p><?=lang('destination_to_code')?><span class="tab"> :</span><b><?=$destination_to_detail->to_cd?></b></p>
					<p><?=lang('destination_to_name')?><span class="tab"> :</span><b><?=$destination_to_detail->descs?></b></p>
					<p><?=lang('delete_destination_to_warning')?> </p>
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