<div class="modal-dialog">
	<div class="modal-content">
		<div class="modal-header"> <button type="button" class="close" data-dismiss="modal">&times;</button> 
		<h4 class="modal-title"><?=lang('edit')?> <?=lang('destination')?></h4>
		</div>
		<?php
			$attributes = array('class' => 'bs-example form-horizontal');
			echo form_open(base_url().'destinations/view/update',$attributes); ?>
			<?php
			if (!empty($destination_details)) {
				foreach ($destination_details as $key => $destination) { ?>
				<div class="modal-body">
					<input type="hidden" name="destination_id" value="<?=$destination->destination_id?>">		
				 
					<div class="form-group form-md-line-input">
					<label class="col-lg-4 control-label"><?=lang('destination_ref')?> <span class="text-danger">*</span></label>
					<div class="col-lg-8">
						<input type="text" class="form-control" value="<?=$destination->destination_ref?>" name="destination_ref">
					</div>
					</div>
					<div class="form-group form-md-line-input">
					<label class="col-lg-4 control-label"><?=lang('destination_name')?> <span class="text-danger">*</span></label>
					<div class="col-lg-8">
						<input type="text" class="form-control" value="<?=$destination->destination_name?>" name="destination_name">
					</div>
					</div>
					<div class="form-group form-md-line-input">
					<label class="col-lg-4 control-label"><?=lang('address_1')?> <span class="text-danger">*</span></label>
					<div class="col-lg-8">
						<input type="text" class="form-control" value="<?=$destination->address_1?>" name="address_1">
					</div>
					</div>
					<div class="form-group form-md-line-input">
					<label class="col-lg-4 control-label"><?=lang('address_2')?></label>
					<div class="col-lg-8">
						<input type="text" class="form-control" value="<?=$destination->address_2?>" name="address_2">
					</div>
					</div>
					<div class="form-group form-md-line-input">
					<label class="col-lg-4 control-label"><?=lang('address_3')?> </label>
					<div class="col-lg-8">
						<input type="text" class="form-control" value="<?=$destination->address_3?>" name="address_3">
					</div>
					</div>
					<div class="form-group form-md-line-input">
					<label class="col-lg-4 control-label"><?=lang('city')?> </label>
					<div class="col-lg-8">
						<input type="text" class="form-control" value="<?=$destination->city?>" name="city">
					</div>
					</div>

					<div class="form-group form-md-line-input">
					<label class="col-lg-4 control-label"><?=lang('destination_flag')?> <span class="text-danger">*</span></label>
					<div class="col-lg-8">
						<select name="destination_flag" class="form-control">
							<option value="<?=$destination->destination_flag?>"><?=$destination->Nm_Ref?></option>
							<option value="1">SUMBER</option>
							<option value="2">CLIENT</option>
							<option value="3">POK</option>
						</select>
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