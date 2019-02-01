<section id="content">
	<section class="hbox stretch">		
		<aside>
			<section class="vbox">
				<header class="header bg-white b-b b-light">
                    <div class="pull-right" style="margin-top: 10px;">
                      <button type="button" class="btn btn-sm btn-dark btn_cleartable" onclick="location.replace('<?php echo base_url('job_order_emkl')?>');//history.back();"><i class="fa fa-arrow-left"></i> <?=lang('back')?></button>
                    </div>
					<p class="pull-left"><strong><?=lang('new_job_order_emkl')?></strong>
				</header>
				<section class="scrollable wrapper">
				<?php
					$attributes = array('class' => 'bs-example form-horizontal', 'autocomplete' => 'off');
					echo form_open(base_url().'job_order_emkl/create_job_order_emkl',$attributes); 
				?>
				<div class="row"> 
					<div class="col-xs-6">
						<div class="group">	
							<div class="row inline-fields form-group form-md-line-input" style="padding-bottom: 10px;">
								<div class="col-md-4"><?=lang('job_order_date')?> <span class="text-danger">*</span></div>
								<div class="col-md-1">:</div>
								<div class="col-md-6">										
									<input type="text" class="form-control input-sm" id="job_order_emkl_date" name="job_order_emkl_date" value="<?=date('d-m-Y')?>" required readonly>
								</div>
							</div>						
							<div class="row inline-fields form-group form-md-line-input" style="padding-bottom: 10px;">
								<div class="col-md-4"><?=lang('job_order_type')?> <span class="text-danger">*</span></div>
								<div class="col-md-1">:</div>
								<div class="col-md-6">
									<select class="form-control input-sm" id="job_order_emkl_type" name="job_order_emkl_type" required>	
    									<option value="">Select Job Order Type</option>
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
								<div class="col-md-4"><?=lang('job_order_so_no')?> </div>
								<div class="col-md-1">:</div>
								<div class="col-md-6">
									<input  type="text" class="form-control input-sm" id="so_no" name="so_no" maxlength="25" autocomplete="off">
								</div>
							</div>
						</div>	
					</div>		
					<div class="col-xs-6">
						<div class="group">
							<div class="row inline-fields form-group form-md-line-input" style="padding-bottom: 10px;">
								<div class="col-md-4"><?=lang('bl_no')?> <span class="text-danger">*</span></div>
								<div class="col-md-1">:</div>
								<div class="col-md-6">
									<input type="text" class="form-control input-sm" id="bl_no" name="bl_no" maxlength="25" autocomplete="off" required />
								</div>
							</div>
                            <div class="row inline-fields form-group form-md-line-input" style="padding-bottom: 10px;">
								<div class="col-md-4"><?=lang('port_warehouse')?> <span class="text-danger">*</span></div>
								<div class="col-md-1">:</div>
								<div class="col-md-6">								
									<select class="form-control input-sm" name="port_jo_type" id="port_jo_type" onchange="show_port_jo_type()" required />
                                        <option value="POK">POK</option>
                                        <option value="PORT">PORT</option>
                                        <option value="WAREHOUSE">WAREHOUSE</option>
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
								<div class="col-md-4"><?=lang('vessel_no')?> <span class="text-danger">*</span></div>
								<div class="col-md-1">:</div>
								<div class="col-md-5">
                                    <input type="hidden" name="vessel_rowID" id="vessel_rowID" value="0" />
									<input  type="text" class="form-control input-sm" id="vessel_no" name="vessel_no" maxlength="25" autocomplete="off" readonly="" required />
								</div>
								<div class="col-md-1" style="padding-left: 0px;"><button type="button" class="btn btn-sm btn-info" onclick="search_vessel_jo()"><i class="fa fa-search"></i></button></div>
							</div>								
							<div class="row inline-fields form-group form-md-line-input" style="padding-bottom: 10px;">
								<div class="col-md-4"><?=lang('vessel_name')?> <span class="text-danger">*</span></div>
								<div class="col-md-1">:</div>
								<div class="col-md-6">
									<input  type="text" class="form-control input-sm" id="vessel_name" name="vessel_name" maxlength="60" autocomplete="off" readonly=""  required="" />
								</div>
							</div>
                            <div class="row inline-fields form-group form-md-line-input" style="padding-bottom: 10px;">
								<div class="col-md-4"><?=lang('description')?></div>
								<div class="col-md-1">:</div>
								<div class="col-md-6">
									<textarea class="form-control input-sm"  id="job_order_emkl_desc" name="job_order_emkl_desc" maxlength="255" rows="2"></textarea>									
								</div>
							</div>
						</div>
					</div>
				</div>					
				<p>&nbsp;</p>
                <div class="bs-example">
                    <ul class="nav nav-tabs">
                        <li class="active"><a data-toggle="tab" href="#cargo_destination"><?=lang('cargo_destination') ?></a></li>
                        <li><a data-toggle="tab" href="#container_20ft">Container <?=lang('20ft')?></a></li>
                        <li><a data-toggle="tab" href="#container_40ft">Container <?=lang('40ft')?></a></li>
                        <li><a data-toggle="tab" href="#container_45ft">Container <?=lang('45ft')?></a></li>
                    </ul>
                    <div class="tab-content">
                        <div id="cargo_destination" class="tab-pane active">
                            <br />                          
                            <div class="table-responsive"> 
                                <table class="table table-responsive table-striped table-condensed" id="detail_cargo_destination">
                                    <tr>
                                        <th style="width: 5%;">
                                            <input id="tamdet" title="Add Row" type="button" onclick="addRow_CargoDestination()" value="&nbsp;" style="height:30px;width:30px;border;background-image:url('<?= base_url();?>resource/images/plus.png');background-repeat:no-repeat;" />
                                        </th>
                                        <th width="10%">Party</th>
                                        <th width="10%"><?=lang('cargo')?></th>
                                        <th width="30%"><?=lang('destination')?></th>
                                        <th width="10%">Unit/Kg</th>
                                        <th width="10%"><?=lang('container_type')?></th>
                                    </tr>
                                </table>
                            </div>                          
                        </div>
                        <div id="container_20ft" class="tab-pane">
                            <br />
                            <div class="table-responsive"> 
                                <table class="table table-responsive" cellspacing="0" cellpadding="3" id="detail_20ft">
                                    <tr valign="middle">
                                        <th width="5%">
                                            <input id="tamdet" title="Tambah Baris" type="button" onclick="add_20ft()" value="&nbsp;" style="height:30px;width:30px;border;background-image:url('<?= base_url();?>resource/images/plus.png');background-repeat:no-repeat;" />
                                        </th>
                                        <th width="25%">Container No</th>
                                        <th width="25%">Seal No</th>
                                        <th width="30%">Replacement Seal No</th>
                                        <th width="15%">Unit/Kg</th>
                                    </tr>
                                </table>
                            </div>
                        </div>
                        <div id="container_40ft" class="tab-pane">
                            <br />
                            <div class="table-responsive">  
                                <table class="table table-responsive" cellspacing="0" cellpadding="3" id="detail_40ft">
                                    <tr valign="middle">
                                        <th width="5%">
                                            <input id="tamdet" title="Tambah Baris" type="button" onclick="add_40ft()" value="&nbsp;" style="height:30px;width:30px;border;background-image:url('<?= base_url();?>resource/images/plus.png');background-repeat:no-repeat;" />
                                        </th>
                                        <th width="25%">Container No</th>
                                        <th width="25%">Seal No</th>
                                        <th width="30%">Replacement Seal No</th>
                                        <th width="15%">Unit/Kg</th>
                                    </tr>
                                </table>
                            </div>
                        </div>
                        <div id="container_45ft" class="tab-pane">
                            <br />
                            <div class="table-responsive">  
                                <table class="table table-responsive" cellspacing="0" cellpadding="3" id="detail_45ft">
                                    <tr valign="middle">
                                        <th width="5%">
                                            <input id="tamdet" title="Tambah Baris" type="button" onclick="add_45ft()" value="&nbsp;" style="height:30px;width:30px;border;background-image:url('<?= base_url();?>resource/images/plus.png');background-repeat:no-repeat;" />
                                        </th>
                                        <th width="25%">Container No</th>
                                        <th width="25%">Seal No</th>
                                        <th width="30%">Replacement Seal No</th>
                                        <th width="15%">Unit/Kg</th>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <br />
				<div class="line"></div>
                <br />
                <div>
					<button type="submit" class="btn green"><i class="fa fa-plus"></i> <?=lang('save')?></button> &nbsp;
                    <button type="button" class="btn red" onclick="history.go(0);"><i class="fa fa-refresh"></i> <?=lang('refresh')?></button>
				</div>
                <p>&nbsp;</p>
				</form>			
           		</section>  
			</section> 
		
            <select id="ContType" style="display:none;">
                <option value="20">20 Feet</option>
                <option value="40">40 Feet</option>
                <option value="45">45 Feet</option>
            </select>
            
            <select class="form-control input-sm" id="party" name="party" style="display:none;">
                <?php
                    $char = array('A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z');
                    
                    for($i=0;$i<count($char);$i++){
                        echo '<option value="'.$char[$i].'">'.$char[$i].'</option>';
                    }
                ?>
    		</select>
            
            <select class="form-control input-sm" id="item" name="item" style="display:none;">
        		<?php
        			if (!empty($items)) {
        				foreach ($items as $item) { ?>
        				<option value="<?php echo $item->rowID;?>"><?php echo $item->item_cd;?> - <?php echo $item->item_name;?></option>
        		<?php }}?>
    		</select>	
            
            <select class="form-control input-sm" id="fare_trip" name="fare_trip" style="display:none;">
        		<?php
        			if (!empty($fare_trips)) {
        				foreach ($fare_trips as $fare_trip) { ?>
        				<option value="<?php echo $fare_trip->rowID;?>"><?php echo $fare_trip->destination_from.' - '.$fare_trip->destination_to;?></option>
        		<?php }}?>
    		</select>
            
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
            
        </aside>
        
    </section> 
</section>

<script type="text/javascript">
$(function() {
    
    $.ajax({
        type: "POST",
        url : "<?php echo base_url(); ?>job_order_emkl/get_data_vessel",
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