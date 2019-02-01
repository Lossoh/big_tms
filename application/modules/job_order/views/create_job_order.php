<section id="content">
	<section class="hbox stretch">		
		<aside>
			<section class="vbox">
				<header class="header bg-white b-b b-light">
                    <div class="pull-right" style="margin-top: 10px;">
                      <button type="button" class="btn btn-sm btn-dark btn_cleartable" onclick="location.replace('<?php echo base_url('job_order')?>');//history.back();"><i class="fa fa-arrow-left"></i> <?=lang('back')?></button>
                    </div>
					<p class="pull-left"><strong><?=lang('new_job_order')?></strong>
				</header>
				<section class="scrollable wrapper">
				<?php
					$attributes = array('class' => 'bs-example form-horizontal', 'autocomplete' => 'off');
					echo form_open(base_url().'job_order/create_job_order',$attributes); 
				?>
				<div class="row"> 
					<div class="col-xs-6">
						<div class="group">	
							<div class="row inline-fields form-group form-md-line-input" style="padding-bottom: 10px;">
								<div class="col-md-4"><?=lang('job_order_date')?> <span class="text-danger">*</span></div>
								<div class="col-md-1">:</div>
								<div class="col-md-6">										
									<input type="text" class="form-control input-sm" id="job_order_date" name="job_order_date" value="<?=date('d-m-Y')?>" required readonly>
								</div>
							</div>						
							<div class="row inline-fields form-group form-md-line-input" style="padding-bottom: 10px;">
								<div class="col-md-4"><?=lang('job_order_type')?> <span class="text-danger">*</span></div>
								<div class="col-md-1">:</div>
								<div class="col-md-6">
									<select class="form-control input-sm" id="tipe_job_order" name="job_order_type" required>	
    									<option value="1">BULK</option>
    									<option value="2">CONTAINER</option>
    									<option value="3">OTHERS</option>
									</select> 
								</div>
							</div>	
							<div class="row inline-fields form-group form-md-line-input" style="padding-bottom: 10px;">
								<div class="col-md-4"><?=lang('debtor')?> <span class="text-danger">*</span></div>
								<div class="col-md-1">:</div>
								<div class="col-md-6">								
									<select  class="form-control input-sm" id="debtor" name="debtor"  required>
									   <option value ="0"><?=lang('select')?><?=lang('debtor')?></option>
									<?php
										if (!empty($debtors)) {
											foreach ($debtors as $debtor) { ?>
											<option value="<?php echo $debtor->rowID; ?>"><?php echo $debtor->debtor_cd;?> - <?php echo $debtor->debtor_name;?></option>
									<?php }}?>
									</select>
									<textarea class="form-control input-sm"  id="debtor_dtl" name="debtor_dtl" maxlength="60" rows="2" readonly></textarea>
								</div>
							</div>
							<div class="row inline-fields form-group form-md-line-input" style="padding-bottom: 10px;">
								<div class="col-md-4"><?=lang('job_order_po_spk_no')?> <span class="text-danger">*</span></div>
								<div class="col-md-1">:</div>
								<div class="col-md-6">
									<input  type="text" class="form-control input-sm" id="po_spk_no" name="po_spk_no" maxlength="25" autocomplete="off" required>
								</div>
							</div>
							<div class="row inline-fields form-group form-md-line-input" style="padding-bottom: 10px;">
								<div class="col-md-4"><?=lang('job_order_so_no')?></div>
								<div class="col-md-1">:</div>
								<div class="col-md-6">
									<input  type="text" class="form-control input-sm" id="so_no" name="so_no" maxlength="25" autocomplete="off">
								</div>
							</div>
							<div class="row inline-fields form-group form-md-line-input" style="padding-bottom: 10px;">
								<div class="col-md-4"><?=lang('port_warehouse')?></div>
								<div class="col-md-1">:</div>
								<div class="col-md-6">								
									<select class="form-control input-sm" name="port_jo_type" id="port_jo_type" onchange="show_port_jo_type()" >
                                        <option value="POK">POK</option>
                                        <option value="PORT">PORT</option>
                                        <option value="WAREHOUSE">WAREHOUSE</option>
                                        <option value="DEPO">DEPO</option>
                                    </select>									
								</div>
							</div>
                            <div class="row inline-fields form-group form-md-line-input" style="padding-bottom: 10px;">
								<div class="col-md-4"></div>
								<div class="col-md-1"></div>
								<div class="col-md-6">								
									<select  class="form-control input-sm" id="port" name="port"  required>
									<option value=""><?=lang('select_your_option')?></option>
									<?php
										if (!empty($ports)) {
											foreach ($ports as $port) { ?>
											<option value="<?php echo $port->rowID;?>"><?php echo $port->port_cd;?> - <?php echo $port->port_name;?></option>
									<?php }}?>
									</select>									
								</div>
							</div>							
							<div class="row inline-fields form-group form-md-line-input" style="padding-bottom: 10px;">
								<div class="col-md-4"><?=lang('vessel_no')?></div>
								<div class="col-md-1">:</div>
								<div class="col-md-5">
                                    <input type="hidden" name="vessel_rowID" id="vessel_rowID" value="0" />
									<input  type="text" class="form-control input-sm" id="vessel_no" name="vessel_no" maxlength="25" autocomplete="off" readonly="" />
								</div>
								<div class="col-md-1" style="padding-left: 0px;"><button type="button" class="btn btn-sm btn-info" onclick="search_vessel_jo()"><i class="fa fa-search"></i></button></div>
							</div>								
							<div class="row inline-fields form-group form-md-line-input" style="padding-bottom: 10px;">
								<div class="col-md-4"><?=lang('vessel_name')?></div>
								<div class="col-md-1">:</div>
								<div class="col-md-6">
									<input  type="text" class="form-control input-sm" id="vessel_name" name="vessel_name" maxlength="60" autocomplete="off" readonly="" />
								</div>
							</div>
							<div class="row inline-fields form-group form-md-line-input" style="padding-bottom: 10px;">
								<div class="col-md-4"><?=lang('item')?> <span class="text-danger">*</span></div>
								<div class="col-md-1">:</div>
								<div class="col-md-6">
									<select  class="form-control input-sm" id="item" name="item"  required>
									<option value ="0"><?=lang('select')?><?=lang('item')?></option>
									<?php
										if (!empty($items)) {
											foreach ($items as $item) { ?>
											<option value="<?php echo $item->rowID;?>"><?php echo $item->item_cd;?> - <?php echo $item->item_name;?></option>
									<?php }}?>
									</select>									
								</div>
							</div>							
							<div class="row inline-fields form-group form-md-line-input" style="padding-bottom: 10px;">
								<div class="col-md-4"><?=lang('weight')?> <span class="text-danger">*</span></div>
								<div class="col-md-1">:</div>
								<div class="col-md-5">
									<input  type="text" class="form-control input-sm" id="weight_item" name="weight_item" maxlength="9" style="text-align: right;" onkeyup="angka(this)" value="0" autocomplete="off" required>
								</div>
								<div class="col-md-1" style="padding-left: 0px;"><big>Kgs</big></div>								
							</div>						
						</div>	
					</div>		
					<div class="col-xs-6">
						<div class="group">
							<div class="row inline-fields form-group form-md-line-input" style="padding-bottom: 10px;">
								<div class="col-md-4"><?=lang('fare_trip')?> <span class="text-danger">*</span></div>
								<div class="col-md-1">:</div>
								<div class="col-md-6">								
									<select  class="form-control input-sm" id="fare_trip" name="fare_trip"  required>
									<option value ="0"><?=lang('select')?><?=lang('fare_trip')?></option>
									<?php
										if (!empty($fare_trips)) {
											foreach ($fare_trips as $fare_trip) { ?>
											<option value="<?php echo $fare_trip->rowID;?>"><?php echo $fare_trip->fare_trip_cd;?></option>
									<?php }}?>
									</select>
									<textarea class="form-control input-sm"  id="fare_trip_dtl" name="fare_trip_dtl" maxlength="60" rows="3" readonly></textarea>
								    <input type="hidden" name="destination_from_id" id="destination_from_id" />
								    <input type="hidden" name="destination_to_id" id="destination_to_id" />
                                </div>
							</div>							
							<div class="row inline-fields form-group form-md-line-input" style="padding-bottom: 10px;">
								<div class="col-md-4"><?=lang('job_order_wholesale')?> <span class="text-danger">*</span></div>
								<div class="col-md-1">:</div>
								<div class="col-md-2">
		                        	<label class="switch">								
    									<input type="checkbox" class="form-control input-sm" id="job_order_wholesale_yes_no" name="job_order_wholesale_yes_no" />
    									<span></span>
                                    </label>
								</div>
                                <div class="col-md-2">Regular</div>
								<div class="col-md-2">
		                        	<label class="switch">								
    									<input type="checkbox" class="form-control input-sm" id="regular_type" name="regular_type" />
    									<span></span>
                                    </label>                                    									
								</div>
							</div>							
 							<div class="row inline-fields form-group form-md-line-input" style="padding-bottom: 10px;">
								<div class="col-md-4"><?=lang('price')?> <span class="text-danger">*</span></div>
								<div class="col-md-1">:</div>
								<div class="col-md-5">
									<input  type="text" class="form-control input-sm" id="job_order_price" name="job_order_price" onkeyup="IsNumeric(this)" placeholder="Ex : 50,5" maxlength="9" style="text-align: right;" value="0" autocomplete="off">
								</div>
								<div class="col-md-1" style="padding-left: 0px;"><big>Kgs</big></div>								
							</div>
							<div class="row inline-fields form-group form-md-line-input" style="padding-bottom: 10px;">
								<div class="col-md-4"><?=lang('description')?></div>
								<div class="col-md-1">:</div>
								<div class="col-md-6">
									<textarea class="form-control input-sm"  id="job_order_desc" name="job_order_desc" maxlength="255" rows="2"></textarea>									
								</div>
							</div>
							<div class="line"></div>
							<div class="row inline-fields form-group form-md-line-input" style="padding-bottom: 10px;">
								<div class="col-md-12" align="center"><?=lang('container')?></div>								
							</div>								
							<div class="row inline-fields form-group form-md-line-input" style="padding-bottom: 10px;">
								<div class="col-md-3"><?=lang('size')?></div>
								<div class="col-md-3"><?=lang('total')?></div>
								<div class="col-md-3"><?=lang('release')?></div>
								<div class="col-md-3"><?=lang('price')?></div>
							</div>									
							<div class="row inline-fields form-group form-md-line-input" style="padding-bottom: 10px;">
								<div class="col-md-3"><?=lang('20ft')?></div>
								<div class="col-md-3"><input type="text" class="form-control input-sm" id="job_order_total_20ft" name="job_order_total_20ft" maxlength="9" style="text-align: right;" onkeyup="angka(this)" value="0" autocomplete="off"></div>
								<div class="col-md-3"><input type="text" class="form-control input-sm" id="job_order_release_20ft" name="job_order_release_20ft" maxlength="9" style="text-align: right;" onkeyup="angka(this)" value="0" autocomplete="off"></div>
								<div class="col-md-3"><input type="text" class="form-control input-sm" id="job_order_price_20ft" name="job_order_price_20ft" maxlength="9" style="text-align: right;" onkeyup="angka(this)" value="0" autocomplete="off"></div>
							</div>
							<div class="row inline-fields form-group form-md-line-input" style="padding-bottom: 10px;">
								<div class="col-md-3"><?=lang('40ft')?></div>
								<div class="col-md-3"><input type="text" class="form-control input-sm" id="job_order_total_40ft" name="job_order_total_40ft" maxlength="9" style="text-align: right;" onkeyup="angka(this)" value="0" autocomplete="off"></div>
								<div class="col-md-3"><input type="text" class="form-control input-sm" id="job_order_release_40ft" name="job_order_release_40ft" maxlength="9" style="text-align: right;" onkeyup="angka(this)" value="0" autocomplete="off"></div>
								<div class="col-md-3"><input type="text" class="form-control input-sm" id="job_order_price_40ft" name="job_order_price_40ft" maxlength="9" style="text-align: right;" onkeyup="angka(this)" value="0" autocomplete="off"></div>
							</div>
							<div class="row inline-fields form-group form-md-line-input" style="padding-bottom: 10px;">
								<div class="col-md-3"><?=lang('45ft')?></div>
								<div class="col-md-3"><input type="text" class="form-control input-sm" id="job_order_total_45ft" name="job_order_total_45ft" maxlength="9" style="text-align: right;" onkeyup="angka(this)" value="0" autocomplete="off"></div>
								<div class="col-md-3"><input type="text" class="form-control input-sm" id="job_order_release_45ft" name="job_order_release_45ft" maxlength="9" style="text-align: right;" onkeyup="angka(this)" value="0" autocomplete="off"></div>
								<div class="col-md-3"><input type="text" class="form-control input-sm" id="job_order_price_45ft" name="job_order_price_45ft" maxlength="9" style="text-align: right;" onkeyup="angka(this)" onkeyup="angka(this)" value="0" autocomplete="off"></div>
							</div>				
	
									
						</div>
					</div>
				</div>					
				<div class="line"></div>
				<div>
					<button type="submit" class="btn green"><i class="fa fa-plus"></i> <?=lang('save')?></button> &nbsp;
                    <button type="button" class="btn red" onclick="history.go(0);"><i class="fa fa-refresh"></i> <?=lang('refresh')?></button>
				</div>
                <p>&nbsp;</p>
				</form>					
				</section>  
			</section> 
		</aside>
            
        <div class="modal fade" id="modal_search_vessel_jo" role="dialog">
          <div class="modal-dialog" style="width:90%;">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h3 class="modal-title-search-vessel">Select Vessel</h3>
              </div>
              <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <div class="panel-title">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="input-group input-daterange">
                                                <input type="text" name="start_date" id="start_date" class="form-control input-sm tanggal_datetimepicker" placeholder="<?=lang('start_date')?>" value="<?=date('d-m-Y')?>">
                                                <span class="input-group-addon">to</span>
                                                <input type="text" name="end_date" id="end_date" class="form-control input-sm tanggal_datetimepicker" placeholder="<?=lang('end_date')?>" value="<?=date('d-m-Y')?>">
                                            </div>
                                        </div>
                                        <div class="col-md-1" style="padding-left: 0px;">
                                            <button type="button" class="btn btn-sm btn-info" onclick="searchVesselJO()"><i class="fa fa-search"></i> Search</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="panel-body">
                                <div class="table-responsive">
                                  <table id="tbl-search-data-vessel" class="table table-responsive table-striped" width="100%"></table>
                                </div>                            
                            </div>
                        </div>            
                    </div>
                </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn red" data-dismiss="modal">Close</button>
              </div>
            </div>
          </div>
        </div>

    </section> 
