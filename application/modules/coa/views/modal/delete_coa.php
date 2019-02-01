<div class="modal-dialog">
	<div class="modal-content">
		<div class="modal-header"> <button type="button" class="close" data-dismiss="modal">&times;</button> 
		<h4 class="modal-title"><?=lang('delete_coa')?></h4>
		</div><?php
			echo form_open(base_url().'coa/view/delete'); ?>
		<div class="modal-body">
<?php
			if (!empty($coa_details)) {
				foreach ($coa_details as $key => $coa) { ?>

					<input type="hidden" name="row_id" value="<?=$coa->rowID?>">				 
					
					<p><?=lang('coa_code')?><span class="tab"> :</span><b><?=$coa->acc_cd?></b></p>
					<p><?=lang('coa_name')?><span class="tab"> :</span><b><?=$coa->acc_name?></b></p>
					<p><?=lang('delete_coa_warning')?> </p>
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