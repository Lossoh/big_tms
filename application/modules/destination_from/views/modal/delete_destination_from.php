<div class="modal-dialog">
	<div class="modal-content">
		<div class="modal-header"> <button type="button" class="close" data-dismiss="modal">&times;</button> 
		<h4 class="modal-title"><?=lang('delete_destination_from')?></h4>
		</div><?php
			echo form_open(base_url().'destination_from/view/delete'); ?>
		<div class="modal-body">
		<?php
			if (!empty($destination_from_details)) {
				foreach ($destination_from_details as $key => $destination_from_detail) { ?>

					<input type="hidden" name="row_id" value="<?=$destination_from_detail->rowID?>">				 
					
					<p><?=lang('destination_from_code')?><span class="tab"> :</span><b><?=$destination_from_detail->from_cd?></b></p>
					<p><?=lang('destination_from_name')?><span class="tab"> :</span><b><?=$destination_from_detail->decs?></b></p>
					<p><?=lang('delete_destination_from_warning')?> </p>
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