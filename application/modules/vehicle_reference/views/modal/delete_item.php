<div class="modal-dialog">
	<div class="modal-content">
		<div class="modal-header"> <button type="button" class="close" data-dismiss="modal">&times;</button> 
		<h4 class="modal-title"><?=lang('delete_item')?></h4>
		</div><?php
			echo form_open(base_url().'item/view/delete'); ?>
		<div class="modal-body">
		<?php
			if (!empty($item_details)) {
				foreach ($item_details as $key => $item_detail) { ?>

					<input type="hidden" name="row_id" value="<?=$item_detail->rowID?>">				 
					
					<p><?=lang('item_code')?><span class="tab"> :</span><b><?=$item_detail->item_cd?></b></p>
					<p><?=lang('item_name')?><span class="tab"> :</span><b><?=$item_detail->descs?></b></p>
					<p><?=lang('delete_item_warning')?> </p>
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