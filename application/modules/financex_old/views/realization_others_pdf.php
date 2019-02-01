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

    <table width="100%" border="0" cellpadding="3" cellspacing="0">
    	<tr>
            <th align="left" width="24%"><?= lang('cash_advance_no'); ?></th>
            <th align="left" width="1%">:</th>
            <td align="left" width="35%"><?= $cash_advance->advance_no;?></td>
            <th align="left" width="24%"><?= lang('cash_advance_amt'); ?> (Rp)</th>
            <th align="left" width="1%">:</th>
            <td align="right" width="15%"><?= number_format($cash_advance->advance_amount,0,',','.');?></td>
        </tr>
    	<tr>
    		<th align="left">Transaction Type</th>
            <th align="left">:</th>
            <td align="left"><?= ucwords(strtolower($cash_advance->advance_name));?></td>
    		<th align="left"><?= lang('extra_amount'); ?> (Rp)</th>
            <th align="left">:</th>
            <td align="right"><?= number_format($cash_advance->advance_extra_amount,0,',','.');?></td>
        </tr>
        <tr>
            <th align="left"><?= lang('date'); ?></th>
            <th align="left">:</th>
            <td align="left"><?= date("d F Y",strtotime($cash_advance->advance_date));?></td>
    		<th align="left">Addendum (Rp)</th>
            <td align="left">:</td>
            <td align="right">
                <?= number_format($cash_advance->pay_over_allocation,0,',','.');?>
            </td>
        </tr>
        <tr>
    		<th align="left"><?=lang('driver')?>/<?=lang('employee')?> Name</th>
            <th align="left">:</th>
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
    		<th align="left"><?= lang('cash_advance_alloc'); ?> (Rp)</th>
            <th align="left">:</th>
            <td align="right"><?= number_format($cash_advance->advance_allocation,0,',','.');?></td>
        </tr>
        <tr>
            <th align="left"></th>
            <th align="left"></th>
            <td align="right"></td>
    		<th align="left"><?= lang('balance'); ?> (Rp)</th>
            <th align="left">:</th>
            <td align="right">
                <?php
                $total_balance = ($cash_advance->advance_amount + $cash_advance->advance_extra_amount + $cash_advance->pay_over_allocation) - $cash_advance->advance_allocation; 
                ?>
                <?= number_format($total_balance,0,',','.');?>
            </td>
    	</tr>
    </table>
       
    <br />
    <b><?=lang('cost_code_details')?></b>
    <br />
    <br />
    <table width="100%" border="1" align="center" cellpadding="2" cellspacing="0">
    	<tr>
    		<td  align="center" height="20px" width="5%">No</td>
    		<td  align="center" width="27%"><?= lang('cost'); ?> Code</td>
            <td  align="center"><?= lang('description'); ?></td>
    		<td  align="center" width="13%"><?= lang('amount'); ?></td>
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
</div>
</body>
</html>
