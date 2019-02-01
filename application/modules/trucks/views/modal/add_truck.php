<script>

$(document).ready(function() {
    
    $("#add_modal").modal({backdrop: false}).modal("show");
    $("#truck_type_id").select2();


});
</script>




<div class="modal-dialog" id="add_modal">
	<div class="modal-content">
		<div class="modal-header"> <button type="button" class="close" data-dismiss="modal">&times;</button> <h4 class="modal-title"><?=lang('add_truck')?></h4>
		</div>
		<?php
		$attributes = array('class' => 'bs-example form-horizontal');
        echo form_open(base_url().'trucks/create',$attributes); ?>          
		<?php echo validation_errors(); ?>
		<div class="modal-body">
			 <input type="hidden" name="r_url" value="<?=base_url()?>transporters/view/details/<?=$transporter?>">
			 <input type="hidden" name="transporter_id" value="<?=$transporter?>">
			 <input type="hidden" name="role" value="2">
			 <div class="form-group form-md-line-input">
				<label class="col-lg-4 control-label"><?=lang('truck_ref')?> <span class="text-danger">*</span></label>
				<div class="col-lg-8">
					<input type="text" class="form-control" value="<?=set_value('truck_ref')?>" placeholder="Input Truck Reference(No Spacing ex: B1234ABC)" name="truck_ref" required>
				</div>
				</div>
          		<div class="form-group form-md-line-input">
				<label class="col-lg-4 control-label"><?=lang('truck_name')?> <span class="text-danger">*</span></label>
				<div class="col-lg-8">
					<input type="text" class="form-control" value="<?=set_value('truck_name')?>" placeholder="Input Truck No (With Spacing Ex: B 1234 ABC)" name="truck_name" required>
				</div>
				</div>
				<div class="form-group form-md-line-input">
				<label class="col-lg-4 control-label"><?=lang('gps_id')?></label>
				<div class="col-lg-8">
					<input type="text" class="form-control" value="<?=set_value('gps_id')?>" placeholder="GPS ID" name="gps_id">
				</div>
				</div>
				<div class="form-group form-md-line-input">
				<label class="col-lg-4 control-label"><?=lang('truck_type')?> <span class="text-danger">*</span></label>
					<div class="col-lg-8">
						<select id="truck_type_id" style="width:260px" name="truck_type_id" required> 			          
							<optgroup label="Truck Types"> 
								<?php foreach ($truck_types as $truck_type): ?>
							<option value="<?=$truck_type->No_Urut_Ref?>"><?=$truck_type->Nm_Ref?></option>
								<?php endforeach; ?>
						</select> 
					</div>
				</div>	
				<div class="form-group form-md-line-input">
				<label class="col-lg-4 control-label"><?=lang('max_load_kgs')?></label>
				<div class="col-lg-8">
					<input type="text" class="form-control" value="<?=set_value('max_load_kgs')?>" placeholder=" Input Max. Load Truck Unit in  Kilo grams" name="max_load_kgs">
					<p> Note : 1 Ton = 1000 Kgs </p>
				</div>
				</div>
				
		</div>
		<div class="modal-footer"> <a href="#" class="btn btn-default" data-dismiss="modal"><?=lang('close')?></a> 
		<button type="submit" class="btn green"><?=lang('add_truck')?></button>
		</form>
		</div>
	</div>
	<!-- /.modal-content -->
</div>
<!-- /.modal-dialog -->