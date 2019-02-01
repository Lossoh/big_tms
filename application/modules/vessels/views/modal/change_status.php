<script>

$(document).ready(function() {
    
    $("#edit_modal").modal({backdrop: false}).modal("show");
    $("#vessel_status_id").select2();


});
</script>
<div class="modal-dialog" id="edit_modal">
	<div class="modal-content">

		<div class="modal-header"> <button type="button" class="close" data-dismiss="modal">&times;</button> <h4 class="modal-title"><?=lang('change_status')?></h4>
		</div>
					
		<?php 

		$attributes = array('class' => 'bs-example form-horizontal');
        echo form_open(base_url().'vessels/manage/change_status',$attributes); ?>          

		<div class="modal-body">

					<?php
			if (!empty($vessel_details)) {
				foreach ($vessel_details as $key => $vessel_detail) { ?>
			<input type="hidden" name="vessel_id" value="<?=$vessel_detail->vessel_id?>">


			<div class="form-group form-md-line-input">
				<label class="col-lg-4 control-label"><?=lang('vessel_name')?> </label>
					<div class="col-lg-8">
						<input type="text" class="form-control"  value="<?=$vessel_detail->vessel_name?>" disabled>
					</div>
			</div>
			
			<div class="form-group form-md-line-input">
			<label class="col-lg-4 control-label"><?=lang('vessel_ref')?></label>
				<div class="col-lg-8">
					<input type="text" class="form-control"  value="<?=$vessel_detail->vessel_ref?>" disabled>
				</div>
			</div>
			<div class="form-group form-md-line-input">
					<label class="col-lg-4 control-label"><?=lang('vessel_status')?> <span class="text-danger">*</span></label>
					<div class="col-lg-8">
						  <select id="vessel_status_id" style="width:260px" name="vessel_status_id" required> 			          
						  <optgroup label="Vessel Status"> 						 			
						  <?php foreach ($vessel_status as $status): ?>
							<option value="<?=$status->No_Urut_Ref?>"><?=$status->Nm_Ref?></option>
						  <?php endforeach; ?>
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

