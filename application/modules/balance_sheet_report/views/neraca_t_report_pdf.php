<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Neraca T Report</title>
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
	@page { margin: 0px 10px 0px 10px; }
     
    #header { left: 0px; top: 0px; right: 0px; text-align: center;  }
    #footer { left: 0px; bottom: 0px; right: 0px; font-size: 11px; font-family: sans-serif; text-align:right; }
	#content{
	   border-bottom:0px solid #000000;
       margin-top: 10px;
	}
    #footer .page:after { content: counter(page, upper-roman); }
	#content{
	background-color:#FFFFFF;
	}
</style>
<?php  
$month_name = array('JANUARI', 'FEBRUARI', 'MARET', 'APRIL', 'MEI', 'JUNI', 'JULI', 'AGUSTUS', 'SEPTEMBER', 'OKTOBER', 'NOVEMBER', 'DESEMBER');
$date = date('d',strtotime($str_end_date));
$month = date('m',strtotime($str_end_date));
$year = date('Y',strtotime($str_end_date));
$period = strtoupper($date.' '.$month_name[$month-1].' '.$year);
?>
<table width="100%" cellpadding="2" cellspacing="0">
    <tr>
        <td width="50%" align="left">&nbsp;</td>
        <td width="50%" align="right">Waktu Cetak : <?=date('d F Y H:i:s')?> </td>
    </tr>
</table>
<div id="header">
    <span style="font-size: 14px;"><?=$this->config->item('comp_name')?></span><br />
    <span style="font-size: 16px;">NERACA</span><br />
    <span style="font-size: 14px;"><?=$period?></span>
