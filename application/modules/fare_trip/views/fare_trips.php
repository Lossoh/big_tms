<section id="content">
  <section class="hbox stretch">

      <section class="vbox">
        <header class="header bg-white b-b b-light">
            <div class="pull-right" style="margin-top: 10px;">
              <?php
              if($this->user_profile->get_user_access('Created') == 1){
              ?>
			     <a  class="btn btn-sm green" onclick="add_fare_trip()"><i class="fa fa-plus"></i> <?=lang('new_fare_trip')?></a>
              <?php
              }
              ?>
              <a  class="btn btn-sm red" onclick="fare_trip_pdf()"><i class="fa fa-file-pdf-o"></i> Print PDF</a>
              <a  class="btn btn-sm btn-success" onclick="fare_trip_excel()"><i class="fa fa-file-excel-o"></i> Print Excel</a>
            </div>
            <p class="pull-left"><?=lang('fare_trip_details')?></p>
        </header>
        <section class="scrollable wrapper">
          <div class="row">
            <div class="col-lg-12">
                <ul class="nav nav-tabs" role="tablist">
                    <li role="presentation" class="active"><a href="#active" aria-controls="active" role="tab" data-toggle="tab">ACTIVE <span class="badge"><?=count($fare_trips_active)?></span></a></li>
                    <li role="presentation"><a href="#not_active" aria-controls="not_active" role="tab" data-toggle="tab">NOT ACTIVE <span class="badge"><?=count($fare_trips_not_active)?></span></a></li>
                </ul>
                <div class="tab-content">
                    <div role="tabpanel" class="tab-pane fade in active" id="active">
                      <section class="panel panel-default">
                        <div class="table-responsive"><?php echo validation_errors(); ?>
                          <table id="tbl-data-faretrip" class="table table-striped table-hover b-t b-light text-sm" width="100%">
                            <thead>
                              <tr>
                                <th width="10%"><?=lang('options')?></th>
                                <th><?=lang('fare_trip_code')?> </th>
        						<th><?=lang('fare_trip_destination_from')?> </th>
        						<th><?=lang('fare_trip_destination_to')?> </th>
        						<th><?=lang('fare_trip_distance')?> </th>
        						<th>Trip Condition </th>
                                <th><?=lang('points')?> </th>
        						<th><?=lang('trip_type')?> </th>
        						<th><?=lang('vehicle')?> </th>
        						<th><?=lang('cost')?> </th>
        						<th><?=lang('komisi_supir')?> </th>
        						<th><?=lang('komisi_kernet')?> </th>
        						<th><?=lang('total')?> </th>
                              </tr> 
        					</thead>
        					<tbody>
                              <?php
                              if (!empty($fare_trips_active)) {
                              foreach ($fare_trips_active as $fare_trip) { 
                                    if($fare_trip->trip_type == '1')
                                        $trip_type = "BULK";
                                    else if($fare_trip->trip_type == '2')
                                        $trip_type = "CONTAINER";
                                    else
                                        $trip_type = "OTHERS";  
                                        
                                    if($fare_trip->split == 1){
                                        $star = "<span style='color:#C00'>*</span>";
                                    }
                                    else{
                                        $star = "";
                                    }
                              ?>
                              <tr>
                                <td>
        							  <div class="btn-group">
        								<button class="btn btn-xs btn-default dropdown-toggle" data-toggle="dropdown">
        								 <?=lang('options')?>
        								<span class="caret"></span>
        								</button>
        								<ul class="dropdown-menu">
                                            <?php
                                            if($this->user_profile->get_user_access('Created') == 1){
                                            ?>
        									   <li><a  href="javascript:void()" title="<?=lang('copy_option')?>" onclick="copy_fare_trip(<?=$fare_trip->rowID ?>)"><i class="fa fa-copy"></i> <?=lang('copy_option')?></a></li>                                    
                                            <?php
                                            }
                                            if($this->user_profile->get_user_access('Updated') == 1){
                                            ?>
        									   <li><a  href="javascript:void()" title="<?=lang('update_option')?>" onclick="edit_fare_trip(<?=$fare_trip->rowID ?>)"><i class="fa fa-pencil"></i> <?=lang('update_option')?></a></li>                                    
                                               <li><a  href="javascript:void()" title="Disactivate" onclick="disactivate_fare_trip(<?=$fare_trip->rowID ?>)"><i class="fa fa-times"></i> Disactivate</a></li>
                                            <?php
                                            }
                                            if($this->user_profile->get_user_access('Deleted') == 1){
                                            ?>
                                                <li><a  href="javascript:void()" title="<?=lang('delete_option')?>" onclick="delete_fare_trip(<?=$fare_trip->rowID ?>)"><i class="fa fa-trash-o"></i> <?=lang('delete_option')?></a></li>
                                            <?php
                                            }
                                            ?>
        								</ul>
        							  </div>
        						</td>
        						<td><?=$fare_trip->fare_trip_cd.$star?></td>
        						<td><?=$fare_trip->destination_from?></td>
        						<td><?=$fare_trip->destination_to?></td>
        						<td><?="<a href=\"https://www.google.co.id/maps/dir/'".str_replace(' ','',$fare_trip->origin)."'/'".str_replace(' ','',$fare_trip->destination)."'\" target='_blank' title='Show Direction Detail'>".
                                        number_format($fare_trip->distance/1000,1,',','.').' km</a> ('.number_format($fare_trip->estimated_time_receipt,0,',','.').' minutes)'?></td>
                                <!--<td><?="<a href='javascript:void()' title='Show Direction Detail' onclick=\"showDirectionDetail('".$fare_trip->origin."','".$fare_trip->destination."')\">".
                                        number_format($fare_trip->distance,0,',','.').'</a> ('.number_format($fare_trip->estimated_time_receipt,0,',','.').' minutes)'?></td>
                                -->
                                <td><?=ucwords($fare_trip->trip_condition)?></td>
                                <td align="center"><?=$fare_trip->poin?></td>
                                <td><?=$trip_type?></td>
        						<td>
                                <?php
                                    $get_vehicle = $this->vehicle_category_model->get_by_id('sa_vehicle_type',$fare_trip->vehicle_id);
                                    echo strtoupper($get_vehicle->type_name);
                                ?>
                                </td>
        						<td>
                                <?php
                                    $get_cost_code = $this->cost_code_model->get_by_id('sa_cost',$fare_trip->cost_id);
                                    echo strtoupper($get_cost_code->descs);
                                ?>
                                </td>
        						<td align="right"><?=number_format($fare_trip->komisi_supir,0,',','.')?></td>
                                <td align="right"><?=number_format($fare_trip->komisi_kernet,0,',','.')?></td>
                                <td align="right"><?=number_format($fare_trip->total,0,',','.')?></td>
                            </tr>
                            <?php } } ?>
                          </tbody>
                        </table>
        
                      </div>
                    </section>    
                  </div>
                  <div role="tabpanel" class="tab-pane fade" id="not_active">
                    <section class="panel panel-default">
                        <div class="table-responsive"><?php echo validation_errors(); ?>
                          <table id="tbl-projects" class="table table-striped table-hover b-t b-light text-sm" width="100%">
                            <thead>
                              <tr>
                                <th width="10%"><?=lang('options')?></th>
                                <th><?=lang('fare_trip_code')?> </th>
        						<th><?=lang('fare_trip_destination_from')?> </th>
        						<th><?=lang('fare_trip_destination_to')?> </th>
        						<th><?=lang('fare_trip_distance')?> </th>
        						<th>Trip Condition </th>
        						<th><?=lang('points')?> </th>
        						<th><?=lang('trip_type')?> </th>
        						<th><?=lang('vehicle')?> </th>
        						<th><?=lang('cost')?> </th>
        						<th><?=lang('komisi_supir')?> </th>
        						<th><?=lang('komisi_kernet')?> </th>
        						<th><?=lang('total')?> </th>
                              </tr> 
        					</thead>
        					<tbody>
                              <?php
                              if (!empty($fare_trips_not_active)) {
                              foreach ($fare_trips_not_active as $fare_trip) { 
                                    if($fare_trip->trip_type == '1')
                                        $trip_type = "BULK";
                                    else if($fare_trip->trip_type == '2')
                                        $trip_type = "CONTAINER";
                                    else
                                        $trip_type = "OTHERS";  
                                        
                                    if($fare_trip->split == 1){
                                        $star = "<span style='color:#C00'>*</span>";
                                    }
                                    else{
                                        $star = "";
                                    }
                              ?>
                              <tr>
                                <td>
        							  <div class="btn-group">
        								<button class="btn btn-xs btn-default dropdown-toggle" data-toggle="dropdown">
        								 <?=lang('options')?>
        								<span class="caret"></span>
        								</button>
        								<ul class="dropdown-menu">
                                            <?php
                                            if($this->user_profile->get_user_access('Created') == 1){
                                            ?>
        									   <li><a  href="javascript:void()" title="<?=lang('copy_option')?>" onclick="copy_fare_trip(<?=$fare_trip->rowID ?>)"><i class="fa fa-copy"></i> <?=lang('copy_option')?></a></li>                                    
                                            <?php
                                            }
                                            if($this->user_profile->get_user_access('Updated') == 1){
                                            ?>
        									   <li><a  href="javascript:void()" title="<?=lang('update_option')?>" onclick="edit_fare_trip(<?=$fare_trip->rowID ?>)"><i class="fa fa-pencil"></i> <?=lang('update_option')?></a></li>
                                               <li><a  href="javascript:void()" title="Activate" onclick="activate_fare_trip(<?=$fare_trip->rowID ?>)"><i class="fa fa-check"></i> Activate</a></li>                                    
                                            <?php
                                            }
                                            if($this->user_profile->get_user_access('Deleted') == 1){
                                            ?>
                                                <li><a  href="javascript:void()" title="<?=lang('delete_option')?>" onclick="delete_fare_trip(<?=$fare_trip->rowID ?>)"><i class="fa fa-trash-o"></i> <?=lang('delete_option')?></a></li>
                                            <?php
                                            }
                                            ?>
        								</ul>
                                        
        							  </div>
        						</td>
        						<td><?=$fare_trip->fare_trip_cd.$star?></td>
        						<td><?=$fare_trip->destination_from?></td>
        						<td><?=$fare_trip->destination_to?></td>
        						<td><?="<a href=\"https://www.google.co.id/maps/dir/'".str_replace(' ','',$fare_trip->origin)."'/'".str_replace(' ','',$fare_trip->destination)."'\" target='_blank' title='Show Direction Detail'>".
                                        number_format($fare_trip->distance/1000,1,',','.').' km</a> ('.number_format($fare_trip->estimated_time_receipt,0,',','.').' minutes)'?></td>
                                <!--<td><?="<a href='javascript:void()' title='Show Direction Detail' onclick=\"showDirectionDetail('".$fare_trip->origin."','".$fare_trip->destination."')\">".
                                        number_format($fare_trip->distance,0,',','.').'</a> ('.number_format($fare_trip->estimated_time_receipt,0,',','.').' minutes)'?></td>
                                -->
                                <td><?=ucwords($fare_trip->trip_condition)?></td>
                                <td align="center"><?=$fare_trip->poin?></td>
                                <td><?=$trip_type?></td>
        						<td>
                                <?php
                                    $get_vehicle = $this->vehicle_category_model->get_by_id('sa_vehicle_type',$fare_trip->vehicle_id);
                                    echo strtoupper($get_vehicle->type_name);
                                ?>
                                </td>
        						<td>
                                <?php
                                    $get_cost_code = $this->cost_code_model->get_by_id('sa_cost',$fare_trip->cost_id);
                                    echo strtoupper($get_cost_code->descs);
                                ?>
                                </td>
        						<td align="right"><?=number_format($fare_trip->komisi_supir,0,',','.')?></td>
                                <td align="right"><?=number_format($fare_trip->komisi_kernet,0,',','.')?></td>
                                <td align="right"><?=number_format($fare_trip->total,0,',','.')?></td>
                            </tr>
                            <?php } } ?>
                          </tbody>
                        </table>
        
                      </div>
                    </section> 
                  </div>
                </div>        
          </div>
        </div>
      </section>

    </section>

