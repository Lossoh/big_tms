<section id="content">
  <section class="hbox stretch">
 
    <!-- .aside -->
    <!--<aside>-->
      <section class="vbox">
        <header class="header bg-white b-b b-light">
            <p class="pull-left"><?=lang('service_history')?></p>
        </header>
        <section class="scrollable wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <?php
                    if(count($all_service_historys) > 0){
                      $data_reminder = '';
                      $no_reminder = 1;
                      foreach ($all_service_historys as $service_history) { 
                        $get_data_spk = $this->service_history_model->get_data_spk_by_complaint_no($service_history->trx_no);
                        
                        $next_service_date = "";                    
                        $next_service = "-"; 
                        $spk_already = FALSE;
                        
                        if($get_data_spk->change_oil == 1){
                            $get_data_service_not_finish = $this->service_history_model->get_data_service_not_finish_by_code($get_data_spk->trx_no);
                            if(count($get_data_service_not_finish) == 0){
                                $get_data_service_finish = $this->service_history_model->get_data_service_finish_by_code($get_data_spk->trx_no);
                            
                                $progress_date = new DateTime($get_data_service_finish->progress_date);
                                $progress_date->modify('next year');
                                $next_service_date = $progress_date->format('d F Y'); 
                                $next_service = number_format($service_history->last_km + 10000,0,',','.').' KM / '. $next_service_date;
                                
                                $spk_already = TRUE;
                            }
                        }
                        else{
                            if(count($get_data_spk) > 0){
                                $get_data_service_not_finish = $this->service_history_model->get_data_service_not_finish_by_code($get_data_spk->trx_no);
                                if(count($get_data_service_not_finish) == 0){
                                    $get_data_service_finish = $this->service_history_model->get_data_service_finish_by_code($get_data_spk->trx_no);
    
                                    $progress_date = new DateTime($get_data_service_finish->progress_date);
                                    $progress_date->modify('next year');
                                    $next_service_date = $progress_date->format('d F Y');
                                    $next_service = $next_service_date;
                                    
                                    $spk_already = TRUE;
                                }
                            }
                        }
                        
                        $date1  = date('Y-m-d'); 
                        $date2  = date('Y-m-d',strtotime($next_service_date)); 
                        $diff   = round(abs(strtotime($date2)-strtotime($date1))/86400);
                        if($diff <= 7){
                            if($diff == 1){
                               $days_txt = 'day'; 
                            }
                            else{
                               $days_txt = 'days';  
                            }
                            
                            $data_reminder .= $no_reminder.'. '.$service_history->police_no.' in '.$diff.' '.$days_txt.' left</br>';
                            $no_reminder++;
                        }
                      }
                      
                      if($data_reminder != ''){
                    ?>
                        <div class="alert alert-info alert-dismissible" role="alert">
                          <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                          <strong>Service time reminders for :</strong><br />
                          <?=$data_reminder?>
                        </div> 
                    <?php
                      }
                    }
                    ?>
                </div>
            </div>
            <div class="row">
                <?=form_open(base_url().'service_history/set_filter','autocomplete="off" id="form_period" class="form-horizontal"')?>
                <div class="col-lg-2" style="padding-right: 5px;">
                    <select name="vehicle_id" id="vehicle_id" class="form-control input-sm" onchange="visible_add_service_history()">
                        <option value=''><?=lang('select_your_option')?></option>
                        <?php
                            if (!empty($vehicles)) {
                                foreach($vehicles as $vehicle) {
                    		      echo '<option value="'.$vehicle->rowID.'">'.$vehicle->police_no.'</option>';
                                }
                            }
                        ?>
                    </select>
                </div>
                <div class="col-lg-8" style="padding-left: 0px;">
                    <button type="submit" class="btn btn-sm btn-info"><i class="fa fa-search"></i> Search</button> &nbsp;
                    <?php
                    if($this->user_profile->get_user_access('Created') == 1){
                        if(!empty($vehicle_id)){
                    ?>
                            <a class="btn btn-sm green" id="btnAddSH" onclick="add_service_history()"><i class="fa fa-plus"></i> <?=lang('new_service_history')?></a>
                    <?php
                            if($this->user_profile->get_user_access('PrintLimited') == 1 || $this->user_profile->get_user_access('PrintUnlimited') == 1 || 
                                $this->user_profile->get_user_access('PrintOne') == 1 || $this->user_profile->get_user_access('PrintTwo') == 1){
                    ?>
                                <a  class="btn btn-sm red" onclick="service_history_pdf()"><i class="fa fa-file-pdf-o"></i> Print PDF</a>
                                <a  class="btn btn-sm btn-success" onclick="service_history_excel()"><i class="fa fa-file-excel-o"></i> Print Excel</a>
                    <?php
                            }
                        }
                    }
                    ?>
                </div>
                <?=form_close()?>
                <script>
                    $(function(){
                        $('#vehicle_id').val('<?=$vehicle_id?>');
                    })
                </script>
            </div>
            <br />
          <div class="row">
            <div class="col-lg-12">
              <section class="panel panel-default">
                <div class="table-responsive"><?php echo validation_errors(); ?>
                  <table id="tbl-orders" class="table table-striped table-hover b-t b-light text-sm">
                    <thead>
                      <tr>
                        <th width="10%"><?=lang('options')?></th>
                        <th><?=lang('complaint_no')?> </th>
						<th><?=lang('complaint').' '.lang('date')?> </th>
						<th><?=lang('type')?> </th>
						<th><?=lang('last_km')?> </th>
						<th><?=lang('driver_name')?> </th>
						<th><?=lang('complaint')?></th>
						<th><?=lang('next_service_date')?></th>
                      </tr> 
                    </thead> 
                    <tbody>
                    <?php
                    if (!empty($service_historys)) {
                      foreach ($service_historys as $service_history) { 
                        $get_data_spk = $this->service_history_model->get_data_spk_by_complaint_no($service_history->trx_no);
                        
                        $next_service_date = "";                    
                        $next_service = "-"; 
                        $spk_already = FALSE;
                        
                        if($get_data_spk->change_oil == 1){
                            $get_data_service_not_finish = $this->service_history_model->get_data_service_not_finish_by_code($get_data_spk->trx_no);
                            if(count($get_data_service_not_finish) == 0){
                                $get_data_service_finish = $this->service_history_model->get_data_service_finish_by_code($get_data_spk->trx_no);
                            
                                $progress_date = new DateTime($get_data_service_finish->progress_date);
                                $progress_date->modify('next year');
                                $next_service_date = $progress_date->format('d F Y'); 
                                $next_service = number_format($service_history->last_km + 10000,0,',','.').' KM / '. $next_service_date;
                                
                                $spk_already = TRUE;
                            }
                        }
                        else{
                            if(count($get_data_spk) > 0){
                                $get_data_service_not_finish = $this->service_history_model->get_data_service_not_finish_by_code($get_data_spk->trx_no);
                                if(count($get_data_service_not_finish) == 0){
                                    $get_data_service_finish = $this->service_history_model->get_data_service_finish_by_code($get_data_spk->trx_no);
    
                                    $progress_date = new DateTime($get_data_service_finish->progress_date);
                                    $progress_date->modify('next year');
                                    $next_service_date = $progress_date->format('d F Y');
                                    $next_service = $next_service_date;
                                    
                                    $spk_already = TRUE;
                                }
                            }
                        }
                        
                    ?>
                      <tr>
                        <td align="center">
						  <div class="btn-group">
							<button class="btn btn-xs btn-default dropdown-toggle" data-toggle="dropdown">
							 <?=lang('options')?>
							<span class="caret"></span>
							</button>
							<ul class="dropdown-menu">
                                <?php
                                if($this->user_profile->get_user_access('Updated') == 1){
                                ?>
								    <li><a  href="javascript:void()" title="<?=lang('update_option')?> Complaint" onclick="edit_service_history(<?=$service_history->rowID ?>)"><i class="fa fa-edit"></i> <?=lang('update_option')?> Complaint</a></li>
                                <?php
                                }
                                if(count($get_data_spk) > 0){
                                    if($spk_already == true){
                                        if($this->user_profile->get_user_access('Created') == 1){
                                ?>
    							            <li><a  href="javascript:void()" title="Jobs Return" onclick="jobs_return(<?=$service_history->rowID ?>)"><i class="fa fa-refresh"></i> Jobs Return</a></li>
				                <?php
                                        }
                                            
                                        if($this->user_profile->get_user_access('PrintLimited') == 1 || $this->user_profile->get_user_access('PrintUnlimited') == 1 || 
                                            $this->user_profile->get_user_access('PrintOne') == 1 || $this->user_profile->get_user_access('PrintTwo') == 1){    
                                                if($this->user_profile->get_user_access('PrintLimited') == 1){
                                                    if($this->user_profile->get_log_limited_printed($get_data_spk->trx_no,'Service History') == 0){
                                ?>
                                                       <li><a  href="javascript:void()" title="Print Service Invoice" onclick="print_service_invoice('<?=$get_data_spk->trx_no ?>')"><i class="fa fa-print"></i> Print Service Invoice</a></li>
                                <?php
                                                    }
                                                }
                                                else{
                                ?>
                                                    <li><a  href="javascript:void()" title="Print Service Invoice" onclick="print_service_invoice('<?=$get_data_spk->trx_no ?>')"><i class="fa fa-print"></i> Print Service Invoice</a></li>
                                <?php
                                                }
                                        }
                                    }
                                    else{     
                                        if($this->user_profile->get_user_access('Updated') == 1){
                                ?>
                                            <li><a  href="javascript:void()" title="<?=lang('update_spk')?>" onclick="create_spk_service(<?=$service_history->rowID ?>)"><?='<i class="fa fa-edit"></i> '.lang('update_spk')?></a></li>
                                <?php
                                        }
                                            
                                        if($this->user_profile->get_user_access('Updated') == 1){
                                ?>
                                           <li><a  href="javascript:void()" title="<?=lang('progress_spk')?>" onclick="progress_spk_service(<?=$service_history->rowID ?>)"><i class="fa fa-check-square-o"></i> <?=lang('progress_spk')?></a></li>
                                <?php
                                        }
                                    }
                                    
                                    if($this->user_profile->get_user_access('PrintLimited') == 1 || $this->user_profile->get_user_access('PrintUnlimited') == 1 || 
                                        $this->user_profile->get_user_access('PrintOne') == 1 || $this->user_profile->get_user_access('PrintTwo') == 1){
                                            if($this->user_profile->get_user_access('PrintLimited') == 1){
                                                if($this->user_profile->get_log_limited_printed($get_data_spk->trx_no,'Service History') == 0){
                                ?>
                                                   <li><a  href="javascript:void()" title="<?=lang('print_progress_spk')?>" onclick="print_progress_spk_service('<?=$get_data_spk->trx_no ?>')"><i class="fa fa-print"></i> <?=lang('print_progress_spk')?></a></li>
                                <?php
                                                }
                                            }
                                            else{
                                ?>
					                           <li><a  href="javascript:void()" title="<?=lang('print_progress_spk')?>" onclick="print_progress_spk_service('<?=$get_data_spk->trx_no ?>')"><i class="fa fa-print"></i> <?=lang('print_progress_spk')?></a></li>
                                <?php
                                            }
                                    }
                                }
                                else{
                                    if($this->user_profile->get_user_access('Created') == 1){
                                ?>
                                        <li><a  href="javascript:void()" title="<?=lang('create_spk')?>" onclick="create_spk_service(<?=$service_history->rowID ?>)"><?='<i class="fa fa-plus"></i> '.lang('create_spk')?></a></li>
                                <?php
                                    }
                                }
                                if($this->user_profile->get_user_access('Deleted') == 1){
                                ?>
                                    <li><a  href="javascript:void()" title="<?=lang('delete_option')?> Complaint" onclick="delete_service_history(<?=$service_history->rowID ?>)"><i class="fa fa-trash-o"></i> <?=lang('delete_option')?> Complaint</a></li>
                                <?php
                                }
                                ?>
							</ul>
                            
						  </div>
						</td>
						<td><?=$service_history->trx_no?></td>
						<td><?=date("d F Y",strtotime($service_history->trx_date))?></td>
						<td><?=$service_history->type?></td>
						<td><?=number_format($service_history->last_km,0,',','.')?></td>
						<td><?=$service_history->debtor_name?></td>
						<td>
                            <?php
                            $get_data_complaint = $this->service_history_model->get_data_detail_by_trx_no($service_history->trx_no);
                            if(count($get_data_complaint) > 0){
                                $no = 1;
                                foreach($get_data_complaint as $row){
                                    echo $no++.'. '.$row->complaint_note.'<br>';
                                }
                            }
                            else{
                                echo '-';
                            }
                            ?>
                        </td>
						<td><?=$next_service?></td>
                    </tr>
                    <?php 
                        } 
                    } 
                    ?>
                    
                  </tbody>
                </table>

              </div>
            </section>            
          </div>
        </div>
      </section>

    </section>
  <!--</aside>-->
  
