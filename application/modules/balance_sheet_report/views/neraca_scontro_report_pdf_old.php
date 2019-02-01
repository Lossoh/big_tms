<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Neraca Scontro Report</title>
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
    <span style="font-size: 16px;">Neraca</span><br />
</div>
<div id="content">
Period : <?=date('m-Y',strtotime($str_start_date)).' ('.$str_start_date.' to '.$str_end_date.')';?> <br />
<table width="100%" cellpadding="1" cellspacing="0">
	<tr>
        <th style="border: #000000 solid 1px;" width="11%">GL Code</th>
        <th style="border: #000000 solid 1px;" width="29%">Description</th>
        <th style="border: #000000 solid 1px;" width="15%">Starting Balance</th>
        <th style="border: #000000 solid 1px;" width="15%">Debit</th>
        <th style="border: #000000 solid 1px;" width="15%">Credit</th>
        <th style="border: #000000 solid 1px;" width="15%">Remaining Balance</th>
    </tr>
	<?php 
    $i = 0;
    $i_sn = 0;
    $i_tn = 0;
    $subtotal_name = array('SUBTOTAL KAS & BANK', 'SUBTOTAL PIUTANG USAHA', 'SUBTOTAL PIUTANG LAIN-LAIN', 'SUBTOTAL UANG MUKA', 'SUBTOTAL PAJAK', 'SUBTOTAL 
                            NILAI PEROLEHAN', 'SUBTOTAL AKUMULASI PENYUSUTAN', 'SUBTOTAL UANG MUKA ASET', 'AKTIVA LAINNYA', 'SUBTOTAL HUTANG OUTSTANDING CEK', 
                            'SUBTOTAL HUTANG SUPPLIER', 'SUBTOTAL HUTANG PAJAK', 'SUBTOTAL HUTANG UANG MUKA', 'SUBTOTAL BIAYA YANG MASIH HARUS DIBAYAR', 'SUBTOTAL HUTANG 
                            PIHAK KETIGA', 'SUBTOTAL HUTANG BANK', 'SUBTOTAL HUTANG LAIN-LAIN', 'SUBTOTAL HUTANG INTERNAL', 'SUBTOTAL HUTANG SUPIR', 'TOTAL MODAL');
    $total_name = array('TOTAL AKTIVA LANCAR', 'TOTAL AKTIVA TETAP', 'TOTAL AKTIVA LAIN-LAIN', 'TOTAL HUTANG USAHA', 'TOTAL KEWAJIBAN LANCAR', 'TOTAL KEWAJIBAN 
                        JANGKA PANJANG', 'TOTAL KEWAJIBAN LAIN-LAIN');
    
    $subtotal_starting_balance = 0;
    $subtotal_debit = 0;
    $subtotal_credit = 0;
    $subtotal_remaining_balance = $balance;

    $total_starting_balance = 0;
    $total_debit = 0;
    $total_credit = 0;
    $total_remaining_balance = 0;
    
    $grandtotal_starting_balance = 0;
    $grandtotal_debit = 0;
    $grandtotal_credit = 0;
    $grandtotal_remaining_balance = 0;
    
    $grandtotal_pasiva_starting_balance = 0;
    $grandtotal_pasiva_remaining_balance = 0;
    
    if (!empty($coas)) {
        foreach ($coas as $coa) { 
            $i++;
            if($coa->acc_condition > 0){
                if($first_date == '2016-12-01'){                    
                    $starting_balance = $this->balance_sheet_report_model->get_data_saldo_gl_by_coa($coa->rowID,'2017-01-01','2017-01-01')->total_saldo;
                    $debit = $this->balance_sheet_report_model->get_data_debit_gl_by_coa($coa->rowID,'2017-01-02',$end_date)->total_debit;
                    $credit = $this->balance_sheet_report_model->get_data_credit_gl_by_coa($coa->rowID,'2017-01-02',$end_date)->total_credit * -1;
                }
                else{
                    if($first_date == '2017-01-01'){
                        $last_date = date('Y-m-t',strtotime($start_date.' last day of last month'));

                        $starting_balance = $this->balance_sheet_report_model->get_data_saldo_gl_by_coa($coa->rowID,'2017-01-02',$last_date)->total_saldo;
                        $debit = $this->balance_sheet_report_model->get_data_debit_gl_by_coa($coa->rowID,$start_date,$end_date)->total_debit;
                        $credit = $this->balance_sheet_report_model->get_data_credit_gl_by_coa($coa->rowID,$start_date,$end_date)->total_credit * -1;
                    }
                    else{
                        if(date('m',strtotime($first_date)) == 12){
                            if($first_date == '2017-12-01'){
                                $first_date = date('Y-01-02',strtotime($first_date));                                    
                            }
                            else{
                                $first_date = date('Y-01-d',strtotime($first_date));
                            }
                        }
                        
                        $last_date = date('Y-m-t',strtotime($start_date.' last day of last month'));
                        
                        $starting_balance = $this->balance_sheet_report_model->get_data_saldo_gl_by_coa($coa->rowID,$first_date,$last_date)->total_saldo;
                        $debit = $this->balance_sheet_report_model->get_data_debit_gl_by_coa($coa->rowID,$start_date,$end_date)->total_debit;
                        $credit = $this->balance_sheet_report_model->get_data_credit_gl_by_coa($coa->rowID,$start_date,$end_date)->total_credit * -1;
                    }
                }
                
                
                
                if(substr($coa->acc_cd,0,1) == '1'){
                    $remaining_balance = $starting_balance + $debit - $credit;                    
                }
                else{
                    $starting_balance = $starting_balance * -1;
                    $remaining_balance = $starting_balance - $debit - $credit;
                }
                
                
                $subtotal_starting_balance += $starting_balance;
                $subtotal_debit += $debit;
                $subtotal_credit += $credit;
                $subtotal_remaining_balance += $remaining_balance;
                
                $total_starting_balance += $starting_balance;
                $total_debit += $debit;
                $total_credit += $credit;
                $total_remaining_balance += $remaining_balance;
                
                if($coa->rowID == 61 || $coa->rowID == 62 || $coa->rowID == 63 || $coa->rowID == 64 || $coa->rowID == 65 || $coa->rowID == 66 || $coa->rowID == 67){
                    $grandtotal_starting_balance -= $starting_balance;
                    $grandtotal_debit -= $debit;
                    $grandtotal_credit -= $credit;
                    $grandtotal_remaining_balance -= $remaining_balance;                    
                }
                else{
                    $grandtotal_starting_balance += $starting_balance;
                    $grandtotal_debit += $debit;
                    $grandtotal_credit += $credit;
                    $grandtotal_remaining_balance += $remaining_balance;
                }
                
                $padding = 'padding-left:20px';
            }
            else{
                $starting_balance = 0;
                $debit = 0;
                $credit = 0;
                $remaining_balance = 0;
                $padding = '';
            }
    ?>
        	<tr>
        		<td style="border: #000000 solid 1px;" align="left"><?=$coa->acc_cd?></td>
				<td style="border: #000000 solid 1px;<?=$padding?>" align="left"><?=$coa->acc_name?></td>
				<?php
                if($coa->acc_condition > 0){
                ?>
                    <td style="border: #000000 solid 1px;" align="right"><?=$starting_balance >= 0 ? number_format($starting_balance,2) : '('.number_format($starting_balance * -1,2).')'?></td>
    				<td style="border: #000000 solid 1px;" align="right"><?=$debit >= 0 ? number_format($debit,2) : '('.number_format($debit * -1,2).')'?></td>
    				<td style="border: #000000 solid 1px;" align="right"><?=$credit >= 0 ? number_format($credit,2) : '('.number_format($credit * -1,2).')'?></td>
    				<td style="border: #000000 solid 1px;" align="right"><?=$remaining_balance >= 0 ? number_format($remaining_balance,2) : '('.number_format($remaining_balance * -1,2).')'?></td>
                <?php
                }
                else{
                ?>
                    <td style="border: #000000 solid 1px;" align="right"></td>
    				<td style="border: #000000 solid 1px;" align="right"></td>
    				<td style="border: #000000 solid 1px;" align="right"></td>
    				<td style="border: #000000 solid 1px;" align="right"></td>
                <?php                    
                }
                ?>
        	</tr>
	<?php 
            if($coa->acc_condition == 2){
                $subtotal_name_tmp = $subtotal_name[$i_sn];
                $i_sn++;
    ?>
                <tr>
                    <th colspan="2" align="right" style="border: #000000 solid 1px;height: 25px;"><?=$subtotal_name_tmp?> (Rp) &nbsp; </th>
                    <th align="right" style="border: #000000 solid 1px;height: 25px;"><?=$subtotal_starting_balance >= 0 ? number_format($subtotal_starting_balance,2) : '('.number_format($subtotal_starting_balance * -1,2).')'?></th>
                    <th align="right" style="border: #000000 solid 1px;height: 25px;"><?=$subtotal_debit >= 0 ? number_format($subtotal_debit,2) : '('.number_format($subtotal_debit * -1,2).')'?></th>
                    <th align="right" style="border: #000000 solid 1px;height: 25px;"><?=$subtotal_credit >= 0 ? number_format($subtotal_credit,2) : '('.number_format($subtotal_credit * -1,2).')'?></th>
                    <th align="right" style="border: #000000 solid 1px;height: 25px;"><?=$subtotal_remaining_balance >= 0 ? number_format($subtotal_remaining_balance,2) : '('.number_format($subtotal_remaining_balance * -1,2).')'?></th>
                </tr>
    <?php       
                if($subtotal_name_tmp == 'TOTAL MODAL'){
    ?>
                <tr>
                    <th colspan="2" align="right" style="border: #000000 solid 1px;height: 25px;">GRAND TOTAL PASIVA (Rp) &nbsp; </th>
                    <th align="right" style="border: #000000 solid 1px;height: 25px;"><?=$grandtotal_pasiva_starting_balance >= 0 ? number_format($grandtotal_pasiva_starting_balance,2) : '('.number_format($grandtotal_pasiva_starting_balance * -1,2).')'?></th>
                    <th align="right" style="border: #000000 solid 1px;height: 25px;"></th>
                    <th align="right" style="border: #000000 solid 1px;height: 25px;"></th>
                    <th align="right" style="border: #000000 solid 1px;height: 25px;"><?=$grandtotal_pasiva_remaining_balance >= 0 ? number_format($grandtotal_pasiva_remaining_balance,2) : '('.number_format($grandtotal_pasiva_remaining_balance * -1,2).')'?></th>
                </tr>
    <?php
                    $grandtotal_pasiva_starting_balance = 0;
                    $grandtotal_pasiva_remaining_balance = 0;
                    
                    $grandtotal_starting_balance = 0;
                    $grandtotal_debit = 0;
                    $grandtotal_credit = 0;
                    $grandtotal_remaining_balance = 0;
                }
                
                $subtotal_starting_balance = 0;
                $subtotal_debit = 0;
                $subtotal_credit = 0;
                $subtotal_remaining_balance = 0;
            }
            else if($coa->acc_condition == 3){
                $subtotal_name_tmp = $subtotal_name[$i_sn];
                $i_sn++;
                
                $total_name_tmp = $total_name[$i_tn];
                $i_tn++;
    ?>
                <tr>
                    <th colspan="2" align="right" style="border: #000000 solid 1px;height: 25px;"><?=$subtotal_name_tmp?> (Rp) &nbsp; </th>
                    <th align="right" style="border: #000000 solid 1px;height: 25px;"><?=$subtotal_starting_balance >= 0 ? number_format($subtotal_starting_balance,2) : '('.number_format($subtotal_starting_balance * -1,2).')'?></th>
                    <th align="right" style="border: #000000 solid 1px;height: 25px;"><?=$subtotal_debit >= 0 ? number_format($subtotal_debit,2) : '('.number_format($subtotal_debit * -1,2).')'?></th>
                    <th align="right" style="border: #000000 solid 1px;height: 25px;"><?=$subtotal_credit >= 0 ? number_format($subtotal_credit,2) : '('.number_format($subtotal_credit * -1,2).')'?></th>
                    <th align="right" style="border: #000000 solid 1px;height: 25px;"><?=$subtotal_remaining_balance >= 0 ? number_format($subtotal_remaining_balance,2) : '('.number_format($subtotal_remaining_balance * -1,2).')'?></th>
                </tr>
                <tr>
                    <th colspan="2" align="right" style="border: #000000 solid 1px;height: 25px;"><?=$total_name_tmp?> (Rp) &nbsp; </th>
                    <th align="right" style="border: #000000 solid 1px;height: 25px;"><?=$total_starting_balance >= 0 ? number_format($total_starting_balance,2) : '('.number_format($total_starting_balance * -1,2).')'?></th>
                    <th align="right" style="border: #000000 solid 1px;height: 25px;"><?=$total_debit >= 0 ? number_format($total_debit,2) : '('.number_format($total_debit * -1,2).')'?></th>
                    <th align="right" style="border: #000000 solid 1px;height: 25px;"><?=$total_credit >= 0 ? number_format($total_credit,2) : '('.number_format($total_credit * -1,2).')'?></th>
                    <th align="right" style="border: #000000 solid 1px;height: 25px;"><?=$total_remaining_balance >= 0 ? number_format($total_remaining_balance,2) : '('.number_format($total_remaining_balance * -1,2).')'?></th>
                </tr>
    <?php
                if($total_name_tmp == 'TOTAL AKTIVA LAIN-LAIN'){
    ?>
                <tr>
                    <th colspan="2" align="right" style="border: #000000 solid 1px;height: 25px;">GRAND TOTAL AKTIVA (Rp) &nbsp; </th>
                    <th align="right" style="border: #000000 solid 1px;height: 25px;"><?=$grandtotal_starting_balance >= 0 ? number_format($grandtotal_starting_balance,2) : '('.number_format($grandtotal_starting_balance * -1,2).')'?></th>
                    <th align="right" style="border: #000000 solid 1px;height: 25px;"><?=$grandtotal_debit >= 0 ? number_format($grandtotal_debit,2) : '('.number_format($grandtotal_debit * -1,2).')'?></th>
                    <th align="right" style="border: #000000 solid 1px;height: 25px;"><?=$grandtotal_credit >= 0 ? number_format($grandtotal_credit,2) : '('.number_format($grandtotal_credit * -1,2).')'?></th>
                    <th align="right" style="border: #000000 solid 1px;height: 25px;"><?=$grandtotal_remaining_balance >= 0 ? number_format($grandtotal_remaining_balance,2) : '('.number_format($grandtotal_remaining_balance * -1,2).')'?></th>
                </tr>
    <?php
                    $grandtotal_pasiva_starting_balance += $grandtotal_starting_balance;
                    $grandtotal_pasiva_remaining_balance += $grandtotal_remaining_balance;

                    $grandtotal_starting_balance = 0;
                    $grandtotal_debit = 0;
                    $grandtotal_credit = 0;
                    $grandtotal_remaining_balance = 0;
                }
                else if($total_name_tmp == 'TOTAL KEWAJIBAN LAIN-LAIN'){
    ?>
                <tr>
                    <th colspan="2" align="right" style="border: #000000 solid 1px;height: 25px;">GRAND TOTAL KEWAJIBAN (Rp) &nbsp; </th>
                    <th align="right" style="border: #000000 solid 1px;height: 25px;"><?=$grandtotal_starting_balance >= 0 ? number_format($grandtotal_starting_balance,2) : '('.number_format($grandtotal_starting_balance * -1,2).')'?></th>
                    <th align="right" style="border: #000000 solid 1px;height: 25px;"><?=$grandtotal_debit >= 0 ? number_format($grandtotal_debit,2) : '('.number_format($grandtotal_debit * -1,2).')'?></th>
                    <th align="right" style="border: #000000 solid 1px;height: 25px;"><?=$grandtotal_credit >= 0 ? number_format($grandtotal_credit,2) : '('.number_format($grandtotal_credit * -1,2).')'?></th>
                    <th align="right" style="border: #000000 solid 1px;height: 25px;"><?=$grandtotal_remaining_balance >= 0 ? number_format($grandtotal_remaining_balance,2) : '('.number_format($grandtotal_remaining_balance * -1,2).')'?></th>
                </tr>
    <?php
                    $grandtotal_pasiva_starting_balance -= $grandtotal_starting_balance;
                    $grandtotal_pasiva_remaining_balance -= $grandtotal_remaining_balance;

                    $grandtotal_starting_balance = 0;
                    $grandtotal_debit = 0;
                    $grandtotal_credit = 0;
                    $grandtotal_remaining_balance = 0;
                }
                
                $subtotal_starting_balance = 0;
                $subtotal_debit = 0;
                $subtotal_credit = 0;
                $subtotal_remaining_balance = 0;

                $total_starting_balance = 0;
                $total_debit = 0;
                $total_credit = 0;
                $total_remaining_balance = 0;

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
    ?>
</table>
<p>&nbsp;</p>
</div>

</body>
</html>
