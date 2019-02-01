<div class="modal-dialog">
	<div class="modal-content">
		<div class="modal-header"> <button type="button" class="close" data-dismiss="modal">&times;</button> 
		<h4 class="modal-title"><?=lang('delete_delivery_order_container')?></h4>
		</div><?php
			echo form_open(base_url().'delivery_order/view/delete'); ?>
		<div class="modal-body">
		<?php
			if (!empty($delivery_order_details)) {
				foreach ($delivery_order_details as $key => $delivery_order_detail) { ?>
					<input type="hidden" name="year" value="<?=$delivery_order_detail['year']?>">
					<input type="hidden" name="month" value="<?=$delivery_order_detail['month']?>">
					<input type="hidden" name="code" value="<?=$delivery_order_detail['code']?>">
					<p><?=lang('delivery_order_no.')?><span class="tab"> :</span><b>&nbsp;<?=$delivery_order_detail['do_no']?></b></p>
					<p><?=lang('delivery_order_reg_no')?><span class="tab"> :</span><b>&nbsp;<?=$delivery_order_detail['reg_no']?></b></p>
					<p><?=lang('delivery_order_date')?><span class="tab"> :</span><b>&nbsp;<?=$delivery_order_detail['deliver_date']?></p>
					<p><?=lang('delete_delivery_order_warning')?> </p>
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