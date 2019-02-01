<section id="content">
  <section class="hbox stretch">
 
    <!-- .aside -->
    <!--<aside>-->
      <section class="vbox">
        <header class="header bg-white b-b b-light">
            <div class="pull-right" style="margin-top: 10px;">
              <button type="button" class="btn btn-sm btn-dark btn_cleartable" onclick="location.replace('<?=base_url()?>planning_order');//history.back();"><i class="fa fa-arrow-left"></i> BACK</button>
            </div>
            <p class="pull-left"><?=lang('edit_planning_order').' - '.$get_data->trx_no?></p>
        </header>
        <section class="scrollable wrapper">
          <div class="row">
            <div class="col-lg-12">
              <div class="panel panel-default">
                <div class="panel-body">
                    <?=form_open(base_url().'planning_order/update','autocomplete="off" id="form" class="form-horizontal"')?>
                    <input type="hidden" name="trx_no" id="trx_no" value="<?=$get_data->trx_no?>" />
                    <input type="hidden" id="user_created" name="user_created" value="<?=$get_data->user_created?>" />
                    <input type="hidden" id="date_created" name="date_created" value="<?=$get_data->date_created?>" />
                    <input type="hidden" id="time_created" name="time_created" value="<?=$get_data->time_created?>" />
                    
                    <div class="form-group form-md-line-input">
                        <label class="col-lg-2 control-label"><?=lang('planning_order').' '.lang('date')?><span class="text-danger">*</span></label>
                        <div class="col-lg-2">
                            <input type="text" class="form-control tanggal_datetimepicker" name="trx_date" id="trx_date" placeholder="dd-mm-YYYY" value="<?=date('d-m-Y',strtotime($get_data->trx_date))?>" style="text-align: center;" required="" />
                        </div>
                        <label class="col-lg-5 control-label"><?=lang('job_order_no')?><span class="text-danger">*</span></label>
                        <div class="col-lg-3">
                            <select name="jo_no" id="jo_no" class="form-control all_select2" onchange="show_edit_planning_order_detail()" required="">
            				    <option value=""><?=lang('select_your_option')?></option>
                                <?php
                                if (!empty($job_orders)) {
                                    foreach ($job_orders as $job_order) { 
                                        $check_jo = $this->planning_order_model->check_po_by_jo($job_order->jo_no, $get_data->trx_date);
                                        if($get_data->jo_no == $job_order->jo_no){
                                ?>
            					           <option value="<?php echo $job_order->jo_no; ?>"><?php echo $job_order->jo_no; ?></option>
            					<?php                                             
                                        }
                                        else if(count($check_jo) == 0 && $job_order->status != 2){
                                ?>
            					           <option value="<?php echo $job_order->jo_no; ?>"><?php echo $job_order->jo_no; ?></option>
            					<?php 
                                        }
                                    }
                                }
                                ?>
                			</select>
                            
                        </div>
                    </div>
                    <div class="form-group form-md-line-input row">
                        <label class="col-lg-2 control-label"><?=lang('vessel_name')?></label>
                        <div class="col-lg-2"><div id="desc_vessel" style="padding-top: 7px;"><?=$jo_detail->vessel_no.' - '.$jo_detail->vessel_name?></div></div>
                        <label class="col-lg-2 control-label"><?=lang('job_order_po_spk_no')?></label>
                        <div class="col-lg-2"><div id="desc_po_spk_no" style="padding-top: 7px;"><?=$jo_detail->po_spk_no?></div></div>
                        <label class="col-lg-2 control-label"><?=lang('job_order_so_no')?></label>
                        <div class="col-lg-2"><div id="desc_so_no" style="padding-top: 7px;"><?=$jo_detail->so_no?></div></div>
                    </div>
                    <div class="form-group form-md-line-input row">
                        <label class="col-lg-2 control-label"><?=lang('port_name')?></label>
                        <div class="col-lg-2"><div id="desc_port_name" style="padding-top: 7px;"><?=$jo_detail->port_name?></div></div>
                        <label class="col-lg-2 control-label"><?=lang('destination')?></label>
                        <div class="col-lg-2"><div id="desc_destination" style="padding-top: 7px;"><?=$jo_detail->from_name.' - '.$jo_detail->to_name?></div></div>
                    </div>
                    <br />
                    <div class="form-group form-md-line-input">
                        <div class="col-lg-12">
                            <div id="planning_order_detail">
                                <table class="table table-striped text-sm" width="100%">
                                    <tr>
                                        <th width="5%"><?=lang('no')?></th>
                                        <th width="12%"><?=lang('police_no')?></th>
                                        <th width="9%"><?=lang('ritase')?></th>
                                        <th width="20%"><?=lang('remark')?></th>
                                        <th><?=lang('information')?></th>
                                    </tr>
                                    <?php
                                    if(!empty($vehicles)){
                                        $no = 1;
                                        foreach($vehicles as $vehicle){
                                            $check_condition = $this->planning_order_model->check_condition($vehicle->rowID);
                                            $check_po = $this->planning_order_model->check_po_by_vehicle($vehicle->rowID,$get_data->trx_date);
                                            $get_data_detail = $this->planning_order_model->check_edit_po_by_vehicle($get_data->trx_no,$get_data->jo_no,$vehicle->rowID,$get_data->trx_date);
                                
                                            if(count($check_condition) > 0){
                                                if($check_condition->condition == lang('layak_jalan') && count($check_po) == 0){
                                    ?>
                                                    <tr>
                                                        <td><?=$no?></td>
                                                        <td><input type="hidden" name="vehicle_rowID[]" value="<?=$vehicle->rowID?>" /><input type="text" class="form-control input-sm" name="police_no[]" value="<?=$vehicle->police_no?>" readonly="" /></td>
                                                        <td><input type="text" class="form-control input-sm" name="ritase[]" placeholder="<?=lang('ritase')?>" value="0" maxlength="5" onkeyup="angka(this);" /></td>
                                                        <td><input type="text" class="form-control input-sm" name="remark[]" placeholder="<?=lang('remark')?>" value="" maxlength="150" /></td>
                                                        <td>-</td>
                                                    </tr>
                                    <?php
                                                }
                                                else if(count($check_po) > 0){
                                                    $ritase = 0;
                                                    $info_jo = '';
                                                    $i = 1;
                                                    $show = true;
                                                    foreach($check_po as $row_po){
                                                        $ritase += $row_po->ritase;
                                                        $info_jo .= '<br>'.$i.'. JO No : <b>'.$row_po->jo_no.'</b>, Vessel Name : '.$row_po->vessel_name.', Destination : '.$row_po->from_name.' - '.$row_po->to_name;
                                                        
                                                        if($show == true){
                                                            if($get_data->jo_no == $row_po->jo_no){
                                                                $show = false;
                                                            }
                                                        }
                                                        $i++;
                                                    }
                                                    
                                                    if($show == true){
                                    ?>
                                                        <tr>
                                                            <td><?=$no?></td>
                                                            <td><input type="hidden" name="vehicle_rowID[]" value="<?=$vehicle->rowID?>" /><input type="text" class="form-control input-sm" name="police_no[]" value="<?=$vehicle->police_no?>" readonly="" /></td>
                                                            <td><input type="text" class="form-control input-sm" name="ritase[]" placeholder="<?=lang('ritase')?>" value="0" maxlength="5" onkeyup="angka(this);" /></td>
                                                            <td><input type="text" class="form-control input-sm" name="remark[]" placeholder="<?=lang('remark')?>" value="" maxlength="150" /></td>
                                                            <td align="justify">
                                                                Ritase : <b><?=number_format($ritase,0,',','.')?></b>
                                                                <?=$info_jo?>
                                                            </td>
                                                        </tr>
                                    <?php
                                                    }
                                                    else{
                                                        if(count($get_data_detail) > 0){
                                    ?>
                                                            <tr>
                                                                <td><?=$no?></td>
                                                                <td><input type="hidden" name="vehicle_rowID[]" value="<?=$vehicle->rowID?>" /><input type="text" class="form-control input-sm" name="police_no[]" value="<?=$vehicle->police_no?>" readonly="" /></td>
                                                                <td><input type="text" class="form-control input-sm" name="ritase[]" placeholder="<?=lang('ritase')?>" value="<?=$get_data_detail->ritase?>" maxlength="5" onkeyup="angka(this);" /></td>
                                                                <td><input type="text" class="form-control input-sm" name="remark[]" placeholder="<?=lang('remark')?>" value="<?=$get_data_detail->remark?>" maxlength="150" /></td>
                                                                <td align="justify">
                                                                    Ritase : <b><?=number_format($ritase,0,',','.')?></b>
                                                                    <?=$info_jo?>
                                                                </td>
                                                            </tr>
                                    <?php                            
                                                        }
                                                        else{
                                                            if(date('N',strtotime(date('d-m-Y'))) == 1){
                                    ?>
                                                                <tr>
                                                                    <td><?=$no?></td>
                                                                    <td><input type="hidden" name="vehicle_rowID[]" value="<?=$vehicle->rowID?>" /><input type="text" class="form-control input-sm" name="police_no[]" value="<?=$vehicle->police_no?>" readonly="" /></td>
                                                                    <td><input type="text" class="form-control input-sm" name="ritase[]" placeholder="<?=lang('ritase')?>" value="0" maxlength="5" onkeyup="angka(this);" /></td>
                                                                    <td><input type="text" class="form-control input-sm" name="remark[]" placeholder="<?=lang('remark')?>" value="" maxlength="150" /></td>
                                                                    <td align="justify">
                                                                        Ritase : <b><?=number_format($ritase,0,',','.')?></b>
                                                                        <?=$info_jo?>
                                                                    </td>
                                                                </tr>
                                    <?php
                                                            }
                                                            else{
                                    ?>
                                                                <tr>
                                                                    <td><?=$no?></td>
                                                                    <td><?=$vehicle->police_no?></td>
                                                                    <td>-</td>
                                                                    <td>-</td>
                                                                    <td align="justify">
                                                                        Ritase : <b><?=number_format($ritase,0,',','.')?></b>
                                                                        <?=$info_jo?>
                                                                    </td>
                                                                </tr>
                                    <?php
                                                            }
                                                        }
                                                    }
                                                }
                                                else{
                                                    if(date('N',strtotime(date('d-m-Y'))) == 1){
                                    ?>
                                                        <tr>
                                                            <td><?=$no?></td>
                                                            <td><input type="hidden" name="vehicle_rowID[]" value="<?=$vehicle->rowID?>" /><input type="text" class="form-control input-sm" name="police_no[]" value="<?=$vehicle->police_no?>" readonly="" /></td>
                                                            <td><input type="text" class="form-control input-sm" name="ritase[]" placeholder="<?=lang('ritase')?>" value="0" maxlength="5" onkeyup="angka(this);" /></td>
                                                            <td><input type="text" class="form-control input-sm" name="remark[]" placeholder="<?=lang('remark')?>" value="" maxlength="150" /></td>
                                                            <td><?=$check_condition->condition?></td>
                                                        </tr>
                                    <?php
                                                    }
                                                    else{
                                    ?>
                                                        <tr>
                                                            <td><?=$no?></td>
                                                            <td><?=$vehicle->police_no?></td>
                                                            <td>-</td>
                                                            <td>-</td>
                                                            <td><?=$check_condition->condition?></td>
                                                        </tr>
                                    <?php
                                                    }
                                                }
                                            }
                                            else{
                                                if(count($check_po) == 0){
                                    ?>
                                                    <tr>
                                                        <td><?=$no?></td>
                                                        <td><input type="hidden" name="vehicle_rowID[]" value="<?=$vehicle->rowID?>" /><input type="text" class="form-control input-sm" name="police_no[]" value="<?=$vehicle->police_no?>" readonly="" /></td>
                                                        <td><input type="text" class="form-control input-sm" name="ritase[]" placeholder="<?=lang('ritase')?>" value="0" maxlength="5" onkeyup="angka(this);" /></td>
                                                        <td><input type="text" class="form-control input-sm" name="remark[]" placeholder="<?=lang('remark')?>" value="" maxlength="150" /></td>
                                                        <td>-</td>
                                                    </tr>
                                    <?php
                                                }
                                                else{
                                                    $ritase = 0;
                                                    $info_jo = '';
                                                    $i = 1;
                                                    $show = true;
                                                    foreach($check_po as $row_po){
                                                        $ritase += $row_po->ritase;
                                                        $info_jo .= '<br>'.$i.'. JO No : <b>'.$row_po->jo_no.'</b>, Vessel Name : '.$row_po->vessel_name.', Destination : '.$row_po->from_name.' - '.$row_po->to_name;
                                                        
                                                        if($show == true){
                                                            if($get_data->jo_no == $row_po->jo_no){
                                                                $show = false;
                                                            }
                                                        }
                                                        $i++;
                                                    }
                                                    
                                                    if($show == true){
                                    ?>
                                                        <tr>
                                                            <td><?=$no?></td>
                                                            <td><input type="hidden" name="vehicle_rowID[]" value="<?=$vehicle->rowID?>" /><input type="text" class="form-control input-sm" name="police_no[]" value="<?=$vehicle->police_no?>" readonly="" /></td>
                                                            <td><input type="text" class="form-control input-sm" name="ritase[]" placeholder="<?=lang('ritase')?>" value="0" maxlength="5" onkeyup="angka(this);" /></td>
                                                            <td><input type="text" class="form-control input-sm" name="remark[]" placeholder="<?=lang('remark')?>" value="" maxlength="150" /></td>
                                                            <td align="justify">
                                                                Ritase : <b><?=number_format($ritase,0,',','.')?></b>
                                                                <?=$info_jo?>
                                                            </td>
                                                        </tr>
                                    <?php
                                                    }
                                                    else{
                                                        if(count($get_data_detail) > 0){
                                    ?>
                                                            <tr>
                                                                <td><?=$no?></td>
                                                                <td><input type="hidden" name="vehicle_rowID[]" value="<?=$vehicle->rowID?>" /><input type="text" class="form-control input-sm" name="police_no[]" value="<?=$vehicle->police_no?>" readonly="" /></td>
                                                                <td><input type="text" class="form-control input-sm" name="ritase[]" placeholder="<?=lang('ritase')?>" value="<?=$get_data_detail->ritase?>" maxlength="5" onkeyup="angka(this);" /></td>
                                                                <td><input type="text" class="form-control input-sm" name="remark[]" placeholder="<?=lang('remark')?>" value="<?=$get_data_detail->remark?>" maxlength="150" /></td>
                                                                <td align="justify">
                                                                    Ritase : <b><?=number_format($ritase,0,',','.')?></b>
                                                                    <?=$info_jo?>
                                                                </td>
                                                            </tr>
                                    <?php                            
                                                        }
                                                        else{
                                                            if(date('N',strtotime(date('d-m-Y'))) == 1){
                                    ?>
                                                                <tr>
                                                                    <td><?=$no?></td>
                                                                    <td><input type="hidden" name="vehicle_rowID[]" value="<?=$vehicle->rowID?>" /><input type="text" class="form-control input-sm" name="police_no[]" value="<?=$vehicle->police_no?>" readonly="" /></td>
                                                                    <td><input type="text" class="form-control input-sm" name="ritase[]" placeholder="<?=lang('ritase')?>" value="0" maxlength="5" onkeyup="angka(this);" /></td>
                                                                    <td><input type="text" class="form-control input-sm" name="remark[]" placeholder="<?=lang('remark')?>" value="" maxlength="150" /></td>
                                                                    <td align="justify">
                                                                        Ritase : <b><?=number_format($ritase,0,',','.')?></b>
                                                                        <?=$info_jo?>
                                                                    </td>
                                                                </tr>
                                    <?php
                                                            }
                                                            else{
                                    ?>
                                                                <tr>
                                                                    <td><?=$no?></td>
                                                                    <td><?=$vehicle->police_no?></td>
                                                                    <td>-</td>
                                                                    <td>-</td>
                                                                    <td align="justify">
                                                                        Ritase : <b><?=number_format($ritase,0,',','.')?></b>
                                                                        <?=$info_jo?>
                                                                    </td>
                                                                </tr>
                                    <?php
                                                            }
                                                        }
                                                    }
                                                }
                                            }
                                            
                                            $no++;
                                        }
                                    }
                                    ?>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="form-group form-md-line-input">
                        <div class="col-lg-4">
                            <button type="submit" class="btn green btn-sm"><i class="fa fa-save"></i> SAVE</button> &nbsp;
                            <button type="button" class="btn red btn-sm " onclick="history.go(0);"><i class="fa fa-refresh"></i> REFRESH</button>
                        </div>
                    </div>
                    <?=form_close()?>
                  </div>
               </div>
            </div> 
                       
          </div>
        </div>
      </section>

    </section>
 <!-- </aside>-->
  <!-- /.aside -->
<script type="text/javascript">
    $(function() {
        $('#jo_no').select2();
        $('#jo_no').select2('val','<?=$get_data->jo_no?>');
    });
</script>

</section>
<a href="#" class="hide nav-off-screen-block" data-toggle="class:nav-off-screen, open" data-target="#nav,html"></a>
</section>