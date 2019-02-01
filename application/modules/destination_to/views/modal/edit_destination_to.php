<div class="modal-dialog">
	<div class="modal-content">
		<div class="modal-header"> <button type="button" class="close" data-dismiss="modal">&times;</button> 
		<h4 class="modal-title"> <?=lang('edit_destination_to')?></h4>
		</div>
		<?php
			$attributes = array('class' => 'bs-example form-horizontal');
			echo form_open(base_url().'destination_to/view/update',$attributes); ?>
			<?php
			if (!empty($destination_to_details)) {
				foreach ($destination_to_details as $destination_to_detail) { ?>
				<div class="modal-body">
					<input type="hidden" name="row_id" value="<?=$destination_to_detail->rowID?>">
					
					<div class="form-group form-md-line-input">
					<label class="col-lg-4 control-label"><?=lang('destination_to_code')?> <span class="text-danger">*</span></label>
					<div class="col-lg-8">
						<input type="text" class="form-control" value="<?=$destination_to_detail->to_cd?>" name="destination_to_code" readonly="true">
					</div>
					</div>
					
					<div class="form-group form-md-line-input">
					<label class="col-lg-4 control-label"><?=lang('destination_to_nam')?><span class="text-danger">*</span></label>
					<div class="col-lg-8">
						<input type="text" class="form-control" value="<?=$destination_to_detail->descs?>" name="destination_to_name" autocomplete="off" required>
					</div>
					</div>
					
					<div class="form-group form-md-line-input">
					<label class="col-lg-4 control-label"><?=lang('destination_to_address')?></label>
					<div class="col-lg-8">
						<input type="text" class="form-control" value="<?=$destination_to_detail->address1?>" name="destination_to_address1" autocomplete="off"><br/>
						<input type="text" class="form-control" value="<?=$destination_to_detail->address2?>" name="destination_to_address2" autocomplete="off"><br/>
						<input type="text" class="form-control" value="<?=$destination_to_detail->address3?>" name="destination_to_address3" autocomplete="off">
					</div>
					</div>
					
					<div class="form-group form-md-line-input">
					<label class="col-lg-4 control-label"><?=lang('destination_to_contact_person')?></label>
					<div class="col-lg-8">
						<input type="text" class="form-control" value="<?=$destination_to_detail->contact_prs?>" name="destination_to_contact_person" autocomplete="off">
					</div>
					</div>
					
					<div class="form-group form-md-line-input">
					<label class="col-lg-4 control-label"><?=lang('destination_to_tlp')?></label>
					<div class="col-lg-8">
						<input type="text" class="form-control" value="<?=$destination_to_detail->telp_no?>" name="destination_to_tlp" autocomplete="off">
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