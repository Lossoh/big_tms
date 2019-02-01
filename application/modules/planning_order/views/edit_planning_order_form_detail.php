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
            $check_po = $this->planning_order_model->check_po_by_vehicle($vehicle->rowID,$trx_date);
            $get_data_detail = $this->planning_order_model->check_edit_po_by_vehicle($trx_no,$jo_no,$vehicle->rowID,$trx_date);

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
                            if($jo_no == $row_po->jo_no){
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
                            if($jo_no == $row_po->jo_no){
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