</section>

<script type="text/javascript">
$(function() {
    
    $.ajax({
        type: "POST",
        url : "<?php echo base_url(); ?>job_order/get_data_vessel",
    	data: 'start_date=<?=date('d-m-Y')?>&end_date=<?=date('d-m-Y')?>&<?=$this->security->get_csrf_token_name()?>=<?=$this->security->get_csrf_hash()?>',
        dataType:"JSON",
        cache:false,
        success: function(result){
            
            $('#tbl-search-data-vessel').html('');

            var isi_table = '<thead>'+
                                '<tr>'+
                                    '<th>No</th>' +
                    				'<th><?=lang('vessel_no')?></th>' +
            						'<th>ETA <?=lang('date')?></th>' +
            						'<th><?=lang('vessel_name')?></th>' +
            						'<th><?=lang('port_warehouse')?></th>' +
            						'<th><?=lang('agent')?></th>' +
            						'<th><?=lang('original_copy')?></th>' +
            						'<th><?=lang('status')?></th>' +
                                '</tr>'+
                            '</thead>';
                
            var no = 1;
            
            $.each(result, function(key, data) {	
				isi_table += '<tr onclick="get_data_vessel(\''+data.rowID+'\',\''+data.trx_no+'\',\''+data.vessel_name+'\')" style="cursor:pointer">'+
                                '<td>'+no+'</td>' +
                                '<td>'+data.trx_no+'</td>' +
        						'<td>'+data.eta_date+'</td>' +
        						'<td>'+data.vessel_name+'</td>' +
        						'<td>'+data.port_name+'</td>' +
        						'<td>'+data.agent+'</td>' +
        						'<td>'+data.original_copy+'</td>' +
        						'<td>'+data.status+'</td>' +  
                             '</tr>';
			     no++;
            });  
            
                      
            $('#tbl-search-data-vessel').append(isi_table);   
               
            //$('#tbl-search-data-vessel').DataTable().destroy();
            $('#tbl-search-data-vessel').DataTable({
                "aaSorting": [[0, 'asc']],
        		"bProcessing": true,
                "sDom": "<'row'<'col-sm-6'l><'col-sm-6'f>r>t<'row'<'col-sm-6'i><'col-sm-6'p>>",
                "sPaginationType": "full_numbers",
        	});
            
        },
    	error: function(xhr, status, error) {
    		document.write(xhr.responseText);
    	}
    }); 
    
});

</script>