<!-- Bootstrap modal -->
<div class="modal fade" id="modal_form" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h3 class="modal-title"><?=lang('new_service_history')?></h3>
      </div>
      <div class="modal-body form">
        <?=form_open('','autocomplete="off" id="form" class="form-horizontal"')?>
        <input type="hidden" name="rowID" value="">
        <input type="hidden" name="vehicle_rowID" value="">
        <input type="hidden" id="user_created" name="user_created"/>
        <input type="hidden" id="date_created" name="date_created"/>
        <input type="hidden" id="time_created" name="time_created"/>
        
        <div class="form-group form-md-line-input">
            <label class="col-lg-4 control-label"><?=lang('complaint').' '.lang('date')?><span class="text-danger">*</span></label>
            <div class="col-lg-3">
                <input type="text" class="form-control input-sm tanggal_datetimepicker" value="<?=date('d-m-Y')?>" name="trx_date" id="trx_date" style="text-align: center;" placeholder="dd-mm-YYYY" required>
            </div>
        </div>
        <div class="form-group form-md-line-input">
            <label class="col-lg-4 control-label"><?=lang('type')?><span class="text-danger">*</span></label>
            <div class="col-lg-5">
                <select class="form-control input-sm" name="type" id="type" >
                    <option value="Check">Check</option>
                    <option value="Regular">Regular</option>
                    <option value="Urgent">Urgent</option>
                </select>
            </div>
        </div>        
        <div class="form-group form-md-line-input">
            <label class="col-lg-4 control-label"><?=lang('last_km')?><span class="text-danger">*</span></label>
            <div class="col-lg-5">
                <input type="text" class="form-control input-sm angka_jutaan" name="last_km" id="last_km" placeholder="<?=lang('last_km')?>" value="0" required>
            </div>
        </div>        
        <div class="form-group form-md-line-input">
            <label class="col-lg-4 control-label"><?=lang('driver_name')?><span class="text-danger">*</span></label>
            <div class="col-lg-5">
                <select class="form-control input-sm" name="debtor_rowID" id="debtor_rowID" >
                    <option value=''><?=lang('select_your_option')?></option>
                    <?php
                        if (!empty($drivers)) {
                            foreach($drivers as $driver) {
                		      echo '<option value="'.$driver->rowID.'">'.$driver->debtor_name.'</option>';
                            }
                        }
                    ?>
                </select>
            </div>
        </div>
        <p>&nbsp;</p>
        <div class="bs-example"> 
            <table class="table table-responsive" cellspacing="0" cellpadding="3" id="detail_complaint">
                <tr valign="middle">
                    <th width="5%">
                        <input id="tamdet" title="Add Row" type="button" onclick="add_complaint()" value="&nbsp;" style="height:30px;width:30px;border;background-image:url('<?= base_url();?>resource/images/plus.png');background-repeat:no-repeat;" />
                    </th>
                    <th><?=lang('complaint')?></th>
                </tr>
            </table>
        </div>         
              
          <?=form_close()?>
       </div>
       <div class="modal-footer">
            <button type="button" id="btnSave" onclick="save_service_history()" class="btn green">Save</button>
            <button type="button" class="btn red" data-dismiss="modal">Cancel</button>
       </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<select class="form-control input-sm" name="services" id="services">
    <option value=""><?=lang('select_your_option')?></option>
    <?php
    foreach($services as $service){
        echo '<option value="'.$service->code.'">'.$service->name.'</option>';
    }
    ?>
