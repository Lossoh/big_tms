<table class="table table-responsive table-striped table-condensed" width="100%">
    <thead>
		<th style="text-align: center;">Transaction No</th>
		<th style="text-align: center;">Container</th>
		<th style="text-align: center;">Tonase</th>
		<th style="text-align: center;">Price by Container (Rp)</th>
		<th style="text-align: center;">Price by Tonase (Rp)</th>
    </thead>
    <tbody>
        <?php
        $i=1;
        $total_container = 0;
        $total_tonase = 0;
        $total_price_container = 0;
        $total_price_tonase = 0;
        $wholesale = 0;
        $jo_type = 0;
        
        if(!empty($data_do)){
            
            foreach($data_do as $row){
        		
                $price_container = 0;
                $price_tonase = 0;
                $wholesale = $row->wholesale;
                $jo_type = $row->jo_type;
                
                if($row->wholesale == 1){
                    $price_container = $row->price_amount;
                    $price_tonase = $row->price_amount;                    
                }
                else{
                    $biaya = 0;
                    if($row->container_size == 20){
                        $biaya = $row->price_20ft;
                    }
                    elseif($row->container_size == 40){
                        $biaya = $row->price_40ft;
                    }
                    elseif($row->container_size == 45){
                        $biaya = $row->price_45ft;
                    }
                    
                    $price_container = $row->container_size * $biaya;
                    $price_tonase = $row->received_weight * $row->price_amount;
                }
                
                $total_container += $row->count_container;
        		$total_tonase += $row->received_weight;
                
                $total_price_container += $price_container;
                $total_price_tonase += $price_tonase;
                
        ?>
        		<tr id="baris_<?=$i?>">
        			<td>
                        <?=$row->trx_no?>
                        <input type="hidden" name="count_container[]" id="count_container_<?=$i?>" value="<?=$row->count_container?>" />
                        <input type="hidden" name="tonase[]" id="tonase_<?=$i?>" value="<?=$row->received_weight?>" />
                        <input type="hidden" name="price_container[]" id="price_container_<?=$i?>" value="<?=$price_container?>" />
                        <input type="hidden" name="price_tonase[]" id="price_tonase_<?=$i?>" value="<?=$price_tonase?>" />
                        <input type="hidden" name="job_id[]" id="job_id_<?=$i?>" value="<?=$row->rowID?>" />                    
                    </td>
        			<td align="center"><?=$row->count_container.' x '.$row->container_size?> feet</td>
        			<td align="center"><?= number_format($row->received_weight,0,',','.')?></td>
        			<td align="right"><?= number_format($price_container,0,',','.')?></td>
        			<td align="right"><?= number_format($price_tonase,0,',','.')?></td>	
        		</tr>
        <?php 
                $i++;
            }
        }
        else{
            echo '<tr><td align="center" colspan="6">Data delivery order not available</td></tr>';
        }
        ?>
    </tbody>
    <tfoot>
        <tr>
            <th style="text-align: center;">
                Total
                <input type="hidden" name="wholesale" id="wholesale" value="<?=$wholesale?>" />
                <input type="hidden" name="count_data_do" id="count_data_do" value="<?=count($data_do)?>" />
                <input type="hidden" name="jo_type" id="jo_type" value="<?=$jo_type?>" />
                
                <?php
                $amount = 0;
                if($jo_type == 1){
                    $amount = $total_price_tonase;
                }
                else if($jo_type == 2){
                    $amount = $total_price_container;
                }
                else{
                    if($total_price_tonase > $total_price_container){
                        $amount = $total_price_tonase;
                    }
                    else{
                        $amount = $total_price_container;
                    }
                }
                ?>
            </th>
    		<th style="text-align: center;">
                <input type="text" class="form-control input-sm text-center" name="total_container" id="total_container" value="<?=number_format($total_container,0,',','.')?>" readonly="" />                
            </th>
    		<th style="text-align: center;">
                <input type="text" class="form-control input-sm text-center" name="total_tonase" id="total_tonase" value="<?=number_format($total_tonase,0,',','.')?>" readonly="" />      
            </th>
    		<th style="text-align: center;">
                <div class="input-group">
                  <span class="input-group-addon" id="basic-addon1">Rp</span>
                  <input type="text" class="form-control input-sm text-right" name="total_price_container" id="total_price_container" value="<?=number_format($total_price_container,0,',','.')?>" readonly="" />
                </div>      
            </th>
    		<th style="text-align: center;">
                <div class="input-group">
                  <span class="input-group-addon" id="basic-addon1">Rp</span>
                  <input type="text" class="form-control input-sm text-right" name="total_price_tonase" id="total_price_tonase" value="<?=number_format($total_price_tonase,0,',','.')?>" readonly="" />
                </div>      
            </th>
        </tr>
    </tfoot>
</table>

