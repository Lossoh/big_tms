<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>
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

<div id="header">
    <h2><?php echo lang('cash_advance_deleted'); ?></h2>
    <?=lang('periode')." : <b>".$periode."</b>"?>
</div>

<div id="content" style="text-align:center;">
<table width="100%" border="1" align="center" cellpadding="1" cellspacing="0">
	<tr>
		<th>No</th>
        <th><?=lang('cash_advance_no')?></th>
		<th>CA <?=lang('date')?></th>
		<th><?=lang('driver')?>/<?=lang('employee')?> Name</th>
		<th><?=lang('fare_trip_code')?></th>
        <th width="10%">Police No</th>
		<th><?=lang('cash_advance_amt')?></th>
		<th><?=lang('extra_amount')?></th>
		<th>Addendum</th>
		<th><?=lang('cash_advance_alloc')?></th>
		<th><?=lang('balance')?></th>
	</tr>
    <?php
    if (!empty($cash_advance_lists)) {
    $no = 1;
    foreach ($cash_advance_lists as $cash_advance_list) { 
        $total_balance = ($cash_advance_list->advance_amount + $cash_advance_list->advance_extra_amount + $cash_advance_list->pay_over_allocation) - $cash_advance_list->advance_allocation;
    ?>
        <tr>
            <td align="center"><?=number_format($no++)?></td>	
            <td><?=$cash_advance_list->advance_no?></td>
        	<td style="width:10%"><?=date("d-m-Y H:i:s",strtotime($cash_advance_list->advance_date.' '.$cash_advance_list->time_created))?></td>
        	<td><?=$cash_advance_list->debtor_code?> - <?=$cash_advance_list->debtor_name?></td>
        	<td><?=$cash_advance_list->fare_trip_no == '' ? '-' : $cash_advance_list->fare_trip_no?></td>
            <td align="center"><?=empty($cash_advance_list->police_no) ? '-' : $cash_advance_list->police_no.' '.$star?></td>
        	<td style="text-align: right;"><?= number_format($cash_advance_list->advance_amount);?></td>
        	<td style="text-align: right;"><?= number_format($cash_advance_list->advance_extra_amount);?></td>
        	<td style="text-align: right;"><?= number_format($cash_advance_list->pay_over_allocation);?></td>
        	<td style="text-align: right;"><?= number_format($cash_advance_list->advance_allocation);?></td>
        	<td style="text-align: right;"><?= number_format($total_balance);?></td>
        </tr>
    <?php 
        } 
    } 
    else{
    ?>
        <tr style="font-size:9px">
		  <td align="center" colspan="11">No Data Available</td>
        </tr>
    <?php
    }
    ?>
</table>
</div>

</body>
</html>
