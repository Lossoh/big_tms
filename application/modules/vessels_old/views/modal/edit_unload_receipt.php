
<div class="modal-dialog" id="add_modal">
	<div class="modal-content">

		<div class="modal-header"> <button type="button" class="close" data-dismiss="modal">&times;</button> <h4 class="modal-title"><?=lang('edit_unload_receipt')?></h4>
		</div>
					
		<?php 

		$attributes = array('class' => 'bs-example form-horizontal');
        echo form_open(base_url().'vessels/manage/edit_unload_receipt',$attributes); ?>          

		<div class="modal-body">

					<?php
			if (!empty($unload_receipt_details)) {
				foreach ($unload_receipt_details as $key => $unload_receipt_detail) { ?>
			<input type="hidden" name="vessel_id" value="<?=$unload_receipt_detail->vessel_id?>">
			<input type="hidden" name="unload_receipt_id" value="<?=$unload_receipt_detail->unload_receipt_id?>">
			<input type="hidden" name="unload_receipt_ref" value="<?=$unload_receipt_detail->unload_receipt_ref?>">
			<div class="form-group form-md-line-input">
				<label class="col-lg-4 control-label"><?=lang('unload_receipt_ref')?> </label>
					<div class="col-lg-8">
						<input type="text" class="form-control"  value="<?=$unload_receipt_detail->unload_receipt_ref?>" disabled>
					</div>
			</div>
			<div class="form-group form-md-line-input">
				<label class="col-lg-4 control-label"><?=lang('transporter_name')?> </label>
					<div class="col-lg-8">
						<input type="text" class="form-control" value="<?=$unload_receipt_detail->transporter_name?>" disabled>
					</div>
			</div>
			<div class="form-group form-md-line-input">
				<label class="col-lg-4 control-label"><?=lang('truck_name')?> <span class="text-danger">*</span></label>
					<div class="col-lg-8">
						<input type="text" class="form-control" value="<?=$unload_receipt_detail->truck_name?>" disabled>
					</div>
			</div>
			<div class="form-group form-md-line-input">
				<label class="col-lg-4 control-label"><?=lang('truck_type')?></label>
					<div class="col-lg-8">
						<input type="text" class="form-control" value="<?=$unload_receipt_detail->Nm_Ref?>" disabled>
					</div>
			</div>			
			<div class="form-group form-md-line-input">
				<label class="col-lg-4 control-label"><?=lang('driver_name')?> </label>
				<div class="col-lg-8">
					<input type="text" class="form-control" value="<?=$unload_receipt_detail->driver_name?>" disabled>
				</div>
			</div>	
			<div class="form-group form-md-line-input">
			<label class="col-lg-4 control-label"><?=lang('description')?></label>
				<div class="col-lg-8">
					<textarea name="description" class="form-control" maxlength="255" rows="8"><?=$unload_receipt_detail->description?></textarea>
				</div>
			</div>				
		</div>
		<div class="modal-footer"><a href="#" class="btn btn-default" data-dismiss="modal"><?=lang('close')?></a> 
		<button type="submit" class="btn green"><?=lang('edit_unload_receipt')?></button>
		</form>
<?php }}?>
		</div>
	</div>
</div>

