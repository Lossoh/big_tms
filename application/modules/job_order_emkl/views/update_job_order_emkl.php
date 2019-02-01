<section id="content">
	<section class="hbox stretch">		
		<aside>
			<section class="vbox">
				<header class="header bg-white b-b b-light">
                    <div class="pull-right" style="margin-top: 10px;">
                      <button type="button" class="btn btn-sm btn-dark btn_cleartable" onclick="location.replace('<?php echo base_url('job_order_emkl')?>');//history.back();"><i class="fa fa-arrow-left"></i> <?=lang('back')?></button>
                    </div>
					<p class="pull-left"><strong><?=lang('update_option')?> <?=lang('job_order_emkl')?></strong>
				</header>
			
				<section class="scrollable wrapper">
				<?php
					$attributes = array('class' => 'bs-example form-horizontal', 'autocomplete' => 'off');
					echo form_open(base_url().'job_order_emkl/update_job_order_emkl',$attributes); 
					if (!empty($job_order_emkls)) {
						foreach ($job_order_emkls as $job_order_emkl) {
					
				?>
				<div class="row"> 
					<div class="col-xs-6">
						<div class="group">	
							<div class="row inline-fields form-group form-md-line-input" style="padding-bottom: 10px;">
								<div class="col-md-4"><?=lang('job_order_date')?> <span class="text-danger">*</span></div>
								<div class="col-md-1">:</div>
								<div class="col-md-7">										
									<input type="hidden"  id="job_order_emkl_year" name="job_order_emkl_year" value="<?=$job_order_emkl['year']?>">
									<input type="hidden"  id="job_order_emkl_month" name="job_order_emkl_month" value="<?=$job_order_emkl['month']?>">
									<input type="hidden"  id="job_order_emkl_code" name="job_order_emkl_code" value="<?=$job_order_emkl['code']?>">
									<input type="hidden"  id="job_order_emkl_no" name="job_order_emkl_no" value="<?=$job_order_emkl['jo_no']?>">
									<input type="hidden"  id="user_created" name="user_created" value="<?=$job_order_emkl['user_created']?>">
                                    <input type="hidden"  id="date_created" name="date_created" value="<?=$job_order_emkl['date_created']?>">
                                    <input type="hidden"  id="time_created" name="time_created" value="<?=$job_order_emkl['time_created']?>">

									<strong><?=$job_order_emkl['jo_no']?> - <?=$job_order_emkl['jo_date']?></strong>
								</div>

							</div>						
							<div class="row inline-fields form-group form-md-line-input" style="padding-bottom: 10px;">
								<div class="col-md-4"><?=lang('job_order_type')?> <span class="text-danger">*</span></div>
								<div class="col-md-1">:</div>
								<div class="col-md-6">																		
									<select class="form-control input-sm" id="job_order_emkl_type" name="job_order_emkl_type" required>	
                                        <option value="1" <?= $job_order_emkl['jo_type'] == '1' ? 'selected' : '' ?>>BULK</option>
    									<option value="2" <?= $job_order_emkl['jo_type'] == '2' ? 'selected' : '' ?>>CONTAINER</option>
    									<option value="3" <?= $job_order_emkl['jo_type'] == '3' ? 'selected' : '' ?>>OTHERS</option>
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
                                            <option value="<?php echo $debtor->rowID; ?>" <?= $job_order_emkl['debtor_rowID'] == $debtor->rowID ? 'selected' : '' ?>>
                                                <?php echo $debtor->debtor_cd;?> - <?php echo $debtor->debtor_name;?>
                                            </option>
									<?php }}?>
									</select>
									<textarea class="form-control input-sm"  id="debtor_dtl" name="debtor_dtl" maxlength="60" rows="2" readonly><?=$job_order_emkl['debtor_name']?></textarea>
								</div>
							</div>
							<div class="row inline-fields form-group form-md-line-input" style="padding-bottom: 10px;">
								<div class="col-md-4"><?=lang('job_order_po_spk_no')?> <span class="text-danger">*</span></div>
								<div class="col-md-1">:</div>
								<div class="col-md-6">
									<input  type="text" class="form-control input-sm" id="po_spk_no" name="po_spk_no" maxlength="25" value="<?=$job_order_emkl['po_spk_no']?>" autocomplete="off" required>
								</div>
							</div>
							<div class="row inline-fields form-group form-md-line-input" style="padding-bottom: 10px;">
								<div class="col-md-4"><?=lang('job_order_so_no')?></div>
								<div class="col-md-1">:</div>
								<div class="col-md-6">
									<input  type="text" class="form-control input-sm" id="so_no" name="so_no" maxlength="25" value="<?=$job_order_emkl['so_no']?>" autocomplete="off">
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
									<input  type="text" class="form-control input-sm" id="bl_no" name="bl_no" maxlength="25" value="<?=$job_order_emkl['bl_no']?>" autocomplete="off" required />
								</div>
							</div>
                            <div class="row inline-fields form-group form-md-line-input" style="padding-bottom: 10px;">
								<div class="col-md-4"><?=lang('port_warehouse')?></div>
								<div class="col-md-1">:</div>
								<div class="col-md-6">								
									<select class="form-control input-sm" name="port_jo_type" id="port_jo_type" onchange="show_port_jo_type()" >
                                        <option value="POK" <?= $job_order_emkl['port_jo_type'] == 'POK' ? 'selected' : '' ?>>POK</option>
                                        <option value="PORT" <?= $job_order_emkl['port_jo_type'] == 'PORT' ? 'selected' : '' ?>>PORT</option>
                                        <option value="WAREHOUSE" <?= $job_order_emkl['port_jo_type'] == 'WAREHOUSE' ? 'selected' : '' ?>>WAREHOUSE</option>
                                    </select>									
								</div>
							</div>
                            <div class="row inline-fields form-group form-md-line-input" style="padding-bottom: 10px;">
								<div class="col-md-4"></div>
								<div class="col-md-1"></div>
								<div class="col-md-6">								
									<select  class="form-control input-sm" id="port" name="port"  required />
									<?php
                                        if($job_order_emkl['port_jo_type'] == 'POK'){
                                            $ports = $this->job_order_emkl_model->get_all_records('sa_port', $array =
                                                array('rowID >' => 0, 'deleted' => 0), $join_table = '', $join_criteria = '', 'port_name', 'asc');	   
                                        }
                                        else{
                                            $ports = $this->job_order_emkl_model->get_all_records('sa_port', $array =
                                                array('rowID >' => 0, 'deleted' => 0, 'port_type' => $job_order_emkl['port_jo_type']), $join_table = '', $join_criteria = '', 'port_name', 'asc');
                                        }
                                        
										if (!empty($ports)) {
											foreach ($ports as $port) { ?>
									        <option value="<?php echo $port->rowID;?>" <?= $job_order_emkl['port_rowID'] == $port->rowID ? 'selected' : '' ?>>
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
                                    <input type="hidden" name="vessel_rowID" id="vessel_rowID" value="<?=$job_order_emkl['vessel_rowID']?>" />
									<input  type="text" class="form-control input-sm" id="vessel_no" name="vessel_no" maxlength="25" value="<?=$job_order_emkl['vessel_no']?>" autocomplete="off" readonly="" />
								</div>
                                <div class="col-md-1" style="padding-left: 0px;"><button type="button" class="btn btn-sm btn-info" onclick="search_vessel_jo()"><i class="fa fa-search"></i></button></div>
							</div>								
							<div class="row inline-fields form-group form-md-line-input" style="padding-bottom: 10px;">
								<div class="col-md-4"><?=lang('vessel_name')?></div>
								<div class="col-md-1">:</div>
								<div class="col-md-6">
									<input  type="text" class="form-control input-sm" id="vessel_name" name="vessel_name" maxlength="60" value="<?=$job_order_emkl['vessel_name']?>" autocomplete="off" readonly="" required="" />
								</div>
							</div>	
							<div class="row inline-fields form-group form-md-line-input" style="padding-bottom: 10px;">
								<div class="col-md-4"><?=lang('description')?></div>
								<div class="col-md-1">:</div>
								<div class="col-md-6">
									<textarea class="form-control input-sm"  id="job_order_emkl_desc" name="job_order_emkl_desc" maxlength="255" rows="2"><?=$job_order_emkl['description']?></textarea>									
								</div>
							</div>	
						</div>
					</div>
				</div>			
                
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
                                    <?php
                                    if($count_data_detail_jo > 0){
                                        $totrowCD = 1;
                                        foreach($get_data_detail as $row){
                                            echo "
                                                <tr id='rowCD_".$totrowCD."'>
                                                    <td>
                                                        <input type='hidden' name='dtl_rowID[]' value='".$row->rowID."' />
                                                        <input type='button' style='height:30px;width:30px;border:0px;background-image:url(\"".base_url()."resource/images/delete.png\");background-repeat:no-repeat;' title='Hapus Baris' value='&nbsp;' onclick='deleteCargoDestination(".$totrowCD.")' />
                                                    </td>
                                                    <td>
                                                        <select class='form-control input-sm'  id='party_".$totrowCD."' name='party[]' style='background-color:white;border:solid 1px #ccc;'></select>
                                                    </td>
                                                    <td>
                                                        <select class='form-control input-sm'  id='cargo_".$totrowCD."' name='cargo[]' style='background-color:white;border:solid 1px #ccc;'></select>
                                                    </td>
                                                    <td>
                                                        <select class='form-control input-sm'  id='destination_".$totrowCD."' name='destination[]' style='background-color:white;border:solid 1px #ccc;'></select>
                                                    </td>
                                                    <td>
                                                        <input class='form-control input-sm angka_jutaan' id='weight_".$totrowCD."' name='weight[]' type='text' style='text-align: left;' value='".number_format($row->weight,0,',','.')."' autocomplete='off' />
                                                    </td>
                                                    <td>
                                                        <select class='form-control input-sm'  id='container_type_".$totrowCD."' name='container_type[]' style='background-color:white;border:solid 1px #ccc;'>
                                                        
                                                        </select>
                                                    </td>
                                                </tr>
                                            ";
                                            
                                            echo "
                                            <script>
                                                document.getElementById('party_".$totrowCD."').innerHTML=document.getElementById('party').innerHTML;
                                                document.getElementById('cargo_".$totrowCD."').innerHTML=document.getElementById('item').innerHTML;
                                                document.getElementById('destination_".$totrowCD."').innerHTML=document.getElementById('fare_trip').innerHTML;
                                                document.getElementById('container_type_".$totrowCD."').innerHTML=document.getElementById('ContType').innerHTML;
                                                $('#party_".$totrowCD."').val('".$row->party."');
                                                $('#cargo_".$totrowCD."').select2();
                                                $('#cargo_".$totrowCD."').select2('val','".$row->item_rowID."');
                                                $('#destination_".$totrowCD."').select2();
                                                $('#destination_".$totrowCD."').select2('val','".$row->fare_trip_rowID."');
                                                $('#container_type_".$totrowCD."').val('".$row->container_type."');                                                
                                            </script>
                                            ";
                                            
                                            $totrowCD++;
                                        }
                                    }
                                    ?>
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
                                    <?php
                                    if($count_data_container_20ft_detail > 0){
                                        $totrow20ft = 1;
                                        foreach($get_data_container_20ft_detail as $row_20ft){
                                            echo "
                                                <tr id='row20ft_".$totrow20ft."'>
                                                    <td>
                                                        <input type='hidden' name='rowID_20ft[]' value='".$row_20ft->rowID."' />
                                                        <input type='button' style='height:30px;width:30px;border:0px;background-image:url(\"".base_url()."resource/images/delete.png\");background-repeat:no-repeat;' id='hapdetReimburse".$totrow20ft."' title='Hapus Baris' value='&nbsp;' onclick='deleteDetail20ft(".$totrow20ft.")' />
                                                    </td>
                                                    <td>
                                                        <input id='row_id_20ft_".$totrow20ft."' name='row_id_20ft[]' type='hidden' /><input class='form-control' id='container_no_20ft_".$totrow20ft."' name='container_no_20ft[]' type='text' style='height:30px;border:solid 1px #ccc;' maxlength='50' value='".$row_20ft->container_no."' />
                                                    </td>       
                                                    <td>
                                                        <input class='form-control' id='seal_no_20ft_".$totrow20ft."' name='seal_no_20ft[]' type='text' style='height:30px;border:solid 1px #ccc;' maxlength='50' value='".$row_20ft->seal_no."' />
                                                    </td>
                                                    <td>
                                                        <input class='form-control' id='replacement_seal_no_20ft_".$totrow20ft."' name='replacement_seal_no_20ft[]' type='text' style='height:30px;border:solid 1px #ccc;' maxlength='50' value='".$row_20ft->replacement_seal_no."' />
                                                    </td> 
                                                    <td>
                                                        <input class='form-control angka_jutaan' id='weight_20ft_".$totrow20ft."' name='weight_20ft[]' type='text' style='height:30px;border:solid 1px #ccc;' value='".number_format($row_20ft->weight,0,',','.')."' />
                                                    </td> 
                                                </tr>
                                            ";
                                            
                                            $totrow20ft++;
                                        }
                                    }
                                    ?>
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
                                    <?php
                                    if($count_data_container_40ft_detail > 0){
                                        $totrow40ft = 1;
                                        foreach($get_data_container_40ft_detail as $row_40ft){
                                            echo "
                                                <tr id='row40ft_".$totrow40ft."'>
                                                    <td>
                                                        <input type='hidden' name='rowID_40ft[]' value='".$row_40ft->rowID."' />
                                                        <input type='button' style='height:30px;width:30px;border:0px;background-image:url(\"".base_url()."resource/images/delete.png\");background-repeat:no-repeat;' id='hapdetReimburse".$totrow40ft."' title='Hapus Baris' value='&nbsp;' onclick='deleteDetail40ft(".$totrow40ft.")' />
                                                    </td>
                                                    <td>
                                                        <input id='row_id_40ft_".$totrow40ft."' name='row_id_40ft[]' type='hidden' /><input class='form-control' id='container_no_40ft_".$totrow40ft."' name='container_no_40ft[]' type='text' style='height:30px;border:solid 1px #ccc;' maxlength='50' value='".$row_40ft->container_no."' />
                                                    </td>       
                                                    <td>
                                                        <input class='form-control' id='seal_no_40ft_".$totrow40ft."' name='seal_no_40ft[]' type='text' style='height:30px;border:solid 1px #ccc;' maxlength='50' value='".$row_40ft->seal_no."' />
                                                    </td>
                                                    <td>
                                                        <input class='form-control' id='replacement_seal_no_40ft_".$totrow40ft."' name='replacement_seal_no_40ft[]' type='text' style='height:30px;border:solid 1px #ccc;' maxlength='50' value='".$row_40ft->replacement_seal_no."' />
                                                    </td>  
                                                    <td>
                                                        <input class='form-control angka_jutaan' id='weight_40ft_".$totrow40ft."' name='weight_40ft[]' type='text' style='height:30px;border:solid 1px #ccc;' value='".number_format($row_40ft->weight,0,',','.')."' />
                                                    </td> 
                                                </tr>
                                            ";
                                            
                                            $totrow40ft++;
                                        }
                                    }
                                    ?>
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
                                    <?php
                                    if($count_data_container_45ft_detail > 0){
                                        $totrow45ft = 1;
                                        foreach($get_data_container_45ft_detail as $row_45ft){
                                            echo "
                                                <tr id='row45ft_".$totrow45ft."'>
                                                    <td>
                                                        <input type='hidden' name='rowID_45ft[]' value='".$row_45ft->rowID."' />
                                                        <input type='button' style='height:30px;width:30px;border:0px;background-image:url(\"".base_url()."resource/images/delete.png\");background-repeat:no-repeat;' id='hapdetReimburse".$totrow45ft."' title='Hapus Baris' value='&nbsp;' onclick='deleteDetail45ft(".$totrow45ft.")' />
                                                    </td>
                                                    <td>
                                                        <input id='row_id_45ft_".$totrow45ft."' name='row_id_45ft[]' type='hidden' /><input class='form-control' id='container_no_45ft_".$totrow45ft."' name='container_no_45ft[]' type='text' style='height:30px;border:solid 1px #ccc;' maxlength='50' value='".$row_45ft->container_no."' />
                                                    </td>       
                                                    <td>
                                                        <input class='form-control' id='seal_no_45ft_".$totrow45ft."' name='seal_no_45ft[]' type='text' style='height:30px;border:solid 1px #ccc;' maxlength='50' value='".$row_45ft->seal_no."' />
                                                    </td>
                                                    <td>
                                                        <input class='form-control' id='replacement_seal_no_45ft_".$totrow45ft."' name='replacement_seal_no_45ft[]' type='text' style='height:30px;border:solid 1px #ccc;' maxlength='50' value='".$row_45ft->replacement_seal_no."' />
                                                    </td>  
                                                    <td>
                                                        <input class='form-control angka_jutaan' id='weight_45ft_".$totrow45ft."' name='weight_45ft[]' type='text' style='height:30px;border:solid 1px #ccc;' value='".number_format($row_45ft->weight,0,',','.')."' />
                                                    </td> 
                                                </tr>
                                            ";
                                            
                                            $totrow45ft++;
                                        }
                                    }
                                    ?>
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
				<?php 
                    }
                } 
                ?>		
				</section>  
			</section> 
		
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