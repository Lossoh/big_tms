<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Profit and Loss Report (Yearly)</title>
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

Waktu Cetak : <?=date('d F Y H:i:s')?><br />

<div id="header">
    <span style="font-size: 14px;"><?=$this->config->item('comp_name')?></span><br />
    <span style="font-size: 16px;">LAPORAN LABA/RUGI</span><br />
    <span style="font-size: 14px;">TAHUN <?=date('Y',strtotime($start_date))?></span><br />
</div>
<div id="content">
	
<?php
$month_name = array('JANUARI', 'FEBRUARI', 'MARET', 'APRIL', 'MEI', 'JUNI', 'JULI', 'AGUSTUS', 'SEPTEMBER', 'OKTOBER', 'NOVEMBER', 'DESEMBER');

$date_start = date('d',strtotime($start_date));
$year_start = date('Y',strtotime($start_date));
$date_end = 28;
$year_end = date('Y',strtotime($end_date));

$i_first = (int) date('m',strtotime($start_date)) - 1;
$i_end = (int) date('m',strtotime($end_date));

$subtotal_pendapatan_jasa = array();
$subtotal_potongan_pendapatan_jasa = array();
$total_pendapatan_usaha = array();

$subtotal_biaya_ops = array();
$subtotal_potongan_biaya_ops = array();
$total_biaya_ops = array();

$total_biaya_non_ops = array();
$total_biaya_lain = array();
$total_biaya_penyusutan = array();
$total_biaya_pajak = array();

$total_biaya_usaha = array();
$total_laba_rugi_usaha = array();

$total_pendapatan_luar_usaha = array();
$total_biaya_luar_usaha = array();
$total_laba_rugi_bersih = array();

$subtotal = array();
$subtotal_tmp = array();

$subtotal_pendapatan_jasa_yearly_end = 0;
$subtotal_potongan_pendapatan_jasa_yearly_end = 0;
$total_pendapatan_usaha_yearly_end = 0;

$subtotal_biaya_ops_yearly_end = 0;
$subtotal_potongan_biaya_ops_yearly_end = 0;
$total_biaya_ops_yearly_end = 0;

$total_biaya_non_ops_yearly_end = 0;
$total_biaya_lain_yearly_end = 0;
$total_biaya_penyusutan_yearly_end = 0;
$total_biaya_pajak_yearly_end = 0;

$total_biaya_usaha_yearly_end = 0;
$total_laba_rugi_usaha_yearly_end = 0;

$total_pendapatan_luar_usaha_yearly_end = 0;
$total_biaya_luar_usaha_yearly_end = 0;
$total_laba_rugi_bersih_yearly_end = 0;

$subtotal_yearly_end = 0;
$subtotal_tmp_yearly_end = 0;
?>

<p></p>

