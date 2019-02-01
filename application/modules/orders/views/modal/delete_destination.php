<div class="modal-dialog">
	<div class="modal-content">
		<div class="modal-header"> <button type="button" class="close" data-dismiss="modal">&times;</button> 
		<h4 class="modal-title"><?=lang('delete_palka')?></h4>
		</div><?php
			echo form_open(base_url().'vessels/manage/delete_destination'); ?>
		<div class="modal-body">
			<p><?=lang('delete_destination_warning')?></p>
			<input type="hidden" name="document_id" value="<?=$document_id?>">			
			<input type="hidden" name="document_separate_id" value="<?=$document_separate_id?>">
		

		</div>
		<div class="modal-footer"> <a href="#" class="btn btn-default" data-dismiss="modal"><?=lang('close')?></a>
			<button type="submit" class="btn red"><?=lang('delete_button')?></button>
		</form>
	</div>
</div>
<!-- /.modal-content -->
</div>
<!-- /.modal-dialog -->