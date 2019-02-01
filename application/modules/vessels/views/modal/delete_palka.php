<div class="modal-dialog">
	<div class="modal-content">
		<div class="modal-header"> <button type="button" class="close" data-dismiss="modal">&times;</button> 
		<h4 class="modal-title"><?=lang('delete_palka')?></h4>
		</div><?php
			echo form_open(base_url().'vessels/manage/delete_palka'); ?>
		<div class="modal-body">
			<p><?=lang('delete_palka_warning')?></p>
			
			<input type="hidden" name="palka_id" value="<?=$palka_id?>">
			<input type="hidden" name="vessel_id" value="<?=$vessel_id?>">

		</div>
		<div class="modal-footer"> <a href="#" class="btn btn-default" data-dismiss="modal"><?=lang('close')?></a>
			<button type="submit" class="btn red"><?=lang('delete_button')?></button>
		</form>
	</div>
</div>
<!-- /.modal-content -->
</div>
<!-- /.modal-dialog -->