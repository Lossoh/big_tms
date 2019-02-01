<div class="modal-dialog">
	<div class="modal-content">
		<div class="modal-header"> <button type="button" class="close" data-dismiss="modal">&times;</button> 
		<h4 class="modal-title"><?=lang('delete_client')?></h4>
		</div><?php
			echo form_open(base_url().'transporters/view/delete'); ?>
		<div class="modal-body">
<?php
			if (!empty($transporter_details)) {
				foreach ($transporter_details as $key => $transporter) { ?>

					<input type="hidden" name="transporter_id" value="<?=$transporter->transporter_id?>">				 
					
					<p><?=lang('transporter_ref')?><span class="tab"> :</span><b><?=$transporter->transporter_ref?></b></p>
					<p><?=lang('transporter_name')?><span class="tab"> :</span><b><?=$transporter->transporter_name?></b></p>
					<p><?=lang('delete_transporter_warning')?> </p>
			

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