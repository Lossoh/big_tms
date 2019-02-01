<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title><?php echo lang('cash_bank_payment_branch'); ?></title>
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

<table width="100%" cellpadding="2" cellspacing="0">
    <tr>
        <td width="50%" align="left"><?=$this->config->item('comp_name')?></td>
        <td width="50%" align="right">Print Date Time : <?=date('d F Y H:i:s')?> </td>
    </tr>
</table>

<div id="header">
    <h2><?php echo lang('cash_bank_payment_branch'); ?></h2>
    <?=lang('periode')." : <b>".$periode."</b>"?>
</div>
<br />

<div id="content" style="text-align:center;">
<table width="100%" border="1" align="center" cellpadding="1" cellspacing="0">
	<tr >
    
		<th>No</th>
		<th>Payment No</th>
		<th>Payment Date</th>
        <th>Payment Type</th>
		<th>Cash/Bank</th>
		<th>Remark</th>
        <th>Pay to</th>
        <th>Amount</th>
	</tr>
	<?php 
    $i=1;
    if(!empty($cash_banks)){
    	foreach($cash_banks as $val){
    	    
            if($val->payment_type == 'P')
                $payment_type = 'Payment';
            elseif($val->payment_type == 'R')
                $payment_type = 'Receive';
            else
                $payment_type = '-';
                
            $nama_pay_to = '-';
            if($val->debtor_creditor_type == 'D'){
                $get_nama = $this->cash_bank_payment_branch_model->get_by_id_table('sa_debtor',$val->debtor_creditor_rowID);
                $nama_pay_to = $get_nama->debtor_name == '' ? '-' : $get_nama->debtor_name;
            }
            else if($val->debtor_creditor_type == 'C'){
                $get_nama = $this->cash_bank_payment_branch_model->get_by_id_table('sa_creditor',$val->debtor_creditor_rowID);
                $nama_pay_to = $get_nama->creditor_name == '' ? '-' : $get_nama->creditor_name;                            
            }
            else if($val->debtor_creditor_type == 'G'){
                if($val->manual_debtor_creditor_type == 'D' || $val->manual_debtor_creditor_type == 'E'){ 
                    $get_nama = $this->cash_bank_payment_branch_model->get_by_id_table('sa_debtor',$val->debtor_creditor_rowID);
                    $nama_pay_to = $get_nama->debtor_name == '' ? '-' : strtoupper($get_nama->debtor_name);
                }
                else{
                    $nama_pay_to = $val->manual_debtor_creditor;                            
                }
            }

	?>
	<tr style="font-size:9px">
		<td align="center"><?= $i++;?></td>
		<td><?= $val->trx_no;?></td>
		<td><?= date("d F Y",strtotime($val->trx_date));?></td>
		<td><?= $payment_type;?></td>
        <td><?=$val->cash_bank == '' ? '-' : $val->cash_bank?></td>
		<td><?=$val->descs == '' ? '-' : strtoupper($val->descs)?></td>                        
		<td><?= $nama_pay_to?></td>
		<td align="right"><?= number_format($val->trx_amt,2);?></td>
	</tr>
	<?php 
        }
    }
    else{
    ?>
        <tr style="font-size:9px">
		  <td align="center" colspan="8">No Data Available</td>
        </tr>
    <?php
    }
    ?>
</table>
</div>
</body>
</html>
