<div class="modal-dialog">
	<div class="modal-content">
		<div class="modal-header"> <button type="button" class="close" data-dismiss="modal">&times;</button> 
		<h4 class="modal-title"><?=lang('edit')?> <?=lang('item')?></h4>
		</div>
		<?php
			if (!empty($item_details)) {
			foreach ($item_details as $key => $item) { ?>

		<?php
			 $attributes = array('class' => 'bs-example form-horizontal');
          echo form_open(base_url().'templates/edit_item',$attributes); ?>
          <input type="hidden" name="r_url" value="<?=base_url()?>templates">
          <input type="hidden" name="item_id" value="<?=$item->item_id?>">
		<div class="modal-body">
			 
          				<div class="form-group form-md-line-input">
				<label class="col-lg-4 control-label"><?=lang('item_name')?> <span class="text-danger">*</span></label>
				<div class="col-lg-8">
					<input type="text" class="form-control" value="<?=$item->item_desc?>" name="item_name">
				</div>
				</div>

				<div class="form-group form-md-line-input">
				<label class="col-lg-4 control-label"><?=lang('unit_price')?> <span class="text-danger">*</span></label>
				<div class="col-lg-8">
					<input type="text" class="form-control" value="<?=$item->unit_cost?>" name="unit_price">
				</div>
				</div>
				
			
		</div>
		<div class="modal-footer"> <a href="#" class="btn btn-default" data-dismiss="modal"><?=lang('close')?></a> 
		<button type="submit" class="btn btn-success"><?=lang('save_changes')?></button>
		</form>
		</div>
		<?php } } ?>
	</div>
	<!-- /.modal-content -->
</div>
<!-- /.modal-dialog -->