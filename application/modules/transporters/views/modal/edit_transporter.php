<div class="modal-dialog" id="edit_modal">
	<div class="modal-content">
		<div class="modal-header"> <button type="button" class="close" data-dismiss="modal">&times;</button> 
		<h4 class="modal-title"><?=lang('edit')?> <?=lang('transporter')?></h4>
		</div>
		<?php
			$attributes = array('class' => 'bs-example form-horizontal');
			echo form_open(base_url().'transporters/view/update',$attributes); ?>
			<?php
			if (!empty($transporter_details)) {
				foreach ($transporter_details as $key => $transporter) { ?>
				<div class="modal-body">
					<input type="hidden" name="transporter_id" value="<?=$transporter->transporter_id?>">		
				 
					<div class="form-group form-md-line-input">
					<label class="col-lg-4 control-label"><?=lang('transporter_ref')?> <span class="text-danger">*</span></label>
					<div class="col-lg-8">
						<input type="text" class="form-control" value="<?=$transporter->transporter_ref?>" name="transporter_ref">
					</div>
					</div>
					<div class="form-group form-md-line-input">
					<label class="col-lg-4 control-label"><?=lang('transporter_name')?> <span class="text-danger">*</span></label>
					<div class="col-lg-8">
						<input type="text" class="form-control" value="<?=$transporter->transporter_name?>" name="transporter_name">
					</div>
					</div>
					<div class="form-group form-md-line-input">
					<label class="col-lg-4 control-label"><?=lang('address_1')?> <span class="text-danger">*</span></label>
					<div class="col-lg-8">
						<input type="text" class="form-control" value="<?=$transporter->address_1?>" name="address_1">
					</div>
					</div>
					<div class="form-group form-md-line-input">
					<label class="col-lg-4 control-label"><?=lang('address_2')?></label>
					<div class="col-lg-8">
						<input type="text" class="form-control" value="<?=$transporter->address_2?>" name="address_2">
					</div>
					</div>
					<div class="form-group form-md-line-input">
					<label class="col-lg-4 control-label"><?=lang('address_3')?> </label>
					<div class="col-lg-8">
						<input type="text" class="form-control" value="<?=$transporter->address_3?>" name="address_3">
					</div>
					</div>
					<div class="form-group form-md-line-input">
					<label class="col-lg-4 control-label"><?=lang('city')?> </label>
					<div class="col-lg-8">
						<input type="text" class="form-control" value="<?=$transporter->city?>" name="city">
					</div>
					</div>
					<div class="form-group form-md-line-input">
					<label class="col-lg-4 control-label"><?=lang('pic_1')?><span class="text-danger">*</span> </label>
					<div class="col-lg-8">
						<input type="text" class="form-control" value="<?=$transporter->pic_1?>" name="pic_1">
					</div>
					</div>					
					<div class="form-group form-md-line-input">
					<label class="col-lg-4 control-label"><?=lang('pic_2')?> </label>
					<div class="col-lg-8">
						<input type="text" class="form-control" value="<?=$transporter->pic_2?>" name="pic_2">
					</div>
					</div>					
					<div class="form-group form-md-line-input">
					<label class="col-lg-4 control-label"><?=lang('pic_3')?> </label>
					<div class="col-lg-8">
						<input type="text" class="form-control" value="<?=$transporter->pic_3?>" name="pic_3">
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