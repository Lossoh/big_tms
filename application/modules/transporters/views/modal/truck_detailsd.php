

<div class="modal-dialog">
	<div class="modal-content">
		<div class="modal-header"> <button type="button" class="close" data-dismiss="modal">&times;</button> 
		<h4 class="modal-title"><?=lang('truck_details')?></h4>
		</div>
		<section class="scrollable wrapper">
		<section class="panel panel-default">
                <div class="table-responsive">     
		
		
		<table id="clients" class="table table-striped table-hover b-t b-light text-sm">
			<thead>
				<tr>
					<th><?=lang('truck_ref')?></th>
					<th><?=lang('truck_name')?></th>
					<th><?=lang('gps_id')?> </th>
					<th><?=lang('options')?> </th>
				</tr> 
			</thead> 
			<tbody>
			<?php
				if (!empty($truck_details)) {
				foreach ($truck_details as $key => $truck) { ?>
				<tr>
					<td><?=$truck->truck_ref?> </td>
					<td><?=$truck->truck_name?> </td>
					<td><?=$truck->gps_id?> </td>
					<td><?=$truck->gps_id?> </td>
				</tr>
				<?php  }} else{ ?>
				<tr>
					<td><?=lang('nothing_to_display')?></td><td></td><td></td><td></td>
				</tr>
				<?php } ?>			
			</tbody>
		</table>
		</div>
	</section>		
</section>	
</div>
<!-- /.modal-content -->
</div>
<!-- /.modal-dialog -->