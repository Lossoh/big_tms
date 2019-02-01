<section id="content">
	<section class="hbox stretch">		
		<aside>
			<section class="vbox">
				<header class="header bg-white b-b b-light">
                    <div class="pull-right" style="margin-top: 10px;">
                      <button type="button" class="btn btn-sm btn-dark btn_cleartable" onclick="location.replace('<?php echo base_url('spk_transporter')?>');//history.back();"><i class="fa fa-arrow-left"></i> <?=lang('back')?></button>
                    </div>
					<p class="pull-left"><strong><?=lang('update_option')?> <?=lang('spk_transporter')?></strong>
				</header>
			
				<section class="scrollable wrapper">
				<?php
					$attributes = array('class' => 'bs-example form-horizontal', 'autocomplete' => 'off');
					echo form_open(base_url().'spk_transporter/update_spk_transporter',$attributes); 
				?>
    				<div class="row"> 
    					<div class="col-xs-6">
    						<div class="group">	
    							<div class="row inline-fields form-group form-md-line-input" style="padding-bottom: 10px;">
    								<div class="col-md-4"><?=lang('job_order_date')?> <span class="text-danger">*</span></div>
    								<div class="col-md-1">:</div>
    								<div class="col-md-7">										
    									<input type="hidden" id="spk_transporter_year" name="spk_transporter_year" value="<?=$get_data->year?>">
    									<input type="hidden" id="spk_transporter_month" name="spk_transporter_month" value="<?=$get_data->month?>">
    									<input type="hidden" id="spk_transporter_code" name="spk_transporter_code" value="<?=$get_data->code?>">
										<input type="hidden" id="spk_transporter_date" name="spk_transporter_date" value="<?=$get_data->spk_date?>">
    									<input type="hidden" id="spk_transporter_no" name="spk_transporter_no" value="<?=$get_data->spk_no?>">
                                        
    									<strong><?=date('d-m-Y',strtotime($get_data->spk_date))?> [<?=$get_data->spk_no?>]</strong>
    								</div>
    							</div>		
                                
                                <div class="row inline-fields form-group form-md-line-input" style="padding-bottom: 10px;">
    								<div class="col-md-4"><?=lang('creditor_name')?> <span class="text-danger">*</span></div>
    								<div class="col-md-1">:</div>
    								<div class="col-md-6">								
    									<select class="form-control input-sm" id="creditor_rowID" name="creditor_rowID"  required>
    									   <option value =""><?=lang('select')?><?=lang('creditor_name')?></option>
    									<?php
    										if (!empty($creditors)) {
    											foreach ($creditors as $creditor) { ?>
    											<option value="<?php echo $creditor->rowID; ?>"><?php echo $creditor->creditor_name;?></option>
    									<?php }}?>
    									</select>
    								</div>
    							</div>					
    							<div class="row inline-fields form-group form-md-line-input" style="padding-bottom: 10px;">
    								<div class="col-md-4"><?=lang('jo_type')?> <span class="text-danger">*</span></div>
    								<div class="col-md-1">:</div>
    								<div class="col-md-6">																		
    									<select class="form-control input-sm" id="jo_type" name="jo_type" required>	
                                            <option value="1" <?= $get_data->jo_type == '1' ? 'selected' : '' ?>>BULK</option>
        									<option value="2" <?= $get_data->jo_type == '2' ? 'selected' : '' ?>>CONTAINER</option>
        									<option value="3" <?= $get_data->jo_type == '3' ? 'selected' : '' ?>>OTHERS</option>
    									</select> 
    								</div>
    							</div>	
    							<div class="row inline-fields form-group form-md-line-input" style="padding-bottom: 10px;">
    								<div class="col-md-4"><?=lang('job_order_emkl_no')?> <span class="text-danger">*</span></div>
    								<div class="col-md-1">:</div>
    								<div class="col-md-6">										
    									<input type="text" class="form-control input-sm" id="jo_no" name="jo_no" value="<?=$get_data->jo_no?>" required readonly>
                                        <input type="hidden" class="form-control input-sm" id="jo_no_tmp" name="jo_no_tmp" value="<?=$get_data->jo_no?>">
    								</div>
                                    <div class="col-md-1" style="padding-left: 0px;"><button type="button" class="btn btn-sm btn-info" onclick="search_jo_emkl()"><i class="fa fa-search"></i></button></div>
    							</div>	
								
    						</div>	
    					</div>		
    					<div class="col-xs-6">&nbsp;</div>
    				</div>			
                    <p>&nbsp;</p>
                    <table id="tbl-data-detail-jo-emkl" class="table table-responsive table-striped" width="100%">
                        <tr>
                            <th width="5%">No</th>
            				<th width="30%"><?=lang('cargo')?> </th>
    						<th width="30%"><?=lang('destination')?> </th>
    						<th width="15%"><?=lang('job_order_weight')?> </th>
    						<th width="20%"><?=lang('container_type')?> </th>
                        </tr>
                        <?php
                        if(count($get_data_detail_jo) > 0){
                            $no = 1;
                            foreach($get_data_detail_jo as $row){
                        ?>
                             <tr>
                                <td><?=$no?></td>
                                <td><?=$row->item_name?></td>
            					<td><?=$row->destination?></td>
            					<td><?=number_format($row->weight,0,',','.')?></td>
            					<td><?=$row->container_type?> Feet</td>        						
                            </tr>
                        <?php
                                $no++; 
                            }
                        }
                        else{
                        ?>
                            <tr>
                                <td colspan="5" align="center">No Data Job Order EMKL Detail</td>
                            </tr>
                        <?php
                        }
                        ?>
                    </table>
    				<p>&nbsp;</p>
    				<div>
    					<button type="submit" class="btn green"><i class="fa fa-plus"></i> <?=lang('save')?></button> &nbsp;
                        <button type="button" class="btn red" onclick="history.go(0);"><i class="fa fa-refresh"></i> <?=lang('refresh')?></button>
    				</div>
                    <p>&nbsp;</p>
				    <?=form_close()?>
				</section>  
			</section> 
            
    		<div class="modal fade" id="modal_search_jo_emkl" role="dialog">
              <div class="modal-dialog" style="width:90%;">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h3 class="modal-title-search-jo-emkl">Select Job Order EMKL</h3>
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
                                                <button type="button" class="btn btn-sm btn-info" onclick="searchJOEMKL()"><i class="fa fa-search"></i> Search</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="panel-body">
                                    <div class="table-responsive">
                                      <table id="tbl-search-data-jo-emkl" class="table table-responsive table-striped" width="100%"></table>
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
<script>
    $(function(){        
        $('#creditor_rowID').select2();
        $('#creditor_rowID').select2('val','<?=$get_data->creditor_rowID?>');                                            
    });
</script>
