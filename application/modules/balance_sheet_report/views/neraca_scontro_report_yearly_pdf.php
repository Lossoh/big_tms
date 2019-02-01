<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Neraca Scontro Report (Yearly)</title>
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
	@page { margin: 0px 20px 0px 20px; }
     
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

Waktu Cetak : <?=date('d F Y H:i:s')?><br />

<div id="header">
    <span style="font-size: 14px;"><?=$this->config->item('comp_name')?></span><br />
    <span style="font-size: 16px;">NERACA</span><br />
    <span style="font-size: 14px;">TAHUN <?=date('Y',strtotime($start_date))?></span><br />
</div>
<br />
<div id="content">
<?php
$month_name = array('JANUARI', 'FEBRUARI', 'MARET', 'APRIL', 'MEI', 'JUNI', 'JULI', 'AGUSTUS', 'SEPTEMBER', 'OKTOBER', 'NOVEMBER', 'DESEMBER');

$date_start = date('d',strtotime($start_date));
$year_start = date('Y',strtotime($start_date));
$date_end = 28;
$year_end = date('Y',strtotime($end_date));

$i_first = (int) date('m',strtotime($start_date)) - 1;
$i_end = (int) date('m',strtotime($end_date));

?>
<table width="100%" cellpadding="1" cellspacing="0">
	<tr style="font-weight: bold;">
       <td style="border-top: #000000 double 5px;border-bottom: #000000 double 5px;border-left: #000000 solid 1px;border-right: #000000 solid 1px;" align="center">KETERANGAN/PERIODE</td> 
       <?php
       for($i=$i_first;$i<$i_end;$i++){
       ?>
           <td style="border-top: #000000 double 5px;border-bottom: #000000 double 5px;border-left: #000000 solid 1px;border-right: #000000 solid 1px;" align="center"><?=$month_name[$i]?></td> 
       <?php
       }
       ?> 
    </tr>
	<?php 
    $i_row = 0;
    $i_sn = 0;
    $i_tn = 0;
    $subtotal_name = array('SUBTOTAL KAS & BANK', 'SUBTOTAL PIUTANG USAHA', 'SUBTOTAL PIUTANG LAIN-LAIN', 'SUBTOTAL UANG MUKA', 'SUBTOTAL PAJAK', 'SUBTOTAL 
                            NILAI PEROLEHAN', 'SUBTOTAL AKUMULASI PENYUSUTAN', 'SUBTOTAL UANG MUKA ASET', 'AKTIVA LAINNYA', 'SUBTOTAL HUTANG OUTSTANDING CEK', 
                            'SUBTOTAL HUTANG SUPPLIER', 'SUBTOTAL HUTANG PAJAK', 'SUBTOTAL HUTANG UANG MUKA', 'SUBTOTAL BIAYA YANG MASIH HARUS DIBAYAR', 'SUBTOTAL HUTANG 
                            PIHAK KETIGA', 'SUBTOTAL HUTANG BANK', 'SUBTOTAL HUTANG LAIN-LAIN', 'SUBTOTAL HUTANG INTERNAL', 'SUBTOTAL HUTANG SUPIR', 'TOTAL MODAL');
    $total_name = array('TOTAL AKTIVA LANCAR', 'TOTAL AKTIVA TETAP', 'TOTAL AKTIVA LAIN-LAIN', 'TOTAL HUTANG USAHA', 'TOTAL KEWAJIBAN LANCAR', 'TOTAL KEWAJIBAN JANGKA PANJANG', 
                        'TOTAL KEWAJIBAN LAIN-LAIN');
    
    $subtotal_starting_balance = array();
    $subtotal_debit = array();
    $subtotal_credit = array();
    $subtotal_remaining_balance = $balance;

    $total_starting_balance = array();
    $total_debit = array();
    $total_credit = array();
    $total_remaining_balance = array();
    
    $grandtotal_starting_balance = array();
    $grandtotal_debit = array();
    $grandtotal_credit = array();
    $grandtotal_remaining_balance = array();
    
    $grandtotal_pasiva_starting_balance = array();
    $grandtotal_pasiva_remaining_balance = array();
    
    $first_date = date('Y-m-d',strtotime($start_date.' first day of last month')); //2016-12-01
    $a = array();
    $b = array();
    $c = array();
    
    if (!empty($coas)) {
        foreach ($coas as $coa) {
            $i_row++;
            if($coa->acc_condition > 0){
                for($i=$i_first;$i<$i_end;$i++){
                    $first_date_tmp = date('Y-m-d',strtotime($first_date.' +'.$i.' months'));
                    $first_date_cd = date('Y-m-d',strtotime($first_date.' +'.($i+1).' months'));
                    $last_date_cd = date('Y-m-t',strtotime($first_date_cd));
                    
                    $a[$i] = $first_date_tmp;
                    $b[$i] = $first_date_cd;
                    $c[$i] = $last_date_cd;
                    
                    if($first_date_tmp == '2016-12-01'){
                        $starting_balance[$i] = $this->balance_sheet_report_model->get_data_saldo_gl_by_coa($coa->rowID,'2017-01-01','2017-01-01')->total_saldo;
                        $debit[$i] = $this->balance_sheet_report_model->get_data_debit_gl_by_coa($coa->rowID,'2017-01-02',$last_date_cd)->total_debit;
                        $credit[$i] = $this->balance_sheet_report_model->get_data_credit_gl_by_coa($coa->rowID,'2017-01-02',$last_date_cd)->total_credit * -1;
                    }
                    else{
                        $first_date_sb = date('2017-01-01',strtotime($first_date_tmp));
                        $last_date_sb = date('Y-m-t',strtotime($first_date_tmp));
    
                        $starting_balance[$i] = $this->balance_sheet_report_model->get_data_saldo_gl_by_coa($coa->rowID,$first_date_sb,$last_date_sb)->total_saldo;
                        $debit[$i] = $this->balance_sheet_report_model->get_data_debit_gl_by_coa($coa->rowID,$first_date_cd,$last_date_cd)->total_debit;
                        $credit[$i] = $this->balance_sheet_report_model->get_data_credit_gl_by_coa($coa->rowID,$first_date_cd,$last_date_cd)->total_credit * -1;
                    }
                    
                    if($coa->acc_cd == '3.03.01'){
                        $starting_balance[$i] = $starting_balance_profit[$i];
                        $debit[$i] = $debit_profit[$i];
                        $credit[$i] = $credit_profit[$i];
                    }
                    
                    if(substr($coa->acc_cd,0,1) == '1'){
                        $remaining_balance[$i] = $starting_balance[$i] + $debit[$i] - $credit[$i];                    
                    }
                    else if($coa->acc_cd == '3.03.01'){
                        $remaining_balance[$i] = $starting_balance[$i] - $debit[$i] + $credit[$i];                    
                    }
                    else{
                        $starting_balance[$i] = $starting_balance[$i] * -1;
                        $remaining_balance[$i] = $starting_balance[$i] - $debit[$i] + $credit[$i];
                    }
                    
                    $subtotal_starting_balance[$i] += $starting_balance[$i];
                    $subtotal_debit[$i] += $debit[$i];
                    $subtotal_credit[$i] += $credit[$i];
                    $subtotal_remaining_balance[$i] += $remaining_balance[$i];
                    
                    $total_starting_balance[$i] += $starting_balance[$i];
                    $total_debit[$i] += $debit[$i];
                    $total_credit[$i] += $credit[$i];
                    $total_remaining_balance[$i] += $remaining_balance[$i];
                    
                    if($coa->acc_cd == '1.02.02' || $coa->acc_cd == '1.02.02.01' || $coa->acc_cd == '1.02.02.02' || $coa->acc_cd == '1.02.02.03' || $coa->acc_cd == '1.02.02.04' || $coa->acc_cd == '1.02.02.05' || $coa->acc_cd == '1.02.02.06'){
                        $grandtotal_starting_balance[$i] -= $starting_balance[$i];
                        $grandtotal_debit[$i] -= $debit[$i];
                        $grandtotal_credit[$i] -= $credit[$i];
                        $grandtotal_remaining_balance[$i] -= $remaining_balance[$i];                    
                    }
                    else{
                        $grandtotal_starting_balance[$i] += $starting_balance[$i];
                        $grandtotal_debit[$i] += $debit[$i];
                        $grandtotal_credit[$i] += $credit[$i];
                        $grandtotal_remaining_balance[$i] += $remaining_balance[$i];
                    }
                    
                }
                
                $padding = 'padding-left:20px';
                
            }
            else{
                for($i=$i_first;$i<$i_end;$i++){
                    $starting_balance[$i] = 0;
                    $debit[$i] = 0;
                    $credit[$i] = 0;
                    $remaining_balance[$i] = 0;
                }
                
                $padding = '';
                
            }     
            
    ?>
        	<tr>
				<td style="border: #000000 solid 1px;<?=$padding?>" align="left"><?=$coa->acc_name?></td>
				<?php
                if($coa->acc_condition > 0){
                    for($i=$i_first;$i<$i_end;$i++){
                ?>
    				    <td style="border: #000000 solid 1px;" align="right"><?=$remaining_balance[$i] >= 0 ? number_format($remaining_balance[$i],2) : '('.number_format($remaining_balance[$i] * -1,2).')'?></td>
                <?php
                    }
                }
                else{
                    for($i=$i_first;$i<$i_end;$i++){
                ?>
    				    <td style="border: #000000 solid 1px;" align="right"></td>
                <?php                    
                    }
                }
                ?>
        	</tr>
	<?php 
            if($coa->acc_condition == 2){
                $subtotal_name_tmp = $subtotal_name[$i_sn];
                $i_sn++;
    ?>
                <tr>
                    <th align="right" style="border: #000000 solid 1px;height: 25px;"><?=$subtotal_name_tmp?> (Rp) &nbsp; </th>
                    <?php
                    for($i=$i_first;$i<$i_end;$i++){
                    ?>
                        <th align="right" style="border: #000000 solid 1px;height: 25px;"><?=$subtotal_remaining_balance[$i] >= 0 ? number_format($subtotal_remaining_balance[$i],2) : '('.number_format($subtotal_remaining_balance[$i] * -1,2).')'?></th>
                    <?php
                    }
                    ?>
                </tr>
    <?php       
                if($subtotal_name_tmp == 'TOTAL MODAL'){
                    for($i=$i_first;$i<$i_end;$i++){
                        $grandtotal_pasiva_starting_balance[$i] = $grandtotal_kewajiban_starting_balance[$i] + $subtotal_starting_balance[$i];
                        $grandtotal_pasiva_remaining_balance[$i] = $grandtotal_kewajiban_remaining_balance[$i] + $subtotal_remaining_balance[$i];
                    }
    ?>
                <tr>
                    <th align="right" style="border: #000000 solid 1px;height: 25px;">GRAND TOTAL PASIVA (Rp) &nbsp; </th>
                    <?php
                    for($i=$i_first;$i<$i_end;$i++){
                    ?>
                        <th align="right" style="border: #000000 solid 1px;height: 25px;"><?=$grandtotal_pasiva_remaining_balance[$i] >= 0 ? number_format($grandtotal_pasiva_remaining_balance[$i],2) : '('.number_format($grandtotal_pasiva_remaining_balance[$i] * -1,2).')'?></th>
                    <?php
                    }
                    ?>
                </tr>
    <?php
                    for($i=$i_first;$i<$i_end;$i++){
                        $grandtotal_pasiva_starting_balance[$i] = 0;
                        $grandtotal_pasiva_remaining_balance[$i] = 0;
                        
                        $grandtotal_starting_balance[$i] = 0;
                        $grandtotal_debit[$i] = 0;
                        $grandtotal_credit[$i] = 0;
                        $grandtotal_remaining_balance[$i] = 0;
                    }
                }
                
                for($i=$i_first;$i<$i_end;$i++){
                    $subtotal_starting_balance[$i] = 0;
                    $subtotal_debit[$i] = 0;
                    $subtotal_credit[$i] = 0;
                    $subtotal_remaining_balance[$i] = 0;
                }
            }
            else if($coa->acc_condition == 3){
                $subtotal_name_tmp = $subtotal_name[$i_sn];
                $i_sn++;
                
                $total_name_tmp = $total_name[$i_tn];
                $i_tn++;
                
                if($total_name_tmp == 'TOTAL AKTIVA LANCAR'){
                    for($i=$i_first;$i<$i_end;$i++){
                        $starting_balance_aktiva_lancar[$i] = $total_starting_balance[$i];
                        $debit_aktiva_lancar[$i] = $total_debit[$i];
                        $credit_aktiva_lancar[$i] = $total_credit[$i];
                        $remaining_balance_aktiva_lancar[$i] = $total_remaining_balance[$i];
                    }
                }
                elseif($total_name_tmp == 'TOTAL AKTIVA TETAP'){
                    for($i=$i_first;$i<$i_end;$i++){
                        $starting_balance_aktiva_tetap[$i] = $total_starting_balance[$i];
                        $debit_aktiva_tetap[$i] = $total_debit[$i];
                        $credit_aktiva_tetap[$i] = $total_credit[$i];
                        $remaining_balance_aktiva_tetap[$i] = $total_remaining_balance[$i];
                    }
                }
                elseif($total_name_tmp == 'TOTAL HUTANG USAHA'){
                    for($i=$i_first;$i<$i_end;$i++){
                        $starting_balance_hutang_usaha[$i] = $total_starting_balance[$i];
                        $debit_hutang_usaha[$i] = $total_debit[$i];
                        $credit_hutang_usaha[$i] = $total_credit[$i];
                        $remaining_balance_hutang_usaha[$i] = $total_remaining_balance[$i];
                    }
                }
                elseif($total_name_tmp == 'TOTAL KEWAJIBAN LANCAR'){
                    for($i=$i_first;$i<$i_end;$i++){
                        $starting_balance_kewajiban_lancar[$i] = $total_starting_balance[$i] + $starting_balance_hutang_usaha[$i];
                        $debit_kewajiban_lancar[$i] = $total_debit[$i] + $debit_hutang_usaha[$i];
                        $credit_kewajiban_lancar[$i] = $total_credit[$i] + $credit_hutang_usaha[$i];
                        $remaining_balance_kewajiban_lancar[$i] = $total_remaining_balance[$i] + $remaining_balance_hutang_usaha[$i];
                        
                        $total_starting_balance[$i] = $total_starting_balance[$i] + $starting_balance_hutang_usaha[$i];
                        $total_debit[$i] = $total_debit[$i] + $debit_hutang_usaha[$i];
                        $total_credit[$i] = $total_credit[$i] + $credit_hutang_usaha[$i];
                        $total_remaining_balance[$i] = $total_remaining_balance[$i] + $remaining_balance_hutang_usaha[$i];
                    }
                }
                elseif($total_name_tmp == 'TOTAL KEWAJIBAN JANGKA PANJANG'){
                    for($i=$i_first;$i<$i_end;$i++){
                        $starting_balance_kewajiban_jangka_panjang[$i] = $total_starting_balance[$i];
                        $debit_kewajiban_jangka_panjang[$i] = $total_debit[$i];
                        $credit_kewajiban_jangka_panjang[$i] = $total_credit[$i];
                        $remaining_balance_kewajiban_jangka_panjang[$i] = $total_remaining_balance[$i];
                    }
                }
                
    ?>
                <tr>
                    <th align="right" style="border: #000000 solid 1px;height: 25px;"><?=$subtotal_name_tmp?> (Rp) &nbsp; </th>
                    <?php
                    for($i=$i_first;$i<$i_end;$i++){
                    ?>
                        <th align="right" style="border: #000000 solid 1px;height: 25px;"><?=$subtotal_remaining_balance[$i] >= 0 ? number_format($subtotal_remaining_balance[$i],2) : '('.number_format($subtotal_remaining_balance[$i] * -1,2).')'?></th>
                    <?php
                    }
                    ?>
                </tr>
                <tr>
                    <th align="right" style="border: #000000 solid 1px;height: 25px;"><?=$total_name_tmp?> (Rp) &nbsp; </th>
                    <?php
                    for($i=$i_first;$i<$i_end;$i++){
                    ?>
                        <th align="right" style="border: #000000 solid 1px;height: 25px;"><?=$total_remaining_balance[$i] >= 0 ? number_format($total_remaining_balance[$i],2) : '('.number_format($total_remaining_balance[$i] * -1,2).')'?></th>
                    <?php
                    }
                    ?>
                </tr>
    <?php
                if($total_name_tmp == 'TOTAL AKTIVA LAIN-LAIN'){
                    for($i=$i_first;$i<$i_end;$i++){
                        $starting_balance_aktiva_lain[$i] = $total_starting_balance[$i];
                        $debit_aktiva_lain[$i] = $total_debit[$i];
                        $credit_aktiva_lain[$i] = $total_credit[$i];
                        $remaining_balance_aktiva_lain[$i] = $total_remaining_balance[$i];
                        
                        $grandtotal_aktiva_starting_balance[$i] = $starting_balance_aktiva_lancar[$i] + $starting_balance_aktiva_tetap[$i] + $starting_balance_aktiva_lain[$i];
                        $grandtotal_aktiva_debit[$i] = $debit_aktiva_lancar[$i] + $debit_aktiva_tetap[$i] + $debit_aktiva_lain[$i];
                        $grandtotal_aktiva_credit[$i] = $credit_aktiva_lancar[$i] + $credit_aktiva_tetap[$i] + $credit_aktiva_lain[$i];
                        $grandtotal_aktiva_remaining_balance[$i] = $remaining_balance_aktiva_lancar[$i] + $remaining_balance_aktiva_tetap[$i] + $remaining_balance_aktiva_lain[$i];
                    }
    ?>              
                <tr>
                    <th align="right" style="border: #000000 solid 1px;height: 25px;">GRAND TOTAL AKTIVA (Rp) &nbsp; </th>
                    <?php
                    for($i=$i_first;$i<$i_end;$i++){
                    ?>
                        <th align="right" style="border: #000000 solid 1px;height: 25px;"><?=$grandtotal_aktiva_remaining_balance[$i] >= 0 ? number_format($grandtotal_aktiva_remaining_balance[$i],2) : '('.number_format($grandtotal_aktiva_remaining_balance[$i] * -1,2).')'?></th>
                    <?php
                    }
                    ?>
                </tr>
    <?php
                    //$grandtotal_pasiva_starting_balance += $grandtotal_starting_balance;
                    //$grandtotal_pasiva_remaining_balance += $grandtotal_remaining_balance;
                    
                    for($i=$i_first;$i<$i_end;$i++){
                        $grandtotal_starting_balance[$i] = 0;
                        $grandtotal_debit[$i] = 0;
                        $grandtotal_credit[$i] = 0;
                        $grandtotal_remaining_balance[$i] = 0;
                    }
                }
                else if($total_name_tmp == 'TOTAL KEWAJIBAN LAIN-LAIN'){
                    for($i=$i_first;$i<$i_end;$i++){
                        $starting_balance_kewajiban_lain[$i] = $total_starting_balance[$i];
                        $debit_kewajiban_lain[$i] = $total_debit[$i];
                        $credit_kewajiban_lain[$i] = $total_credit[$i];
                        $remaining_balance_kewajiban_lain[$i] = $total_remaining_balance[$i];
                        
                        $grandtotal_kewajiban_starting_balance[$i] = $starting_balance_kewajiban_lancar[$i] + $starting_balance_kewajiban_jangka_panjang[$i] + $starting_balance_kewajiban_lain[$i];
                        $grandtotal_kewajiban_debit[$i] = $debit_kewajiban_lancar[$i] + $debit_kewajiban_jangka_panjang[$i] + $debit_kewajiban_lain[$i];
                        $grandtotal_kewajiban_credit[$i] = $credit_kewajiban_lancar[$i] + $credit_kewajiban_jangka_panjang[$i] + $credit_kewajiban_lain[$i];
                        $grandtotal_kewajiban_remaining_balance[$i] = $remaining_balance_kewajiban_lancar[$i] + $remaining_balance_kewajiban_jangka_panjang[$i] + $remaining_balance_kewajiban_lain[$i];
                    }
    ?>
                <tr>
                    <th align="right" style="border: #000000 solid 1px;height: 25px;">GRAND TOTAL KEWAJIBAN (Rp) &nbsp; </th>
                    <?php
                    for($i=$i_first;$i<$i_end;$i++){
                    ?>
                        <th align="right" style="border: #000000 solid 1px;height: 25px;"><?=$grandtotal_kewajiban_remaining_balance[$i] >= 0 ? number_format($grandtotal_kewajiban_remaining_balance[$i],2) : '('.number_format($grandtotal_kewajiban_remaining_balance[$i] * -1,2).')'?></th>
                    <?php
                    }
                    ?>
                </tr>
    <?php
                    //$grandtotal_pasiva_starting_balance -= $grandtotal_starting_balance;
                    //$grandtotal_pasiva_remaining_balance -= $grandtotal_remaining_balance;
                    for($i=$i_first;$i<$i_end;$i++){
                        $grandtotal_starting_balance[$i] = 0;
                        $grandtotal_debit[$i] = 0;
                        $grandtotal_credit[$i] = 0;
                        $grandtotal_remaining_balance[$i] = 0;
                    }
                }
                
                for($i=$i_first;$i<$i_end;$i++){
                    $subtotal_starting_balance[$i] = 0;
                    $subtotal_debit[$i] = 0;
                    $subtotal_credit[$i] = 0;
                    $subtotal_remaining_balance[$i] = 0;
    
                    $total_starting_balance[$i] = 0;
                    $total_debit[$i] = 0;
                    $total_credit[$i] = 0;
                    $total_remaining_balance[$i] = 0;
                }
            }
        }
        
    }
    
    if($i_row == 0){
    ?>
        <tr>
            <td colspan="<?=($i_end+1)?>" align="center" style="border: #000000 solid 1px;">Data not available.</td>
        </tr>
    <?php
    }
    ?>
</table>
<p>&nbsp;</p>
</div>

</body>
</html>
