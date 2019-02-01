<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title><?=lang('receivable_employee')?> Reports</title>
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
    <span style="font-size: 16px;">LAPORAN REKAPITULASI PIUTANG <?=strtoupper($employee_type)?> (KAS BON)</span><br />
    Per <?=$str_until_date;?>
</div>
<div id="content">
<table width="100%" cellpadding="1" cellspacing="0">
	<tr>    
		<th width="3%" style="border-top: #000000 double 5px;border-bottom: #000000 solid 1px;border-left: #000000 solid 1px;">No</th>
		<th width="25%" style="border-top: #000000 double 5px;border-bottom: #000000 solid 1px;border-right: #000000 solid 1px;">Name</th>
		<th style="border-top: #000000 double 5px;border-bottom: #000000 solid 1px;">Cash Advance</th>
		<th style="border-top: #000000 double 5px;border-bottom: #000000 solid 1px;">Addendum</th>
		<th style="border-top: #000000 double 5px;border-bottom: #000000 solid 1px;">Realization</th>
		<th style="border-top: #000000 double 5px;border-bottom: #000000 solid 1px;">Refund</th>
		<th style="border-top: #000000 double 5px;border-bottom: #000000 solid 1px;border-right: #000000 solid 1px;">Saldo</th>		
	</tr>
	<?php 
    $i=1;
    $saldo_piutang = 0;
    $total_ca = 0;
    $total_rea = 0;
    $total_ref = 0;
    
    if(count($data_debtor) > 0){
    	foreach($data_debtor as $row){
           $debtor = $this->receivable_employee_model->get_debtor_by_id($row->rowID);
           $data_cash_adv = $this->receivable_employee_model->get_sum_data_cb_adv_by_debtor($row->rowID,$until_date);
           $data_addendum = $this->receivable_employee_model->get_sum_data_addendum_by_debtor($row->rowID,$until_date);
           $data_realization = $this->receivable_employee_model->get_sum_data_realization_by_debtor($row->rowID,$until_date);
           $data_refund = $this->receivable_employee_model->get_sum_data_refund_by_debtor($row->rowID,$until_date);
           
           $total_cash_adv = $data_cash_adv->total_amount;
           $addendum = $data_addendum->total_amount * -1;
           
           $total_ca += $total_cash_adv;
           $total_add += $addendum;
           $total_rea += $data_realization->total_amount;
           $total_ref += $data_refund->total_amount;
           $saldo_debtor = $total_cash_adv + $addendum - $data_realization->total_amount - $data_refund->total_amount;
           $saldo_piutang += $saldo_debtor;
           
    ?>
        	<tr>
        		<td align="center" style="border-left: #000000 solid 1px;"><?php echo number_format($i,0,',','.');?></td>
        		<td style="border-right: #000000 solid 1px;"><?=$debtor->type.$debtor->debtor_cd.' - '.ucwords(strtolower($debtor->debtor_name))?></td>
                <td align="right"><?=number_format($total_cash_adv,2,',','.')?></td>
                <td align="right"><?=number_format($addendum,2,',','.')?></td>
                <td align="right"><?=number_format($data_realization->total_amount,2,',','.')?></td>
                <td align="right"><?=number_format($data_refund->total_amount,2,',','.')?></td>
                <td align="right" style="border-right: #000000 solid 1px;"><?=number_format($saldo_debtor,2,',','.')?></td>
        	</tr>
	<?php 
            $i++;
        }
    }
    if(count($data_debtor) == 0){
    ?>
        <tr>
            <td colspan="7" align="center" style="border: #000000 solid 1px;">Data not available.</td>
        </tr>
    <?php
    }
    else{
    ?>
        <tr>
            <td colspan="2" align="right" style="border-bottom: #000000 double 5px;border-top: #000000 solid 1px;border-left: #000000 solid 1px;border-right: #000000 solid 1px;">Total (Rp) &nbsp; </td>
            <td align="right" style="border-bottom: #000000 double 5px;border-top: #000000 solid 1px;"><?=number_format($total_ca,2,',','.')?></td>
            <td align="right" style="border-bottom: #000000 double 5px;border-top: #000000 solid 1px;"><?=number_format($total_add,2,',','.')?></td>
            <td align="right" style="border-bottom: #000000 double 5px;border-top: #000000 solid 1px;"><?=number_format($total_rea,2,',','.')?></td>
            <td align="right" style="border-bottom: #000000 double 5px;border-top: #000000 solid 1px;"><?=number_format($total_ref,2,',','.')?></td>
            <td align="right" style="border-bottom: #000000 double 5px;border-top: #000000 solid 1px;border-right: #000000 solid 1px;"><?=number_format($saldo_piutang,2,',','.')?></td>
        </tr>
    <?php
    }
    ?>
</table>
</div>

</body>
</html>
