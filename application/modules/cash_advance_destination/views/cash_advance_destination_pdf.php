<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title><?=lang('cash_advance_destination')?></title>
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
    <span style="font-size: 16px;"><?=strtoupper(lang('cash_advance_destination'))?> REPORT</span><br />
    Period : <?=$str_start_date.' to '.$str_end_date;?>
</div>
<div id="content">
<table width="100%" cellpadding="1" cellspacing="0">
	<tr>
        <th style="border: #000000 solid 1px;" width="3%">No</th>
        <th style="border: #000000 solid 1px;" width="11%"><?=lang('cash_advance_no')?></th>
        <th style="border: #000000 solid 1px;" width="11%">CA <?=lang('date')?></th>
        <th style="border: #000000 solid 1px;"><?=lang('driver')?>/<?=lang('employee')?> Name</th>
        <th style="border: #000000 solid 1px;" width="6%"><?=lang('fare_trip_code')?></th>
        <th style="border: #000000 solid 1px;" width="8%">Police No</th>
        <th style="border: #000000 solid 1px;" width="8%">Created By</th>
        <th style="border: #000000 solid 1px;" width="8%"><?=lang('cash_advance_amt')?></th>
        <th style="border: #000000 solid 1px;" width="8%"><?=lang('extra_amount')?></th>
        <th style="border: #000000 solid 1px;" width="8%">Addendum</th>
        <th style="border: #000000 solid 1px;" width="8%"><?=lang('cash_advance_alloc')?></th>
        <th style="border: #000000 solid 1px;" width="8%"><?=lang('balance')?></th>
    </tr> 
	<?php 
    $i=0;
    $grand_total_balance = 0;
    if (!empty($cash_advance_lists)) {
        foreach ($cash_advance_lists as $cash_advance_list) { 
            $total_balance = ($cash_advance_list->advance_amount + $cash_advance_list->advance_extra_amount + $cash_advance_list->pay_over_allocation) - $cash_advance_list->advance_allocation;
            $grand_total_balance += $total_balance;
            $i++;
    ?>
        	<tr>
        		<td style="border: #000000 solid 1px;" align="center"><?=$i?></td>
				<td style="border: #000000 solid 1px;"><?=$cash_advance_list->advance_no?></td>
				<td style="border: #000000 solid 1px;width:10%"><?=date("d-m-Y H:i:s",strtotime($cash_advance_list->advance_date.' '.$cash_advance_list->time_created))?></td>
				<td style="border: #000000 solid 1px;"><?=$cash_advance_list->debtor_code?> - <?=$cash_advance_list->debtor_name?></td>
				<td style="border: #000000 solid 1px;"><?=$cash_advance_list->fare_trip_no == '' ? '-' : $cash_advance_list->fare_trip_no?></td>
                <td style="border: #000000 solid 1px;" align="center"><?=$cash_advance_list->police_no?></td>
                <td style="border: #000000 solid 1px;"><?=ucfirst($cash_advance_list->username)?></td>
                <td style="border: #000000 solid 1px;text-align: right;"><?= number_format($cash_advance_list->advance_amount);?></td>
				<td style="border: #000000 solid 1px;text-align: right;"><?= number_format($cash_advance_list->advance_extra_amount);?></td>
				<td style="border: #000000 solid 1px;text-align: right;"><?= number_format($cash_advance_list->pay_over_allocation);?></td>
				<td style="border: #000000 solid 1px;text-align: right;"><?= number_format($cash_advance_list->advance_allocation);?></td>
				<td style="border: #000000 solid 1px;text-align: right;"><?= number_format($total_balance);?></td>
        	</tr>
	<?php 
        }
        
    }
    
    if($i == 0){
    ?>
        <tr>
            <td colspan="12" align="center" style="border: #000000 solid 1px;">Data not available.</td>
        </tr>
    <?php
    }
    else{
    ?>
        <tr>
            <th colspan="11" align="right" style="border: #000000 solid 1px;">Total (Rp) &nbsp; </th>
            <th align="right" style="border: #000000 solid 1px;"><?= number_format($grand_total_balance);?></th>
        </tr>
    <?php        
    }
    ?>
</table>
</div>

</body>
</html>
