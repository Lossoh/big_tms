      <script src="<?=base_url()?>resource/js/jquery-2.1.4.min.js"></script>
      <script src="<?=base_url()?>resource/js/app.v2.js"></script>


<script src="<?=base_url()?>resource/js/datepicker/bootstrap-datepicker.js" cache="false"></script>



<script src="<?=base_url()?>resource/js/datatables/jquery.dataTables.min.js"></script>


<script type="text/javascript">



$(function() {
	

	
	var table = $('#tbl-faretrip').dataTable({"aaSorting": [[1, 'desc']],
		"bProcessing": true,
      "sDom": "<'row'<'col-sm-6'l><'col-sm-6'f>r>t<'row'<'col-sm-6'i><'col-sm-6'p>>",
      "sPaginationType": "full_numbers",
	});	
	

	$('[data-rel=tooltip]').tooltip();
	

})

</script>
<div class="modal-dialog">
	<div class="modal-content">
		<div class="modal-header">
		<h4 class="modal-title"><?=lang('fare_trip')?> <?=lang('list')?> <a href="#" class="btn btn-default pull-right" data-dismiss="modal">X</a></h4>
		</div>

		<div class="modal-body">
            <div class="table-responsive">
                  <table id="tbl-faretrip" class="table table-striped table-hover b-t b-light text-sm">
                    <thead>
                      <tr>
						<th><?=lang('vehicle_category')?></th>
						<th><?=lang('destination_from')?></th>
						<th><?=lang('destination_to')?></th>
                        <th><?=lang('fare_trip')?> <?=lang('distance')?></th>
						<th><?=lang('fare_trip')?> <?=lang('cost')?> </th>
		
                      </tr> 
					</thead>
					<tbody>
                      <?php
                      if (!empty($fare_trip_lists)) {
                      foreach ($fare_trip_lists as $fare_trip_list) { ?>
                      <tr>
						<td style="text-align: left;"><?=$fare_trip_list->type_name?></td>
						<td style="text-align: left;"><?=$fare_trip_list->destination_from_name?></td>
						<td style="text-align: left;"><?=$fare_trip_list->destination_to_name?></td>
						<td style="text-align: center;"><?=$fare_trip_list->distance?></td>
						<td style="text-align: right;"><?php echo number_format($this->fare_trip_model->get_fare_trip_amount($fare_trip_list->rowID,$fare_trip_list->vehicle_type_rowID),0,$this->config->item('decimal_separator'),$this->config->item('thousand_separator'));?></td>
					</tr>
					  <?php }}?>
                  </tbody>
                </table>

            </div>					
				
								
		</div>
		<div class="modal-footer"> <a href="#" class="btn btn-default" data-dismiss="modal"><?=lang('close')?></a></div>	
	</div>
	<!-- /.modal-content -->
</div>
<!-- /.modal-dialog -->