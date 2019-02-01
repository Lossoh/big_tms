<div class="modal-dialog">
	<div class="modal-content">
		<div class="modal-header"> <button type="button" class="close" data-dismiss="modal">&times;</button> 
		<h4 class="modal-title"><?=lang('delete_invoice_type')?></h4>
		</div><?php
			echo form_open(base_url().'invoice_type/view/delete'); ?>
		<div class="modal-body">
		<?php
			if (!empty($invoice_type_details)) {
				foreach ($invoice_type_details as $key => $invoice_type_detail) { ?>

					<input type="hidden" name="row_id" value="<?=$invoice_type_detail->rowID?>">				 
					
					<p><?=lang('invoice_type_code')?><span class="tab"> :</span><b><?=$invoice_type_detail->inv_type_cd?></b></p>
					<p><?=lang('invoice_type_name')?><span class="tab"> :</span><b><?=$invoice_type_detail->inv_type_name?></b></p>
					<p><?=lang('delete_invoice_type_warning')?> </p>
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