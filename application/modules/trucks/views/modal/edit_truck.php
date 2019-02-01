<script>

$(document).ready(function() {
    
    $("#add_modal").modal({backdrop: false}).modal("show");
    $("#select2-option").select2();


});
</script>
<div class="modal-dialog" id="add_modal">
	<div class="modal-content">

		<div class="modal-header"> <button type="button" class="close" data-dismiss="modal">&times;</button> <h4 class="modal-title"><?=lang('edit_truck')?></h4>
		</div>
					
		<?php 

		$attributes = array('class' => 'bs-example form-horizontal');
        echo form_open(base_url().'trucks/edit_truck',$attributes); ?>          

		<div class="modal-body">

					<?php
			if (!empty($truck_details)) {
				foreach ($truck_details as $key => $truck_detail) { ?>
			<input type="hidden" name="transporter_id" value="<?=$truck_detail->transporter_id?>">
			<input type="hidden" name="truck_id" value="<?=$truck_detail->truck_id?>">
			<input type="hidden" name="truck_ref" value="<?=$truck_detail->truck_ref?>">
			<div class="form-group form-md-line-input">
				<label class="col-lg-4 control-label"><?=lang('truck_name')?> </label>
					<div class="col-lg-8">
						<input type="text" class="form-control"  value="<?=$truck_detail->truck_name?>" disabled>
					</div>
			</div>
			<div class="form-group form-md-line-input">
				<label class="col-lg-4 control-label"><?=lang('gps_id')?> </label>
					<div class="col-lg-8">
						<input type="text" class="form-control"  name="gps_id" value="<?=$truck_detail->gps_id?>">
					</div>
			</div>			
			<div class="form-group form-md-line-input">
			<label class="col-lg-4 control-label"><?=lang('truck_type')?> <span class="text-danger">*</span></label>
				<div class="col-lg-8">
					<select id="select2-option" style="width:260px" name="truck_type_id" required> 
						<option value="<?=$truck_detail->No_Urut_Ref?>"><?=$truck_detail->Nm_Ref?></option>				
						<optgroup label="Truck Types"> 
						<?php foreach ($truck_types as $truck_type): ?>
						<option value="<?=$truck_type->No_Urut_Ref?>"><?=$truck_type->Nm_Ref?></option>
						<?php endforeach; ?>
					</select> 
				</div>
			</div>				
			
		</div>
		<div class="modal-footer"><a href="#" class="btn btn-default" data-dismiss="modal"><?=lang('close')?></a> 
		<button type="submit" class="btn green"><?=lang('edit_truck')?></button>
		</form>
<?php }}?>
		</div>
	</div>
</div>

