<div class="modal-dialog">
	<div class="modal-content">
		<div class="modal-header"> <button type="button" class="close" data-dismiss="modal">&times;</button> 
		<h4 class="modal-title"><?=lang('delete_fare_trip')?></h4>
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
					<p><?=lang('delete_fare_trip_warning')?> </p>
		<?php }}?> 
		</div>
		<div class="modal-footer"> <a href="#" class="btn btn-default" data-dismiss="modal"><?=lang('close')?></a>
			<button type="submit" class="btn red"><?=lang('delete_button')?></button>
		</form>
	</div>
</div>
<!-- /.modal-content -->
</div>
<!-- /.modal-dialog -->