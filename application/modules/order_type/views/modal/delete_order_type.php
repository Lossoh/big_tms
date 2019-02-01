<div class="modal-dialog">
	<div class="modal-content">
		<div class="modal-header"> <button type="button" class="close" data-dismiss="modal">&times;</button> 
		<h4 class="modal-title"><?=lang('delete_order_type')?></h4>
		</div><?php
			echo form_open(base_url().'order_type/view/delete'); ?>
		<div class="modal-body">
		<?php
			if (!empty($order_type_details)) {
				foreach ($order_type_details as $key => $order_type_detail) { ?>

					<input type="hidden" name="row_id" value="<?=$order_type_detail->rowID?>">				 
					
					<p><?=lang('order_type_code')?><span class="tab"> :</span><b><?=$order_type_detail->jtype_cd?></b></p>
					<p><?=lang('order_type_name')?><span class="tab"> :</span><b><?=$order_type_detail->descs?></b></p>
					<p><?=lang('delete_order_type_warning')?> </p>
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