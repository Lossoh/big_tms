<div class="modal-dialog">
	<div class="modal-content">
		<div class="modal-header"> <button type="button" class="close" data-dismiss="modal">&times;</button> 
		<h4 class="modal-title"><?=lang('delete_destination')?></h4>
		</div><?php
			echo form_open(base_url().'destinations/view/delete'); ?>
		<div class="modal-body">
<?php
			if (!empty($destination_details)) {
				foreach ($destination_details as $key => $destination) { ?>

					<input type="hidden" name="destination_id" value="<?=$destination->destination_id?>">				 
					
					<p><?=lang('destination_ref')?><span class="tab"> :</span><b><?=$destination->destination_ref?></b></p>
					<p><?=lang('destination_name')?><span class="tab"> :</span><b><?=$destination->destination_name?></b></p>
					<p><?=lang('delete_destination_warning')?> </p>
			

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