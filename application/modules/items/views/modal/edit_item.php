<div class="modal-dialog">
	<div class="modal-content">
		<div class="modal-header"> <button type="button" class="close" data-dismiss="modal">&times;</button> 
		<h4 class="modal-title"><?=lang('edit')?> <?=lang('item')?></h4>
		</div>
		<?php
			$attributes = array('class' => 'bs-example form-horizontal');
			echo form_open(base_url().'items/view/update',$attributes); ?>
			<?php
			if (!empty($item_details)) {
				foreach ($item_details as $key => $item) { ?>
				<div class="modal-body">
					<input type="hidden" name="item_id" value="<?=$item->item_id?>">		
				 
					<div class="form-group form-md-line-input">
					<label class="col-lg-4 control-label"><?=lang('item_ref')?> <span class="text-danger">*</span></label>
					<div class="col-lg-8">
						<input type="text" class="form-control" value="<?=$item->item_ref?>" name="item_ref">
					</div>
					</div>
					<div class="form-group form-md-line-input">
					<label class="col-lg-4 control-label"><?=lang('item_name')?> <span class="text-danger">*</span></label>
					<div class="col-lg-8">
						<input type="text" class="form-control" value="<?=$item->item_name?>" name="item_name" required>
					</div>
					</div>

					<div class="form-group form-md-line-input">
					<label class="col-lg-4 control-label"><?=lang('tolerance')?> </label>
					<div class="col-lg-8">
						<input type="text" class="form-control" value="<?=$item->tolerance?>" name="tolerance">
					</div>
					</div>			
				</div>
				<div class="modal-footer"> <a href="#" class="btn btn-default" data-dismiss="modal"><?=lang('close')?></a> 
				<button type="submit" class="btn green"><?=lang('save_changes')?></button>
				</form>
				<?php }} ?>
				</div>
	</div>
	<!-- /.modal-content -->
</div>
<!-- /.modal-dialog -->