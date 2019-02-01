<div class="modal-dialog">
	<div class="modal-content">
		<div class="modal-header"> <button type="button" class="close" data-dismiss="modal">&times;</button> 
		<h4 class="modal-title"><?=lang('delete_work_order')?></h4>
		</div><?php
			echo form_open(base_url().'work_order/view/delete'); ?>
		<div class="modal-body">
		<?php
			if (!empty($work_order_details)) {
				foreach ($work_order_details as $key => $work_order_detail) { ?>
					<input type="hidden" name="row_id" value="<?=$work_order_detail['wo_no']?>">				 
					<p><?=lang('work_order_no')?><span class="tab"> :</span><b>&nbsp;<?=$work_order_detail['wo_no']?></b></p>
					<p><?=lang('work_order_date')?><span class="tab"> :</span><b>&nbsp;<?=$work_order_detail['wo_date']?></p>
					<p><?=lang('work_order_ref_no')?><span class="tab"> :</span><b>&nbsp;<?=$work_order_detail['ref_no']?></p>
					<p><?=lang('work_order_debtor')?><span class="tab"> :</span><b>&nbsp;<?=$work_order_detail['debtor_code']?>&nbsp;-&nbsp;<?=$work_order_detail['debtor_name']?></b></p>
					<p><?=lang('delete_work_order_warning')?> </p>
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