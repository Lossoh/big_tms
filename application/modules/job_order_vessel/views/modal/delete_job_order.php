<div class="modal-dialog">
	<div class="modal-content">
		<div class="modal-header"><button type="button" class="close" data-dismiss="modal">&times;</button> 
		<h4 class="modal-title"><?=lang('delete_option')?> <?=lang('job_order')?></h4>
		</div>
		<?php
			echo form_open(base_url().'job_order/delete_job_order'); 
		?>
		<div class="modal-body">
		<?php
			if (!empty($job_orders)) {
				foreach ($job_orders as $key => $job_order) { ?>
					<input type="hidden" name="year" value="<?=$job_order['year']?>">
					<input type="hidden" name="month" value="<?=$job_order['month']?>">
					<input type="hidden" name="code" value="<?=$job_order['code']?>">
					<input type="hidden" name="jo_no" value="<?=$job_order['jo_no']?>">
					<p><?=lang('job_order_no')?><span class="tab"> :</span><b>&nbsp;<?=$job_order['jo_no']?></b></p>
					<p><?=lang('job_order_date')?><span class="tab"> :</span><b>&nbsp;<?=date('d F Y',strtotime($job_order['jo_date']))?></b></p>
					<p><?=lang('job_order_type')?><span class="tab"> :</span><b>&nbsp;<?=$job_order['type_name']?></b></p>
					<p><?=lang('delete_job_order_warning')?> </p>
		<?php }}?> 
		</div>
		<div class="modal-footer"> <a href="#" class="btn btn-default" data-dismiss="modal"><?=lang('close')?></a>
			<button type="submit" class="btn red"><?=lang('delete')?> <?=lang('job_order')?></button>
		</form>
	</div>
</div>
<!-- /.modal-content -->
</div>
<!-- /.modal-dialog -->