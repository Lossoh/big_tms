<div class="modal-dialog">
	<div class="modal-content">
		<div class="modal-header"> <button type="button" class="close" data-dismiss="modal">&times;</button> 
		<h4 class="modal-title"> <?=lang('edit_destination_from')?></h4>
		</div>
		<?php
			$attributes = array('class' => 'bs-example form-horizontal');
			echo form_open(base_url().'destination_from/view/update',$attributes); ?>
			<?php
			if (!empty($destination_from_details)) {
				foreach ($destination_from_details as $destination_from_detail) { ?>
				<div class="modal-body">
					<input type="hidden" name="row_id" value="<?=$destination_from_detail->rowID?>">
					
					<div class="form-group form-md-line-input">
					<label class="col-lg-4 control-label"><?=lang('destination_from_code')?> <span class="text-danger">*</span></label>
					<div class="col-lg-8">
						<input type="text" class="form-control" value="<?=$destination_from_detail->from_cd?>" name="destination_from_code" readonly="true">
					</div>
					</div>
					
					<div class="form-group form-md-line-input">
					<label class="col-lg-4 control-label"><?=lang('destination_from_nam')?><span class="text-danger">*</span></label>
					<div class="col-lg-8">
						<input type="text" class="form-control" value="<?=$destination_from_detail->decs?>" name="destination_from_name" autocomplete="off" required>
					</div>
					</div>
					
					<div class="form-group form-md-line-input">
					<label class="col-lg-4 control-label"><?=lang('destination_from_address')?></label>
					<div class="col-lg-8">
						<input type="text" class="form-control" value="<?=$destination_from_detail->address1?>" name="destination_from_address1" autocomplete="off"><br/>
						<input type="text" class="form-control" value="<?=$destination_from_detail->address2?>" name="destination_from_address2" autocomplete="off"><br/>
						<input type="text" class="form-control" value="<?=$destination_from_detail->address3?>" name="destination_from_address3" autocomplete="off">
					</div>
					</div>
					
					<div class="form-group form-md-line-input">
					<label class="col-lg-4 control-label"><?=lang('destination_from_contact_person')?></label>
					<div class="col-lg-8">
						<input type="text" class="form-control" value="<?=$destination_from_detail->contact_prs?>" name="destination_from_contact_person" autocomplete="off">
					</div>
					</div>
					
					<div class="form-group form-md-line-input">
					<label class="col-lg-4 control-label"><?=lang('destination_from_tlp')?></label>
					<div class="col-lg-8">
						<input type="text" class="form-control" value="<?=$destination_from_detail->telp_no?>" name="destination_from_tlp" autocomplete="off">
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