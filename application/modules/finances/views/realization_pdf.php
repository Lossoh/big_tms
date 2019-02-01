<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title><?php echo lang('realization'); ?> Receipt</title>
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

<table width="100%">
    <tr>
        <td width="50%" align="left">
            <?=$this->config->item('comp_name')?>
        </td>
        <td width="50%" align="right" style="font-size: 10px;">
            Created : <b><?=ucwords($this->session->userdata('username'))?></b> | Print Time : <b><?=date('d F Y H:i:s')?></b>
        </td>
    </tr>
</table>

<?php
if(count($cash_advance) > 0){
?>
<div id="header">
    <h2><?php echo lang('realization'); ?> Receipt</h2>
    <?= $cash_advance->alloc_no == '' ? '-' : $cash_advance->alloc_no;?> - <?= date("d/m/Y",strtotime($cash_advance->alloc_date));?>
</div>

<div id="content" style="text-align:center;">
    <table width="100%" align="center" cellpadding="10" cellspacing="0">
    	<tr>
            <td width="50%" style="border-right: #000000 2px solid;">
                &nbsp;<b>Cash Advance Details</b>
                <br />
                <br />
                <table width="100%" border="0" align="center" cellpadding="3" cellspacing="0">
                	<tr>
                		<th align="left"><?= lang('cash_advance_no'); ?></th>
                        <td align="left">:</td>
                        <td align="left"><?= $cash_advance->advance_no.' ['.$jo_type.']';?></td>
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
                        <td align="right"><?= number_format($cash_advance->alloc_amt,0,',','.');?></td>
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
                    <tr>
                		<th align="left"><?= lang('status'); ?></th>
                        <td align="left">:</td>
                        <td align="left">
                            <?php
                            $status = '-';
                            $status_external = '-';
                            
                            if($cash_advance->status == 1){
                                $status = lang('cancel_load');
                            }
                            if($cash_advance->status == 2){
                                $status = 'POK';
                            }
                            if($cash_advance->status == 3){
                                $status = 'POK Vehicle External';
                            }
                            if($cash_advance->status == 4){
                                if($cash_advance->status_external == 1){
                                    $status_external = 'POK Vehicle External & ';
                                }
                                else{
                                    $status_external = '';
                                }
                                
                                if($cash_advance->reference_pok_no_2 == ''){
                                    $reference_pok_no_1 = $cash_advance->reference_pok_no_1 == "" ? "-" : $cash_advance->reference_pok_no_1;
                                    $status = $status_external.'POK Vehicle Internal ['.$reference_pok_no_1.']';
                                }
                                else{
                                    $status = $status_external.'POK Vehicle Internal ['.$cash_advance->reference_pok_no_1.' & '.$cash_advance->reference_pok_no_2.']';
                                }
                            }
                            
                            echo '<b>'.$status.'</b>';
                            ?>
                        </td>
                	</tr>
                </table>
            </td>
            <td width="50%" valign="top">
                <b>Cost Details</b>
                <br />
                <br />
                <table width="100%" border="1" align="center" cellpadding="2" cellspacing="0">
                	<tr>
                		<th  align="center" height="20px" width="7%">No</th>
                		<th  align="center" width="27%"><?= lang('cost'); ?> Code</th>
                        <th  align="center"><?= lang('description'); ?></th>
                		<th  align="center" width="20%"><?= lang('amount'); ?></th>
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
                  		<td align="right" colspan="3"><b>Total (Rp)</b> &nbsp; </td>
      		            <td align="right"><b><?= number_format($total_cost,0,',','.');?></b></td>
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
    		<th  align="center" height="30px" width="3%">No</th>
    		<th  align="center" width="12%"><?= lang('job_order_no'); ?></th>
            <th  align="center" width="8%"><?= lang('container'); ?> Type</th>
    		<th  align="center"><?= lang('delivery_order_cont_no'); ?></th>
            <th  align="center">DO No</th>
            <th  align="center" width="8%">DO Date</th>
            <th  align="center" width="8%"><?= lang('qty_delivery'); ?></th>
    		<th  align="center" width="9%"><?= lang('receipt_date'); ?></th>
    		<th  align="center" width="9%"><?= lang('qty_receipt'); ?></th>
    	</tr>
    	<?php 
    		$i=1;
    		foreach($documents as $doc){    				   
    	?>
    	<tr style="font-size:9px">
    		<td align="center"><?= $i++?></td>
    		<td align="left"><?= $doc->jo_no;?></td>
    		<td align="left"><?= $doc->container_size == 0 ? '' : $doc->count_container.' x '.$doc->container_size.' Ft';?></td>
    		<td align="left"><?= $doc->container_no == '' ? '' : $doc->container_no;?></td>
    		<td align="left"><?= strtoupper($doc->do_no);?></td>
            <td align="left"><?= date("d/m/Y",strtotime($doc->do_date));?></td>
    		<td align="left"><?= number_format($doc->deliver_weight,0,',','.');?></td>
            <td align="left"><?= date("d/m/Y",strtotime($doc->received_date));?></td>
    		<td align="left"><?= number_format($doc->received_weight,0,',','.');?></td>
    	</tr>
    	<?php }?>
    </table>

</div>
<?php
}

