<script>

$(document).ready(function() {
    
    $("#edit_modal").modal({backdrop: false}).modal("show");
    $("#destination_id").select2();


});
</script>

<div class="modal-dialog" id="edit_modal">
	<div class="modal-content">
		<div class="modal-header"> <button type="button" class="close" data-dismiss="modal">&times;</button> 
		<h4 class="modal-title"><?=lang('edit')?> <?=lang('client')?></h4>
		</div>
		<?php
			$attributes = array('class' => 'bs-example form-horizontal');
			echo form_open(base_url().'clients/view/update',$attributes); ?>
			<?php
			if (!empty($client_details)) {
				foreach ($client_details as $key => $client) { ?>
				<div class="modal-body">
					<input type="hidden" name="client_id" value="<?=$client->client_id?>">		
				 
					<div class="form-group form-md-line-input">
					<label class="col-lg-4 control-label"><?=lang('client_ref')?> <span class="text-danger">*</span></label>
					<div class="col-lg-8">
						<input type="text" class="form-control" value="<?=$client->client_ref?>" name="client_ref">
					</div>
					</div>
					<div class="form-group form-md-line-input">
					<label class="col-lg-4 control-label"><?=lang('client_name')?> <span class="text-danger">*</span></label>
					<div class="col-lg-8">
						<input type="text" class="form-control" value="<?=$client->client_name?>" name="client_name">
					</div>
					</div>
					<div class="form-group form-md-line-input">
					<label class="col-lg-4 control-label"><?=lang('address_1')?> <span class="text-danger">*</span></label>
					<div class="col-lg-8">
						<input type="text" class="form-control" value="<?=$client->address_1?>" name="address_1">
					</div>
					</div>
					<div class="form-group form-md-line-input">
					<label class="col-lg-4 control-label"><?=lang('address_2')?></label>
					<div class="col-lg-8">
						<input type="text" class="form-control" value="<?=$client->address_2?>" name="address_2">
					</div>
					</div>
					<div class="form-group form-md-line-input">
					<label class="col-lg-4 control-label"><?=lang('address_3')?> </label>
					<div class="col-lg-8">
						<input type="text" class="form-control" value="<?=$client->address_3?>" name="address_3">
					</div>
					</div>
					<div class="form-group form-md-line-input">
					<label class="col-lg-4 control-label"><?=lang('city')?> </label>
					<div class="col-lg-8">
						<input type="text" class="form-control" value="<?=$client->city?>" name="city">
					</div>
					</div>
					<div class="form-group form-md-line-input">
					<label class="col-lg-4 control-label"><?=lang('pic_1')?><span class="text-danger">*</span> </label>
					<div class="col-lg-8">
						<input type="text" class="form-control" value="<?=$client->pic_1?>" name="pic_1">
					</div>
					</div>					
					<div class="form-group form-md-line-input">
					<label class="col-lg-4 control-label"><?=lang('pic_2')?> </label>
					<div class="col-lg-8">
						<input type="text" class="form-control" value="<?=$client->pic_2?>" name="pic_2">
					</div>
					</div>					
					<div class="form-group form-md-line-input">
					<label class="col-lg-4 control-label"><?=lang('pic_3')?> </label>
					<div class="col-lg-8">
						<input type="text" class="form-control" value="<?=$client->pic_3?>" name="pic_3">
					</div>
					</div>
					<div class="form-group form-md-line-input">
					<label class="col-lg-4 control-label"><?=lang('destination_name')?> <span class="text-danger">*</span></label>
					<div class="col-lg-8">
						  <select id="destination_id" style="width:260px" name="destination_id" required> 			          
						  <optgroup label="Destinations"> 
						  <option value="<?=$client->bDestinationId?>"><?=$client->bDestinationName?></option>				
							<?php foreach ($destinations as $destination): ?>
							<option value="<?=$destination->destination_id?>"><?=$destination->destination_name?></option>
							<?php endforeach; ?>
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