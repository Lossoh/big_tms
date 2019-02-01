<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title><?=lang('general_ledger_report')?> Report</title>
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
    <span style="font-size: 16px;"><?=strtoupper(lang('general_ledger_report').' Report')?></span><br />
</div>
<div id="content">
<table width="100%">
    <tr>
        <td width="50%" align="left">
            <b>COA Code : <?=$get_data_coa->acc_cd.' - '.$get_data_coa->acc_name?></b>             
        </td>
        <td width="50%" align="right">
            Period : <?=date('m-Y',strtotime($str_start_date)).' to '.date('m-Y',strtotime($str_end_date)).' ('.$str_start_date.' to '.$str_end_date.')';?>
        </td>
    </tr>
    <tr>
        <td align="left">
            <?php
            if($debtor_creditor_type == 'D'){                
                if($debtor_creditor_id == ""){
                    $str_debtor_creditor_type = "All Debitor";
                    $str_debtor_creditor_name = "";
                }
                else{
                    $str_debtor_creditor_type = "Debitor Name";
                    
                    $get_data_debtor = $this->general_ledger_report_model->get_data_by_row_id('sa_debtor',$debtor_creditor_id);
                    $str_debtor_creditor_name = " : ".$get_data_debtor->debtor_name;
                }
            }
            elseif($debtor_creditor_type == 'C'){
                if($debtor_creditor_id == ""){
                    $str_debtor_creditor_type = "All Creditor";
                    $str_debtor_creditor_name = "";
                }
                else{
                    $str_debtor_creditor_type = "Creditor Name";
                    
                    $get_data_creditor = $this->general_ledger_report_model->get_data_by_row_id('sa_creditor',$debtor_creditor_id);
                    $str_debtor_creditor_name = " : ".$get_data_creditor->creditor_name;
                }
            }
            else{
                $str_debtor_creditor_type = "All Debitor and Creditor";
                $str_debtor_creditor_name = "";
            }
            ?>
            <b><?=$str_debtor_creditor_type.$str_debtor_creditor_name?></b>             
        </td>
        <td align="right">&nbsp;</td>
    </tr>
</table>
<table width="100%" cellpadding="1" cellspacing="0">
	<tr>
        <th style="border: #000000 solid 1px;" width="3%">No</th>
        <th style="border: #000000 solid 1px;" width="7%"><?=lang('date')?></th>
        <th style="border: #000000 solid 1px;" colspan="3"><?=lang('description')?></th>
        <th style="border: #000000 solid 1px;" width="10%">Debit</th>
        <th style="border: #000000 solid 1px;" width="10%">Credit</th>
        <th style="border: #000000 solid 1px;" width="10%">Balance</th>
    </tr>
    <tr>
        <th style="border: #000000 solid 1px;" colspan="2"></th>
        <th style="border: #000000 solid 1px;">Starting Balance</th>
        <th style="border: #000000 solid 1px;" colspan="4"></th>
        <th style="border: #000000 solid 1px;" align="right"><?=number_format($balance,2)?></th>
    </tr>
	<?php 
    $i=0;
    $total_debit = 0;
    $total_credit = 0;
    $total_balance = $balance;
    
    if (!empty($general_ledgers)) {
        foreach ($general_ledgers as $general_ledger) { 
            $i++;
            $debit = 0;
            $credit = 0;
            
            if($general_ledger->trx_amt > 0){
                $debit = $general_ledger->trx_amt;                                                                      
                $coa_cd = substr($get_data_coa->acc_cd,0,1);
                if($coa_cd == '2' || $coa_cd == '3' || $coa_cd == '4'){
                    if(substr($get_data_coa->acc_cd,0,7) == '4.01.02' || substr($get_data_coa->acc_cd,0,7) == '5.01.02'){
                        $total_balance += $debit; 
                    }
                    else{
                        $total_balance -= $debit;
                    }                    
                }
                else{
                    $total_balance += $debit;
                }
                
            }
            else{
                $credit = $general_ledger->trx_amt * -1;             
                $coa_cd = substr($get_data_coa->acc_cd,0,1);
                if($coa_cd == '2' || $coa_cd == '3' || $coa_cd == '4'){
                    if(substr($get_data_coa->acc_cd,0,7) == '4.01.02' || substr($get_data_coa->acc_cd,0,7) == '5.01.02'){
                        $total_balance -= $credit;   
                    }
                    else{
                        $total_balance += $credit;
                    }                    
                }
                else{
                    $total_balance -= $credit;
                }       
            }
            
            $total_debit += $debit;
            $total_credit += $credit;
            
    ?>
        	<tr>
        		<td style="border: #000000 solid 1px;" align="center"><?=number_format($i)?></td>
				<td style="border: #000000 solid 1px;" align="center"><?=date('d-m-Y',strtotime($general_ledger->gl_trx_hdr_journal_date))?></td>
				<td style="border: #000000 solid 1px;" width="10%" align="center"><?=$general_ledger->gl_trx_hdr_journal_no?></td>
				<td style="border: #000000 solid 1px;"><?=$general_ledger->descs?></td>
				<td style="border: #000000 solid 1px;" width="10%" align="center"><?=$general_ledger->gl_trx_hdr_ref_no?></td>
				<td style="border: #000000 solid 1px;" align="right"><?=number_format($debit,2)?></td>
				<td style="border: #000000 solid 1px;" align="right"><?=number_format($credit,2)?></td>
				<td style="border: #000000 solid 1px;" align="right"><?=number_format($total_balance,2)?></td>
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
    else{
    ?>
        <tr>
            <td colspan="5" align="right" style="border: #000000 solid 1px;">Total (Rp) &nbsp; </td>
            <td align="right" style="border: #000000 solid 1px;"><?=number_format($total_debit,2)?></td>
            <td align="right" style="border: #000000 solid 1px;"><?=number_format($total_credit,2)?></td>
            <td align="right" style="border: #000000 solid 1px;"></td>
        </tr>
    <?php        
    }
    ?>
</table>
<p>&nbsp;</p>
</div>

</body>
</html>
