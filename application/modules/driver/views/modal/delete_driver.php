<div class="modal-dialog">
	<div class="modal-content">
		<div class="modal-header"> <button type="button" class="close" data-dismiss="modal">&times;</button> 
		<h4 class="modal-title"><?=lang('delete_driver')?></h4>
		</div><?php
			echo form_open(base_url().'driver/view/delete'); ?>
		<div class="modal-body">
<?php
			if (!empty($driver_details)) {
				foreach ($driver_details as $key => $driver_detail) { ?>

					<input type="hidden" name="row_id" value="<?=$driver_detail->rowID?>">				 
					
					<p><?=lang('driver_cd')?><span class="tab"> :</span><b><?=$driver_detail->debtor_cd?></b></p>
					<p><?=lang('driver_name')?><span class="tab"> :</span><b><?=$driver_detail->debtor_name?></b></p>
					<p><?=lang('delete_driver_warning')?> </p>
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