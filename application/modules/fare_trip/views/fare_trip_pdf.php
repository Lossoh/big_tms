<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>
</head>

<body>

<style>
    table th,td{
        font-size: 12px;
    }
	
	 @page { margin: 60px 10px; }
     #header { position: fixed; left: 0px; top: -60px; right: 0px; height: 50px;  text-align: center;  }
     #footer { position: fixed; left: 0px; bottom: -60px; right: 0px; height: 50px; text-align:right; }
	 #content{
	 border-bottom:0px solid #000000;
	 }
     #footer .page:after { content: counter(page, upper-roman); }
	#content{
	background-color:#FFFFFF;
	} 
</style>

<div id="header">
    <h2><?php echo lang('fare_trips'); ?></h2>
</div>

<div id="content" style="text-align:center;">
<table width="100%" border="1" align="center" cellpadding="1" cellspacing="0">
	<tr >    
		<td  align="center" height="30px">No</td>
		<td  align="center"><?php echo lang('fare_trip_code'); ?></td>
        <td  align="center"><?php echo lang('fare_trip_destination_from'); ?></td>
		<td  align="center"><?php echo lang('fare_trip_destination_to'); ?></td>
        <td  align="center"><?php echo lang('fare_trip_distance'); ?></td>
        <td  align="center">Trip Condition </td>
        <td  align="center"><?=lang('points')?> </td>
        <td  align="center"><?php echo lang('trip_type'); ?></td>
        <td  align="center"><?php echo lang('vehicle'); ?></td>
		<td  align="center"><?php echo lang('cost'); ?></td>
		<td  align="center"><?php echo lang('komisi_supir'); ?></td>
		<td  align="center"><?php echo lang('komisi_kernet'); ?></td>
		<td  align="center"><?php echo lang('deposit'); ?></td>
		<td  align="center"><?php echo lang('min_amount'); ?></td>
		<td  align="center"><?php echo lang('os_amount'); ?></td>
		<td  align="center"><?php echo lang('total'); ?></td>
		<td  align="center"><?php echo lang('status'); ?></td>
	</tr>
	<?php 
				 $i=0;
				foreach($fare_trip as $val){
				$i++;
				    $fare_trip_cd=$val->fare_trip_cd;
					$destination_from=$val->destination_from;
                    $destination_to=$val->destination_to;
                    $distance=$val->distance;
                    $trip_condition=$val->trip_condition;
                    $poin=$val->poin;
                    $komisi_supir=$val->komisi_supir;
                    $komisi_kernet=$val->komisi_kernet;
                    $deposit=$val->deposit;
                    $min_amount=$val->min_amount;
                    $os_amount=$val->os_amount;
                    $total=$val->total;
                    if($val->trip_type == '1')
                        $trip_type = "BULK";
                    else if($val->trip_type == '2')
                        $trip_type = "CONTAINER";
                    else
                        $trip_type = "OTHERS";
                    
                    if($val->status == 1)
                        $status = "ACTIVE";
                    else
                        $status = "NOT ACTIVE";
                    
					?>
	<tr style="font-size:9px">
		<td align="center"><?php echo $i;?></td>
		<td align="left"><?php echo $fare_trip_cd;?></td>
		<td align="left"><?php echo $destination_from;?></td>
		<td align="left"><?php echo $destination_to;?></td>
        <td align="right"><?php echo number_format($distance).' ('.number_format($val->estimated_time_receipt).' minutes)';?></td>
        <td align="left"><?=ucwords($trip_condition)?></td>
		<td align="center"><?php echo $poin;?></td>
		<td align="left"><?php echo $trip_type;?></td>
        <td align="left">
        <?php
            $get_vehicle = $this->vehicle_category_model->get_by_id('sa_vehicle_type',$val->vehicle_id);
            echo strtoupper($get_vehicle->type_name);
        ?>
        </td>
		<td align="left">
        <?php
            $get_cost_code = $this->cost_code_model->get_by_id('sa_cost',$val->cost_id);
            echo strtoupper($get_cost_code->descs);
        ?>
        </td>
        <td align="right"><?php echo number_format($komisi_supir);?></td>
        <td align="right"><?php echo number_format($komisi_kernet);?></td>
        <td align="right"><?php echo number_format($deposit);?></td>
        <td align="right"><?php echo number_format($min_amount);?></td>
        <td align="right"><?php echo number_format($os_amount);?></td>
        <td align="right"><?php echo number_format($total);?></td>
		<td align="left">
            <?=$status?>
        </td>
	</tr>
	<?php }?>
</table>
</div>
</body>
</html>
