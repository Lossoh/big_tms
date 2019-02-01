<div class="modal-dialog">
	<div class="modal-content">
		<div class="modal-header"> <button type="button" class="close" data-dismiss="modal">&times;</button> 
		<h4 class="modal-title"><?=lang('delete_debtortype')?></h4>
		</div><?php
			echo form_open(base_url().'debtor_type/view/delete'); ?>
		<div class="modal-body">
<?php
			if (!empty($debtor_type_details)) {
				foreach ($debtor_type_details as $key => $debtor_type_detail) { ?>

					<input type="hidden" name="row_id" value="<?=$debtor_type_detail->rowID?>">				 
					
					<p><?=lang('debtortype_type_cd')?><span class="tab"> :</span><b><?=$debtor_type_detail->type_cd?></b></p>
					<p><?=lang('debtortype_name')?><span class="tab"> :</span><b><?=$debtor_type_detail->name?></b></p>
					<p><?=lang('delete_debtortype_warning')?> </p>
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