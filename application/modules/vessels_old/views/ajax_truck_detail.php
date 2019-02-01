<?php
if(isset($truck_details)){
    foreach($truck_details as $row){
        ?>
		
		<div class="form-group form-md-line-input">
			<label class="col-lg-4 control-label"><?=lang('transporter_name')?></label>
			<div class="col-lg-8">
			<input type="hidden" name="transporter_id" id="transporter_id" value="<?=$row->transporter_id?>">
			<input type="text" class="form-control" value="<?=$row->transporter_name?>"  name="transporter_name" disabled>
			</div>
		</div>
		<div class="form-group form-md-line-input">
			<label class="col-lg-4 control-label"><?=lang('truck_type')?></label>
			<div class="col-lg-8">
			<input type="hidden" name="truck_type_id" id="truck_type_id" value="<?=$row->truck_type_id?>" >
			<input type="text" class="form-control" value="<?=$row->Nm_Ref?>"  name="truck_type_name" disabled>		
			</div>
		</div>
		
       
    <?php
    }
}
?>
