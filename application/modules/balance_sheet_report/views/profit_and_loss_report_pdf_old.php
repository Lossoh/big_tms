<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Profit and Loss Report</title>
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
    <span style="font-size: 16px;">Profit and Loss</span><br />
</div>
<div id="content">
Period : <?=date('m-Y',strtotime($str_start_date)).' ('.$str_start_date.' to '.$str_end_date.')';?> <br />
<table width="100%" cellpadding="1" cellspacing="0">
    <?php
    $border = 'border-top: #000000 solid 1px;border-bottom: #000000 solid 1px;';
    
    $total_pendapatan_usaha = 0;
    $total_pendapatan_jasa = 0;

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
    
    foreach($profit_loss as $row){
        if($row->group != 0){
            if($first_date == '2016-12-01'){                    
                $get_total = $this->balance_sheet_report_model->get_data_total_by_profit_loss($row->group,'2017-01-01','2017-01-01')->total;
            }
            else{
                if($first_date == '2017-01-01'){
                    $last_date = date('Y-m-t',strtotime($start_date.' last day of last month'));
    
                    $get_total = $this->balance_sheet_report_model->get_data_total_by_profit_loss($row->group,'2017-01-02',$last_date)->total;
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
                    
                    $get_total = $this->balance_sheet_report_model->get_data_total_by_profit_loss($row->group,$first_date,$last_date)->total;
                }
            }
        }
        else{
            $get_total = 0;
        }
        
        $subtotal += $get_total;
        
        if($row->group == 6){
            $subtotal_tmp = $subtotal;                     
        }
        
        if($row->total_type == 2){
            $val_angka_1 = $subtotal; 
            $val_angka_2 = 0;
        }  
        else if($row->total_type == 1){
            $val_angka_1 = 0;
            if($subtotal_tmp != 0){
                $total_biaya_ops = $subtotal_tmp - ($subtotal * -1);
                $val_angka_2 = $total_biaya_ops;
                $subtotal_tmp = 0;
            }
            else{
                $val_angka_2 = $subtotal;
            }
            $subtotal = 0;
        }
        else{
            if($row->group == 1 || $row->group == 2 || $row->group == 7 || $row->group == 8 || $row->group == 9 || $row->group == 10 || $row->group == 22 || 
                $row->group == 23 || $row->group == 24 || $row->group == 25){
                $val_angka_1 = $get_total * -1;            
                $val_angka_2 = $get_total * -1;
            }
            else{
                $val_angka_1 = $get_total;            
                $val_angka_2 = $get_total;                
            }
        }
        
        if($row->group == 1){
            $total_pendapatan_jasa = $get_total;
        }
        
        if($row->rowID == 3){
            $val_angka_1 = 0;            
            $val_angka_2 = $total_pendapatan_jasa * -1;
        }
        if($row->rowID == 5){
            $val_angka_1 = 0;            
            $total_pendapatan_usaha = ($total_pendapatan_jasa * -1) + ($val_angka_2 * -1);
            $val_angka_2 = $total_pendapatan_usaha;
            $total_pendapatan_jasa = 0;
        }
        if($row->rowID == 13){
            $subtotal = 0;
        }
        if($row->rowID == 19){
            $val_angka_1 = $subtotal * -1; 
        }
        if($row->rowID == 26){
            $total_biaya_non_ops = $val_angka_2; 
        }
        if($row->rowID == 31){
            $total_biaya_lain = $val_angka_2; 
        }
        if($row->rowID == 36){
            $total_biaya_penyusutan = $val_angka_2; 
        }
        if($row->rowID == 39){
            $total_biaya_pajak = $val_angka_2; 
        }
        if($row->rowID == 40){
            $total_biaya_usaha = $total_biaya_ops + $total_biaya_non_ops + $total_biaya_lain + $total_biaya_penyusutan + $total_biaya_pajak; 
            $val_angka_2 = $total_biaya_usaha;
        }
        if($row->rowID == 41){
            $total_laba_rugi_usaha = $total_pendapatan_usaha - $total_biaya_usaha; 
            $val_angka_2 = $total_laba_rugi_usaha;
        }
        if($row->rowID == 48){
            $total_pendapatan_luar_usaha = $val_angka_2 * -1; 
            $val_angka_2 = $total_pendapatan_luar_usaha;
        }
        if($row->rowID == 55){
            $total_biaya_luar_usaha = $val_angka_2; 
        }
        if($row->rowID == 56){
            $total_laba_rugi_bersih = $total_pendapatan_luar_usaha - $total_biaya_luar_usaha + $total_laba_rugi_usaha;
            $val_angka_2 = $total_laba_rugi_bersih; 
        }

        // Tampilan
        if($row->total_type == 0){
            $align = 'align="left"';
            $padding_total = '';
        }
        else if($row->total_type == 3){
            $align = 'align="left"';
            $padding_total = '';
        }
        else{
            $align = 'align="right"';
            $padding_total = 'padding-right: 20px';
        }
        
        if($row->group == 0){
            $padding = '';
        }
        else{
            $padding = 'padding-left: 20px';
        }
        
        if($row->group == 0){
            if($row->total_type == 2){
                $rp_1 = 'Rp';
                $angka_1 = number_format($val_angka_1,2,',','.');
            }
            else{
                $rp_1 = '';
                $angka_1 = '';
            }
        }
        else{
            if($row->total_type == 3){
                $rp_1 = '';
                $angka_1 = '';
            }
            else{
                $rp_1 = 'Rp';
                $angka_1 = number_format($val_angka_1,2,',','.');
            }
        }
        
        if($row->total_type == 0){
            $rp_2 = '';
            $angka_2 = '';            
        }
        else{
            if($row->total_type == 2){
                $rp_2 = '';
                $angka_2 = '';
            }
            else{
                $rp_2 = 'Rp';
                $angka_2 = number_format($val_angka_2,2,',','.');
            }
        }
        
    ?>
    <tr>
    	<td style="<?=$border.$padding.$padding_total?>" <?=$align?>><?=$row->name?></td>
    	<td style="<?=$border?>" width="3%"><?=$rp_1?></td>
    	<td style="<?=$border?>" align="right" width="15%"><?=$angka_1?></td>
    	<td style="<?=$border?>" width="3%"><?=$rp_2?></td>
    	<td style="<?=$border?>" align="right" width="15%"><?=$angka_2?></td>
    </tr>
    <?php
    }
    ?>
</table>
<p>&nbsp;</p>
</div>
</body>
</html>