</select>

<select class="form-control input-sm" name="part_materials" id="part_materials">
    <option value=""><?=lang('select_your_option')?></option>
    <?php
    foreach($part_materials as $part_material){
        echo '<option value="'.$part_material->code.'">'.$part_material->name.'</option>';
    }
    ?>
</select>

<select class="form-control input-sm" name="mechanics" id="mechanics">
    <option value=""><?=lang('select_your_option')?></option>
    <?php
    foreach($mechanics as $mechanic){
        echo '<option value="'.$mechanic->rowID.'">'.$mechanic->debtor_name.'</option>';
    }
    ?>
</select>


<select class="form-control input-sm" name="service_status" id="service_status">
    <option value="Progress">Progress</option>
    <option value="Pending">Pending</option>
    <option value="Finish">Finish</option>
    <option value="Cancel">Cancel</option>
</select>

<div class="modal fade" id="modal_form_spk" role="dialog">
  <div class="modal-dialog" style="width: 60%;">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h3 class="modal-title-spk"><?=lang('create_spk')?></h3>
      </div>
      <div class="modal-body form">
        <?=form_open('','autocomplete="off" id="form_spk" class="form-horizontal"')?>
        <input type="hidden" name="complaint_rowID" value="">
        <input type="hidden" id="spk_user_created" name="spk_user_created"/>
        <input type="hidden" id="spk_date_created" name="spk_date_created"/>
        <input type="hidden" id="spk_time_created" name="spk_time_created"/>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group form-md-line-input" id="spk_no_field">
                    <label class="col-lg-5 control-label"><?=lang('spk_no')?><span class="text-danger">*</span></label>
                    <div class="col-lg-5">
                        <input type="text" class="form-control input-sm" value="" name="trx_no" id="trx_no" readonly="" required="" />
                    </div>
                </div>
                <div class="form-group form-md-line-input">
                    <label class="col-lg-5 control-label"><?=lang('complaint_no')?><span class="text-danger">*</span></label>
                    <div class="col-lg-5">
                        <input type="text" class="form-control input-sm" value="" name="complaint_no_spk" id="complaint_no_spk" readonly="" required="" />
                    </div>
                </div>
                <div class="form-group form-md-line-input">
                    <label class="col-lg-5 control-label"><?=lang('complaint').' '.lang('date')?><span class="text-danger">*</span></label>
                    <div class="col-lg-5">
                        <input type="text" class="form-control input-sm" value="" name="trx_date_spk" id="trx_date_spk" style="text-align: center;" readonly="" required />
                    </div>
                </div>
                <div class="form-group form-md-line-input">
                    <label class="col-lg-5 control-label"><?=lang('type')?><span class="text-danger">*</span></label>
                    <div class="col-lg-5">
                        <input type="text" class="form-control input-sm" value="" name="type_spk" id="type_spk" readonly="" required="" />
                    </div>
                </div>        
                <div class="form-group form-md-line-input">
                    <label class="col-lg-5 control-label"><?=lang('last_km')?><span class="text-danger">*</span></label>
                    <div class="col-lg-5">
                        <input type="text" class="form-control input-sm" name="last_km_spk" id="last_km_spk" value="0" readonly="" required="" />
                    </div>
                </div>
                <div class="form-group form-md-line-input">
                    <label class="col-lg-5 control-label"><?=lang('driver_name')?><span class="text-danger">*</span></label>
                    <div class="col-lg-5">
                        <input type="text" class="form-control input-sm" name="debtor_name_spk" id="debtor_name_spk" readonly="" required="" />
                    </div>
                </div>
                <div class="form-group form-md-line-input">
                    <label class="col-lg-5 control-label"><?=lang('type_work_list')?><span class="text-danger">*</span></label>
                    <div class="col-lg-5">
                        <select class="form-control input-sm" name="type_work_list" id="type_work_list" >
                            <option value="Unit">Unit</option>
                            <option value="Template">Template</option>
                        </select>
                    </div>
                </div>
                <div class="form-group form-md-line-input" id="template">
                    <label class="col-lg-5 control-label"><?=lang('template_service')?><span class="text-danger">*</span></label>
                    <div class="col-lg-5">
                        <select class="form-control input-sm all_select2" name="template_service_code" id="template_service_code" onchange="show_data_template_service()" >
                            <option value=''><?=lang('select_your_option')?></option>
                            <?php
                                if (!empty($templates)) {
                                    foreach($templates as $template) {
                                        echo '<option value="'.$template->code.'">'.$template->name.'</option>';
                                    }
                                }
                            ?>
                        </select>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group form-md-line-input">
                    <label class="col-lg-5 control-label"><?=lang('change_oil')?></label>
                    <div class="col-lg-5">
                        <input type="checkbox" class="form-control input-sm" name="change_oil" id="change_oil" value="1" style="width: 25px;" />
                    </div>
                </div>
                <div class="form-group form-md-line-input">
                    <label class="col-lg-5 control-label"><?=lang('cost_of_service')?><span class="text-danger">*</span></label>
                    <div class="col-lg-5">
                        <input type="text" class="form-control input-sm angka_jutaan" name="cost_service" id="cost_service" value="0" style="text-align: right;" onkeyup="sumTotalSPK();" readonly="" required="" />
                    </div>
                </div>
                <div class="form-group form-md-line-input">
                    <label class="col-lg-5 control-label"><?=lang('cost_of_part')?><span class="text-danger">*</span></label>
                    <div class="col-lg-5">
                        <input type="text" class="form-control input-sm angka_jutaan" name="cost_part" id="cost_part" value="0" style="text-align: right;" onkeyup="sumTotalSPK();" readonly="" required="" />
                    </div>
                </div>
                <div class="form-group form-md-line-input">
                    <label class="col-lg-5 control-label"><?=lang('cost_of_labour')?><span class="text-danger">*</span></label>
                    <div class="col-lg-5">
                        <input type="text" class="form-control input-sm angka_jutaan" name="cost_labour" id="cost_labour" value="0" style="text-align: right;" onkeyup="sumTotalSPK();" required="" />
                    </div>
                </div>
                <div class="form-group form-md-line-input">
                    <label class="col-lg-5 control-label"><?=lang('cost_of_others')?><span class="text-danger">*</span></label>
                    <div class="col-lg-5">
                        <input type="text" class="form-control input-sm angka_jutaan" name="cost_other" id="cost_other" value="0" style="text-align: right;" onkeyup="sumTotalSPK();" required="" />
                    </div>
                </div>
                <div class="form-group form-md-line-input">
                    <label class="col-lg-5 control-label"><?=lang('cost_total')?><span class="text-danger">*</span></label>
                    <div class="col-lg-5">
                        <input type="text" class="form-control input-sm angka_jutaan" name="cost_total" id="cost_total" value="0" style="text-align: right;" onkeyup="sumTotalSPK();" readonly="" required="" />
                    </div>
                </div>
            </div>
        </div>
        <p>&nbsp;</p>
        <ul class="nav nav-tabs" role="tablist">
            <li role="presentation" class="active"><a href="#work_list" aria-controls="work_list" role="tab" data-toggle="tab"><?=lang('work_list')?></a></li>
            <li role="presentation"><a href="#part_material" aria-controls="part_material" role="tab" data-toggle="tab"><?=lang('part_material')?></a></li>
            <li role="presentation"><a href="#mechanic_list" aria-controls="mechanic_list" role="tab" data-toggle="tab"><?=lang('mechanic_list')?></a></li>
        </ul>
        <div class="tab-content">
            <div role="tabpanel" class="tab-pane fade in active" id="work_list">
                <div class="bs-example"> 
                    <table class="table table-responsive" cellspacing="0" cellpadding="3" id="detail_template_service">
                        <tr valign="middle">
                            <th width="5%">
                                <input id="tamdet" title="Add Row" type="button" onclick="add_template_service_spk()" value="&nbsp;" style="height:30px;width:30px;border;background-image:url('<?= base_url();?>resource/images/plus.png');background-repeat:no-repeat;" />
                            </th>
                            <th width="40%"><?=lang('job_description')?></th>
                            <th width="25%"><?=lang('work_hours')?></th>
                            <th width="30%"><?=lang('flat_rate')?></th>
                        </tr>
                    </table>
                </div>         
            </div>
            <div role="tabpanel" class="tab-pane fade in" id="part_material">
                <div class="bs-example"> 
                    <table class="table table-responsive" cellspacing="0" cellpadding="3" id="detail_part_material">
                        <tr valign="middle">
                            <th width="5%">
                                <input id="tamdet" title="Add Row" type="button" onclick="add_part_material()" value="&nbsp;" style="height:30px;width:30px;border;background-image:url('<?= base_url();?>resource/images/plus.png');background-repeat:no-repeat;" />
                            </th>
                            <th width="45%"><?=lang('part_material')?> Name</th>
                            <th width="20%"><?=lang('qty')?></th>
                            <th width="30%"><?=lang('price')?></th>
                        </tr>
                    </table>
                </div>         
            </div>
            <div role="tabpanel" class="tab-pane fade in" id="mechanic_list">
                <div class="bs-example"> 
                    <table class="table table-responsive" cellspacing="0" cellpadding="3" id="detail_mechanic_list">
                        <tr valign="middle">
                            <th width="5%">
                                <input id="tamdet" title="Add Row" type="button" onclick="add_mechanic_list()" value="&nbsp;" style="height:30px;width:30px;border;background-image:url('<?= base_url();?>resource/images/plus.png');background-repeat:no-repeat;" />
                            </th>
                            <th width="95%"><?=lang('mechanic_name')?></th>
                        </tr>
                    </table>
                </div>         
            </div>
        </div>

       <?=form_close()?>
       </div>
       <div class="modal-footer">
            <button type="button" id="btnSave" onclick="save_spk_service_history()" class="btn green">Save</button>
            <button type="button" class="btn red" data-dismiss="modal">Cancel</button>
       </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->