<table width="100%" cellpadding="0" cellspacing="0">
    <tr style="font-weight: bold;">
       <td style="border-top: #000 1px solid;border-bottom: #000 1px solid;" align="center">KETERANGAN/PERIODE</td> 
       <?php
       for($i=$i_first;$i<$i_end;$i++){
       ?>
           <td style="border-top: #000 1px solid;border-bottom: #000 1px solid;" align="center"><?=$month_name[$i]?></td> 
       <?php
       }
       ?> 
       <td style="border-top: #000 1px solid;border-bottom: #000 1px solid;" align="center">TOTAL</td>  
    </tr>    
    <tr style="font-weight: bold;">
       <td style="padding-left: 0px;">PENDAPATAN USAHA</td> 
       <td colspan="<?=($i_end+1)?>">&nbsp;</td> 
    </tr>    
    <?php
    // PENDAPATAN JASA
    $get_data = $this->balance_sheet_report_model->get_account_profit_loss_by_code('4.01.01.');
    
    foreach($get_data as $row){
    ?>
        <tr>
           <td style="padding-left: 10px;"><?=$row->acc_name?></td> 
           <?php
           $subtotal_pendapatan_jasa_yearly = 0;
           for($i=$i_first;$i<$i_end;$i++){
               $get_total = $this->balance_sheet_report_model->get_data_profit_loss_gl_by_coa($row->rowID,date('Y-m-d',strtotime($year_start.'-'.($i+1).'-'.$date_start)),date('Y-m-t',strtotime($year_end.'-'.($i+1).'-'.$date_end)));

               $total = $get_total->total * -1;
               $subtotal_pendapatan_jasa[$i] += $total;
               $subtotal_pendapatan_jasa_yearly += $total;
           ?> 
                <td align="right"><?=$total >= 0 ? number_format($total,2) : '<span style="color: #fff">-</span>('.number_format($total * -1,2).')'?></td>
           <?php
           }
           $subtotal_pendapatan_jasa_yearly_end += $subtotal_pendapatan_jasa_yearly;
           ?> 
           <td align="right"><?=$subtotal_pendapatan_jasa_yearly >= 0 ? number_format($subtotal_pendapatan_jasa_yearly,2) : '<span style="color: #fff">-</span>('.number_format($subtotal_pendapatan_jasa_yearly * -1,2).')'?></td>
        </tr>    
    <?php
    }
    ?>
    
    <tr style="font-weight: bold;">
       <td align="right" style="padding-right: 10px;">SUBTOTAL PENDAPATAN JASA</td> 
       <?php
       for($i=$i_first;$i<$i_end;$i++){
       ?>
            <td align="right" style="border-top: #000 1px solid;"><?=$subtotal_pendapatan_jasa[$i] >= 0 ? number_format($subtotal_pendapatan_jasa[$i],2) : '<span style="color: #fff">-</span>('.number_format($subtotal_pendapatan_jasa[$i] * -1,2).')'?></td>
       <?php
       }
       ?> 
       <td align="right" style="border-top: #000 1px solid;"><?=$subtotal_pendapatan_jasa_yearly_end >= 0 ? number_format($subtotal_pendapatan_jasa_yearly_end,2) : '<span style="color: #fff">-</span>('.number_format($subtotal_pendapatan_jasa_yearly_end * -1,2).')'?></td>
    </tr>
    
    <?php
    // POTONGAN PENDAPATAN JASA
    $get_data = $this->balance_sheet_report_model->get_account_profit_loss_by_code('4.01.02.');
    foreach($get_data as $row){
    ?>
        <tr>
           <td style="padding-left: 10px;"><?=$row->acc_name?></td> 
           <?php
           $subtotal_potongan_pendapatan_jasa_yearly = 0;
           for($i=$i_first;$i<$i_end;$i++){
               $get_total = $this->balance_sheet_report_model->get_data_profit_loss_gl_by_coa($row->rowID,date('Y-m-d',strtotime($year_start.'-'.($i+1).'-'.$date_start)),date('Y-m-t',strtotime($year_end.'-'.($i+1).'-'.$date_end)));
                
               $total = $get_total->total * -1;
               $subtotal_potongan_pendapatan_jasa[$i] += $total;
               $subtotal_potongan_pendapatan_jasa_yearly += $total;
           ?> 
                <td align="right"><?=$total >= 0 ? number_format($total,2) : '<span style="color: #fff">-</span>('.number_format($total * -1,2).')'?></td> 
           <?php
           }
           $subtotal_potongan_pendapatan_jasa_yearly_end += $subtotal_potongan_pendapatan_jasa_yearly;
           ?>
           <td align="right"><?=$subtotal_potongan_pendapatan_jasa_yearly >= 0 ? number_format($subtotal_potongan_pendapatan_jasa_yearly,2) : '<span style="color: #fff">-</span>('.number_format($subtotal_potongan_pendapatan_jasa_yearly * -1,2).')'?></td>
        </tr>    
    <?php
    }
    ?>
    
    <tr style="font-weight: bold;">
       <td align="right" style="padding-right: 10px;">SUBTOTAL POTONGAN PENDAPATAN JASA</td> 
       <?php
       for($i=$i_first;$i<$i_end;$i++){
       ?>
            <td align="right" style="border-top: #000 1px solid;"><?=$subtotal_potongan_pendapatan_jasa[$i] >= 0 ? number_format($subtotal_potongan_pendapatan_jasa[$i],2) : '<span style="color: #fff">-</span>('.number_format($subtotal_potongan_pendapatan_jasa[$i] * -1,2).')'?></td>
       <?php
       }
       ?>
       <td align="right" style="border-top: #000 1px solid;"><?=$subtotal_potongan_pendapatan_jasa_yearly_end >= 0 ? number_format($subtotal_potongan_pendapatan_jasa_yearly_end,2) : '<span style="color: #fff">-</span>('.number_format($subtotal_potongan_pendapatan_jasa_yearly_end * -1,2).')'?></td>
    </tr>
    
    <tr style="font-weight: bold;">
       <td align="right" style="padding-right: 10px;">TOTAL PENDAPATAN USAHA</td> 
       <?php
       for($i=$i_first;$i<$i_end;$i++){
            $total_pendapatan_usaha[$i] = $subtotal_pendapatan_jasa[$i] + $subtotal_potongan_pendapatan_jasa[$i];
            $total_pendapatan_usaha_yearly_end += $total_pendapatan_usaha[$i];
       ?>
           <td align="right" style="border-top: #000 2px solid;">
            <?php
            if($total_pendapatan_usaha[$i] >= 0)
                echo number_format($total_pendapatan_usaha[$i],2);
            else
                echo '<span style="color: #fff">-</span>('.number_format($total_pendapatan_usaha[$i] * -1,2).')';
            ?>
           </td>
       <?php
       }
       ?> 
       <td align="right" style="border-top: #000 2px solid;"><?=$total_pendapatan_usaha_yearly_end >= 0 ? number_format($total_pendapatan_usaha_yearly_end,2) : '<span style="color: #fff">-</span>('.number_format($total_pendapatan_usaha_yearly_end * -1,2).')'?></td>
    </tr>
    
    <tr style="font-weight: bold;">
       <td style="padding-left: 0px;">BIAYA-BIAYA</td> 
       <td colspan="<?=($i_end+1)?>">&nbsp;</td> 
    </tr>    
    <tr style="font-weight: bold;">
       <td style="padding-left: 0px;">BIAYA USAHA</td> 
       <td colspan="<?=($i_end+1)?>">&nbsp;</td> 
    </tr>    
    <tr style="font-weight: bold;">
       <td style="padding-left: 0px;">BIAYA OPERASIONAL</td> 
       <td colspan="<?=($i_end+1)?>">&nbsp;</td> 
    </tr>    
    <?php
    // BIAYA OPERASIONAL
    $get_data = $this->balance_sheet_report_model->get_account_profit_loss_by_code('5.01.01.');
    foreach($get_data as $row){
    ?>
        <tr>
           <td style="padding-left: 10px;"><?=$row->acc_name?></td> 
           <?php
           $subtotal_biaya_ops_yearly = 0;
           for($i=$i_first;$i<$i_end;$i++){
               $get_total = $this->balance_sheet_report_model->get_data_profit_loss_gl_by_coa($row->rowID,date('Y-m-d',strtotime($year_start.'-'.($i+1).'-'.$date_start)),date('Y-m-t',strtotime($year_end.'-'.($i+1).'-'.$date_end)));
                
               $total = $get_total->total;
               $subtotal_biaya_ops[$i] += $total;
               $subtotal_biaya_ops_yearly += $total;
           ?> 
                <td align="right"><?=$total >= 0 ? number_format($total,2) : '<span style="color: #fff">-</span>('.number_format($total * -1,2).')'?></td> 
           <?php
           }
           $subtotal_biaya_ops_yearly_end += $subtotal_biaya_ops_yearly;
           ?>  
           <td align="right"><?=$subtotal_biaya_ops_yearly >= 0 ? number_format($subtotal_biaya_ops_yearly,2) : '<span style="color: #fff">-</span>('.number_format($subtotal_biaya_ops_yearly * -1,2).')'?></td> 
        </tr>    
    <?php
    }
    ?>
    
    <tr style="font-weight: bold;">
       <td align="right" style="padding-right: 10px;">SUBTOTAL BIAYA OPERASIONAL</td> 
       <?php
       for($i=$i_first;$i<$i_end;$i++){
       ?>
            <td align="right" style="border-top: #000 1px solid;"><?=$subtotal_biaya_ops[$i] >= 0 ? number_format($subtotal_biaya_ops[$i],2) : '<span style="color: #fff">-</span>('.number_format($subtotal_biaya_ops[$i] * -1,2).')'?></td>
       <?php
       }
       ?>        
       <td align="right" style="border-top: #000 1px solid;"><?=$subtotal_biaya_ops_yearly_end >= 0 ? number_format($subtotal_biaya_ops_yearly_end,2) : '<span style="color: #fff">-</span>('.number_format($subtotal_biaya_ops_yearly_end * -1,2).')'?></td>
    </tr>
    <tr style="font-weight: bold;">
       <td style="padding-left: 0px;">POTONGAN BIAYA OPERASIONAL</td>
       <td colspan="<?=($i_end+1)?>">&nbsp;</td> 
    </tr>
    <?php
    // POTONGAN BIAYA OPERASIONAL
    $get_data = $this->balance_sheet_report_model->get_account_profit_loss_by_code('5.01.02.');
    foreach($get_data as $row){
    ?>
        <tr>
           <td style="padding-left: 10px;"><?=$row->acc_name?></td> 
           <?php
           $subtotal_potongan_biaya_ops_yearly = 0;
           for($i=$i_first;$i<$i_end;$i++){
               $get_total = $this->balance_sheet_report_model->get_data_profit_loss_gl_by_coa($row->rowID,date('Y-m-d',strtotime($year_start.'-'.($i+1).'-'.$date_start)),date('Y-m-t',strtotime($year_end.'-'.($i+1).'-'.$date_end)));
                
               $total = $get_total->total;
               $subtotal_potongan_biaya_ops[$i] += $total;
               $subtotal_potongan_biaya_ops_yearly += $total;
           ?> 
                <td align="right"><?=$total >= 0 ? number_format($total,2) : '<span style="color: #fff">-</span>('.number_format($total * -1,2).')'?></td> 
           <?php
           }
           $subtotal_potongan_biaya_ops_yearly_end += $subtotal_potongan_biaya_ops_yearly;
           ?>  
           <td align="right"><?=$subtotal_potongan_biaya_ops_yearly >= 0 ? number_format($subtotal_potongan_biaya_ops_yearly,2) : '<span style="color: #fff">-</span>('.number_format($subtotal_potongan_biaya_ops_yearly * -1,2).')'?></td>
        </tr>    
    <?php
    }
    ?>
    
    <tr style="font-weight: bold;">
       <td align="right" style="padding-right: 10px;">SUBTOTAL POTONGAN BIAYA OPERASIONAL</td> 
       <?php
       for($i=$i_first;$i<$i_end;$i++){
       ?>
            <td align="right" style="border-top: #000 1px solid;"><?=$subtotal_potongan_biaya_ops[$i] >= 0 ? number_format($subtotal_potongan_biaya_ops[$i],2) : '<span style="color: #fff">-</span>('.number_format($subtotal_potongan_biaya_ops[$i] * -1,2).')'?></td>
       <?php
       }
       ?>
       <td align="right" style="border-top: #000 1px solid;"><?=$subtotal_potongan_biaya_ops_yearly_end >= 0 ? number_format($subtotal_potongan_biaya_ops_yearly_end,2) : '<span style="color: #fff">-</span>('.number_format($subtotal_potongan_biaya_ops_yearly_end * -1,2).')'?></td>
    </tr>
    
    <tr style="font-weight: bold;">
       <td align="right" style="padding-right: 10px;">TOTAL BIAYA OPERASIONAL</td> 
       <?php
       for($i=$i_first;$i<$i_end;$i++){
            $total_biaya_ops[$i] = $subtotal_biaya_ops[$i] + $subtotal_potongan_biaya_ops[$i];
            $total_biaya_ops_yearly_end += $total_biaya_ops[$i];
       ?>
           <td align="right" style="border-top: #000 2px solid;">
            <?php            
            if($total_biaya_ops[$i] >= 0)
                echo number_format($total_biaya_ops[$i],2);
            else
                echo '<span style="color: #fff">-</span>('.number_format($total_biaya_ops[$i] * -1,2).')';
            ?>
           </td> 
       <?php
       }
       ?>
       <td align="right" style="border-top: #000 2px solid;"><?=$total_biaya_ops_yearly_end >= 0 ? number_format($total_biaya_ops_yearly_end,2) : '<span style="color: #fff">-</span>('.number_format($total_biaya_ops_yearly_end * -1,2).')'?></td>
    </tr>
    
    <tr style="font-weight: bold;">
       <td style="padding-left: 0px;">BIAYA NON OPERASIONAL</td> 
       <td colspan="<?=($i_end+1)?>">&nbsp;</td> 
    </tr>    
    <?php
    // BIAYA NON OPERASIONAL
    $get_data = $this->balance_sheet_report_model->get_account_profit_loss_by_code('5.01.03.');
    foreach($get_data as $row){
    ?>
        <tr>
           <td style="padding-left: 10px;"><?=$row->acc_name?></td> 
           <?php
           $total_biaya_non_ops_yearly = 0;
           for($i=$i_first;$i<$i_end;$i++){
               $get_total = $this->balance_sheet_report_model->get_data_profit_loss_gl_by_coa($row->rowID,date('Y-m-d',strtotime($year_start.'-'.($i+1).'-'.$date_start)),date('Y-m-t',strtotime($year_end.'-'.($i+1).'-'.$date_end)));
                
               $total = $get_total->total;
               $total_biaya_non_ops[$i] += $total;
               $total_biaya_non_ops_yearly += $total;
           ?> 
                <td align="right"><?=$total >= 0 ? number_format($total,2) : '<span style="color: #fff">-</span>('.number_format($total * -1,2).')'?></td> 
           <?php
           }
           $total_biaya_non_ops_yearly_end += $total_biaya_non_ops_yearly;
           ?>  
           <td align="right"><?=$total_biaya_non_ops_yearly >= 0 ? number_format($total_biaya_non_ops_yearly,2) : '<span style="color: #fff">-</span>('.number_format($total_biaya_non_ops_yearly * -1,2).')'?></td> 
        </tr>    
    <?php
    }
    ?>
    
    <tr style="font-weight: bold;">
       <td align="right" style="padding-right: 10px;">TOTAL BIAYA NON OPERASIONAL</td>  
       <?php
       for($i=$i_first;$i<$i_end;$i++){
       ?>
            <td align="right" style="border-top: #000 1px solid;"><?=$total_biaya_non_ops[$i] >= 0 ? number_format($total_biaya_non_ops[$i],2) : '<span style="color: #fff">-</span>('.number_format($total_biaya_non_ops[$i] * -1,2).')'?></td>
       <?php
       }
       ?> 
       <td align="right" style="border-top: #000 1px solid;"><?=$total_biaya_non_ops_yearly_end >= 0 ? number_format($total_biaya_non_ops_yearly_end,2) : '<span style="color: #fff">-</span>('.number_format($total_biaya_non_ops_yearly_end * -1,2).')'?></td>
    </tr>
    
    <tr style="font-weight: bold;">
       <td style="padding-left: 0px;">BIAYA LAIN-LAIN</td> 
       <td colspan="<?=($i_end+1)?>">&nbsp;</td> 
    </tr>    
    <?php
    // BIAYA LAIN-LAIN
    $get_data = $this->balance_sheet_report_model->get_account_profit_loss_by_code('5.01.04.01.');
    foreach($get_data as $row){
    ?>
        <tr>
           <td style="padding-left: 10px;"><?=$row->acc_name?></td> 
           <?php
           $total_biaya_lain_yearly = 0;
           for($i=$i_first;$i<$i_end;$i++){
               $get_total = $this->balance_sheet_report_model->get_data_profit_loss_gl_by_coa($row->rowID,date('Y-m-d',strtotime($year_start.'-'.($i+1).'-'.$date_start)),date('Y-m-t',strtotime($year_end.'-'.($i+1).'-'.$date_end)));
                
               $total = $get_total->total;
               $total_biaya_lain[$i] += $total;
               $total_biaya_lain_yearly += $total;
           ?> 
                <td align="right"><?=$total >= 0 ? number_format($total,2) : '<span style="color: #fff">-</span>('.number_format($total * -1,2).')'?></td> 
           <?php
           }
           $total_biaya_lain_yearly_end += $total_biaya_lain_yearly;
           ?>  
           <td align="right"><?=$total_biaya_lain_yearly >= 0 ? number_format($total_biaya_lain_yearly,2) : '<span style="color: #fff">-</span>('.number_format($total_biaya_lain_yearly * -1,2).')'?></td>  
        </tr>    
    <?php
    }
    ?>
    
    <tr style="font-weight: bold;">
       <td align="right" style="padding-right: 10px;">TOTAL BIAYA LAIN-LAIN</td> 
       <?php
       for($i=$i_first;$i<$i_end;$i++){
       ?>
            <td align="right" style="border-top: #000 1px solid;"><?=$total_biaya_lain[$i] >= 0 ? number_format($total_biaya_lain[$i],2) : '<span style="color: #fff">-</span>('.number_format($total_biaya_lain[$i] * -1,2).')'?></td>
       <?php
       }
       ?> 
       <td align="right" style="border-top: #000 1px solid;"><?=$total_biaya_lain_yearly_end >= 0 ? number_format($total_biaya_lain_yearly_end,2) : '<span style="color: #fff">-</span>('.number_format($total_biaya_lain_yearly_end * -1,2).')'?></td>
    </tr>
    
    <tr style="font-weight: bold;">
       <td style="padding-left: 0px;">BIAYA PENYUSUTAN</td> 
       <td colspan="<?=($i_end+1)?>">&nbsp;</td> 
    </tr>    
    <?php
    // BIAYA PENYUSUTAN
    $get_data = $this->balance_sheet_report_model->get_account_profit_loss_by_code('5.01.04.02.');
    foreach($get_data as $row){
    ?>
        <tr>
           <td style="padding-left: 10px;"><?=$row->acc_name?></td> 
           <?php
           $total_biaya_penyusutan_yearly = 0;
           for($i=$i_first;$i<$i_end;$i++){
               $get_total = $this->balance_sheet_report_model->get_data_profit_loss_gl_by_coa($row->rowID,date('Y-m-d',strtotime($year_start.'-'.($i+1).'-'.$date_start)),date('Y-m-t',strtotime($year_end.'-'.($i+1).'-'.$date_end)));
                
               $total = $get_total->total;
               $total_biaya_penyusutan[$i] += $total;
               $total_biaya_penyusutan_yearly += $total;
           ?> 
                <td align="right"><?=$total >= 0 ? number_format($total,2) : '<span style="color: #fff">-</span>('.number_format($total * -1,2).')'?></td> 
           <?php
           }
           $total_biaya_penyusutan_yearly_end += $total_biaya_penyusutan_yearly;
           ?>  
           <td align="right"><?=$total_biaya_penyusutan_yearly >= 0 ? number_format($total_biaya_penyusutan_yearly,2) : '<span style="color: #fff">-</span>('.number_format($total_biaya_penyusutan_yearly * -1,2).')'?></td> 
        </tr>    
    <?php
    }
    ?>
    
    <tr style="font-weight: bold;">
       <td align="right" style="padding-right: 10px;">TOTAL BIAYA PENYUSUTAN</td> 
       <?php
       for($i=$i_first;$i<$i_end;$i++){
       ?>
            <td align="right" style="border-top: #000 1px solid;"><?=$total_biaya_penyusutan[$i] >= 0 ? number_format($total_biaya_penyusutan[$i],2) : '<span style="color: #fff">-</span>('.number_format($total_biaya_penyusutan[$i] * -1,2).')'?></td>
       <?php
       }
       ?> 
       <td align="right" style="border-top: #000 1px solid;"><?=$total_biaya_penyusutan_yearly_end >= 0 ? number_format($total_biaya_penyusutan_yearly_end,2) : '<span style="color: #fff">-</span>('.number_format($total_biaya_penyusutan_yearly_end * -1,2).')'?></td> 
    </tr>
    
    <tr style="font-weight: bold;">
       <td style="padding-left: 0px;">BIAYA PAJAK</td> 
       <td colspan="<?=($i_end+1)?>">&nbsp;</td> 
    </tr>    
    <?php
    // BIAYA PAJAK
    $get_data = $this->balance_sheet_report_model->get_account_profit_loss_by_code('5.01.05.02');
    foreach($get_data as $row){
    ?>
        <tr>
           <td style="padding-left: 10px;"><?=$row->acc_name?></td> 
           <?php
           $total_biaya_pajak_yearly = 0;
           for($i=$i_first;$i<$i_end;$i++){
               $get_total = $this->balance_sheet_report_model->get_data_profit_loss_gl_by_coa($row->rowID,date('Y-m-d',strtotime($year_start.'-'.($i+1).'-'.$date_start)),date('Y-m-t',strtotime($year_end.'-'.($i+1).'-'.$date_end)));
                
               $total = $get_total->total;
               $total_biaya_pajak[$i] += $total;
               $total_biaya_pajak_yearly += $total;
           ?> 
                <td align="right"><?=$total >= 0 ? number_format($total,2) : '<span style="color: #fff">-</span>('.number_format($total * -1,2).')'?></td> 
           <?php
           }
           $total_biaya_pajak_yearly_end += $total_biaya_pajak_yearly;
           ?>  
           <td align="right"><?=$total_biaya_pajak_yearly >= 0 ? number_format($total_biaya_pajak_yearly,2) : '<span style="color: #fff">-</span>('.number_format($total_biaya_pajak_yearly * -1,2).')'?></td> 
        </tr>    
    <?php
    }
    ?>
    
    <tr style="font-weight: bold;">
       <td align="right" style="padding-right: 10px;">TOTAL BIAYA PAJAK</td> 
       <?php
       for($i=$i_first;$i<$i_end;$i++){
       ?>
            <td align="right" style="border-top: #000 1px solid;"><?=$total_biaya_pajak[$i] >= 0 ? number_format($total_biaya_pajak[$i],2) : '<span style="color: #fff">-</span>('.number_format($total_biaya_pajak[$i] * -1,2).')'?></td>
       <?php
       }
       ?> 
       <td align="right" style="border-top: #000 1px solid;"><?=$total_biaya_pajak_yearly_end >= 0 ? number_format($total_biaya_pajak_yearly_end,2) : '<span style="color: #fff">-</span>('.number_format($total_biaya_pajak_yearly_end * -1,2).')'?></td> 
    </tr>
    
    <tr style="font-weight: bold;">
       <td align="right" style="padding-right: 10px;font-size: 13px;">TOTAL BIAYA USAHA</td> 
       <?php
       for($i=$i_first;$i<$i_end;$i++){
            $total_biaya_usaha[$i] = $total_biaya_ops[$i] + $total_biaya_non_ops[$i] + $total_biaya_lain[$i] + $total_biaya_penyusutan[$i] + $total_biaya_pajak[$i];
       ?>
           <td align="right" style="border-top: #000 2px solid;font-size: 13px;">
            <?php 
            if($total_biaya_usaha[$i] >= 0)
                echo number_format($total_biaya_usaha[$i],2);
            else
                echo '<span style="color: #fff">-</span>('.number_format($total_biaya_usaha[$i] * -1,2).')'
            ?>
           </td> 
       <?php
       }
       $total_biaya_usaha_yearly_end = $total_biaya_ops_yearly_end + $total_biaya_non_ops_yearly_end + $total_biaya_lain_yearly_end + $total_biaya_penyusutan_yearly_end + $total_biaya_pajak_yearly_end;
       ?>
       <td align="right" style="border-top: #000 2px solid;font-size: 13px;"><?=$total_biaya_usaha_yearly_end >= 0 ? number_format($total_biaya_usaha_yearly_end,2) : '<span style="color: #fff">-</span>('.number_format($total_biaya_usaha_yearly_end * -1,2).')'?></td>
    </tr>
    
    <tr style="font-weight: bold;">
       <td align="right" style="padding-right: 10px;font-size: 13px;">LABA/RUGI USAHA</td> 
       <?php
       for($i=$i_first;$i<$i_end;$i++){
            $total_laba_rugi_usaha[$i] = $total_pendapatan_usaha[$i] - $total_biaya_usaha[$i];
       ?>
           <td align="right" style="border-top: #000 2px solid;font-size: 13px;">
            <?php
            if($total_laba_rugi_usaha[$i] >= 0)
                echo number_format($total_laba_rugi_usaha[$i],2);
            else
                echo '<span style="color: #fff">-</span>('.number_format($total_laba_rugi_usaha[$i] * -1,2).')'
            ?>
           </td> 
       <?php
       }
       $total_laba_rugi_usaha_yearly_end = $total_pendapatan_usaha_yearly_end - $total_biaya_usaha_yearly_end; 
       ?>
       <td align="right" style="border-top: #000 2px solid;font-size: 13px;"><?=$total_laba_rugi_usaha_yearly_end >= 0 ? number_format($total_laba_rugi_usaha_yearly_end,2) : '<span style="color: #fff">-</span>('.number_format($total_laba_rugi_usaha_yearly_end * -1,2).')'?></td>
    </tr>

    <tr>
        <td colspan="<?=($i_end+2)?>">&nbsp;</td>
    </tr>

    <tr style="font-weight: bold;">
       <td style="padding-left: 0px;">PENDAPATAN DAN BIAYA LUAR USAHA</td> 
       <td colspan="<?=($i_end+1)?>" style="padding-left: 0px;">&nbsp;</td>  
    </tr>    
    <tr style="font-weight: bold;">
       <td style="padding-left: 0px;">PENDAPATAN LUAR USAHA</td> 
       <td colspan="<?=($i_end+1)?>">&nbsp;</td> 
    </tr> 
    <tr style="font-weight: bold;">
       <td style="padding-left: 0px;">PENDAPATAN BANK</td> 
       <td colspan="<?=($i_end+1)?>">&nbsp;</td> 
    </tr>   
    <?php
    // PENDAPATAN LUAR USAHA
    $get_data = $this->balance_sheet_report_model->get_account_profit_loss_by_code('4.02.01.');
    foreach($get_data as $row){
    ?>
        <tr>
           <td style="padding-left: 10px;"><?=$row->acc_name?></td> 
           <?php
           $total_pendapatan_luar_usaha_yearly = 0;
           for($i=$i_first;$i<$i_end;$i++){
               $get_total = $this->balance_sheet_report_model->get_data_profit_loss_gl_by_coa($row->rowID,date('Y-m-d',strtotime($year_start.'-'.($i+1).'-'.$date_start)),date('Y-m-t',strtotime($year_end.'-'.($i+1).'-'.$date_end)));
                
               $total = $get_total->total * -1;
               $total_pendapatan_luar_usaha[$i] += $total;
               $total_pendapatan_luar_usaha_yearly += $total;
           ?> 
                <td align="right"><?=$total >= 0 ? number_format($total,2) : '<span style="color: #fff">-</span>('.number_format($total * -1,2).')'?></td> 
           <?php
           }
           $total_pendapatan_luar_usaha_yearly_end += $total_pendapatan_luar_usaha_yearly;
           ?>  
           <td align="right"><?=$total_pendapatan_luar_usaha_yearly >= 0 ? number_format($total_pendapatan_luar_usaha_yearly,2) : '<span style="color: #fff">-</span>('.number_format($total_pendapatan_luar_usaha_yearly * -1,2).')'?></td> 
        </tr>    
    <?php
    }
    ?>
    <tr style="font-weight: bold;">
       <td style="padding-left: 0px;">PENDAPATAN LAIN-LAIN</td> 
       <td colspan="<?=($i_end+1)?>">&nbsp;</td> 
    </tr>   
    <?php
    // PENDAPATAN LUAR USAHA
    $get_data = $this->balance_sheet_report_model->get_account_profit_loss_by_code('4.02.02.');
    foreach($get_data as $row){
    ?>
        <tr>
           <td style="padding-left: 10px;"><?=$row->acc_name?></td> 
           <?php
           $total_pendapatan_luar_usaha_yearly = 0;
           for($i=$i_first;$i<$i_end;$i++){
               $get_total = $this->balance_sheet_report_model->get_data_profit_loss_gl_by_coa($row->rowID,date('Y-m-d',strtotime($year_start.'-'.($i+1).'-'.$date_start)),date('Y-m-t',strtotime($year_end.'-'.($i+1).'-'.$date_end)));
                
               $total = $get_total->total * -1;
               $total_pendapatan_luar_usaha[$i] += $total;
               $total_pendapatan_luar_usaha_yearly += $total;
           ?> 
                <td align="right"><?=$total >= 0 ? number_format($total,2) : '<span style="color: #fff">-</span>('.number_format($total * -1,2).')'?></td> 
           <?php
           }
           $total_pendapatan_luar_usaha_yearly_end += $total_pendapatan_luar_usaha_yearly;
           ?>  
           <td align="right"><?=$total_pendapatan_luar_usaha_yearly >= 0 ? number_format($total_pendapatan_luar_usaha_yearly,2) : '<span style="color: #fff">-</span>('.number_format($total_pendapatan_luar_usaha_yearly * -1,2).')'?></td> 
        </tr>    
    <?php
    }
    ?>
    
    <tr style="font-weight: bold;">
       <td align="right" style="padding-right: 10px;">TOTAL PENDAPATAN LUAR USAHA</td> 
       <?php
       for($i=$i_first;$i<$i_end;$i++){
       ?>
            <td align="right" style="border-top: #000 1px solid;"><?=$total_pendapatan_luar_usaha[$i] >= 0 ? number_format($total_pendapatan_luar_usaha[$i],2) : '<span style="color: #fff">-</span>('.number_format($total_pendapatan_luar_usaha[$i] * -1,2).')'?></td>
       <?php
       }
       ?> 
       <td align="right" style="border-top: #000 1px solid;"><?=$total_pendapatan_luar_usaha_yearly_end >= 0 ? number_format($total_pendapatan_luar_usaha_yearly_end,2) : '<span style="color: #fff">-</span>('.number_format($total_pendapatan_luar_usaha_yearly_end * -1,2).')'?></td>
    </tr>
    
    <tr style="font-weight: bold;">
       <td style="padding-left: 0px;">BIAYA LUAR USAHA</td> 
       <td colspan="<?=($i_end+1)?>">&nbsp;</td> 
    </tr>    
    <?php
    // BIAYA LUAR USAHA
    $get_data = $this->balance_sheet_report_model->get_account_profit_loss_by_code('5.02.01.');
    foreach($get_data as $row){
    ?>
        <tr>
           <td style="padding-left: 10px;"><?=$row->acc_name?></td> 
           <?php
           $total_biaya_luar_usaha_yearly = 0;
           for($i=$i_first;$i<$i_end;$i++){
               $get_total = $this->balance_sheet_report_model->get_data_profit_loss_gl_by_coa($row->rowID,date('Y-m-d',strtotime($year_start.'-'.($i+1).'-'.$date_start)),date('Y-m-t',strtotime($year_end.'-'.($i+1).'-'.$date_end)));
                
               $total = $get_total->total;
               $total_biaya_luar_usaha[$i] += $total;
               $total_biaya_luar_usaha_yearly += $total;
           ?> 
                <td align="right"><?=$total >= 0 ? number_format($total,2) : '<span style="color: #fff">-</span>('.number_format($total * -1,2).')'?></td> 
           <?php
           }
           $total_biaya_luar_usaha_yearly_end += $total_biaya_luar_usaha_yearly;
           ?>  
           <td align="right"><?=$total_biaya_luar_usaha_yearly >= 0 ? number_format($total_biaya_luar_usaha_yearly,2) : '<span style="color: #fff">-</span>('.number_format($total_biaya_luar_usaha_yearly * -1,2).')'?></td> 
        </tr>    
    <?php
    }
    ?>
    
    <tr style="font-weight: bold;">
       <td align="right" style="padding-right: 10px;">TOTAL BIAYA LUAR USAHA</td> 
       <?php
       for($i=$i_first;$i<$i_end;$i++){
       ?>
            <td align="right" style="border-top: #000 1px solid;"><?=$total_biaya_luar_usaha[$i] >= 0 ? number_format($total_biaya_luar_usaha[$i],2) : '<span style="color: #fff">-</span>('.number_format($total_biaya_luar_usaha[$i] * -1,2).')'?></td>
       <?php
       }
       ?> 
       <td align="right" style="border-top: #000 1px solid;"><?=$total_biaya_luar_usaha_yearly_end >= 0 ? number_format($total_biaya_luar_usaha_yearly_end,2) : '<span style="color: #fff">-</span>('.number_format($total_biaya_luar_usaha_yearly_end * -1,2).')'?></td>
    </tr>
    
    <tr style="font-weight: bold;">
       <td align="right" style="padding-right: 10px;font-size: 14px;">LABA/RUGI BERSIH</td> 
       <?php
       for($i=$i_first;$i<$i_end;$i++){
       ?>
           <td align="right" style="border-top: #000 2px solid;font-size: 14px;border-bottom: #000 4px double;">
            <?php
            $total_laba_rugi_bersih[$i] = $total_pendapatan_luar_usaha[$i] - $total_biaya_luar_usaha[$i] + $total_laba_rugi_usaha[$i];
            if($total_laba_rugi_bersih[$i] >= 0)
                echo number_format($total_laba_rugi_bersih[$i],2);
            else
                echo '<span style="color: #fff">-</span>('.number_format($total_laba_rugi_bersih[$i] * -1,2).')';
            ?>
           </td>
       <?php
       }
       $total_laba_rugi_bersih_yearly_end = $total_pendapatan_luar_usaha_yearly_end - $total_biaya_luar_usaha_yearly_end + $total_laba_rugi_usaha_yearly_end;
       ?> 
       <td align="right" style="border-top: #000 2px solid;font-size: 14px;border-bottom: #000 4px double;"><?=$total_laba_rugi_bersih_yearly_end >= 0 ? number_format($total_laba_rugi_bersih_yearly_end,2) : '<span style="color: #fff">-</span>('.number_format($total_laba_rugi_bersih_yearly_end * -1,2).')'?></td>
    </tr>
    
</table>
<p>&nbsp;</p>
</div>

</body>
</html>
