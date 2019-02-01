<script>

$(document).ready(function() {
    
    $("#edit_modal").modal({backdrop: false}).modal("show");
    $("#destination_id_status").select2();


});
</script>
<div class="modal-dialog" id="edit_modal">
	<div class="modal-content">

		<div class="modal-header"> <button type="button" class="close" data-dismiss="modal">&times;</button> <h4 class="modal-title"><?=lang('change_status')?></h4>
		</div>
					
		<?php 

		$attributes = array('class' => 'bs-example form-horizontal');
        echo form_open(base_url().'vessels/manage/change_status_destination',$attributes); ?>          

		<div class="modal-body">

					<?php
			if (!empty($destination_details)) {
				foreach ($destination_details as $key => $destination_detail) { ?>
					<input type="hidden" class="form-control" value="<?=$destination_detail->document_id?>" name="document_id">
					<input type="hidden" class="form-control" value="<?=$destination_detail->document_separate_id?>" name="document_separate_id">

			<div class="form-group form-md-line-input">
				<label class="col-lg-4 control-label"><?=lang('destination_name')?> </label>
					<div class="col-lg-8">
						<input type="text" class="form-control"  value="<?=$destination_detail->destination_ref?>-/-<?=$destination_detail->destination_name?>" disabled>
					</div>
			</div>
			
			<div class="form-group form-md-line-input">
			<label class="col-lg-4 control-label"><?=lang('destination_status')?></label>
				<div class="col-lg-8">
					<input type="text" class="form-control"  value="<?php if($destination_detail->document_separate_status){echo "ACTIVATED";}else{echo "INACTIVATED";}?>" disabled>
				</div>
			</div>
			<div class="form-group form-md-line-input">
					<label class="col-lg-4 control-label"><?=lang('destination_status')?> <span class="text-danger">*</span></label>
					<div class="col-lg-8">
						  <select id="destination_id_status" style="width:260px" name="destination_id_status" required> 			          
						  <optgroup label="Destination Status"> 						 			
						 
							<option value=0>INACTIVATED</option>
							<option value=1>ACTIVATED</option>
						
						  </select> 
					</div>	  
			</div>				
		</div>
		<div class="modal-footer"><a href="#" class="btn btn-default" data-dismiss="modal"><?=lang('close')?></a> 
		<button type="submit" class="btn green"><?=lang('change_status')?></button>
		</form>
<?php }}?>
		</div>
	</div>
</div>

