<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title><?=lang('cheque_giro_report')?></title>
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
<div id="header">
    <span style="font-size: 16px;"><?=strtoupper(lang('cheque_giro_report'))?></span><br />
    <span style="font-size: 12px;"><?=$per_end_date?></span><br />
</div>
<b>Status : <?=ucwords($status)?></b>
<div id="content">
<table width="100%" cellpadding="1" cellspacing="0">
	<tr>
        <th style="border: #000000 solid 1px;" width="3%">No</th>
        <th style="border: #000000 solid 1px;" width="10%">Payment/Receive No</th>
        <th style="border: #000000 solid 1px;" width="10%">Payment/Receive Date</th>
        <th style="border: #000000 solid 1px;" width="6%">Type</th>
        <th style="border: #000000 solid 1px;" width="6%">Payment Type</th>
        <th style="border: #000000 solid 1px;" width="6%">Payment Method</th>
        <th style="border: #000000 solid 1px;" width="13%">Cash Bank</th>
        <th style="border: #000000 solid 1px;">Remark</th>
        <th style="border: #000000 solid 1px;" width="12%">Payment To / Receive From</th>
        <th style="border: #000000 solid 1px;" width="10%">Amount (Rp)</th>
    </tr>
	<?php 
    $no = 1;
    
    if(count($data_cheque_giro) > 0) {
        foreach($data_cheque_giro as $row) {
            if($row->payment_type == 'P')
                $payment_type = 'Payment';
            elseif($row->payment_type == 'R')
                $payment_type = 'Receive';
            else
                $payment_type = '-';
            
            $name_pay_to = '-';
            if($row->debtor_creditor_type == 'D'){
                $get_nama = $this->cheque_giro_report_model->get_data_by_row_id('sa_debtor',$row->debtor_creditor_rowID);
                $name_pay_to = $get_nama->debtor_name == '' ? '-' : $get_nama->debtor_name;
            }
            else if($row->debtor_creditor_type == 'C'){
                $get_nama = $this->cheque_giro_report_model->get_data_by_row_id('sa_creditor',$row->debtor_creditor_rowID);
                $name_pay_to = $get_nama->creditor_name == '' ? '-' : $get_nama->creditor_name;                            
            }
            else if($row->debtor_creditor_type == 'G'){
                if($row->manual_debtor_creditor_type == 'D' || $row->manual_debtor_creditor_type == 'E'){ 
                    $get_nama = $this->cheque_giro_report_model->get_data_by_row_id('sa_debtor',$row->debtor_creditor_rowID);
                    $name_pay_to = $get_nama->debtor_name == '' ? '-' : ucwords(strtolower($get_nama->debtor_name));
                }
                else{
                    $name_pay_to = $row->manual_debtor_creditor;                            
                }
            }
    ?>
        	<tr>
        		<td style="border: #000000 solid 1px;" align="center"><?=number_format($no)?></td>
				<td style="border: #000000 solid 1px;"><?=$row->trx_no?></td>
				<td style="border: #000000 solid 1px;" align="center"><?=date('d-m-Y',strtotime($row->trx_date))?></td>
				<td style="border: #000000 solid 1px;"><?=$payment_type?></td>
				<td style="border: #000000 solid 1px;"><?=ucwords($row->transaction_type)?></td>
				<td style="border: #000000 solid 1px;"><?=ucwords($row->payment_method)?></td>
				<td style="border: #000000 solid 1px;"><?=$row->acc_name?></td>
				<td style="border: #000000 solid 1px;"><?=$row->descs == '' ? '-' : $row->descs?></td>
				<td style="border: #000000 solid 1px;"><?=$name_pay_to?></td>
				<td style="border: #000000 solid 1px;" align="right"><?=number_format($row->cg_amt,2)?></td>
        	</tr>
            
	<?php 
            $no++;
        }
    }
    else{
    ?>
        <tr>
            <td colspan="8" align="center" style="border: #000000 solid 1px;">Data not available.</td>
        </tr>
    <?php
    }
    ?>
</table>
<p>&nbsp;</p>
</div>

</body>
</html>