<select id="reference" class="form-control" style="display: none;">
	 <option value="" selected><?=lang('select_your_option')?></option>
	 <?php if (!empty($references)) {
	  foreach ($references as $ref) { ?>
	  <option value="<?php echo $ref->rowID;?>"><?php echo $ref->reference;?></option>
	 <?php }} ?>
</select>
                    
  <!-- Bootstrap modal -->
  <div class="modal fade" id="modal_form" role="dialog">
  <div class="modal-dialog" style="width:75%;">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h3 class="modal-title"></h3>
      </div>
      <div class="modal-body form">
        <?=form_open('','autocomplete="off" id="form" class="form-horizontal"')?>
        <input type="hidden" name="rowID" value="">
        <div class="form-body">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group form-md-line-input">
                        <label class="control-label col-md-5"><?=lang('fare_trip_destination_from')?><span class="text-danger">*</span></label>
                        <div class="col-md-7">
                             <select class="form-control" name="fare_trip_destination_from" id="fare_trip_destination_from" placeholder="<?=lang('select')?>" >	
                                 <option value="" disabled selected><?=lang('select_your_option')?></option>
        						 <?php if (!empty($destination)) {
        						  foreach ($destination as $rs) { ?>
        						  <option value="<?php echo $rs->rowID;?>"><?php echo $rs->destination_no.' - '.$rs->destination_name;?></option>
        						 <?php }} ?>
        				    </select> 
                        </div>
                      </div>
                      <input type="hidden" name="destination_from_code" value="">
                      <div class="form-group form-md-line-input">
                        <label class="control-label col-md-5"><?=lang('fare_trip_destination_to')?><span class="text-danger">*</span></label>
                        <div class="col-md-7">
                             <select class="form-control" name="fare_trip_destination_to" id="fare_trip_destination_to" placeholder="<?=lang('select')?>" >	
                                         <option value="" disabled selected><?=lang('select_your_option')?></option>
        								 <?php if (!empty($destination)) {
        								  foreach ($destination as $rs) { ?>
        								  <option value="<?php echo $rs->rowID;?>"><?php echo $rs->destination_no.' - '.$rs->destination_name;?></option>
        								 <?php }} ?>
        				    </select> 
                        </div>
                      </div>
                      <input type="hidden" name="destination_to_code" value="">
                      <input type="hidden" name="fare_trip_no" value="">
        
                    <div class="form-group form-md-line-input">
                        <label class="control-label col-md-5"><?=lang('trip_type')?><span class="text-danger">*</span></label>
                        <div class="col-md-7">
                            <select name="trip_type" id="trip_type" class="form-control">
                        	    <option value="1">BULK</option>
        						<option value="2">CONTAINER</option>
        						<option value="3">OTHERS</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group form-md-line-input"> 
                        <label class="control-label col-md-5"><?=lang('points')?><span class="text-danger">*</span></label>
                        <div class="col-md-3">
                            <input type="text" name="poin" id="poin" value="0" class="form-control" style='text-align:center;' onkeyup="angka(this);" maxlength="5" />
                        </div>
                        <label class="control-label col-md-2">Split</label>
                        <div class="col-md-2">
                            <input type="checkbox" class="form-control" name="split" id="split" value="1" style="width: 35%;" />
                        </div>
                    </div>
                    <div class="form-group form-md-line-input"> 
                        <label class="col-md-5 control-label"><?=lang('komisi_supir')?></label>
                        <div class="col-md-7">
                            <div class="input-group">
                              <span class="input-group-addon" id="basic-addon1">Rp</span>
                              <input type="text" name="komisi_supir" id="komisi_supir" class="form-control currency" style="text-align:right;"/>
                            </div>
                        </div>
                    </div>  
                    <div class="form-group form-md-line-input"> 
                        <label class="col-md-5 control-label"><?=lang('komisi_kernet')?></label>
                        <div class="col-md-7">
                            <div class="input-group">
                              <span class="input-group-addon" id="basic-addon1">Rp</span>
                              <input type="text" name="komisi_kernet" id="komisi_kernet" class="form-control currency" style="text-align:right;" />
                            </div>
                        </div>
                    </div>  
                    <div class="form-group form-md-line-input"> 
                        <label class="col-md-5 control-label"><?=lang('deposit')?></label>
                        <div class="col-md-7">
                            <div class="input-group">
                              <span class="input-group-addon" id="basic-addon1">Rp</span>
                              <input type="text" name="deposit" id="deposit" class="form-control currency" style="text-align:right;" />
                            </div>
                        </div>
                    </div>
                    <div class="form-group form-md-line-input"> 
                        <label class="col-md-5 control-label"><?=lang('min_amount')?></label>
                        <div class="col-md-7">
                            <div class="input-group">
                              <span class="input-group-addon" id="basic-addon1">Rp</span>
                              <input type="text" name="min_amount" id="min_amount" class="form-control currency" style="text-align:right;" />
                            </div>
                        </div>
                    </div>
                    <div class="form-group form-md-line-input"> 
                        <label class="col-md-5 control-label"><?=lang('os_amount')?></label>
                        <div class="col-md-7">
                            <div class="input-group">
                              <span class="input-group-addon" id="basic-addon1">Rp</span>
                              <input type="text" name="os_amount" id="os_amount" class="form-control currency" style="text-align:right;" />
                            </div>
                        </div>
                    </div>  
                </div>
                <div class="col-md-6">
                    <div class="form-group form-md-line-input">
                        <label class="control-label col-md-5">Trip Condition<span class="text-danger">*</span></label>
                        <div class="col-md-7">
                            <select name="trip_condition" id="trip_condition" class="form-control">
                       	        <option value="short distance">Short Distance</option>
                       	        <option value="long distance">Long Distance</option>
                       	        <option value="pok">POK</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group form-md-line-input">
                        <label class="col-md-5 control-label"><?=lang('fare_trip_distance')?> (meters)</label>
                        <div class="col-md-7">
                            <input type="text" class="input-sm form-control" value="" name="fare_trip_distance" id="fare_trip_distance" placeholder="<?=lang('fare_trip_distance')?> (meters)" required>
                        </div>
                        <!--onclick="ambil_data()"-->
                    </div>
                    <div class="form-group form-md-line-input">
                        <label class="control-label col-md-5"><?=lang('vehicle')?><span class="text-danger">*</span></label>
                        <div class="col-md-7">
                            <select name="vehicle_type" id="vehicle_type" class="form-control">
                                 <option value="" disabled selected><?=lang('select_your_option')?></option>
                            	 <?php if (!empty($vehicle_types)) {
                            	  foreach ($vehicle_types as $rs) { ?>
                            	  <option value="<?php echo $rs->rowID;?>"><?php echo $rs->type_cd.' - '.$rs->type_name;?></option>
                            	 <?php }} ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group form-md-line-input">
                        <label class="control-label col-md-5"><?=lang('cost')?><span class="text-danger">*</span></label>
                        <div class="col-md-7">
                            <select name="cost_code" id="cost_code" class="form-control">
                            	 <option value="" disabled selected><?=lang('select_your_option')?></option>
                            	 <?php if (!empty($cost)) {
                            	  foreach ($cost as $rs) { ?>
                            	  <option value="<?php echo $rs->rowID;?>"><?php echo $rs->cost_cd.' - '.$rs->descs;?></option>
                            	 <?php }} ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group form-md-line-input"> 
                        <label class="col-md-5 control-label">Total</label>
                        <div class="col-md-7">
                            <input type="text"  name="Total" id="Total" value="0" readonly="" class="form-control" style='text-align:right;height:30px;width:170px;background-color:white;border:solid 1px #ccc;' />
                        </div>
                    </div>
                    <div class="form-group form-md-line-input"> 
                        <label class="col-md-5 control-label"><?=lang('estimated_time_receipt')?></label>
                        <div class="col-md-7">
                            <div class="input-group">
                              <input type="text" class="form-control angka_ribuan" id="estimated_time_receipt" name="estimated_time_receipt" value="0" required />
                              <span class="input-group-addon" id="basic-addon1">Minutes</span>
                            </div>
                        </div>
                    </div>
                    <div class="form-group form-md-line-input"> 
                        <label class="col-md-5 control-label">Effective Date</label>
                        <div class="col-md-7">
                            <input type="text" class="datepicker-input form-control" id="effective_date" name="effective_date" value="<?=date('d-m-Y')?>"  data-date-format="dd-mm-yyyy" required >
                        </div>
                    </div>
                    <div class="form-group form-md-line-input"> 
                        <label class="col-md-5 control-label"><?=lang('note')?></label>
                        <div class="col-md-7">
                            <textarea class="form-control" id="note" name="note" rows="2"></textarea>
                        </div>
                    </div>
                </div>
            </div>
            <hr />
            <div class="row">
              <label class="col-md-2 control-label"></label>
              <div class="col-md-8">
                  <table cellspacing="0" cellpadding="0" class="table table-responsive table-striped table-condensed b-t b-light text-sm" style="width:100%;"style="width:100%;" id="detail">
                    <thead>
                        <tr valign="middle">
                            <th width="10%">
                                <input id="tamdet" title="Tambah Baris" type="button" onclick="addRow()" value="&nbsp;" style="height:30px;width:30px;border;background-image:url('<?= base_url();?>resource/images/plus.png');background-repeat:no-repeat;" />
                            </th>
                            <th width="45%"><?=lang('reference')?></th>
                            <th width="45%"><?=lang('amount')?></th>
                        </tr>
                    </thead>
                  </table>
              </div>             
            </div>
         </div>  
        </form>
          </div>
          <div class="modal-footer">
            <button type="button" id="btnSave" onclick="save_fare_trip()" class="btn green">Save</button>
            <button type="button" class="btn red" data-dismiss="modal">Cancel</button>
          </div>
        </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
    
    
  <!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog" style="width:1000px;height:30px;">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Modal Header</h4>
        </div>
        <div class="modal-body">
          <section class="scrollable wrapper">
          <div class="row">
            <div class="col-lg-12">
              <section class="panel panel-default">
                <div class="table-responsive"><?php echo validation_errors(); ?>
                  <table id="tbl-projects2" class="table table-striped table-hover b-t b-light text-sm">
                    <thead>
                      <tr>
                        <th><?=lang('fare_trip_code')?> </th>
						<th><?=lang('fare_trip_destination_from')?> </th>
						<th><?=lang('fare_trip_destination_to')?> </th>
                      </tr> 
					</thead>
					<tbody>
                      <?php
                      if (!empty($fare_trips)) {
                      foreach ($fare_trips as $fare_trip) { ?>
                      <tr>
						<td><?=$fare_trip->fare_trip_cd?></td>
						<td><?=$fare_trip->destination_from?></td>
						<td><?=$fare_trip->destination_to?></td>
                    </tr>
                    <?php } } ?>
                  </tbody>
                </table>

              </div>
            </section>            
          </div>
        </div>
      </section>
        
        </div>

      </div>
      
    </div>
  </div>  
  

