<div class="modal-dialog">
	<div class="modal-content">
		<div class="modal-header"> <button type="button" class="close" data-dismiss="modal">&times;</button> 
		<h4 class="modal-title"><?=lang('delete_job_order_container')?></h4>
		</div><?php
			echo form_open(base_url().'job_order/delete'); ?>
		<div class="modal-body">
		<?php
			if (!empty($container_details)) {
				foreach ($container_details as $key => $container_detail) { ?>
					<input type="hidden" name="year" value="<?=$container_detail['jo_trx_hdr_year']?>">
					<input type="hidden" name="month" value="<?=$container_detail['jo_trx_hdr_month']?>">
					<input type="hidden" name="code" value="<?=$container_detail['jo_trx_hdr_code']?>">
					<input type="hidden" name="size" value="<?=$container_detail['size']?>">
					<input type="hidden" name="weight" value="<?=$container_detail['weight']?>">
					<input type="hidden" name="rowID" value="<?=$container_detail['rowID']?>">
					<p><?=lang('job_order_no_container')?><span class="tab"> :</span><b>&nbsp;<?=$container_detail['container_no']?></b></p>
					<p><?=lang('job_order_size_container')?><span class="tab"> :</span><b>&nbsp;<?=$container_detail['size']?></b></p>
					<p><?=lang('job_order_weight_container')?><span class="tab"> :</span><b>&nbsp;<?=$container_detail['weight']?></b></p>
					<p><?=lang('delete_job_order_container_warning')?> </p>
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