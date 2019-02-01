<div class="modal-dialog">
	<div class="modal-content">
		<div class="modal-header"> <button type="button" class="close" data-dismiss="modal">&times;</button> 
		<h4 class="modal-title"><?=lang('delete_destination_to')?></h4>
		</div><?php
			echo form_open(base_url().'uom/view/delete'); ?>
		<div class="modal-body">
		<?php
			if (!empty($uom_details)) {
				foreach ($uom_details as $key => $uom_detail) { ?>

					<input type="hidden" name="row_id" value="<?=$uom_detail->rowID?>">				 
					
					<p><?=lang('uom_code')?><span class="tab"> :</span><b><?=$uom_detail->uom_cd?></b></p>
					<p><?=lang('uom_name')?><span class="tab"> :</span><b><?=$uom_detail->descs?></b></p>
					<p><?=lang('delete_uom_warning')?> </p>
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