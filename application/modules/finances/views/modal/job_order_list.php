      <script src="<?=base_url()?>resource/js/jquery-2.1.4.min.js"></script>
      <script src="<?=base_url()?>resource/js/app.v2.js"></script>


<script src="<?=base_url()?>resource/js/datepicker/bootstrap-datepicker.js" cache="false"></script>



<script src="<?=base_url()?>resource/js/datatables/jquery.dataTables.min.js"></script>


<script type="text/javascript">



$(function() {
	

	
	var table = $('#tbl-joborder').dataTable({"aaSorting": [[1, 'desc']],
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
		<h4 class="modal-title">Job Order List <a href="#" class="btn btn-default pull-right" data-dismiss="modal">X</a></h4>
		</div>

		<div class="modal-body">
            <div class="table-responsive">
                  <table id="tbl-joborder" class="table table-striped table-hover b-t b-light text-sm">
                    <thead>
                      <tr>
                        <th><?=lang('job_order_no')?></th>
						<th><?=lang('job_order_date')?></th>
						<!--<th><?=lang('job_order_debtor')?></th>-->
                        <th><?=lang('job_order_po_spk_no')?></th>
                        <th><?=lang('job_order_so_no')?></th>
                        <th><?=lang('vessel_no')?> </th>
                        <th><?=lang('vessel_name')?> </th>
                        <!--<th><?=lang('port')?></th>
                        <th><?=lang('fare_trip_code')?></th>-->
                        <th>Year</th>
                        <th>month</th>
                        <th>code</th>
                      </tr> 
					</thead>
					<tbody>
                      <?php
                      if (!empty($cash_advance_jo)) {
                      foreach ($cash_advance_jo as $rs) { ?>
                      <tr>
						<td><?=$rs->jo_no?></td>
						<td><?=$rs->jo_date?></td>
						<!--<td><?=$rs->debtor?></td>-->
                        <td><?=$rs->po_spk_no?></td>
                        <td><?=$rs->so_no?></td>
                        <td><?=$rs->vessel_no?></td>
                        <td><?=$rs->vessel_name?></td>
                        <!--<td><?=$rs->port_name?></td>
                        <td><?=$rs->fare_trip_cd?></td>-->
                        <td><?=$rs->year?></td>
                        <td><?=$rs->month?></td>
                        <td><?=$rs->code?></td>
                    </tr>
                    <?php } } ?>
                  </tbody>
                </table>

            </div>					
				
								
		</div>
		<div class="modal-footer"> <a href="#" class="btn btn-default" data-dismiss="modal"><?=lang('close')?></a></div>	
	</div>
	<!-- /.modal-content -->
</div>
<!-- /.modal-dialog -->