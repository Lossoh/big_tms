<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title><?=lang('do_commission_report')?> Report</title>
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
    <span style="font-size: 16px;"><?=strtoupper(lang('do_commission_report').' Report')?></span><br />
    Period : <?=$str_start_date.' to '.$str_end_date;?>
</div>
<div id="content">
Driver : <b><?=$driver_name?></b>
<br />
<table width="100%" cellpadding="3" cellspacing="0">
	<tr>
        <th style="border: #000000 solid 1px;" width="3%">No</th>
        <th style="border: #000000 solid 1px;"><?=lang('driver')?>/<?=lang('employee')?> Name</th>
        <th style="border: #000000 solid 1px;" width="9%">Realization No</th>
        <th style="border: #000000 solid 1px;" width="9%">JO No</th>
        <th style="border: #000000 solid 1px;" width="14%">Vessel Name</th>
        <th style="border: #000000 solid 1px;" width="14%">From - To</th>
        <th style="border: #000000 solid 1px;" width="12%">Cargo</th>
        <th style="border: #000000 solid 1px;" width="10%"><?=lang('delivery_order_no')?></th>
        <th style="border: #000000 solid 1px;" width="8%">Receive Date</th>
        <th style="border: #000000 solid 1px;" width="5%">Tonase Receive</th>
        <th style="border: #000000 solid 1px;" width="7%">Commission No</th>
    </tr>  
	<?php 
    $i=0;
        
    if (!empty($list_do)) {
        foreach ($list_do as $do) { 
            $i++;
    ?>
        	<tr>
        		<td style="border: #000000 solid 1px;" align="center"><?=number_format($i)?></td>
				<td style="border: #000000 solid 1px;"><?=$do->debtor_name?></td>
				<td style="border: #000000 solid 1px;" align="center"><?=$do->trx_no?></td>
				<td style="border: #000000 solid 1px;" align="center"><?=$do->jo_no?></td>
				<td style="border: #000000 solid 1px;" align="left"><?=$do->vessel_name?></td>
				<td style="border: #000000 solid 1px;" align="left"><?=$do->from_name.' - '.$do->to_name?></td>
				<td style="border: #000000 solid 1px;" align="left"><?=$do->item_name?></td>
				<td style="border: #000000 solid 1px;" align="left"><?=$do->do_no?></td>
				<td style="border: #000000 solid 1px;" align="center"><?=date("d-m-Y",strtotime($do->received_date))?></td>
				<td style="border: #000000 solid 1px;" align="left"><?=number_format($do->received_weight)?></td>
				<td style="border: #000000 solid 1px;" align="center"><?=$do->commission_no == '' ? '-' : $do->commission_no?></td>
        	</tr>
	<?php 
        }
        
    }
    
    if($i == 0){
    ?>
        <tr>
            <td colspan="11" align="center" style="border: #000000 solid 1px;">Data not available.</td>
        </tr>
    <?php
    }
    ?>
</table>
</div>

</body>
</html>
