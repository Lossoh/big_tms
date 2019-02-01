<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title><?=lang('loan_report')?></title>
</head>

<body>

<style>
    table th,td{
        font-size: 11px;
    }
	body{
	   font-size: 11px;
       font-family: sans-serif;
	}
	 @page { margin: 15px 30px 15px 20px; }
     
     #header { left: 0px; top: 0px; right: 0px; text-align: center;  }
     #footer { left: 0px; bottom: 30px; right: 0px; font-size: 11px; font-family: sans-serif; text-align:right; }
	 #content{
	   border-bottom:0px solid #000000;
       margin-top: 10px;
	 }
     #footer .page:after { content: counter(page, upper-roman); }
	#content{
	background-color:#FFFFFF;
	}
</style>
<table width="100%" cellpadding="2" cellspacing="0">
    <tr>
        <td width="50%" align="left"><?=$this->config->item('comp_name')?></td>
        <td width="50%" align="right">Print Date Time : <?=date('d F Y H:i:s')?> </td>
    </tr>
</table>
<br />
<div id="header">
    <span style="font-size: 16px;"><?=strtoupper(lang('loan_report'))?></span><br />
    Period : <?=$str_start_date.' to '.$str_end_date;?>
</div>
<div id="content">
Balance Status : <b><?=ucfirst($balance_status)?></b><br />
Debitor Name &nbsp; : <b><?=$debtor_name?></b><br />
<table width="100%" cellpadding="3" cellspacing="0">
	<tr>
        <th style="border: #000000 solid 1px;" width="3%">No</th>
        <th style="border: #000000 solid 1px;" width="9%"><?=lang('cash_advance_no')?></th>
        <th style="border: #000000 solid 1px;" width="11%"><?=lang('date')?></th>
        <th style="border: #000000 solid 1px;" width="15%"><?=lang('driver')?>/<?=lang('employee')?> Name</th>
        <th style="border: #000000 solid 1px;">Description</th>
        <th style="border: #000000 solid 1px;" width="11%"><?=lang('cash_advance_amt')?></th>
        <th style="border: #000000 solid 1px;" width="11%"><?=lang('cash_advance_alloc')?> (Rp)</th>
        <th style="border: #000000 solid 1px;" width="11%"><?=lang('balance')?> (Rp)</th>
    </tr>  
	<?php 
    $i=0;
        
    if (!empty($loan_list)) {
        foreach ($loan_list as $cash_advance_list) { 
            $i++;
            $total_balance = ($cash_advance_list->advance_amount + $cash_advance_list->advance_extra_amount + $cash_advance_list->pay_over_allocation) - $cash_advance_list->advance_allocation;
                                    
    ?>
        	<tr>
        		<td style="border: #000000 solid 1px;" align="center"><?=number_format($i)?></td>
				<td style="border: #000000 solid 1px;"><?=$cash_advance_list->advance_no?></td>
				<td style="border: #000000 solid 1px;"><?=date("d-m-Y H:i:s",strtotime($cash_advance_list->advance_date.' '.$cash_advance_list->time_created))?></td>
				<td style="border: #000000 solid 1px;"><?=$cash_advance_list->debtor_type.$cash_advance_list->debtor_code?> - <?=$cash_advance_list->debtor_name?></td>
				<td style="border: #000000 solid 1px;"><?=$cash_advance_list->description == '' ? '-' : $cash_advance_list->description?></td>
				<td style="text-align: right;border: #000000 solid 1px;"><?= number_format($cash_advance_list->advance_amount,0);?></td>
				<td style="text-align: right;border: #000000 solid 1px;"><?= number_format($cash_advance_list->advance_allocation,0);?></td>
				<td style="text-align: right;border: #000000 solid 1px;"><?= number_format($total_balance,0);?></td>
        	</tr>
	<?php 
        }
        
    }
    
    if($i == 0){
    ?>
        <tr>
            <td colspan="8" align="center" style="border: #000000 solid 1px;">Data not available.</td>
        </tr>
    <?php
    }
    ?>
</table>
</div>

</body>
</html>
