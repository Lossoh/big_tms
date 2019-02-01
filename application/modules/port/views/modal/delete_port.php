<div class="modal-dialog">
	<div class="modal-content">
		<div class="modal-header"> <button type="button" class="close" data-dismiss="modal">&times;</button> 
		<h4 class="modal-title"><?=lang('delete_port')?></h4>
		</div><?php
			echo form_open(base_url().'port/view/delete'); ?>
		<div class="modal-body">
		<?php
			if (!empty($port_details)) {
				foreach ($port_details as $key => $port_detail) { ?>

					<input type="hidden" name="row_id" value="<?=$port_detail->rowID?>">				 
					
					<p><?=lang('port_code')?><span class="tab"> :</span><b><?=$port_detail->port_cd?></b></p>
					<p><?=lang('port_name')?><span class="tab"> :</span><b><?=$port_detail->descs?></b></p>
					<p><?=lang('delete_port_warning')?> </p>
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