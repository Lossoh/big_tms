<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Changes in Capital Report</title>
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
    <span style="font-size: 16px;">LAPORAN PERUBAHAN MODAL</span><br />
    <span style="font-size: 14px;"><?=$period?></span>
</div>
<div id="content">
    <p>&nbsp;</p>
    <table width="100%" cellpadding="10" cellspacing="0">
	<?php 
    
    $subtotal_starting_balance = 0;
    $subtotal_debit = 0;
    $subtotal_credit = 0;
    $subtotal_remaining_balance = $balance;

    $total_starting_balance = 0;
    $total_debit = 0;
    $total_credit = 0;
    $total_remaining_balance = 0;
    
    if (!empty($coas)) {
        foreach ($coas as $coa) { 

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
                
                if($coa->acc_cd == '3.03.01'){
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
                                
            }
            else{
                $starting_balance = 0;
                $debit = 0;
                $credit = 0;
                $remaining_balance = 0;
            }

    ?>
        	<tr>
                <?php
                if($coa->acc_cd == '3.01.01'){
                ?>
				    <td align="left"><b><?=$coa->acc_name?></b></td>
				<?php
                }
                else{
                ?>
				    <td align="left"><?=$coa->acc_name?></td>
				<?php                        
                }
                if($coa->acc_cd == '3.01.01'){
                ?>
				    <td align="center" width="3%"></td>
    				<td align="right" width="20%"></td>
				    <td align="center" width="3%">Rp</td>
    				<td align="right" width="20%"><?=$remaining_balance >= 0 ? number_format($remaining_balance,2) : '('.number_format($remaining_balance * -1,2).')'?></td>
                <?php
                }
                else{
                    if($coa->acc_cd == '3.03.01'){
                        $border = 'border-bottom: #000 1px solid;';
                    }
                    else{
                        $border = '';
                    }
                    
                    $total_starting_balance += $starting_balance;
                    $total_debit += $debit;
                    $total_credit += $credit;
                    $total_remaining_balance += $remaining_balance;
                ?>
				    <td align="center" width="3%" style="<?=$border?>">Rp</td>
    				<td align="right" width="20%" style="<?=$border?>"><?=$remaining_balance >= 0 ? number_format($remaining_balance,2) : '('.number_format($remaining_balance * -1,2).')'?></td>
				    <td align="center" width="3%"></td>
    				<td align="right" width="20%"></td>
                <?php                    
                }
                ?>
            </tr>
	<?php 
            if($coa->acc_condition == 2){
                
    ?>
                <tr>
                    <td align="left" style="height: 25px;">LABAR RUGI DITAHAN <?=$year?> &nbsp; </td>
				    <td align="center"></td>
    				<td align="right"></td>
                    <td align="center" style="border-bottom: #000 1px solid;height: 25px;">Rp</td>
                    <td align="right" style="border-bottom: #000 1px solid;height: 25px;"><?=$total_remaining_balance >= 0 ? number_format($total_remaining_balance,2) : '('.number_format($total_remaining_balance * -1,2).')'?></td>
                </tr>
                <tr>
                    <th align="right" style="height: 25px;">MODAL - <?=$period?> &nbsp; </th>
				    <td align="center"></td>
    				<td align="right"></td>
                    <th align="center" style="border-bottom: #000 3px double;height: 25px;">Rp</th>
                    <th align="right" style="border-bottom: #000 3px double;height: 25px;"><?=$subtotal_remaining_balance >= 0 ? number_format($subtotal_remaining_balance,2) : '('.number_format($subtotal_remaining_balance * -1,2).')'?></th>
                </tr>
    <?php       
                
                                
                $subtotal_starting_balance = 0;
                $subtotal_debit = 0;
                $subtotal_credit = 0;
                $subtotal_remaining_balance = 0;
            }
            
        }
        
    }
    
    ?>
</table>
<p>&nbsp;</p>
</div>

</body>
</html>
