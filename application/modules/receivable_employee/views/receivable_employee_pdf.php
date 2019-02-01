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
     #footer { left: 0px; bottom: 30px; right: 0px; font-size: 12px; font-family: sans-serif; text-align:right; }
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
    <span style="font-size: 16px;">LAPORAN BUKU BESAR PEMBANTU PIUTANG <?=strtoupper($type)?></span><br />
    Per <?=$until_date;?>
</div>
<div id="content">
<table width="100%">
    <tr>
        <td width="50%" align="left">
            <b>Nama <?=$type?> : <?=strtoupper($debtor_cd)?> - <?=ucwords(strtolower($debtor_name))?></b> 
        </td>
        <td width="50%" align="right">
            &nbsp; 
        </td>
    </tr>
</table>
<br />
<table width="100%" cellpadding="1" cellspacing="0">
	<tr>    
		<th width="3%" style="border-top: #000000 double 5px;border-bottom: #000000 solid 1px;border-left: #000000 solid 1px;">No</th>
		<th width="6%" style="border-top: #000000 double 5px;border-bottom: #000000 solid 1px;">Tanggal</th>
        <th width="11%" style="border-top: #000000 double 5px;border-bottom: #000000 solid 1px;">No Transaksi</th>
		<th width="13%" style="border-top: #000000 double 5px;border-bottom: #000000 solid 1px;">Keterangan</th>
		<th style="border-top: #000000 double 5px;border-bottom: #000000 solid 1px;">No Referensi</th>
		<th width="10%" style="border-top: #000000 double 5px;border-bottom: #000000 solid 1px;">Cash Advance Type</th>
		<th style="border-top: #000000 double 5px;border-bottom: #000000 solid 1px;">No JO</th>
		<th style="border-top: #000000 double 5px;border-bottom: #000000 solid 1px;">Amount</th>
		<th style="border-top: #000000 double 5px;border-bottom: #000000 solid 1px;">Extra Amount</th>
		<th style="border-top: #000000 double 5px;border-bottom: #000000 solid 1px;">Cash Advance</th>
		<th style="border-top: #000000 double 5px;border-bottom: #000000 solid 1px;">Addendum</th>
		<th style="border-top: #000000 double 5px;border-bottom: #000000 solid 1px;">Realisasi</th>
		<th style="border-top: #000000 double 5px;border-bottom: #000000 solid 1px;">Refund</th>
		<th style="border-top: #000000 double 5px;border-bottom: #000000 solid 1px;border-right: #000000 solid 1px;">Saldo</th>		
	</tr>
	<?php 
    $i=1;
    $saldo = 0;
    $total_ca = 0;
    $total_add = 0;
    $total_rea = 0;
    $total_ref = 0;
    
    if(count($data_temp) > 0){
    	foreach($data_temp as $row){
    	   $addendum = $row->addendum * -1;
           
           $total_ca += $row->total_amount;
           $total_add += $addendum;
           $total_rea += $row->realisasi;
           $total_ref += $row->refund;
           
           $saldo += $row->total_amount;
           $saldo += $addendum;
           $saldo -= $row->realisasi;
           $saldo -= $row->refund;
           
    ?>
        	<tr>
        		<td align="center" style="border-left: #000000 solid 1px;"><?php echo number_format($i,0,',','.');?></td>
        		<td><?=date("d-m-Y",strtotime($row->tanggal))?></td>
        		<td <?=$row->no_transaksi == '-' ? 'align="center"' : ''?>><?=$row->no_transaksi?></td>
        		<td <?=$row->keterangan == '-' ? 'align="center"' : ''?>><?=$row->keterangan?></td>
        		<td <?=$row->no_referensi == '-' ? 'align="center"' : ''?>><?=$row->no_referensi?></td>
        		<td <?=$row->type_kas_bon == '-' ? 'align="center"' : ''?>><?=$row->type_kas_bon?></td>
        		<td <?=$row->no_jo == '-' ? 'align="center"' : ''?>><?=$row->no_jo?></td>
                <td align="right"><?=number_format($row->amount,2,',','.')?></td>
                <td align="right"><?=number_format($row->extra_amount,2,',','.')?></td>
                <td align="right"><?=number_format($row->total_amount,2,',','.')?></td>
                <td align="right"><?=number_format($addendum,2,',','.')?></td>
                <td align="right"><?=number_format($row->realisasi,2,',','.')?></td>
                <td align="right"><?=number_format($row->refund,2,',','.')?></td>
                <td align="right" style="border-right: #000000 solid 1px;"><?=number_format($saldo,2,',','.')?></td>
        	</tr>
	<?php 
            $i++;
        }
    }
    
    if(count($data_temp) == 0){
    ?>
        <tr>
            <td colspan="14" align="center" style="border: #000000 solid 1px;">Data not available.</td>
        </tr>
    <?php
    }
    else{
    ?>
        <tr>
            <td colspan="9" align="right" style="border-bottom: #000000 double 5px;border-top: #000000 solid 1px;border-left: #000000 solid 1px;">Total (Rp) &nbsp; </td>
            <td align="right" style="border-bottom: #000000 double 5px;border-top: #000000 solid 1px;"><?=number_format($total_ca,2,',','.')?></td>
            <td align="right" style="border-bottom: #000000 double 5px;border-top: #000000 solid 1px;"><?=number_format($total_add,2,',','.')?></td>
            <td align="right" style="border-bottom: #000000 double 5px;border-top: #000000 solid 1px;"><?=number_format($total_rea,2,',','.')?></td>
            <td align="right" style="border-bottom: #000000 double 5px;border-top: #000000 solid 1px;"><?=number_format($total_ref,2,',','.')?></td>
            <td align="right" style="border-bottom: #000000 double 5px;border-top: #000000 solid 1px;border-right: #000000 solid 1px;"><?=number_format($saldo,2,',','.')?></td>
        </tr>
    <?php
    }
    ?>
</table>
</div>

</body>
</html>
