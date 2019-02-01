<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title><?=lang('account_payable_report')?> Report</title>
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
    <span style="font-size: 16px;"><?=strtoupper(lang('account_payable_report').' Report')?></span><br />
    Period : <?=$str_start_date.' to '.$str_end_date;?>
</div>
<div id="content">
<table width="100%">
    <tr>
        <td width="50%" align="left">
            <?php
            if(count($creditor) > 0){
                echo 'Creditor Name : <b>'.$creditor->creditor_name.'</b>';
            }
            ?>
        </td>
        <td width="50%" align="right">
            <?php
                echo 'Paid : <b>'.strtoupper(str_replace('_',' ',$status_paid)).'</b>';
            ?> 
        </td>
    </tr>
</table>
<table width="100%" cellpadding="3" cellspacing="0">
	<tr>
        <th style="border: #000000 solid 1px;" width="3%">No</th>
        <th style="border: #000000 solid 1px;" width="9%">AP No</th>
        <th style="border: #000000 solid 1px;" width="7%">AP <?=lang('date')?></th>
        <th style="border: #000000 solid 1px;">Creditor Name</th>
        <th style="border: #000000 solid 1px;" width="20%">Invoice No</th>
        <th style="border: #000000 solid 1px;" width="11%">AP Total (Rp)</th>
    </tr> 
    
	<?php
    $i=0;
    $total_account_payable = 0;
    $total_payment = 0;
    
    if (!empty($account_payables)) {
        foreach ($account_payables as $account_payable) {
            $get_data_cash_bank = $this->account_payable_report_model->get_data_cash_bank_by_account_payable_no($account_payable->trx_no);
            if(count($get_data_cash_bank) > 0){
                $show = false;
            }
            else{
                $show = true;
            }
            
            if($show == true){
                $i++;
                $total_account_payable += $account_payable->total_amt;
    ?>
            	<tr>
            		<td style="border: #000000 solid 1px;" align="center"><?=number_format($i)?></td>
    				<td style="border: #000000 solid 1px;"><?=$account_payable->trx_no?></td>
    				<td style="border: #000000 solid 1px;" align="center"><?=date("d-m-Y",strtotime($account_payable->trx_date))?></td>
    				<td style="border: #000000 solid 1px;"><?=$account_payable->creditor_name?></td>
    				<td style="border: #000000 solid 1px;"><?=$account_payable->ref_no?></td>
    				<td style="border: #000000 solid 1px;" align="right"><?=number_format($account_payable->total_amt,2)?></td>
            	</tr>
	<?php 
            }
        }
        
    }
    
    if($i == 0){
    ?>
        <tr>
            <td colspan="6" align="center" style="border: #000000 solid 1px;">Data not available.</td>
        </tr>
    <?php
    }
    else{
    ?>
        <tr>
            <td colspan="5" align="right" style="border: #000000 solid 1px;">Total &nbsp; </td>
            <td align="right" style="border: #000000 solid 1px;"><?=number_format($total_account_payable,2)?></td>
        </tr>        
    <?php
    }
    ?>
</table>
</div>

</body>
</html>
