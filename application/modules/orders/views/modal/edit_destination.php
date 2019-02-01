<script>

$(document).ready(function() {
    
    $("#edit_modal").modal({backdrop: false}).modal("show");
    $("#destination_id").select2();


});
</script>

<div class="modal-dialog" id="edit_modal">
	<div class="modal-content">
		<div class="modal-header"> <button type="button" class="close" data-dismiss="modal">&times;</button> 
		<h4 class="modal-title"><?=lang('edit_destination')?></h4>
		</div>
	
						
		<?php
			$attributes = array('class' => 'bs-example form-horizontal');
			echo form_open(base_url().'vessels/manage/edit_destination',$attributes); ?>
			<?php
			if (!empty($destination_details)) {
				foreach ($destination_details as $key => $destination_detail) { ?>
				<div class="modal-body">
					
					<div class="form-group form-md-line-input">
					<input type="hidden" class="form-control" value="<?=$destination_detail->document_id?>" name="document_id">
					<input type="hidden" class="form-control" value="<?=$destination_detail->document_separate_id?>" name="document_separate_id">
						<label class="col-lg-4 control-label"><?=lang('destination_name')?> <span class="text-danger">*</span></label>
						<div class="col-lg-8">
							  <select id="destination_id" style="width:260px" name="destination_id" required> 			          
							  <optgroup label="Destinations"> 
							  <option value="<?=$destination_detail->destination_id?>" ><?=$destination_detail->destination_name?></option>				
							  <?php foreach ($destinations as $destination): ?>
								<option value="<?=$destination->destination_id?>"><?=$destination->destination_name?></option>
							  <?php endforeach; ?>
							  </select> 

						</div>
					</div>						
					<div class="form-group form-md-line-input">
					<label class="col-lg-4 control-label"><?=lang('destination_description')?> <span class="text-danger">*</span></label>
					<div class="col-lg-8">
						<textarea name="destination_description" class="form-control"  required><?=$destination_detail->destination_description?></textarea>
					</div>
					</div>	

					<div class="form-group form-md-line-input">
					<label class="col-lg-4 control-label"><?=lang('destination_qty')?> <span class="text-danger">*</span></label>
					<div class="col-lg-8">
						<input type="text" class="form-control" value="<?=$destination_detail->qty_destination?>" name="qty_destination">
						<input type="hidden" class="form-control" value="<?=$destination_detail->qty_destination?>" name="qty_destination_temp">
					</div>
					</div>	
					<div class="form-group form-md-line-input">
					<label class="col-lg-4 control-label"><?=lang('remarks')?> <span class="text-danger">*</span></label>
					<div class="col-lg-8">
						<textarea name="remarks" class="form-control" required><?=$destination_detail->remarks?></textarea>
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