<style>
.datepicker{z-index:1151 !important;}
</style>
<script src="<?=base_url()?>resource/js/datepicker/bootstrap-datepicker.js" cache="false"></script>




<script type="text/javascript">

//Select2
$.getScript('<?=base_url()?>resource/js/select2/select2.min.js',function(){
           
  /* dropdown and filter select */
  var select = $('#jo_list').select2();


}); //script 
 
	$('#delivery_order_date').datepicker().on('changeDate', function(ev){                 
		$('#delivery_order_date').datepicker('hide');
	});
	$('#receipt_order_date').datepicker().on('changeDate', function(ev){                 
		$('#receipt_order_date').datepicker('hide');
	});	


</script>

<div class="modal-dialog">
	<div class="modal-content">
		<div class="modal-header">
		<h4 class="modal-title"><?=lang('new')?> <?=lang('delivery_order')?><a href="#" class="btn btn-default pull-right" data-dismiss="modal">X</a></h4>
		</div>

		<div class="modal-body">
			<div class="row"> 
			<div class="col-xs-12">
			<div class="group">	
			<div class="row inline-fields form-group form-md-line-input">
				<div class="col-md-4"><?=lang('job_order')?><span class="text-danger">*</span></div>
					<div class="col-md-1">:</div>
						<div class="col-md-7">								
							<select  class="form-control" id="jo_list" name="jo_list"  required>
								<option value ="0"><?=lang('select')?><?=lang('job_order')?></option>
								<?php
									if (!empty($fare_trips)) {
										foreach ($fare_trips as $fare_trip) { ?>
										<option value="<?php echo $fare_trip->rowID;?>"><?php echo $fare_trip->fare_trip_no;?></option>
								<?php }}?>
							</select>
							<textarea class="form-control"  id="fare_trip_dtl" name="fare_trip_dtl" maxlength="60" rows="2" readonly></textarea>
						</div>
			</div>
			<div class="row inline-fields form-group form-md-line-input">
				<div class="col-md-4"><?=lang('delivery_order_date')?></div>
					<div class="col-md-1">:</div>
						<div class="col-md-6"><p>
							<input type="text" class="datepicker-input form-control" id="delivery_order_date" name="delivery_order_date" value="<?=date('d-m-Y')?>"  data-date-format="dd-mm-yyyy" required />
						</div>																
			</div>
			<div class="row inline-fields form-group form-md-line-input">
				<div class="col-md-4"><?=lang('delivery_order_no')?></div>
					<div class="col-md-1">:</div>
						<div class="col-md-6"><p>
							<input  type="text" class="form-control" id="do_no" name="do_no" />
						</div>																
			</div>	
			<div class="row inline-fields form-group form-md-line-input">
				<div class="col-md-4"><?=lang('delivery_order_type')?></div>
					<div class="col-md-1">:</div>
						<div class="col-md-6"><p>
							<label class="radio-inline"><input type="radio" name="optradio">20 Feet</label>
							<label class="radio-inline"><input type="radio" name="optradio">40 Feet</label>
							<label class="radio-inline"><input type="radio" name="optradio">45 Feet</label>
						</div>																
			</div>	
			<div class="row inline-fields form-group form-md-line-input">
				<div class="col-md-4"><?=lang('delivery_order_cont_no')?></div>
					<div class="col-md-1">:</div>
						<div class="col-md-6"><p>
							<input  type="text" class="form-control" id="container_no" name="container_no" />
						</div>																
			</div>				
			<div class="row inline-fields form-group form-md-line-input">
				<div class="col-md-4"><?=lang('delivery_order_netto')?></div>
					<div class="col-md-1">:</div>
						<div class="col-md-6"><p>
							<input  type="text" class="form-control" id="delivery_order_netto" name="delivery_order_netto" maxlength="9" style="font-size:15px;font-weight:600;color: black;text-align: right;" value="0" autocomplete="off" required>
						</div>																
			</div>	
			<div class="row inline-fields form-group form-md-line-input">
				<div class="col-md-4"><?=lang('receipt_order_date')?></div>
					<div class="col-md-1">:</div>
						<div class="col-md-6"><p>
							<input type="text" class="datepicker-input form-control" id="receipt_order_date" name="receipt_order_date" value="<?=date('d-m-Y')?>"  data-date-format="dd-mm-yyyy" required />
			
						</div>																
			</div>	
			<div class="row inline-fields form-group form-md-line-input">
				<div class="col-md-4"><?=lang('receipt_order_netto')?></div>
					<div class="col-md-1">:</div>
						<div class="col-md-6"><p>
							<input  type="text" class="form-control" id="receipt_order_netto" name="receipt_order_netto" maxlength="9" style="font-size:15px;font-weight:600;color: black;text-align: right;" value="0" autocomplete="off" required>
						</div>																
			</div>				

			</div>		
		</div>		
		</div>								
		</div>
		<div class="modal-footer"> <a href="#" class="btn btn-default" data-dismiss="modal"><?=lang('close')?></a></div>	
	</div>
	<!-- /.modal-content -->
</div>
<!-- /.modal-dialog -->