<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Profit and Loss Report (Monthly)</title>
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
       margin-top: 0px;
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
    <span style="font-size: 16px;">LAPORAN LABA/RUGI</span><br />
    <span style="font-size: 14px;"><?=$period?></span>
</div>
<div id="content">
	
<?php
$subtotal_pendapatan_jasa = 0;
$subtotal_potongan_pendapatan_jasa = 0;
$total_pendapatan_usaha = 0;

$subtotal_biaya_ops = 0;
$subtotal_potongan_biaya_ops = 0;
$total_biaya_ops = 0;

$total_biaya_non_ops = 0;
$total_biaya_lain = 0;
$total_biaya_penyusutan = 0;
$total_biaya_pajak = 0;

$total_biaya_usaha = 0;
$total_laba_rugi_usaha = 0;

$total_pendapatan_luar_usaha = 0;
$total_biaya_luar_usaha = 0;
$total_laba_rugi_bersih = 0;

$subtotal = 0;
$subtotal_tmp = 0;
?>
<hr />
<table width="100%" cellpadding="0" cellspacing="0">
    <tr style="font-weight: bold;">
       <td style="padding-left: 0px;">PENDAPATAN USAHA</td> 
       <td width="3%">&nbsp;</td> 
       <td width="15%">&nbsp;</td> 
       <td width="3%">&nbsp;</td> 
       <td width="15%">&nbsp;</td> 
    </tr>    
    <?php
    // PENDAPATAN JASA
    $get_data = $this->balance_sheet_report_model->get_account_profit_loss_by_code('4.01.01.');
    
    foreach($get_data as $row){
        /*
        if($first_date == '2016-12-01'){
            $get_total = $this->balance_sheet_report_model->get_data_profit_loss_gl_by_coa($row->rowID,'2017-01-01','2017-01-01');
        }
        else{
            if($first_date == '2017-01-01'){
                $last_date = date('Y-m-t',strtotime($start_date.' last day of last month'));

                $get_total = $this->balance_sheet_report_model->get_data_profit_loss_gl_by_coa($row->rowID,'2017-01-02',$last_date);
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
                
                $get_total = $this->balance_sheet_report_model->get_data_profit_loss_gl_by_coa($row->rowID,$first_date,$last_date);
            }
        }
        */
        $get_total = $this->balance_sheet_report_model->get_data_profit_loss_gl_by_coa($row->rowID,$start_date,$end_date);
        
        $total = $get_total->total * -1;
        $subtotal_pendapatan_jasa += $total;
        
    ?>
        <tr>
           <td style="padding-left: 10px;"><?=$row->acc_name?></td> 
           <td>Rp</td> 
           <td align="right"><?=$total >= 0 ? number_format($total,2) : '('.number_format($total * -1,2).')'?></td> 
           <td></td> 
           <td align="right"></td> 
        </tr>    
    <?php
    }
    ?>
    
    <tr style="font-weight: bold;">
       <td align="right" style="padding-right: 10px;">SUBTOTAL PENDAPATAN JASA</td> 
       <td></td> 
       <td></td> 
       <td style="padding-left: 10px;">Rp</td> 
       <td align="right"><?=$subtotal_pendapatan_jasa >= 0 ? number_format($subtotal_pendapatan_jasa,2) : '('.number_format($subtotal_pendapatan_jasa * -1,2).')'?></td> 
    </tr>
    
    <?php
    // POTONGAN PENDAPATAN JASA
    $get_data = $this->balance_sheet_report_model->get_account_profit_loss_by_code('4.01.02.');
    foreach($get_data as $row){
        $get_total = $this->balance_sheet_report_model->get_data_profit_loss_gl_by_coa($row->rowID,$start_date,$end_date);
        
        $total = $get_total->total * -1;
        $subtotal_potongan_pendapatan_jasa += $total;
        
    ?>
        <tr>
           <td style="padding-left: 10px;"><?=$row->acc_name?></td> 
           <td>Rp</td> 
           <td align="right"><?=$total >= 0 ? number_format($total,2) : '('.number_format($total * -1,2).')'?></td> 
           <td></td> 
           <td align="right"></td> 
        </tr>    
    <?php
    }
    ?>
    
    <tr style="font-weight: bold;">
       <td align="right" style="padding-right: 10px;">SUBTOTAL POTONGAN PENDAPATAN JASA</td> 
       <td></td> 
       <td></td> 
       <td style="padding-left: 10px;">Rp</td> 
       <td align="right"><?=$subtotal_potongan_pendapatan_jasa >= 0 ? number_format($subtotal_potongan_pendapatan_jasa,2) : '('.number_format($subtotal_potongan_pendapatan_jasa * -1,2).')'?></td>
    </tr>
    
    <tr style="font-weight: bold;">
       <td align="right" style="padding-right: 10px;">TOTAL PENDAPATAN USAHA</td> 
       <td></td> 
       <td></td> 
       <td style="padding-left: 10px;border-top: #000 1px solid;">Rp</td> 
       <td align="right" style="padding-left: 10px;border-top: #000 1px solid;">
        <?php
        $total_pendapatan_usaha = $subtotal_pendapatan_jasa + $subtotal_potongan_pendapatan_jasa;
        if($total_pendapatan_usaha >= 0)
            echo number_format($total_pendapatan_usaha,2);
        else
            echo '('.number_format($total_pendapatan_usaha * -1,2).')';
        ?>
       </td> 
    </tr>
    
    <tr style="font-weight: bold;">
       <td style="padding-left: 0px;">BIAYA-BIAYA</td> 
       <td>&nbsp;</td> 
       <td>&nbsp;</td> 
       <td>&nbsp;</td> 
       <td>&nbsp;</td> 
    </tr>    
    <tr style="font-weight: bold;">
       <td style="padding-left: 0px;">BIAYA USAHA</td> 
       <td>&nbsp;</td> 
       <td>&nbsp;</td> 
       <td>&nbsp;</td> 
       <td>&nbsp;</td> 
    </tr>    
    <tr style="font-weight: bold;">
       <td style="padding-left: 0px;">BIAYA OPERASIONAL</td> 
       <td>&nbsp;</td> 
       <td>&nbsp;</td> 
       <td>&nbsp;</td> 
       <td>&nbsp;</td> 
    </tr>    
    <?php
    // BIAYA OPERASIONAL
    $get_data = $this->balance_sheet_report_model->get_account_profit_loss_by_code('5.01.01.');
    foreach($get_data as $row){
        $get_total = $this->balance_sheet_report_model->get_data_profit_loss_gl_by_coa($row->rowID,$start_date,$end_date);
        
        $total = $get_total->total;
        $subtotal_biaya_ops += $total;
        
    ?>
        <tr>
           <td style="padding-left: 10px;"><?=$row->acc_name?></td> 
           <td>Rp</td> 
           <td align="right"><?=$total >= 0 ? number_format($total,2) : '('.number_format($total * -1,2).')'?></td> 
           <td></td> 
           <td align="right"></td> 
        </tr>    
    <?php
    }
    ?>
    
    <tr style="font-weight: bold;">
       <td align="right" style="padding-right: 10px;">SUBTOTAL BIAYA OPERASIONAL</td> 
       <td></td> 
       <td></td> 
       <td style="padding-left: 10px;">Rp</td> 
       <td align="right"><?=$subtotal_biaya_ops >= 0 ? number_format($subtotal_biaya_ops,2) : '('.number_format($subtotal_biaya_ops * -1,2).')'?></td> 
    </tr>
    <tr style="font-weight: bold;">
       <td style="padding-left: 0px;">POTONGAN BIAYA OPERASIONAL</td> 
       <td>&nbsp;</td> 
       <td>&nbsp;</td> 
       <td>&nbsp;</td> 
       <td>&nbsp;</td>  
    </tr>
    <?php
    // POTONGAN BIAYA OPERASIONAL
    $get_data = $this->balance_sheet_report_model->get_account_profit_loss_by_code('5.01.02.');
    foreach($get_data as $row){
        $get_total = $this->balance_sheet_report_model->get_data_profit_loss_gl_by_coa($row->rowID,$start_date,$end_date);
        
        $total = $get_total->total;
        $subtotal_potongan_biaya_ops += $total;
        
    ?>
        <tr>
           <td style="padding-left: 10px;"><?=$row->acc_name?></td> 
           <td>Rp</td> 
           <td align="right"><?=$total >= 0 ? number_format($total,2) : '('.number_format($total * -1,2).')'?></td> 
           <td></td> 
           <td align="right"></td> 
        </tr>    
    <?php
    }
    ?>
    
    <tr style="font-weight: bold;">
       <td align="right" style="padding-right: 10px;">SUBTOTAL POTONGAN BIAYA OPERASIONAL</td> 
       <td></td> 
       <td></td> 
       <td style="padding-left: 10px;">Rp</td> 
       <td align="right"><?=$subtotal_potongan_biaya_ops >= 0 ? number_format($subtotal_potongan_biaya_ops,2) : '('.number_format($subtotal_potongan_biaya_ops * -1,2).')'?></td>
    </tr>
    
    <tr style="font-weight: bold;">
       <td align="right" style="padding-right: 10px;">TOTAL BIAYA OPERASIONAL</td> 
       <td></td> 
       <td></td> 
       <td style="padding-left: 10px;border-top: #000 1px solid;">Rp</td> 
       <td align="right" style="padding-left: 10px;border-top: #000 1px solid;">
        <?php
        $total_biaya_ops = $subtotal_biaya_ops + $subtotal_potongan_biaya_ops;
        if($total_biaya_ops >= 0)
            echo number_format($total_biaya_ops,2);
        else
            echo '('.number_format($total_biaya_ops * -1,2).')';
        ?>
       </td> 
    </tr>
    
    <tr style="font-weight: bold;">
       <td style="padding-left: 0px;">BIAYA NON OPERASIONAL</td> 
       <td>&nbsp;</td> 
       <td>&nbsp;</td> 
       <td>&nbsp;</td> 
       <td>&nbsp;</td> 
    </tr>    
    <?php
    // BIAYA NON OPERASIONAL
    $get_data = $this->balance_sheet_report_model->get_account_profit_loss_by_code('5.01.03.');
    foreach($get_data as $row){
        $get_total = $this->balance_sheet_report_model->get_data_profit_loss_gl_by_coa($row->rowID,$start_date,$end_date);
        
        $total = $get_total->total;
        $total_biaya_non_ops += $total;
        
    ?>
        <tr>
           <td style="padding-left: 10px;"><?=$row->acc_name?></td> 
           <td>Rp</td> 
           <td align="right"><?=$total >= 0 ? number_format($total,2) : '('.number_format($total * -1,2).')'?></td> 
           <td></td> 
           <td align="right"></td> 
        </tr>    
    <?php
    }
    ?>
    
    <tr style="font-weight: bold;">
       <td align="right" style="padding-right: 10px;">TOTAL BIAYA NON OPERASIONAL</td> 
       <td></td> 
       <td></td> 
       <td style="padding-left: 10px;">Rp</td> 
       <td align="right"><?=$total_biaya_non_ops >= 0 ? number_format($total_biaya_non_ops,2) : '('.number_format($total_biaya_non_ops * -1,2).')'?></td> 
    </tr>
    
    <tr style="font-weight: bold;">
       <td style="padding-left: 0px;">BIAYA LAIN-LAIN</td> 
       <td>&nbsp;</td> 
       <td>&nbsp;</td> 
       <td>&nbsp;</td> 
       <td>&nbsp;</td> 
    </tr>    
    <?php
    // BIAYA LAIN-LAIN
    $get_data = $this->balance_sheet_report_model->get_account_profit_loss_by_code('5.01.04.01.');
    foreach($get_data as $row){
        $get_total = $this->balance_sheet_report_model->get_data_profit_loss_gl_by_coa($row->rowID,$start_date,$end_date);
        
        $total = $get_total->total;
        $total_biaya_lain += $total;
        
    ?>
        <tr>
           <td style="padding-left: 10px;"><?=$row->acc_name?></td> 
           <td>Rp</td> 
           <td align="right"><?=$total >= 0 ? number_format($total,2) : '('.number_format($total * -1,2).')'?></td> 
           <td></td> 
           <td align="right"></td> 
        </tr>    
    <?php
    }
    ?>
    
    <tr style="font-weight: bold;">
       <td align="right" style="padding-right: 10px;">TOTAL BIAYA LAIN-LAIN</td> 
       <td></td> 
       <td></td> 
       <td style="padding-left: 10px;">Rp</td> 
       <td align="right"><?=$total_biaya_lain >= 0 ? number_format($total_biaya_lain,2) : '('.number_format($total_biaya_lain * -1,2).')'?></td> 
    </tr>
    
    <tr style="font-weight: bold;">
       <td style="padding-left: 0px;">BIAYA PENYUSUTAN</td> 
       <td>&nbsp;</td> 
       <td>&nbsp;</td> 
       <td>&nbsp;</td> 
       <td>&nbsp;</td> 
    </tr>    
    <?php
    // BIAYA PENYUSUTAN
    $get_data = $this->balance_sheet_report_model->get_account_profit_loss_by_code('5.01.04.02.');
    foreach($get_data as $row){
        $get_total = $this->balance_sheet_report_model->get_data_profit_loss_gl_by_coa($row->rowID,$start_date,$end_date);
        
        $total = $get_total->total;
        $total_biaya_penyusutan += $total;
        
    ?>
        <tr>
           <td style="padding-left: 10px;"><?=$row->acc_name?></td> 
           <td>Rp</td> 
           <td align="right"><?=$total >= 0 ? number_format($total,2) : '('.number_format($total * -1,2).')'?></td> 
           <td></td> 
           <td align="right"></td> 
        </tr>    
    <?php
    }
    ?>
    
    <tr style="font-weight: bold;">
       <td align="right" style="padding-right: 10px;">TOTAL BIAYA PENYUSUTAN</td> 
       <td></td> 
       <td></td> 
       <td style="padding-left: 10px;">Rp</td> 
       <td align="right"><?=$total_biaya_penyusutan >= 0 ? number_format($total_biaya_penyusutan,2) : '('.number_format($total_biaya_penyusutan * -1,2).')'?></td> 
    </tr>
    
    <tr style="font-weight: bold;">
       <td style="padding-left: 0px;">BIAYA PAJAK</td> 
       <td>&nbsp;</td> 
       <td>&nbsp;</td> 
       <td>&nbsp;</td> 
       <td>&nbsp;</td> 
    </tr>    
    <?php
    // BIAYA PAJAK
    $get_data = $this->balance_sheet_report_model->get_account_profit_loss_by_code('5.01.05.02');
    foreach($get_data as $row){
        $get_total = $this->balance_sheet_report_model->get_data_profit_loss_gl_by_coa($row->rowID,$start_date,$end_date);
        
        $total = $get_total->total;
        $total_biaya_pajak += $total;
        
    ?>
        <tr>
           <td style="padding-left: 10px;"><?=$row->acc_name?></td> 
           <td>Rp</td> 
           <td align="right"><?=$total >= 0 ? number_format($total,2) : '('.number_format($total * -1,2).')'?></td> 
           <td></td> 
           <td align="right"></td> 
        </tr>    
    <?php
    }
    ?>
    
    <tr style="font-weight: bold;">
       <td align="right" style="padding-right: 10px;">TOTAL BIAYA PAJAK</td> 
       <td></td> 
       <td></td> 
       <td style="padding-left: 10px;">Rp</td> 
       <td align="right"><?=$total_biaya_pajak >= 0 ? number_format($total_biaya_pajak,2) : '('.number_format($total_biaya_pajak * -1,2).')'?></td> 
    </tr>
    
    <tr style="font-weight: bold;">
       <td align="right" style="padding-right: 10px;font-size: 13px;">TOTAL BIAYA USAHA</td> 
       <td></td> 
       <td></td> 
       <td style="padding-left: 10px;border-top: #000 1px solid;font-size: 13px;">Rp</td> 
       <td align="right" style="border-top: #000 1px solid;font-size: 13px;">
        <?php
        $total_biaya_usaha = $total_biaya_ops + $total_biaya_non_ops + $total_biaya_lain + $total_biaya_penyusutan + $total_biaya_pajak; 
        if($total_biaya_usaha >= 0)
            echo number_format($total_biaya_usaha,2);
        else
            echo '('.number_format($total_biaya_usaha * -1,2).')'
        ?>
       </td> 
    </tr>
    
    <tr style="font-weight: bold;">
       <td align="right" style="padding-right: 10px;font-size: 13px;">LABA/RUGI USAHA</td> 
       <td></td> 
       <td></td> 
       <td style="padding-left: 10px;border-top: #000 1px solid;font-size: 13px;">Rp</td> 
       <td align="right" style="border-top: #000 1px solid;font-size: 13px;">
        <?php
        $total_laba_rugi_usaha = $total_pendapatan_usaha - $total_biaya_usaha; 
        if($total_laba_rugi_usaha >= 0)
            echo number_format($total_laba_rugi_usaha,2);
        else
            echo '('.number_format($total_laba_rugi_usaha * -1,2).')'
        ?>
       </td> 
    </tr>
    
    <tr style="font-weight: bold;">
       <td style="padding-left: 0px;">PENDAPATAN DAN BIAYA LUAR USAHA</td> 
       <td style="padding-left: 0px;">&nbsp;</td> 
       <td style="padding-left: 0px;">&nbsp;</td> 
       <td style="padding-left: 0px;">&nbsp;</td> 
       <td style="padding-left: 0px;">&nbsp;</td> 
    </tr>    
    <tr style="font-weight: bold;">
       <td style="padding-left: 0px;">PENDAPATAN LUAR USAHA</td> 
       <td>&nbsp;</td> 
       <td>&nbsp;</td> 
       <td>&nbsp;</td> 
       <td>&nbsp;</td> 
    </tr>
    <tr style="font-weight: bold;">
       <td style="padding-left: 0px;">PENDAPATAN BANK</td> 
       <td>&nbsp;</td> 
       <td>&nbsp;</td> 
       <td>&nbsp;</td> 
       <td>&nbsp;</td> 
    </tr>     
    <?php
    // PENDAPATAN LUAR USAHA
    $get_data = $this->balance_sheet_report_model->get_account_profit_loss_by_code('4.02.01.');
    foreach($get_data as $row){
        $get_total = $this->balance_sheet_report_model->get_data_profit_loss_gl_by_coa($row->rowID,$start_date,$end_date);
        
        $total = $get_total->total * -1;
        $total_pendapatan_luar_usaha += $total;
        
    ?>
        <tr>
           <td style="padding-left: 10px;"><?=$row->acc_name?></td> 
           <td>Rp</td> 
           <td align="right"><?=$total >= 0 ? number_format($total,2) : '('.number_format($total * -1,2).')'?></td> 
           <td></td> 
           <td align="right"></td> 
        </tr>    
    <?php
    }
    ?>
    <tr style="font-weight: bold;">
       <td style="padding-left: 0px;">PENDAPATAN LAIN-LAIN</td> 
       <td>&nbsp;</td> 
       <td>&nbsp;</td> 
       <td>&nbsp;</td> 
       <td>&nbsp;</td> 
    </tr>     
    <?php
    // PENDAPATAN LUAR USAHA
    $get_data = $this->balance_sheet_report_model->get_account_profit_loss_by_code('4.02.02.');
    foreach($get_data as $row){
        $get_total = $this->balance_sheet_report_model->get_data_profit_loss_gl_by_coa($row->rowID,$start_date,$end_date);
        
        $total = $get_total->total * -1;
        $total_pendapatan_luar_usaha += $total;
        
    ?>
        <tr>
           <td style="padding-left: 10px;"><?=$row->acc_name?></td> 
           <td>Rp</td> 
           <td align="right"><?=$total >= 0 ? number_format($total,2) : '('.number_format($total * -1,2).')'?></td> 
           <td></td> 
           <td align="right"></td> 
        </tr>    
    <?php
    }
    ?>
    
    <tr style="font-weight: bold;">
       <td align="right" style="padding-right: 10px;">TOTAL PENDAPATAN LUAR USAHA</td> 
       <td></td> 
       <td></td> 
       <td style="padding-left: 10px;">Rp</td> 
       <td align="right"><?=$total_pendapatan_luar_usaha >= 0 ? number_format($total_pendapatan_luar_usaha,2) : '('.number_format($total_pendapatan_luar_usaha * -1,2).')'?></td> 
    </tr>
    
    <tr style="font-weight: bold;">
       <td style="padding-left: 0px;">BIAYA LUAR USAHA</td> 
       <td>&nbsp;</td> 
       <td>&nbsp;</td> 
       <td>&nbsp;</td> 
       <td>&nbsp;</td> 
    </tr>    
    <?php
    // BIAYA LUAR USAHA
    $get_data = $this->balance_sheet_report_model->get_account_profit_loss_by_code('5.02.01.');
    foreach($get_data as $row){
        $get_total = $this->balance_sheet_report_model->get_data_profit_loss_gl_by_coa($row->rowID,$start_date,$end_date);
        
        $total = $get_total->total;
        $total_biaya_luar_usaha += $total;
        
    ?>
        <tr>
           <td style="padding-left: 10px;"><?=$row->acc_name?></td> 
           <td>Rp</td> 
           <td align="right"><?=$total >= 0 ? number_format($total,2) : '('.number_format($total * -1,2).')'?></td> 
           <td></td> 
           <td align="right"></td> 
        </tr>    
    <?php
    }
    ?>
    
    <tr style="font-weight: bold;">
       <td align="right" style="padding-right: 10px;">TOTAL BIAYA LUAR USAHA</td> 
       <td></td> 
       <td></td> 
       <td style="padding-left: 10px;">Rp</td> 
       <td align="right"><?=$total_biaya_luar_usaha >= 0 ? number_format($total_biaya_luar_usaha,2) : '('.number_format($total_biaya_luar_usaha * -1,2).')'?></td> 
    </tr>
    
    <tr style="font-weight: bold;">
       <td align="right" style="padding-right: 10px;font-size: 14px;">LABA/RUGI BERSIH</td> 
       <td></td> 
       <td></td> 
       <td style="padding-left: 10px;border-top: #000 1px solid;font-size: 14px;border-bottom: #000 5px double;">Rp</td> 
       <td align="right" style="border-top: #000 1px solid;font-size: 14px;border-bottom: #000 5px double;">
        <?php
        $total_laba_rugi_bersih = $total_pendapatan_luar_usaha - $total_biaya_luar_usaha + $total_laba_rugi_usaha;
        if($total_laba_rugi_bersih >= 0)
            echo number_format($total_laba_rugi_bersih,2);
        else
            echo '('.number_format($total_laba_rugi_bersih * -1,2).')';
        ?>
       </td> 
    </tr>
    
</table>
<p>&nbsp;</p>
</div>

</body>
</html>
