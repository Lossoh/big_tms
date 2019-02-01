<section id="content">
	<section class="hbox stretch">		
		<aside>
			<section class="vbox">
				<header class="header bg-white b-b b-light">
                    <div class="pull-right" style="margin-top: 10px;">
                      <button type="button" class="btn btn-sm btn-dark btn_cleartable" onclick="location.replace('<?php echo base_url('spk_transporter')?>');//history.back();"><i class="fa fa-arrow-left"></i> <?=lang('back')?></button>
                    </div>
					<p class="pull-left"><strong><?=lang('set_price')?> <?=lang('spk_transporter')?></strong>
				</header>
			
				<section class="scrollable wrapper">
    				<div class="row"> 
    					<div class="col-xs-6">
    						<div class="group">	
    							<div class="row inline-fields form-group form-md-line-input" style="padding-bottom: 10px;">
    								<div class="col-md-4"><?=lang('job_order_date')?> <span class="text-danger">*</span></div>
    								<div class="col-md-1">:</div>
    								<div class="col-md-7">										
    									<strong><?=date('d-m-Y',strtotime($get_data->spk_date))?> [<?=$get_data->spk_no?>]</strong>
    								</div>
    							</div>		
                                
                                <div class="row inline-fields form-group form-md-line-input" style="padding-bottom: 10px;">
    								<div class="col-md-4"><?=lang('creditor_name')?> <span class="text-danger">*</span></div>
    								<div class="col-md-1">:</div>
    								<div class="col-md-6">								
    									<strong><?=$get_data->creditor_name?></strong>
    								</div>
    							</div>					
    							<div class="row inline-fields form-group form-md-line-input" style="padding-bottom: 10px;">
    								<div class="col-md-4"><?=lang('jo_type')?> <span class="text-danger">*</span></div>
    								<div class="col-md-1">:</div>
    								<div class="col-md-6">																		
                                        <?php
                                        $jo_type = '-';
                                        if($get_data->jo_type == '1'){
                                            $jo_type = 'BULK';
                                        }
                                        else if($get_data->jo_type == '2'){
                                            $jo_type = 'CONTAINER';
                                        }
                                        else if($get_data->jo_type == '3'){
                                            $jo_type = 'OTHERS';
                                        }
                                        ?>
                                        <strong><?=$jo_type?></strong> 
    								</div>
    							</div>	
    							<div class="row inline-fields form-group form-md-line-input" style="padding-bottom: 10px;">
    								<div class="col-md-4"><?=lang('job_order_emkl_no')?> <span class="text-danger">*</span></div>
    								<div class="col-md-1">:</div>
    								<div class="col-md-6">	
                                        <strong><?=$get_data->jo_no?></strong> 									
    								</div>
    							</div>	
								
    						</div>	
    					</div>		
    					<div class="col-xs-6">&nbsp;</div>
    				</div>			
                    <p>&nbsp;</p>
                    <table id="tbl-data-detail-jo-emkl" class="table table-responsive table-striped" width="100%">
                        <tr>
                            <th width="5%">No</th>
            				<th width="20%"><?=lang('cargo')?> </th>
    						<th width="20%"><?=lang('destination')?> </th>
    						<th width="15%"><?=lang('job_order_weight')?> </th>
    						<th width="15%"><?=lang('container_type')?> </th>
    						<th width="15%">Total <?=lang('price')?> (Rp)</th>
    						<th width="10%"><?=lang('set_price')?> </th>
                        </tr>
                        <?php
                        if(count($get_data_detail_jo) > 0){
                            $no = 1;
                            foreach($get_data_detail_jo as $row){
                                $get_total_price = $this->spk_transporter_model->get_sum_price_by_spk_no_jo_detail_id($get_data->spk_no,$row->rowID);
        
                        ?>
                             <tr>
                                <td><?=$no?></td>
                                <td><?=$row->item_name?></td>
            					<td><?=$row->destination?></td>
            					<td><?=number_format($row->weight,0,',','.')?></td>
            					<td><?=$row->container_type?> Feet</td>        						
            					<td align="right"><?=number_format($get_total_price->total_price,0,',','.')?></td>
            					<td>
                                    <button type="button" class="btn btn-success btn-sm" onclick="setPriceSPK(<?=$row->item_rowID?>,<?=$row->destination_from_rowID?>,
                                        <?=$row->destination_to_rowID?>,<?=$row->rowID?>)"><i class="fa fa-money"></i> <?=lang('set_price')?></button>
                                </td>        						
                            </tr>
                        <?php
                                $no++; 
                            }
                        }
                        else{
                        ?>
                            <tr>
                                <td colspan="7" align="center">No Data Job Order EMKL Detail</td>
                            </tr>
                        <?php
                        }
                        ?>
                    </table>
				</section>  
			</section> 
            
            <select class="form-control input-sm" name="vehicle_type" id="vehicle_type">
                <?php
                    if (!empty($vehicle_categories)) {
                        echo "<option value=''>".lang('select_your_option')."</option>";
                        if($get_data->jo_type == 2){
                            foreach ($vehicle_categories as $row_vehicle) {
                		      echo '<option value="'.$row_vehicle->rowID.'">'.$row_vehicle->type_name.'</option>';
                            }
                        }
                    }
                ?>
            </select> 
            
    		<div class="modal fade" id="modal_form_set_price" role="dialog">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h3 class="modal-title-set-price"><?=lang('set_price')?></h3>
                  </div>
                  <div class="modal-body form">
                    <?=form_open('','autocomplete="off" id="form_set_price" class="form-horizontal"')?>
                    <input type="hidden" name="rowID" id="rowID" value="">
                    <input type="hidden" id="spk_transporter_year" name="spk_transporter_year" value="<?=$get_data->year?>">
					<input type="hidden" id="spk_transporter_month" name="spk_transporter_month" value="<?=$get_data->month?>">
					<input type="hidden" id="spk_transporter_code" name="spk_transporter_code" value="<?=$get_data->code?>">
					<input type="hidden" id="spk_transporter_date" name="spk_transporter_date" value="<?=$get_data->spk_date?>">
					<input type="hidden" id="spk_transporter_no" name="spk_transporter_no" value="<?=$get_data->spk_no?>">
                    <input type="hidden" id="creditor_rowID" name="creditor_rowID" value="<?=$get_data->creditor_rowID?>">
                    <input type="hidden" id="jo_type" name="jo_type" value="<?=$get_data->jo_type?>">
                    <input type="hidden" id="jo_no" name="jo_no" value="<?=$get_data->jo_no?>">
                    <input type="hidden" id="item_rowID" name="item_rowID" value="">
                    <input type="hidden" id="destination_from_rowID" name="destination_from_rowID" value="">
                    <input type="hidden" id="destination_to_rowID" name="destination_to_rowID" value="">
                        
                    <div class="bs-example"> 
                        <table class="table table-responsive" cellspacing="0" cellpadding="3" id="detail_spk_price">
                            <tr valign="middle">
                                <th width="5%">
                                    <input id="tamdet" title="Add Row" type="button" onclick="add_spk_price()" value="&nbsp;" style="height:30px;width:30px;border;background-image:url('<?= base_url();?>resource/images/plus.png');background-repeat:no-repeat;" />
                                </th>
                                <th width="50%"><?=lang('vehicle_category')?></th>
                                <th><?=lang('price')?></th>
                            </tr>
                        </table>
                    </div>         
                      
                    <?=form_close()?>
                  </div>
                  <div class="modal-footer">
                        <button type="button" id="btnSave" onclick="save_spk_price()" class="btn green">Save</button>
                        <button type="button" class="btn red" data-dismiss="modal">Cancel</button>
                  </div>
                </div><!-- /.modal-content -->
              </div><!-- /.modal-dialog -->
            </div><!-- /.modal -->

        </aside>
        
	</section> 
</section>
