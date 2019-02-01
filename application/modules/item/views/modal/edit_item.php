<div class="modal-dialog">
	<div class="modal-content">
		<div class="modal-header"> <button type="button" class="close" data-dismiss="modal">&times;</button> 
		<h4 class="modal-title"> <?=lang('edit_item')?></h4>
		</div>
		<?php
			$attributes = array('class' => 'bs-example form-horizontal');
			echo form_open(base_url().'item/view/update',$attributes); ?>
			<?php
			if (!empty($item_details)) {
				foreach ($item_details as $item_detail) { ?>
				<div class="modal-body">
					<input type="hidden" name="row_id" value="<?=$item_detail->rowID?>">
					
					<div class="form-group form-md-line-input">
					<label class="col-lg-4 control-label"><?=lang('item_code')?> <span class="text-danger">*</span></label>
					<div class="col-lg-8">
						<input type="text" class="form-control" value="<?=$item_detail->item_cd?>" name="uom_code" readonly="true">
					</div>
					</div>
					
					<div class="form-group form-md-line-input">
					<label class="col-lg-4 control-label"><?=lang('item_name')?><span class="text-danger">*</span></label>
					<div class="col-lg-8">
						<input type="text" class="form-control" value="<?=$item_detail->descs?>" name="item_name" autocomplete="off" required>
					</div>
					</div>
					
					<div class="form-group form-md-line-input">
					<label class="col-lg-4 control-label"><?=lang('item_name')?><span class="text-danger">*</span></label>
					<div class="col-lg-8">
						<select name="uom_id" class="form-control" id="uom_id" required>
							<option value="">Select</option>
								<?php
									if (!empty($uoms)) {
										foreach ($uoms as $uom) { ?>
									<option value="<?=$uom->rowID?>" <?php if($item_detail->uom_id==$uom->rowID){echo "selected";} ?>><?=$uom->uom_cd?>&nbsp;-&nbsp<?=$uom->descs?></option>
								<?php }}?>
						</select>						
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