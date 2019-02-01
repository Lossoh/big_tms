<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Print Faktur Service</title>
</head>

<body>

<style>
    body,table th,td{
        font-size: 11px;
        font-family: sans-serif;
    }
	
	 @page { margin: 10px 10px; }
     #header { left: 0px; top: 0px; right: 0px; text-align: center;  }
     #footer { left: 0px; bottom: 30px; right: 0px; font-size: 11px; font-family: sans-serif; text-align:right; }	
	  #content{
    	 border-bottom:0px solid #000000;
	 }
     #footer .page:after { content: counter(page, upper-roman); }
	#content{
	background-color:#FFFFFF;
	} 
</style>

<p align="right">Print Date Time : <?=date('d F Y H:i:s')?> </p>

<div id="header">
    <h2>FAKTUR SERVICE</h2>
</div>
<br />

<div id="content" style="text-align:center;">
    <table width="100%" cellpadding="1" cellspacing="0">
    	<tr>
    		<td width="13%"><?=lang('spk_no')?></td>
            <td width="45%">: &nbsp; <b><?=$get_data->spk_no?></b></td>
            <td width="13%"><?=lang('last_km')?></td>
            <td>: &nbsp; <b><?=number_format($get_data->last_km,0,',','.')?></b></td>        
        </tr>
        <tr>
            <td>SPK <?=lang('date')?></td>
            <td>: &nbsp; <b><?=date("d F Y",strtotime($get_data->spk_date))?></b></td>
            <td><?=lang('type')?></td>
            <td>: &nbsp; <b><?=$get_data->type?></b></td>
        </tr>
        <tr>
            <td><?=lang('police_no')?></td>
            <td>: &nbsp; <b><?=$get_data->police_no?></b></td>
            <td><?=lang('type_work_list')?></td>
            <td>:&nbsp; 
                <b>
                    <?php
                    
                    if($get_data->type_work_list == "Template"){
                        $get_data_template = $this->service_history_model->get_data_service_by_code($get_data->template_service_code);
                        echo $get_data->type_work_list.' ('.$get_data_template->name.')';
                    }
                    else{
                        echo $get_data->type_work_list;
                    }
                    
                    ?>
                </b>
            </td>
        </tr>
        <tr>
            <td>Driver Name</td>
            <td>: &nbsp; <b><?=$get_data->debtor_name?></b></td>
            <td>SA Name</td>
            <td>: &nbsp; <b><?=ucwords($this->session->userdata('username'))?></b></td>
        </tr>
    </table>
    <br />
    <p align="left"><big><b><?=lang('job_description')?>s</b></big></p>
    <table width="100%" border="1" cellpadding="1" cellspacing="0">
    	<tr>
    		<th height="30px" width="5%">No</th>
            <th><?=lang('job_description')?> </th>
         	<th width="15%">Discount (Rp)</th>
    		<th width="15%">Price (Rp)</th>
    	</tr>
    	<?php 
    	$i = 1;
        $gross_wl = 0;
        $discount_wl = 0;
        $price_wl = 0;
        $ppn_wl = 0;
        $total_wl = 0;
        
        if(!empty($get_data_work_list)){
            foreach($get_data_work_list as $row_wl){
                $amount = $row_wl->work_hours_spk * $row_wl->flat_rate_spk;
                
                if($row_wl->discount_type == 'price')
                    $discount = $row_wl->discount;
                else
                    $discount = ($amount * $row_wl->discount) / 100;
                
                $price = $amount - $discount;
                $ppn = $price * 0.1;
                $total_price = $price + $ppn;
                
                $gross_wl += $total_price + $discount;
                $discount_wl += $discount;
                $price_wl += $price;
                $ppn_wl += $ppn;
                $total_wl += $total_price;
                
    	?>
            	<tr style="font-size:9px" valign="top">
            		<td align="center"><?php echo $i++;?></td>
            		<td><?=$row_wl->service_name?></td>
            		<td align="right"><?=number_format($discount,0,',','.')?></td>
            		<td align="right"><?=number_format($total_price,0,',','.')?></td>
            	</tr>
    	<?php 
            }
        ?>
            <tr>
    		  <th align="right" colspan="3">Sub Total Jobs &nbsp; </th>
    		  <th align="right"><?=number_format($total_wl,0,',','.')?></th>
            </tr>
        <?php
        }
        else{
        ?>
            <tr style="font-size:9px"> 
    		  <td align="center" colspan="4">No Data Available</td>
            </tr>
        <?php
        }
        ?>
    </table>
    <br />
    <p align="left"><big><b>Replacement Parts/Materials</b></big></p>
    <table width="100%" border="1" cellpadding="1" cellspacing="0">
    	<tr>
    		<th height="30px" width="5%">No</th>
            <th><?=lang('part_material')?> Name</th>
         	<th width="7%"><?=lang('qty')?> </th>
         	<th width="13%">Unit Price (Rp)</th>
    		<th width="13%">Discount (Rp)</th>
    		<th width="13%">PPN (Rp)</th>
    		<th width="15%">Price (Rp)</th>
    	</tr>
    	<?php 
    	$i = 1;
        $gross_pm = 0;
        $discount_pm = 0;
        $price_pm = 0;
        $ppn_pm = 0;
        $total_pm = 0;
        
        if(!empty($get_data_part_material)){
            foreach($get_data_part_material as $row_pm){                
                $unit_price = $row_pm->price;
                $amount = $row_pm->qty * $unit_price;

                if($row_pm->discount_type == 'price')
                    $discount = $row_pm->qty * $row_pm->discount;
                else
                    $discount = ($amount * $row_pm->discount) / 100;
                
                $price = $amount - $discount;
                $ppn = $price * 0.1;
                $total_price = $price + $ppn;
                
                $gross_pm += $total_price + $discount;
                $discount_pm += $discount;
                $price_pm += $price;
                $ppn_pm += $ppn;
                $total_pm += $total_price;
                
    	?>
    	<tr style="font-size:9px" valign="top">
    		<td align="center"><?php echo $i++;?></td>
    		<td><?=$row_pm->part_material_name?></td>
    		<td align="center"><?=number_format($row_pm->qty,0,',','.')?></td> 
    		<td align="right"><?=number_format($unit_price,0,',','.')?></td>
    		<td align="right"><?=number_format($discount,0,',','.')?></td>
    		<td align="right"><?=number_format($ppn,0,',','.')?></td>
            <td align="right"><?=number_format($total_price,0,',','.')?></td>
    	</tr>
    	<?php 
            }
        ?>
            <tr>
    		  <th align="right" colspan="6">Sub Total Parts/Materials &nbsp; </th>
    		  <th align="right"><?=number_format($total_pm,0,',','.')?></th>
            </tr>
        <?php
        }
        else{
        ?>
            <tr style="font-size:9px">
    		  <td align="center" colspan="7">No Data Available</td>
            </tr>
        <?php
        }
        ?>
    </table>
    <br />
    <p align="left"><big><b>Total Payment</b></big></p>
    <table width="100%" border="1" cellpadding="1" cellspacing="0">
    	<tr>
         	<th></th>
         	<th width="15%">Gross Price (Rp)</th>
         	<th width="15%">Discount (Rp)</th>
         	<th width="15%">Price (Rp)</th>
         	<th width="15%">PPN (Rp)</th>
         	<th width="15%">Nett (Rp)</th>
    	</tr>
        <tr>
         	<td>Sub Total Jobs</td>
         	<td align="right"><?=number_format($gross_wl,0,',','.')?></td>
         	<td align="right"><?=number_format($discount_wl,0,',','.')?></td>
         	<td align="right"><?=number_format($price_wl,0,',','.')?></td>
         	<td align="right"><?=number_format($ppn_wl,0,',','.')?></td>
         	<td align="right"><?=number_format($total_wl,0,',','.')?></td>
    	</tr>
    	<tr>
         	<td>Sub Total Part/Material</td>
         	<td align="right"><?=number_format($gross_pm,0,',','.')?></td>
         	<td align="right"><?=number_format($discount_pm,0,',','.')?></td>
         	<td align="right"><?=number_format($price_pm,0,',','.')?></td>
         	<td align="right"><?=number_format($ppn_pm,0,',','.')?></td>
         	<td align="right"><?=number_format($total_pm,0,',','.')?></td>
    	</tr>
    	<tr>
         	<th align="left" style="font-size: 13px;">Grand Total</th>
         	<th align="right" style="font-size: 13px;"><?=number_format($gross_wl + $gross_pm,0,',','.')?></th>
         	<th align="right" style="font-size: 13px;"><?=number_format($discount_wl + $discount_pm,0,',','.')?></th>
         	<th align="right" style="font-size: 13px;"><?=number_format($price_wl + $price_pm,0,',','.')?></th>
         	<th align="right" style="font-size: 13px;"><?=number_format($ppn_wl + $ppn_pm,0,',','.')?></th>
         	<th align="right" style="font-size: 13px;"><?=number_format($total_wl + $total_pm,0,',','.')?></th>
    	</tr>
    </table>
</div>

</body>
</html>