</div>
<div id="content">
<br />
<table width="100%" cellpadding="10" cellspacing="0">
    <tr>
        <td width="50%" valign="top" style="border-top: #000 2px solid;border-right: #000 2px solid;">
            <table width="100%" cellpadding="0" cellspacing="0">
	<?php 
    $i = 0;
    $i_sn = 0;
    $i_tn = 0;
    $subtotal_name = array('KAS & BANK', 'PIUTANG USAHA', 'PIUTANG LAIN-LAIN', 'UANG MUKA', 'PAJAK', '
                            NILAI PEROLEHAN', 'AKUMULASI PENYUSUTAN', 'UANG MUKA ASET', 'AKTIVA LAINNYA', 'HUTANG OUTSTANDING CEK', 
                            'HUTANG SUPPLIER', 'HUTANG PAJAK', 'HUTANG UANG MUKA', 'BIAYA YANG MASIH HARUS DIBAYAR', 'HUTANG 
                            PIHAK KETIGA', 'HUTANG BANK', 'HUTANG LAIN-LAIN', 'HUTANG INTERNAL', 'HUTANG SUPIR', 'TOTAL MODAL');
    $total_name = array('TOTAL AKTIVA LANCAR', 'TOTAL AKTIVA TETAP', 'TOTAL AKTIVA LAIN-LAIN', 'TOTAL HUTANG USAHA', 'TOTAL KEWAJIBAN JANGKA PENDEK', 'TOTAL KEWAJIBAN JANGKA PANJANG', 
                        'TOTAL HUTANG LAIN-LAIN');
    
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
                    $first_date = date('2017-01-01',strtotime($first_date));
                    $last_date = date('Y-m-t',strtotime($start_date.' last day of last month'));

                    $starting_balance = $this->balance_sheet_report_model->get_data_saldo_gl_by_coa($coa->rowID,$first_date,$last_date)->total_saldo;
                    $debit = $this->balance_sheet_report_model->get_data_debit_gl_by_coa($coa->rowID,$start_date,$end_date)->total_debit;
                    $credit = $this->balance_sheet_report_model->get_data_credit_gl_by_coa($coa->rowID,$start_date,$end_date)->total_credit * -1;
                }
                
                if($coa->acc_cd == '3.03.01'){
                    $starting_balance = $starting_balance_profit;
                    $debit = $debit_profit;
                    $credit = $credit_profit;
                }
                
                if(substr($coa->acc_cd,0,1) == '1'){
                    $remaining_balance = $starting_balance + $debit - $credit;                    
                }
                else if($coa->acc_cd == '3.03.01'){
                    $remaining_balance = $starting_balance - $debit + $credit;                    
                }
                else{
                    $starting_balance = $starting_balance * -1;
                    $remaining_balance = $starting_balance - $debit + $credit;
                }
                
                $subtotal_starting_balance += $starting_balance;
                $subtotal_debit += $debit;
                $subtotal_credit += $credit;
                $subtotal_remaining_balance += $remaining_balance;
                
                $total_starting_balance += $starting_balance;
                $total_debit += $debit;
                $total_credit += $credit;
                $total_remaining_balance += $remaining_balance;
                
                if($coa->acc_cd == '1.02.02' || $coa->acc_cd == '1.02.02.01' || $coa->acc_cd == '1.02.02.02' || $coa->acc_cd == '1.02.02.03' || $coa->acc_cd == '1.02.02.04' || $coa->acc_cd == '1.02.02.05' || $coa->acc_cd == '1.02.02.06'){
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
            }
            else{
                $starting_balance = 0;
                $debit = 0;
                $credit = 0;
                $remaining_balance = 0;
            }

            if($coa->acc_name == 'AKTIVA' || $coa->acc_name == 'AKTIVA LANCAR' || $coa->acc_name == 'AKTIVA TETAP' || $coa->acc_name == 'AKTIVA LAINNYA' || $coa->acc_name == 'BIAYA PRA OPERASI' || 
                $coa->acc_name == 'AKUMULASI AMORTISASI' || $coa->acc_name == 'INVESTASI PADA SAHAM' || $coa->acc_name == 'KEWAJIBAN' || $coa->acc_name == 'KEWAJIBAN JANGKA PENDEK' || $coa->acc_name == 'KEWAJIBAN JANGKA PANJANG' ||
                $coa->acc_name == 'HUTANG LAIN-LAIN' || $coa->acc_name == 'MODAL' || $coa->acc_name == 'MODAL DISETOR' || $coa->acc_name == 'LABA (RUGI) DITAHAN' || $coa->acc_name == 'DEVIDEN (LABA/RUGI DIBAGIKAN)' || $coa->acc_name == 'LABA (RUGI) BERJALAN'){
                
                if($coa->acc_cd != '1.03.01' && $coa->acc_cd != '2.02.02' && $coa->acc_cd != '3.01' && $coa->acc_cd != '3.02' && $coa->acc_cd != '3.03'){
    ?>
                	<tr>
                        <?php
                        if($coa->acc_type == 'H'){
                        ?>
        				    <td align="left"><b><?=$coa->acc_name?></b></td>
        				<?php
                        }
                        else{
                        ?>
        				    <td align="left"><?=$coa->acc_name?></td>
        				<?php                        
                        }
                        if($coa->acc_condition > 0){
                        ?>
        				    <td align="center" width="9%">Rp</td>
            				<td align="right" width="30%"><?=$remaining_balance >= 0 ? number_format($remaining_balance,2) : '('.number_format($remaining_balance * -1,2).')'?></td>
                        <?php
                        }
                        else{
                        ?>
        				    <td align="center" width="9%"></td>
            				<td align="right" width="30%"></td>
                        <?php                    
                        }
                        ?>
                    </tr>
	<?php 
                }
            }
            
            if($coa->acc_condition == 2){
                $subtotal_name_tmp = $subtotal_name[$i_sn];
                $i_sn++;
                if($subtotal_name_tmp == 'TOTAL MODAL'){               
    ?>
                <tr>
                    <th align="right" style="height: 25px;"><?=$subtotal_name_tmp?></th>
                    <th align="center" style="border-top: #000 1px solid;height: 25px;">Rp</th>
                    <th align="right" style="border-top: #000 1px solid;height: 25px;"><?=$subtotal_remaining_balance >= 0 ? number_format($subtotal_remaining_balance,2) : '('.number_format($subtotal_remaining_balance * -1,2).')'?></th>
                </tr>
    <?php       
                }
                else{
    ?>
                <tr>
                    <td align="left"><?=$subtotal_name_tmp?></td>
                    <td align="center">Rp</td>
                    <td align="right"><?=$subtotal_remaining_balance >= 0 ? number_format($subtotal_remaining_balance,2) : '('.number_format($subtotal_remaining_balance * -1,2).')'?></td>
                </tr>
    <?php                           
                }
                
                if($subtotal_name_tmp == 'TOTAL MODAL'){
                    $grandtotal_pasiva_starting_balance = $grandtotal_kewajiban_starting_balance + $subtotal_starting_balance;
                    $grandtotal_pasiva_remaining_balance = $grandtotal_kewajiban_remaining_balance + $subtotal_remaining_balance;
    ?>
                <tr><td colspan="3" style="padding-top: 3px;">&nbsp;</td></tr>
                <tr>
                    <th align="right" style="height: 25px;">GRAND TOTAL PASIVA &nbsp; </th>
                    <th align="center" style="border-top: #000 2px solid;border-left: #000 2px solid;border-bottom: #000 2px solid;height: 25px;">Rp</th>
                    <th align="right" style="border-top: #000 2px solid;border-right: #000 2px solid;border-bottom: #000 2px solid;height: 25px;"><?=$grandtotal_pasiva_remaining_balance >= 0 ? number_format($grandtotal_pasiva_remaining_balance,2) : '('.number_format($grandtotal_pasiva_remaining_balance * -1,2).')'?></th>
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
                
                if($total_name_tmp == 'TOTAL AKTIVA LANCAR'){
                    $starting_balance_aktiva_lancar = $total_starting_balance;
                    $debit_aktiva_lancar = $total_debit;
                    $credit_aktiva_lancar = $total_credit;
                    $remaining_balance_aktiva_lancar = $total_remaining_balance;
                }
                elseif($total_name_tmp == 'TOTAL AKTIVA TETAP'){
                    $starting_balance_aktiva_tetap = $total_starting_balance;
                    $debit_aktiva_tetap = $total_debit;
                    $credit_aktiva_tetap = $total_credit;
                    $remaining_balance_aktiva_tetap = $total_remaining_balance;
                }
                elseif($total_name_tmp == 'TOTAL HUTANG USAHA'){
                    $starting_balance_hutang_usaha = $total_starting_balance;
                    $debit_hutang_usaha = $total_debit;
                    $credit_hutang_usaha = $total_credit;
                    $remaining_balance_hutang_usaha = $total_remaining_balance;
                }
                elseif($total_name_tmp == 'TOTAL KEWAJIBAN JANGKA PENDEK'){
                    $starting_balance_kewajiban_lancar = $total_starting_balance + $starting_balance_hutang_usaha;
                    $debit_kewajiban_lancar = $total_debit + $debit_hutang_usaha;
                    $credit_kewajiban_lancar = $total_credit + $credit_hutang_usaha;
                    $remaining_balance_kewajiban_lancar = $total_remaining_balance + $remaining_balance_hutang_usaha;
                    
                    $total_starting_balance = $total_starting_balance + $starting_balance_hutang_usaha;
                    $total_debit = $total_debit + $debit_hutang_usaha;
                    $total_credit = $total_credit + $credit_hutang_usaha;
                    $total_remaining_balance = $total_remaining_balance + $remaining_balance_hutang_usaha;
                    
                }
                elseif($total_name_tmp == 'TOTAL KEWAJIBAN JANGKA PANJANG'){
                    $starting_balance_kewajiban_jangka_panjang = $total_starting_balance;
                    $debit_kewajiban_jangka_panjang = $total_debit;
                    $credit_kewajiban_jangka_panjang = $total_credit;
                    $remaining_balance_kewajiban_jangka_panjang = $total_remaining_balance;
                }
                
    ?>
                <tr>
                    <td align="left"><?=$subtotal_name_tmp?></td>
                    <td align="center">Rp</td>
                    <td align="right"><?=$subtotal_remaining_balance >= 0 ? number_format($subtotal_remaining_balance,2) : '('.number_format($subtotal_remaining_balance * -1,2).')'?></td>
                </tr>
                <tr>
                    <th align="right" style="height: 25px;"><?=$total_name_tmp?></th>
                    <th align="center" style="border-top: #000 1px solid;height: 25px;">Rp</th>
                    <th align="right" style="border-top: #000 1px solid;height: 25px;"><?=$total_remaining_balance >= 0 ? number_format($total_remaining_balance,2) : '('.number_format($total_remaining_balance * -1,2).')'?></th>
                </tr>
    <?php
                if($total_name_tmp == 'TOTAL AKTIVA LAIN-LAIN'){
                    $starting_balance_aktiva_lain = $total_starting_balance;
                    $debit_aktiva_lain = $total_debit;
                    $credit_aktiva_lain = $total_credit;
                    $remaining_balance_aktiva_lain = $total_remaining_balance;
                    
                    $grandtotal_aktiva_starting_balance = $starting_balance_aktiva_lancar + $starting_balance_aktiva_tetap + $starting_balance_aktiva_lain;
                    $grandtotal_aktiva_debit = $debit_aktiva_lancar + $debit_aktiva_tetap + $debit_aktiva_lain;
                    $grandtotal_aktiva_credit = $credit_aktiva_lancar + $credit_aktiva_tetap + $credit_aktiva_lain;
                    $grandtotal_aktiva_remaining_balance = $remaining_balance_aktiva_lancar + $remaining_balance_aktiva_tetap + $remaining_balance_aktiva_lain;
                    
    ?>              
                <tr><td colspan="3">&nbsp;</td></tr>
                <tr><td colspan="3">&nbsp;</td></tr>
                <tr><td colspan="3">&nbsp;</td></tr>
                <tr><td colspan="3">&nbsp;</td></tr>
                <tr><td colspan="3">&nbsp;</td></tr>
                <tr><td colspan="3">&nbsp;</td></tr>
                <tr><td colspan="3">&nbsp;</td></tr>
                <tr><td colspan="3">&nbsp;</td></tr>
                <tr><td colspan="3">&nbsp;</td></tr>
                <tr><td colspan="3">&nbsp;<br /><br /></td></tr>
                <tr>
                    <th align="right" style="height: 25px;">GRAND TOTAL AKTIVA &nbsp; </th>
                    <th align="center" style="border-top: #000 2px solid;border-left: #000 2px solid;border-bottom: #000 2px solid;height: 25px;">Rp</th>
                    <th align="right" style="border-top: #000 2px solid;border-right: #000 2px solid;border-bottom: #000 2px solid;height: 25px;"><?=$grandtotal_aktiva_remaining_balance >= 0 ? number_format($grandtotal_aktiva_remaining_balance,2) : '('.number_format($grandtotal_aktiva_remaining_balance * -1,2).')'?></th>
                </tr>
            </table>
        </td>
        <td width="50%" valign="top" style="border-top: #000 2px solid;">    
            <table width="100%" cellpadding="0" cellspacing="0">
    <?php
                    //$grandtotal_pasiva_starting_balance += $grandtotal_starting_balance;
                    //$grandtotal_pasiva_remaining_balance += $grandtotal_remaining_balance;

                    $grandtotal_starting_balance = 0;
                    $grandtotal_debit = 0;
                    $grandtotal_credit = 0;
                    $grandtotal_remaining_balance = 0;
                }
                else if($total_name_tmp == 'TOTAL HUTANG LAIN-LAIN'){
                    $starting_balance_kewajiban_lain = $total_starting_balance;
                    $debit_kewajiban_lain = $total_debit;
                    $credit_kewajiban_lain = $total_credit;
                    $remaining_balance_kewajiban_lain = $total_remaining_balance;
                    
                    $grandtotal_kewajiban_starting_balance = $starting_balance_kewajiban_lancar + $starting_balance_kewajiban_jangka_panjang + $starting_balance_kewajiban_lain;
                    $grandtotal_kewajiban_debit = $debit_kewajiban_lancar + $debit_kewajiban_jangka_panjang + $debit_kewajiban_lain;
                    $grandtotal_kewajiban_credit = $credit_kewajiban_lancar + $credit_kewajiban_jangka_panjang + $credit_kewajiban_lain;
                    $grandtotal_kewajiban_remaining_balance = $remaining_balance_kewajiban_lancar + $remaining_balance_kewajiban_jangka_panjang + $remaining_balance_kewajiban_lain;
    ?>
                <tr>
                    <th align="right" style="height: 25px;">GRAND TOTAL KEWAJIBAN</th>
                    <th align="center" style="border-top: #000 2px solid;height: 25px;">Rp</th>
                    <th align="right" style="border-top: #000 2px solid;height: 25px;"><?=$grandtotal_kewajiban_remaining_balance >= 0 ? number_format($grandtotal_kewajiban_remaining_balance,2) : '('.number_format($grandtotal_kewajiban_remaining_balance * -1,2).')'?></th>
                </tr>
    <?php
                    //$grandtotal_pasiva_starting_balance -= $grandtotal_starting_balance;
                    //$grandtotal_pasiva_remaining_balance -= $grandtotal_remaining_balance;

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
    
    ?>
        </td>
    </tr>
</table>
<p>&nbsp;</p>
</div>

</body>
</html>
