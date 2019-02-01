<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title><?=lang('deposit_report')?></title>
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
    <span style="font-size: 16px;">
        <?=strtoupper(lang('deposit_report'))?><br />
        <?=$year?><br />
    </span>
    Period : <?=$start_period.' to '.$end_period;?>
</div>
<div id="content">
<table width="100%" cellpadding="3" cellspacing="0">
	<tr>
        <th style="border: #000000 solid 1px;" width="3%">No</th>
        <th style="border: #000000 solid 1px;">Driver Name</th>
        <th style="border: #000000 solid 1px;" width="15%">Driver Comm (Rp)</th>
        <th style="border: #000000 solid 1px;" width="15%">Co Driver Comm (Rp)</th>
        <th style="border: #000000 solid 1px;" width="15%">Deposit (Rp)</th>
        <th style="border: #000000 solid 1px;" width="15%">Max Saldo Loan (Rp)</th>
        <th style="border: #000000 solid 1px;" width="15%">Amount Loan (Rp)</th>
    </tr>  
	<?php 
    $i=0;
        
    if (!empty($deposit_list)) {
        foreach ($deposit_list as $row) { 
            $i++;                                    
    ?>
        	<tr>
        		<td style="border: #000000 solid 1px;" align="center"><?=number_format($i)?></td>
                <td style="border: #000000 solid 1px;"><?=$row->debtor_name?></td>
                <td style="text-align: right;border: #000000 solid 1px;"><?=number_format($row->driver_commission,0,',','.')?></td>
				<td style="text-align: right;border: #000000 solid 1px;"><?=number_format($row->co_driver_commission,0,',','.')?></td>
				<td style="text-align: right;border: #000000 solid 1px;"><?=number_format($row->amount_deposit,0,',','.')?></td>
				<td style="text-align: right;border: #000000 solid 1px;"><?=number_format($row->max_saldo_loan,0,',','.')?></td>
				<td style="text-align: right;border: #000000 solid 1px;"><?=number_format($row->amount_loan,0,',','.')?></td>				
        	</tr>
	<?php 
        }
        
    }
    
    if($i == 0){
    ?>
        <tr>
            <td colspan="7" align="center" style="border: #000000 solid 1px;">Data not available.</td>
        </tr>
    <?php
    }
    ?>
</table>
</div>

</body>
</html>
