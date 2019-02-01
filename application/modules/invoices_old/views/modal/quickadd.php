<div class="modal-dialog">
	<div class="modal-content">
		<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal">&times;</button> <h4 class="modal-title"><?=lang('add_item')?></h4>
		</div>
		
					<?php
			 $attributes = array('class' => 'bs-example form-horizontal');
          echo form_open(base_url().'invoices/manage/quickadd',$attributes); ?>
          <input type="hidden" name="invoice" value="<?=$invoice?>">

		<div class="modal-body">

				<div class="form-group form-md-line-input">
				<label class="col-lg-4 control-label"><?=lang('task_name')?> <span class="text-danger">*</span></label>
				<div class="col-lg-8">
				<select name="item" class="form-control">
					<?php
					if (!empty($items)) {
					foreach ($items as $key => $item) { ?>
						<option value="<?=$item->item_id?>"><?=$item->item_desc?> - <?=$this->config->item('default_currency')?> <?=$item->unit_cost?></option>
					<?php } } ?>					
				</select>
				</div>
				</div>


				<div class="form-group form-md-line-input">
				<label class="col-lg-4 control-label"><?=lang('quantity')?> <span class="text-danger">*</span></label>
				<div class="col-lg-8">
					<input type="text" class="form-control" placeholder="2" name="quantity">
				</div>
				</div>

			
		</div>
		<div class="modal-footer"> <a href="#" class="btn btn-default" data-dismiss="modal"><?=lang('close')?></a> 
		<button type="submit" class="btn btn-success"><?=lang('add_item')?></button>
		</form>
		</div>
	</div>
	<!-- /.modal-content -->
</div>
<!-- /.modal-dialog -->