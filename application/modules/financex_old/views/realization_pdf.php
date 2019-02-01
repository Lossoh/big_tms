<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>
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

<div id="header">
    <h2><?php echo lang('realization'); ?> Receipt</h2>
    <?= $cash_advance->trx_no == '' ? '-' : $cash_advance->trx_no;?> - <?= date("d/m/Y",strtotime($cash_advance->alloc_date));?>
</div>

<div id="content" style="text-align:center;">
    <table width="100%">
        <tr>
            <td width="50%" align="left">
                &nbsp; 
            </td>
            <td width="50%" align="right" style="font-size: 10px;">
                Print Date Time : <?=date('d F Y H:i:s')?> 
            </td>
        </tr>
    </table>

    <table width="100%" align="center" cellpadding="10" cellspacing="0">
    	<tr>
            <td style="border-right: #000000 2px solid;">
                <b>Cash Advance Details</b>
                <br />
                <br />
                <table width="100%" border="0" align="center" cellpadding="3" cellspacing="0">
                	<tr>
                		<th align="left"><?= lang('cash_advance_no'); ?></th>
                        <td align="left">:</td>
                        <td align="left"><?= $cash_advance->advance_no;?></td>
                    </tr>
                	<tr>
                		<th align="left">Transaction Type</th>
                        <td align="left">:</td>
                        <td align="left"><?= ucwords(strtolower($cash_advance->advance_name));?></td>
                    </tr>
                    <tr>
                        <th align="left"><?= lang('date'); ?></th>
                        <td align="left">:</td>
                        <td align="left"><?= date("d F Y",strtotime($cash_advance->advance_date));?></td>
                    </tr>
                    <tr>
                		<th align="left"><?=lang('driver')?>/<?=lang('employee')?> Name</th>
                        <td align="left">:</td>
                        <td align="left">
                            <?php
                            $type = '-';
                            if($cash_advance->type == 'C'){
                                $type = 'Company';
                            }
                            else if($cash_advance->type == 'D'){
                                $type = 'Driver';                                
                            }
                            else if($cash_advance->type == 'E'){
                                $type = 'Employee';                                
                            }
                            ?>
                            <?=$cash_advance->type.$cash_advance->debtor_code?> - <?=ucwords(strtolower($cash_advance->debtor_name))?> [<?=$type?>]
                        </td>
                    </tr>
                    <tr>
                        <th align="left"><?= lang('fare_trip'); ?></th>
                        <td align="left">:</td>
                        <td align="left"><?= ucwords(strtolower($cash_advance->destination_from_name)).' - '.ucwords(strtolower($cash_advance->destination_to_name));?></td>
                    </tr>
                    <tr>
                        <th align="left"><?= lang('vehicle_police_no'); ?></th>
                        <td align="left">:</td>
                        <td align="left"><?=$cash_advance->police_no != '' ? $cash_advance->police_no : '-'?> [<?= $cash_advance->type_name != '' ? ucfirst(strtolower($cash_advance->type_name)) : '-';?>]</td>
                    </tr>
                    <tr>
                        <th align="left"><?= lang('cash_advance_amt'); ?> (Rp)</th>
                        <td align="left">:</td>
                        <td align="right"><?= number_format($cash_advance->advance_amount,0,',','.');?></td>
                    </tr>
                    <tr>
                        <th align="left"><?= lang('extra_amount'); ?> (Rp)</th>
                        <td align="left">:</td>
                        <td align="right"><?= number_format($cash_advance->advance_extra_amount,0,',','.');?></td>
                    </tr>
                    <tr>
                        <th align="left">Addendum (Rp)</th>
                        <td align="left">:</td>
                        <td align="right">
                            <?= number_format($cash_advance->pay_over_allocation,0,',','.');?>
                        </td>
                    </tr>
                    <tr>
                		<th align="left"><?= lang('cash_advance_alloc'); ?> (Rp)</th>
                        <td align="left">:</td>
                        <td align="right"><?= number_format($cash_advance->advance_allocation,0,',','.');?></td>
                    </tr>
                    <tr>
                		<th align="left"><?= lang('balance'); ?> (Rp)</th>
                        <td align="left">:</td>
                        <td align="right">
                            <?php
                            $total_balance = ($cash_advance->advance_amount + $cash_advance->advance_extra_amount + $cash_advance->pay_over_allocation) - $cash_advance->advance_allocation; 
                            ?>
                            <?= number_format($total_balance,0,',','.');?>
                        </td>
                	</tr>
                </table>
            </td>
            <td valign="top">
                <b>Cost Details</b>
                <br />
                <br />
                <table width="100%" border="1" align="center" cellpadding="2" cellspacing="0">
                	<tr>
                		<td  align="center" height="20px" width="7%">No</td>
                		<td  align="center" width="27%"><?= lang('cost'); ?> Code</td>
                        <td  align="center"><?= lang('description'); ?></td>
                		<td  align="center" width="20%"><?= lang('amount'); ?></td>
                	</tr>
                	<?php 
                		$i=1;
                        $total_cost = 0;
                		foreach($costs as $cost){
                		  $total_cost += $cost->trx_amt;
                	?>
                	<tr style="font-size:9px">
                		<td align="center"><?= $i++?></td>
                		<td align="left"><?= ucfirst(strtolower($cost->cost_name));?></td>
                		<td align="left"><?= $cost->descs;?></td>
                		<td align="right"><?= number_format($cost->trx_amt,0,',','.');?></td>
                	</tr>
                	<?php 
                        }
                    ?>
                    <tr style="font-size:9px">
                  		<td align="center" colspan="3">Total (Rp)</td>
                  		<td align="right"><?= number_format($total_cost,0,',','.');?></td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
    <br />
    <b><?=lang('delivery_order')?> (DO) Details</b>
    <br />
    <br />
    <table width="100%" border="1" align="center" cellpadding="2" cellspacing="0">
    	<tr >
    		<td  align="center" height="30px" width="3%">No</td>
    		<td  align="center" width="12%"><?= lang('job_order_no'); ?></td>
            <td  align="center" width="8%"><?= lang('container'); ?> Type</td>
    		<td  align="center"><?= lang('delivery_order_cont_no'); ?></td>
            <td  align="center">DO No</td>
            <td  align="center" width="8%">DO Date</td>
            <td  align="center" width="8%"><?= lang('qty_delivery'); ?></td>
    		<td  align="center" width="9%"><?= lang('qty_receipt'); ?></td>
    		<td  align="center" width="9%"><?= lang('receipt_date'); ?></td>
    	</tr>
    	<?php 
    		$i=1;
    		foreach($documents as $doc){    				   
    	?>
    	<tr style="font-size:9px">
    		<td align="center"><?= $i++?></td>
    		<td align="left"><?= $doc->jo_no;?></td>
    		<td align="left"><?= $doc->container_size == 0 ? '' : $doc->container_size.' Ft';?></td>
    		<td align="left"><?= $doc->container_no == '' ? '' : $doc->container_no;?></td>
    		<td align="left"><?= strtoupper($doc->do_no);?></td>
            <td align="left"><?= date("d/m/Y",strtotime($doc->do_date));?></td>
    		<td align="left"><?= number_format($doc->deliver_weight,0,',','.');?></td>
    		<td align="left"><?= number_format($doc->received_weight,0,',','.');?></td>
            <td align="left"><?= date("d/m/Y",strtotime($doc->received_date));?></td>
    	</tr>
    	<?php }?>
    </table>

</div>
</body>
</html>
