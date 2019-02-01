<div class="modal-dialog">
	<div class="modal-content">
		<div class="modal-header"> <button type="button" class="close" data-dismiss="modal">&times;</button> 
		<h4 class="modal-title"><?=lang('detail_fare_trip')?></h4>
		</div><?php
			echo form_open(base_url().'fare_trip/view/delete'); ?>
		<div class="modal-body">
		<?php
			if (!empty($fare_trip_details)) {
				foreach ($fare_trip_details as $key => $fare_trip_detail) { ?>
					<input type="hidden" name="row_id" value="<?=$fare_trip_detail['rowID']?>">				 
					<p><?=lang('fare_trip_effective_date')?><span class="tab"> :</span><b>&nbsp;<?=$fare_trip_detail['effective_date']?></b></p>
					<p><?=lang('fare_trip_vehicle_type')?><span class="tab"> :</span><b>&nbsp;<?=$fare_trip_detail['vehicle_type_code']?>&nbsp;-&nbsp;<?=$fare_trip_detail['vehicle_type_name']?></b></p>
					<p><?=lang('fare_trip_destination_from')?><span class="tab"> :</span><b>&nbsp;<?=$fare_trip_detail['vehicle_type_code']?>&nbsp;-&nbsp;<?=$fare_trip_detail['vehicle_type_name']?></b></p>
					<p><?=lang('fare_trip_destination_to')?><span class="tab"> :</span><b>&nbsp;<?=$fare_trip_detail['vehicle_type_code']?>&nbsp;-&nbsp;<?=$fare_trip_detail['vehicle_type_name']?></b></p>
					<p><?=lang('fare_trip_distance')?><span class="tab"> :</span><b>&nbsp;<?=$fare_trip_detail['distance']?>&nbsp;KM</b></p>
					<p><?=lang('fare_trip_rate')?><span class="tab"> :</span><b>&nbsp;<?=$fare_trip_detail['fare_trip_rate']?>&nbsp;KM</b></p>
					<p><?=lang('fare_trip_fuel_rate')?><span class="tab"> :</span><b>&nbsp;<?=$fare_trip_detail['fuel_rate']?>&nbsp;KM</b></p>
					<p><?=lang('fare_trip_tol_rate')?><span class="tab"> :</span><b>&nbsp;<?=$fare_trip_detail['tol_rate']?>&nbsp;KM</b></p>
					<p><?=lang('fare_trip_load_rate')?><span class="tab"> :</span><b>&nbsp;<?=$fare_trip_detail['load_rate']?>&nbsp;KM</b></p>
					<p><?=lang('fare_trip_unload_rate')?><span class="tab"> :</span><b>&nbsp;<?=$fare_trip_detail['unload_rate']?>&nbsp;KM</b></p>
					<p><?=lang('fare_trip_others_rate')?><span class="tab"> :</span><b>&nbsp;<?=$fare_trip_detail['other_rate']?>&nbsp;KM</b></p>
		<?php }}?> 
		</div>
		</form>
	</div>
</div>
<!-- /.modal-content -->
</div>
<!-- /.modal-dialog -->