<div class="modal fade" id="modal_form_progress_spk" role="dialog">
  <div class="modal-dialog" style="width: 60%;">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h3 class="modal-title-progress-spk"><?=lang('progress_spk')?></h3>
      </div>
      <div class="modal-body form">
        <?=form_open('','autocomplete="off" id="form_progress_spk" class="form-horizontal"')?>
        <div class="row">
            <div class="col-md-12">
                <div class="form-group form-md-line-input">
                    <label class="col-lg-2 control-label"><?=lang('spk_no')?><span class="text-danger">*</span></label>
                    <div class="col-lg-3">
                        <input type="text" class="form-control input-sm" value="" name="spk_no" id="spk_no" readonly="" required="" />
                    </div>
                    <label class="col-lg-2 control-label"><?=lang('police_no')?><span class="text-danger">*</span></label>
                    <div class="col-lg-3">
                        <input type="text" class="form-control input-sm" value="" name="police_no" id="police_no" readonly="" required="" />
                    </div>
                </div>
            </div>
        </div>
        
        <table class="table table-responsive table-stripped" cellspacing="0" cellpadding="3" id="detail_work_list">
            <tr>
                <th width="5%" style="text-align: center;">No</th>
                <th width="33%" style="text-align: center;"><?=lang('job_description')?></th>
                <th width="17%" style="text-align: center;"><?=lang('date')?></th>
                <th width="14%" style="text-align: center;"><?=lang('start_hours')?></th>
                <th width="14%" style="text-align: center;"><?=lang('end_hours')?></th>
                <th width="17%" style="text-align: center;"><?=lang('status')?></th>
            </tr>
        </table>
            
       <?=form_close()?>
       </div>
       <div class="modal-footer">
            <button type="button" id="btnSave" onclick="save_progress_spk_service_history()" class="btn green">Save</button>
            <button type="button" class="btn red" data-dismiss="modal">Cancel</button>
       </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

</section>
<a href="#" class="hide nav-off-screen-block" data-toggle="class:nav-off-screen, open" data-target="#nav,html"></a>
</section>