<div class="modal fade" id="modal_show_detail_direction" role="dialog">
  <div class="modal-dialog" style="width:50%;">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h3 class="modal-title-show-direction">Direction Detail</h3>
      </div>
      <div class="modal-body">
        <div class="row">
            <div class="col-md-12">
                <p id="detail_direction"></p>
                <div id="map" style="width: 100%;height: 400px;background-color: grey;"></div>
            </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn red" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<script language="javascript">
$(document).ready(function(){
   $.getScript("https://maps.googleapis.com/maps/api/js?v=3.exp&key=AIzaSyAGqAXbPVg8hBkOqq5aX3tvh5Doryc-AnY&callback=loadMap", function() {
        // No code here
   });  
});

function showDirectionDetail(start, end){
    if(start == '' && end == ''){
        sweetAlert('<?=lang('information')?>','No data coordinates on this faretrip.');
    }
    else{        
        var origin = '';
        var destination = '';
    
        latlng_origin = start.replace(' ','');
        url_origin = "http://maps.googleapis.com/maps/api/geocode/json?latlng=" + latlng_origin + "&sensor=false";
    
        latlng_destination = end.replace(' ','');
        url_destination = "http://maps.googleapis.com/maps/api/geocode/json?latlng=" + latlng_destination + "&sensor=false";
    
        $.getJSON(url_origin, function (data_origin) {
            if(data_origin.results[0] != null){
                origin = data_origin.results[0].formatted_address;
                        
                $.getJSON(url_destination, function (data_destination) {
                    if(data_destination.results[0] != null){
                        destination = data_destination.results[0].formatted_address;
                        
                        calculateAndDisplayRoute(origin, destination);   
                    }
                });
                
            }
        });
                
    }       
}

