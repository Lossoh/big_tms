<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title><?=lang('trial_balance_report')?></title>
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
    <span style="font-size: 16px;">
        <?=strtoupper(lang('trial_balance_report'))?><br />
        <?=$per_end_date?><br />
    </span>
</div>
<div id="content">
<table width="100%" cellpadding="1" cellspacing="0">
	<tr>
        <th style="border: #000000 solid 1px;" width="3%" rowspan="2">No</th>
        <th style="border: #000000 solid 1px;" width="8%" rowspan="2">Account No</th>
        <th style="border: #000000 solid 1px;" rowspan="2">Account Name</th>
        <th style="border: #000000 solid 1px;" colspan="2">Beginning Balance</th>
        <th style="border: #000000 solid 1px;" colspan="2">Mutation</th>
        <th style="border: #000000 solid 1px;" colspan="2">Ending Balance</th>
    </tr>
    <tr>
        <th style="border: #000000 solid 1px;" width="10%">Debit (Rp)</th>
        <th style="border: #000000 solid 1px;" width="10%">Credit (Rp)</th>
        <th style="border: #000000 solid 1px;" width="10%">Debit (Rp)</th>
        <th style="border: #000000 solid 1px;" width="10%">Credit (Rp)</th>
        <th style="border: #000000 solid 1px;" width="10%">Debit (Rp)</th>
        <th style="border: #000000 solid 1px;" width="10%">Credit (Rp)</th>
    </tr>
	<?php 
    $no = 1;
    $total_balance_debit = 0;
    $total_balance_credit = 0;
    $total_debit = 0;
    $total_credit = 0;
    $grand_total_debit = 0;
    $grand_total_credit = 0;
    
    $start_date_tmp = date('Y-m-d',strtotime($start_date.' +1 days'));
    
    if(count($coas) > 0) {
        foreach($coas as $coa) {
            
            // START Beginning Balance
            $first_date = date('Y-m-d',strtotime($start_date_tmp.' first day of last month'));
            if($first_date == '2016-12-01'){
                $start_date = $start_date_tmp; //date('Y-m-d',strtotime($start_date.' +1 days'));
                $first_date = date('Y-m-d',strtotime('2017-01-01'));
                $last_date = date('Y-m-d',strtotime('2017-01-01'));
            }
            else{
                $first_date = date('Y-01-01',strtotime($first_date));
                $last_date = date('Y-m-t',strtotime($start_date_tmp.' last day of last month'));
            }
                        
            $value_balance_debit = 0;
            $value_balance_credit = 0;
            
            $get_balance_debit_trx = $this->trial_balance_report_model->get_sum_data_debit_by_row_id($coa->rowID,$first_date,$last_date);
            if(count($get_balance_debit_trx) > 0)
                $value_balance_debit = $get_balance_debit_trx->trx_amt;
            
            $get_balance_credit_trx = $this->trial_balance_report_model->get_sum_data_credit_by_row_id($coa->rowID,$first_date,$last_date);
            if(count($get_balance_credit_trx) > 0)
                $value_balance_credit = $get_balance_credit_trx->trx_amt;
            
            $balance = $value_balance_debit + $value_balance_credit;
            
            $total_balance_debit += $value_balance_debit;
            $total_balance_credit += $value_balance_credit;
            // END Beginning Balance
            
            // START Mutation
            $value_debit = 0;
            $value_credit = 0;           
            $get_data_debit_trx = $this->trial_balance_report_model->get_sum_data_debit_by_row_id($coa->rowID,$start_date,$end_date);
            if(count($get_data_debit_trx) > 0)
                $value_debit = $get_data_debit_trx->trx_amt;
            
            $get_data_credit_trx = $this->trial_balance_report_model->get_sum_data_credit_by_row_id($coa->rowID,$start_date,$end_date);
            if(count($get_data_credit_trx) > 0)
                $value_credit = $get_data_credit_trx->trx_amt;
            
            $total_debit += $value_debit;
            $total_credit += $value_credit;
            // END Mutation
            
            // START Ending Balance
            $value_total = $balance + $value_debit + $value_credit;
            
            $debit = 0;
            $credit = 0;
            if($coa->acc_debit_credit == 'debit'){
                $grand_total_debit += $value_total;
                $debit = $value_total;
            }
            else if($coa->acc_debit_credit == 'credit'){
                $grand_total_credit += $value_total;
                $credit = $value_total;
            }
            // END Ending Balance
            
    ?>
        	<tr>
        		<td style="border: #000000 solid 1px;" align="center"><?=number_format($no)?></td>
				<td style="border: #000000 solid 1px;"><?=$coa->acc_cd?></td>
				<td style="border: #000000 solid 1px;"><?=$coa->acc_name;?></td>
				<td style="border: #000000 solid 1px;font-weight: bold;" align="right"><?=number_format($value_balance_debit,2)?></td>
				<td style="border: #000000 solid 1px;" align="right"><?=number_format($value_balance_credit * -1,2)?></td>
				<td style="border: #000000 solid 1px;font-weight: bold;" align="right"><?=number_format($value_debit,2)?></td>
				<td style="border: #000000 solid 1px;" align="right"><?=number_format($value_credit * -1,2)?></td>
				<td style="border: #000000 solid 1px;font-weight: bold;" align="right"><?=number_format($debit,2)?></td>
				<td style="border: #000000 solid 1px;" align="right"><?=number_format($credit * -1,2)?></td>
        	</tr>
	<?php 
            $no++;
        }
    ?>
        <tr>
            <th style="border: #000000 solid 1px;" colspan="3" align="right">Total &nbsp; </th>
            <td style="border: #000000 solid 1px;font-weight: bold;" align="right"><?=number_format($total_balance_debit,2)?></td>
            <td style="border: #000000 solid 1px;" align="right"><?=number_format($total_balance_credit * -1,2)?></td>
            <td style="border: #000000 solid 1px;font-weight: bold;" align="right"><?=number_format($total_debit,2)?></td>
            <td style="border: #000000 solid 1px;" align="right"><?=number_format($total_credit * -1,2)?></td>
            <td style="border: #000000 solid 1px;font-weight: bold;" align="right"><?=number_format($grand_total_debit,2)?></td>
            <td style="border: #000000 solid 1px;" align="right"><?=number_format($grand_total_credit * -1,2)?></td>
        </tr>
    <?php
    }
    else{
    ?>
        <tr>
            <td colspan="9" align="center" style="border: #000000 solid 1px;">Data not available.</td>
        </tr>
    <?php
    }
    ?>
</table>
<p>&nbsp;</p>
</div>

</body>
</html>
