<?php
if(isset($detail_pelanggan)){
    foreach($detail_pelanggan as $row){
        ?>
		<div class="row inline-fields form-group form-md-line-input">
		<div class="col-md-4"><?=lang('transporter_name')?></div>
		<div class="col-md-1">:</div>
		<div class="col-md-7">
		<input type="hidden" name="transporter_id" id="transporter_id" value="<?=$row->transporter_id?>">
		<p class="h5"><strong><?=$row->transporter_name?></strong></p></div>
        </div>
		<div class="row inline-fields form-group form-md-line-input">
		<div class="col-md-4"><?=lang('truck_type')?></div>
		<div class="col-md-1">:</div>
		<div class="col-md-7">
		<input type="hidden" name="truck_type_id" id="truck_type_id" value="<?=$row->truck_type_id?>" >
		<p class="h5"><strong><?=$row->Nm_Ref?></strong></p></div>
		</div>
       
    <?php
    }
}
?>