if(count($cash_advance_refund) > 0){
?>
<p>&nbsp;</p>
<hr />
<div id="header">
    <h2><?php echo lang('refund'); ?> Receipt</h2>
    <?= $cash_advance_refund->alloc_no == '' ? '-' : $cash_advance_refund->alloc_no;?> - <?= date("d/m/Y",strtotime($cash_advance_refund->alloc_date));?>
</div>

<div id="content" style="text-align:center;">
    <table width="100%" align="center" cellpadding="10" cellspacing="0">
    	<tr>
            <td width="50%">
                &nbsp;<b>Cash Advance Details</b>
                <br />
                <br />
                <table width="100%" border="0" align="center" cellpadding="3" cellspacing="0">
                	<tr>
                		<th align="left"><?= lang('cash_advance_no'); ?></th>
                        <td align="left">:</td>
                        <td align="left"><?= $cash_advance_refund->advance_no.' ['.$jo_type.']';?></td>
                    </tr>
                	<tr>
                		<th align="left">Transaction Type</th>
                        <td align="left">:</td>
                        <td align="left"><?= ucwords(strtolower($cash_advance_refund->advance_name));?></td>
                    </tr>
                    <tr>
                        <th align="left"><?= lang('date'); ?></th>
                        <td align="left">:</td>
                        <td align="left"><?= date("d F Y",strtotime($cash_advance_refund->advance_date));?></td>
                    </tr>
                    <tr>
                		<th align="left"><?=lang('driver')?>/<?=lang('employee')?> Name</th>
                        <td align="left">:</td>
                        <td align="left">
                            <?php
                            $type = '-';
                            if($cash_advance_refund->type == 'C'){
                                $type = 'Company';
                            }
                            else if($cash_advance_refund->type == 'D'){
                                $type = 'Driver';                                
                            }
                            else if($cash_advance_refund->type == 'E'){
                                $type = 'Employee';                                
                            }
                            ?>
                            <?=$cash_advance_refund->type.$cash_advance_refund->debtor_code?> - <?=ucwords(strtolower($cash_advance_refund->debtor_name))?> [<?=$type?>]
                        </td>
                    </tr>
                    <tr>
                        <th align="left"><?= lang('fare_trip'); ?></th>
                        <td align="left">:</td>
                        <td align="left"><?= ucwords(strtolower($cash_advance_refund->destination_from_name)).' - '.ucwords(strtolower($cash_advance_refund->destination_to_name));?></td>
                    </tr>
                    <tr>
                        <th align="left"><?= lang('vehicle_police_no'); ?></th>
                        <td align="left">:</td>
                        <td align="left"><?=$cash_advance_refund->police_no != '' ? $cash_advance_refund->police_no : '-'?> [<?= $cash_advance_refund->type_name != '' ? ucfirst(strtolower($cash_advance_refund->type_name)) : '-';?>]</td>
                    </tr>
                </table>
            </td>
            <td width="50%" valign="top">
                &nbsp;
                <br />
                <br />
                <table width="100%" border="0" align="center" cellpadding="3" cellspacing="0">
                    <tr>
                        <th align="left"><?= lang('cash_advance_amt'); ?> (Rp)</th>
                        <td align="left">:</td>
                        <td align="right"><?= number_format($cash_advance_refund->advance_amount,0,',','.');?></td>
                    </tr>
                    <tr>
                        <th align="left"><?= lang('extra_amount'); ?> (Rp)</th>
                        <td align="left">:</td>
                        <td align="right"><?= number_format($cash_advance_refund->advance_extra_amount,0,',','.');?></td>
                    </tr>
                    <tr>
                		<th align="left">Refund Amount (Rp)</th>
                        <td align="left">:</td>
                        <td align="right"><?= number_format($cash_advance_refund->alloc_amt,0,',','.');?></td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</div>
<?php
}

?>
</body>
</html>
