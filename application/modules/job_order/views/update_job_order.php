<section id="content">
	<section class="hbox stretch">		
		<aside>
			<section class="vbox">
				<header class="header bg-white b-b b-light">
                    <div class="pull-right" style="margin-top: 10px;">
                      <button type="button" class="btn btn-sm btn-dark btn_cleartable" onclick="location.replace('<?php echo base_url('job_order')?>');//history.back();"><i class="fa fa-arrow-left"></i> <?=lang('back')?></button>
                    </div>
					<p class="pull-left"><strong><?=lang('update_option')?> <?=lang('job_order')?></strong>
				</header>
			
				<section class="scrollable wrapper">
				<?php
					$attributes = array('class' => 'bs-example form-horizontal', 'autocomplete' => 'off');
					echo form_open(base_url().'job_order/update_job_order',$attributes); 
					if (!empty($job_orders)) {
						foreach ($job_orders as $job_order) {
                            $show = '';
							$disabled = '';
                            $get_data_do = $this->job_order_model->get_do_by_jo($job_order['jo_no']);
							if(count($get_data_do) > 0){
								$show = 'display:none';
                                $already_do = 1;
                                $disabled = 'disabled="disabled"';
                            
							}
                            else{
                                $already_do = 0;
                                $disabled = '';
                            }
				?>
				<div class="row"> 
					<div class="col-xs-6">
						<div class="group">	
							<div class="row inline-fields form-group form-md-line-input" style="padding-bottom: 10px;">
								<div class="col-md-4"><?=lang('job_order_date')?> <span class="text-danger">*</span></div>
								<div class="col-md-1">:</div>
								<div class="col-md-7">										
									<input type="hidden"  id="job_order_year" name="job_order_year" value="<?=$job_order['year']?>">
									<input type="hidden"  id="job_order_month" name="job_order_month" value="<?=$job_order['month']?>">
									<input type="hidden"  id="job_order_code" name="job_order_code" value="<?=$job_order['code']?>">
									<input type="hidden"  id="job_order_no" name="job_order_no" value="<?=$job_order['jo_no']?>">
											
									<strong><?=$job_order['jo_no']?> - <?=$job_order['jo_date']?></strong>
								</div>

							</div>						
							<div class="row inline-fields form-group form-md-line-input" style="padding-bottom: 10px;">
								<div class="col-md-4"><?=lang('job_order_type')?> <span class="text-danger">*</span></div>
								<div class="col-md-1">:</div>
								<div class="col-md-6">																		
									<select class="form-control input-sm" id="tipe_job_order" name="job_order_type" required="" <?=$disabled?>>	
                                        <option value="1" <?= $job_order['jo_type'] == '1' ? 'selected' : '' ?>>BULK</option>
    									<option value="2" <?= $job_order['jo_type'] == '2' ? 'selected' : '' ?>>CONTAINER</option>
    									<option value="3" <?= $job_order['jo_type'] == '3' ? 'selected' : '' ?>>OTHERS</option>
									</select> 
								</div>
							</div>	
							<div class="row inline-fields form-group form-md-line-input" style="padding-bottom: 10px;">
								<div class="col-md-4"><?=lang('debtor')?> <span class="text-danger">*</span></div>
								<div class="col-md-1">:</div>
								<div class="col-md-6">
									<input type="hidden"  id="debtor_rowID" name="debtor_rowID">								
									<select  class="form-control input-sm" id="debtor" name="debtor"  required>
									<?php
										if (!empty($debtors)) {
											foreach ($debtors as $debtor) { ?>
                                            <option value="<?php echo $debtor->rowID; ?>" <?= $job_order['debtor_rowID'] == $debtor->rowID ? 'selected' : '' ?>>
                                                <?php echo $debtor->debtor_cd;?> - <?php echo $debtor->debtor_name;?>
                                            </option>
									<?php }}?>
									</select>
									<textarea class="form-control input-sm"  id="debtor_dtl" name="debtor_dtl" maxlength="60" rows="2" readonly><?=$job_order['debtor_name']?></textarea>
								</div>
							</div>
							<div class="row inline-fields form-group form-md-line-input" style="padding-bottom: 10px;">
								<div class="col-md-4"><?=lang('job_order_po_spk_no')?> <span class="text-danger">*</span></div>
								<div class="col-md-1">:</div>
								<div class="col-md-6">
									<input  type="text" class="form-control input-sm" id="po_spk_no" name="po_spk_no" maxlength="25" value="<?=$job_order['po_spk_no']?>" autocomplete="off" required>
								</div>
							</div>
							<div class="row inline-fields form-group form-md-line-input" style="padding-bottom: 10px;">
								<div class="col-md-4"><?=lang('job_order_so_no')?></div>
								<div class="col-md-1">:</div>
								<div class="col-md-6">
									<input  type="text" class="form-control input-sm" id="so_no" name="so_no" maxlength="25" value="<?=$job_order['so_no']?>" autocomplete="off">
								</div>
							</div>
							<div class="row inline-fields form-group form-md-line-input" style="padding-bottom: 10px;">
								<div class="col-md-4"><?=lang('port_warehouse')?></div>
								<div class="col-md-1">:</div>
								<div class="col-md-6">								
									<select class="form-control input-sm" name="port_jo_type" id="port_jo_type" onchange="show_port_jo_type()" >
                                        <option value="POK" <?= $job_order['port_jo_type'] == 'POK' ? 'selected' : '' ?>>POK</option>
                                        <option value="PORT" <?= $job_order['port_jo_type'] == 'PORT' ? 'selected' : '' ?>>PORT</option>
                                        <option value="WAREHOUSE" <?= $job_order['port_jo_type'] == 'WAREHOUSE' ? 'selected' : '' ?>>WAREHOUSE</option>
                                        <option value="DEPO" <?= $job_order['port_jo_type'] == 'DEPO' ? 'selected' : '' ?>>DEPO</option>
                                    </select>									
								</div>
							</div>
                            <div class="row inline-fields form-group form-md-line-input" style="padding-bottom: 10px;">
								<div class="col-md-4"></div>
								<div class="col-md-1"></div>
								<div class="col-md-6">								
									<select  class="form-control input-sm" id="port" name="port"  required>
									<?php
                                        if($job_order['port_jo_type'] == 'POK'){
                                            $ports = $this->job_order_model->get_all_records('sa_port', $array =
                                                array('rowID >' => 0, 'deleted' => 0), $join_table = '', $join_criteria = '', 'port_name', 'asc');	   
                                        }
                                        else{
                                            $ports = $this->job_order_model->get_all_records('sa_port', $array =
                                                array('rowID >' => 0, 'deleted' => 0, 'port_type' => $job_order['port_jo_type']), $join_table = '', $join_criteria = '', 'port_name', 'asc');
                                        }
                                        
										if (!empty($ports)) {
											foreach ($ports as $port) { ?>
									        <option value="<?php echo $port->rowID;?>" <?= $job_order['port_rowID'] == $port->rowID ? 'selected' : '' ?>>
                                                <?php echo $port->port_cd;?> - <?php echo $port->port_name;?>
                                            </option>
									<?php }}?>
									</select>									
								</div>
							</div>							
							<div class="row inline-fields form-group form-md-line-input" style="padding-bottom: 10px;">
								<div class="col-md-4"><?=lang('vessel_no')?></div>
								<div class="col-md-1">:</div>
								<div class="col-md-5">
                                    <input type="hidden" name="vessel_rowID" id="vessel_rowID" value="<?=$job_order['vessel_rowID']?>" />
									<input  type="text" class="form-control input-sm" id="vessel_no" name="vessel_no" maxlength="25" value="<?=$job_order['vessel_no']?>" autocomplete="off" readonly="" />
								</div>
                                <div class="col-md-1" style="padding-left: 0px;"><button type="button" class="btn btn-sm btn-info" onclick="search_vessel_jo()"><i class="fa fa-search"></i></button></div>
							</div>								
							<div class="row inline-fields form-group form-md-line-input" style="padding-bottom: 10px;">
								<div class="col-md-4"><?=lang('vessel_name')?></div>
								<div class="col-md-1">:</div>
								<div class="col-md-6">
									<input  type="text" class="form-control input-sm" id="vessel_name" name="vessel_name" maxlength="60" value="<?=$job_order['vessel_name']?>" autocomplete="off" readonly="" />
								</div>
							</div>
							<div class="row inline-fields form-group form-md-line-input" style="padding-bottom: 10px;">
								<div class="col-md-4"><?=lang('item')?> <span class="text-danger">*</span></div>
								<div class="col-md-1">:</div>
								<div class="col-md-6">
									<select  class="form-control input-sm" id="item" name="item"  required>
									<?php
										if (!empty($items)) {
											foreach ($items as $item) { ?>
                                            <option value="<?php echo $item->rowID;?>" <?= $job_order['item_rowID'] == $item->rowID ? 'selected' : '' ?>>
                                                <?php echo $item->item_cd;?> - <?php echo $item->item_name;?>
                                            </option>
									<?php }}?>
									</select>									
								</div>
							</div>							
							<div class="row inline-fields form-group form-md-line-input" style="padding-bottom: 10px;">
								<div class="col-md-4"><?=lang('weight')?> <span class="text-danger">*</span></div>
								<div class="col-md-1">:</div>
								<div class="col-md-5">
									<input  type="text" class="form-control input-sm" id="weight_item" name="weight_item" maxlength="9" value="<?=$job_order['weight']?>" style="text-align: right;" onkeyup="angka(this)" value="0" autocomplete="off" required>
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
									<select  class="form-control input-sm" id="fare_trip" name="fare_trip" style="<?=$show?>" required>
									<?php
										if (!empty($fare_trips)) {
											foreach ($fare_trips as $fare_trip) { ?>
                                            <option value="<?php echo $fare_trip->rowID;?>" <?= $job_order['fare_trip_rowID'] == $fare_trip->rowID ? 'selected' : '' ?>>
                                                <?php echo $fare_trip->fare_trip_cd;?>
                                            </option>
									<?php }}?>
									</select>
									<textarea class="form-control input-sm"  id="fare_trip_dtl" name="fare_trip_dtl" maxlength="60" rows="3" readonly></textarea>
								    <?php
                                    if($job_order['trip_type'] == '1')
                                        $trip_type = "BULK";
                                    else if($job_order['trip_type'] == '2')
                                        $trip_type = "CONTAINER";
                                    else
                                        $trip_type = "OTHERS";
                                     
                                    ?>
                                    <script type="text/javascript">
                                    $(function(){
                                       $('#fare_trip_dtl').text("Destination : <?=$job_order['destination_from_no']?> - <?=$job_order['destination_from_name']?> to <?=$job_order['destination_to_no']?> - <?=$job_order['destination_to_name']?>,\nTrip Type : <?=$trip_type?>,\nVehicle : <?=$job_order['vehicle_type']?>,\nTotal : Rp <?=number_format($job_order['total'],0,',','.')?>,\nDistance : <?=number_format($job_order['distance']/1000,1,',','.')?> km"); 
                                    });
                                    </script>
                                    <input type="hidden" name="destination_from_id" id="destination_from_id" value="<?=$job_order['destination_from_rowID']?>" />
								    <input type="hidden" name="destination_to_id" id="destination_to_id" value="<?=$job_order['destination_to_rowID']?>" />
								    <input type="hidden" name="already_do" id="already_do" value="<?=$already_do?>" />
                                </div>
							</div>							
							<div class="row inline-fields form-group form-md-line-input" style="padding-bottom: 10px;">
								<div class="col-md-4"><?=lang('job_order_wholesale')?> <span class="text-danger">*</span></div>
								<div class="col-md-1">:</div>
								<div class="col-md-2">
		                        	<label class="switch">								
									<input type="checkbox" class="form-control input-sm" id="job_order_wholesale_yes_no" name="job_order_wholesale_yes_no" <?php if($job_order['wholesale']){ echo "checked=\"checked\""; }?> />
									<span></span>
		                        	</label>
								</div>
                                <div class="col-md-2">Regular</div>
								<div class="col-md-2">
		                        	<label class="switch">								
    									<input type="checkbox" class="form-control input-sm" id="regular_type" name="regular_type" <?php if($job_order['regular_type']){ echo "checked=\"checked\""; }?> />
    									<span></span>
                                    </label>                                    									
								</div>
							</div>							
 							<div class="row inline-fields form-group form-md-line-input" style="padding-bottom: 10px;">
								<div class="col-md-4"><?=lang('price')?> <span class="text-danger">*</span></div>
								<div class="col-md-1">:</div>
								<div class="col-md-5">
									<input  type="text" class="form-control input-sm" id="job_order_price" name="job_order_price" onkeyup="IsNumeric(this)" placeholder="Ex : 50,5" maxlength="9" value="<?=number_format($job_order['price_amount'],2,',','')?>" style="text-align: right;" autocomplete="off">
								</div>
								<div class="col-md-1" style="padding-left: 0px;"><big>Kgs</big></div>								
							</div>
							<div class="row inline-fields form-group form-md-line-input" style="padding-bottom: 10px;">
								<div class="col-md-4"><?=lang('description')?></div>
								<div class="col-md-1">:</div>
								<div class="col-md-6">
									<textarea class="form-control input-sm"  id="job_order_desc" name="job_order_desc" maxlength="255" rows="2"><?=$job_order['description']?></textarea>									
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
								<div class="col-md-3"><input type="text" class="form-control input-sm" id="job_order_total_20ft" name="job_order_total_20ft" onkeyup="angka(this)" value="<?=$job_order['container_20ft']?>" maxlength="9" style="text-align: right;" autocomplete="off"></div>
								<div class="col-md-3"><input type="text" class="form-control input-sm" id="job_order_release_20ft" name="job_order_release_20ft" onkeyup="angka(this)" value="0" maxlength="9" style="text-align: right;" autocomplete="off"></div>
								<div class="col-md-3"><input type="text" class="form-control input-sm" id="job_order_price_20ft" name="job_order_price_20ft" onkeyup="angka(this)" value="<?=$job_order['price_20ft']?>" maxlength="9" style="text-align: right;" autocomplete="off"></div>
							</div>
							<div class="row inline-fields form-group form-md-line-input" style="padding-bottom: 10px;">
								<div class="col-md-3"><?=lang('40ft')?></div>
								<div class="col-md-3"><input type="text" class="form-control input-sm" id="job_order_total_40ft" name="job_order_total_40ft" onkeyup="angka(this)" value="<?=$job_order['container_40ft']?>" maxlength="9" style="text-align: right;" autocomplete="off"></div>
								<div class="col-md-3"><input type="text" class="form-control input-sm" id="job_order_release_40ft" name="job_order_release_40ft" onkeyup="angka(this)" value="0" maxlength="9" style="text-align: right;" autocomplete="off"></div>
								<div class="col-md-3"><input type="text" class="form-control input-sm" id="job_order_price_40ft" name="job_order_price_40ft" onkeyup="angka(this)" value="<?=$job_order['price_40ft']?>" maxlength="9" style="text-align: right;" autocomplete="off"></div>
							</div>
							<div class="row inline-fields form-group form-md-line-input" style="padding-bottom: 10px;">
								<div class="col-md-3"><?=lang('45ft')?></div>
								<div class="col-md-3"><input type="text" class="form-control input-sm" id="job_order_total_45ft" name="job_order_total_45ft" onkeyup="angka(this)" value="<?=$job_order['container_45ft']?>" maxlength="9" style="text-align: right;" autocomplete="off"></div>
								<div class="col-md-3"><input type="text" class="form-control input-sm" id="job_order_release_45ft" name="job_order_release_45ft" onkeyup="angka(this)" value="0" maxlength="9" style="text-align: right;" autocomplete="off"></div>
								<div class="col-md-3"><input type="text" class="form-control input-sm" id="job_order_price_45ft" name="job_order_price_45ft" onkeyup="angka(this)" value="<?=$job_order['price_45ft']?>" maxlength="9" style="text-align: right;" autocomplete="off"></div>
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
				<?php }} ?>		
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