function calculateAndDisplayRoute(origin, destination)
{    
    var directionsService = new google.maps.DirectionsService;
    var directionsDisplay = new google.maps.DirectionsRenderer;
    
    $('#detail_direction').html('<b>Origin : </b>' + origin + '<br><b>Destination : </b>' + destination);
   
    directionsService.route({
        origin: origin,
        destination: destination,
        travelMode: 'DRIVING',
        unitSystem: google.maps.UnitSystem.METRIC,
        avoidHighways: false,
        avoidTolls: false
    }, function(response, status) {
      if (status === 'OK') {
        var map = new google.maps.Map(document.getElementById('map'), {
          zoom: 15,
          center: {lat: -6.189014, lng: 106.330447}
        });
        directionsDisplay.setMap(map);
        
        directionsDisplay.setDirections(response);
        $('#modal_show_detail_direction').modal('show');
                    
      } else {
        window.alert('Directions request failed due to ' + status);
      }
    });
    
}

function loadMap() {
  
    var directionsService = new google.maps.DirectionsService;
    var directionsDisplay = new google.maps.DirectionsRenderer;
    var map = new google.maps.Map(document.getElementById('map'), {
      zoom: 15,
      center: {lat: -6.189014, lng: 106.330447}
    });
    directionsDisplay.setMap(map);
    
}

</script>
  
</section>
<a href="#" class="hide nav-off-screen-block" data-toggle="class:nav-off-screen, open" data-target="#nav,html"></a>
</section>