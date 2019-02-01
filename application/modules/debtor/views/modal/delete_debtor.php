<div class="modal-dialog">
	<div class="modal-content">
		<div class="modal-header"> <button type="button" class="close" data-dismiss="modal">&times;</button> 
		<h4 class="modal-title"><?=lang('delete_debtor')?></h4>
		</div><?php
			echo form_open(base_url().'debtor/view/delete'); ?>
		<div class="modal-body">
		<?php
			if (!empty($debtor_details)) {
				foreach ($debtor_details as $key => $debtor_detail) { ?>

					<input type="hidden" name="row_id" value="<?=$debtor_detail->rowID?>">				 
					
					<p><?=lang('debtor_code')?><span class="tab"> :</span><b><?=$debtor_detail->debtor_cd?></b></p>
					<p><?=lang('debtor_name')?><span class="tab"> :</span><b><?=$debtor_detail->debtor_name?></b></p>
					<p><?=lang('delete_debtor_warning')?> </p>
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