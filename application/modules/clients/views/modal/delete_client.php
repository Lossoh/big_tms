<div class="modal-dialog">
	<div class="modal-content">
		<div class="modal-header"> <button type="button" class="close" data-dismiss="modal">&times;</button> 
		<h4 class="modal-title"><?=lang('delete_client')?></h4>
		</div><?php
			echo form_open(base_url().'clients/view/delete'); ?>
		<div class="modal-body">
<?php
			if (!empty($client_details)) {
				foreach ($client_details as $key => $client) { ?>

					<input type="hidden" name="client_id" value="<?=$client->client_id?>">				 
					
					<p><?=lang('client_ref')?><span class="tab"> :</span><b><?=$client->client_ref?></b></p>
					<p><?=lang('client_name')?><span class="tab"> :</span><b><?=$client->client_name?></b></p>
					<p><?=lang('delete_client_warning')?> </p>
			

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