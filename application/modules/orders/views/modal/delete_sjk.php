<div class="modal-dialog">
	<div class="modal-content">
		<div class="modal-header"> <button type="button" class="close" data-dismiss="modal">&times;</button> 
		<?php if (!empty($sjk_details)) {
				foreach ($sjk_details as $key => $sjk_detail) { ?>
		<h4 class="modal-title"><?=lang('delete_delivery_order')?> <?=$sjk_detail->sj_ref?></h4>
		</div>
		
	
		<?php
			echo form_open(base_url().'orders/manage/deletesjk'); ?>
			
		<div class="modal-body">	
		
			<input type="hidden" name="sj_id" value="<?=$sjk_detail->sj_id?>">
			<input type="hidden" name="document_separate_id" value="<?=$sjk_detail->document_separate_id?>">
			<input type="hidden" name="barcode_id" value="<?=$sjk_detail->barcode_id?>">

			<label class="control-label"><?=lang('description')?></label>
				
			<textarea name="deleted_remark" class="form-control" maxlength="255" rows="8"></textarea>
			

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