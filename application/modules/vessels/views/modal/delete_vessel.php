<div class="modal-dialog">
	<div class="modal-content">
		<div class="modal-header"> <button type="button" class="close" data-dismiss="modal">&times;</button> 
		<h4 class="modal-title"><?=lang('delete_vessel')?></h4>
		</div>
		
		<?php if (!empty($vessels)) {
				foreach ($vessels as $key => $vessel) { 	
		
			echo form_open(base_url().'vessels/manage/delete'); ?>
			
		<div class="modal-body">

	
				
			<p><?=lang('delete_vessel_warning')?></p>
			
			<input type="text" name="vessel_id" value="<?=$vessel->vessel_id?>">
			

		</div>
		<div class="modal-footer"> <a href="#" class="btn btn-default" data-dismiss="modal"><?=lang('close')?></a>
			
			<button type="submit" class="btn red"><?=lang('delete_button')?></button>
			
		</form>
			<?php } } ?>
	</div>
</div>
<!-- /.modal-content -->
</div>
<!-- /.modal-dialog -->