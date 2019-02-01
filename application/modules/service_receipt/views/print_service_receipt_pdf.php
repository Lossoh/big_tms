<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Print Kuitansi</title>
</head>

<body>

<style>
    body,table th,td{
        font-size: 11px;
        font-family: sans-serif;
    }
	
	 @page { margin: 10px 10px; }
     #header { left: 0px; top: 0px; right: 0px; text-align: center;  }
     #footer { left: 0px; bottom: 30px; right: 0px; font-size: 11px; font-family: sans-serif; text-align:right; }	
	  #content{
    	 border-bottom:0px solid #000000;
	 }
     #footer .page:after { content: counter(page, upper-roman); }
	#content{
	background-color:#FFFFFF;
	} 
</style>

<p align="right">Print Date Time : <?=date('d F Y H:i:s')?> </p>

<div id="header">
    <h2>KUITANSI</h2>
</div>
<br />

<div id="content" style="text-align:center;">
    <table width="100%" cellpadding="1" cellspacing="0">
    	<tr>
    		<td width="13%">Nomor</td>
            <td>: &nbsp; <b><?=$get_data->trx_no?></b></td>                    
        </tr>
        <tr>
            <td>Tanggal</td>
            <td>: &nbsp; <b><?=date('d-m-Y',strtotime($get_data->trx_date))?></b></td>
        </tr>
        <tr>
            <td>Telah terima dari</td>
            <td>: &nbsp; <b><?=$get_data->debtor_name?></b></td>
        </tr>
        <tr>
            <td>Uang sejumlah</td>
            <td>: &nbsp; <b>Rp <?=number_format($get_data->total,0,',','.')?></b></td>
        </tr>
        <tr>
            <td>Terbilang</td>
            <td>:&nbsp; 
                <b>
                <?php
                    if($get_data->total > 0)
                        echo '<i>'.ucfirst(strtolower($this->moneyformat->terbilang($get_data->total))).' rupiah</i>';
                    else
                        echo '-';
                ?> 
                </b>
            </td>
        </tr>
        <tr>
            <td>Untuk pembayaran</td>
            <td>: &nbsp; <b><?=$get_data->remark?></b></td>
        </tr>
    </table>
    <br />
    <table width="100%" border="1" cellpadding="1" cellspacing="0">
    	<tr>
    		<th height="30px" width="5%">No</th>
            <th width="15%">SPK No</th>
            <th><?=lang('description')?>s</th>
            <th width="15%"><?=lang('amount')?> (Rp)</th>
    	</tr>
    	<?php 
    	$i = 1;
        $total = 0;
        
        if(!empty($get_data_detail)){
            foreach($get_data_detail as $row){

                $total += $row->amount;
                
    	?>
            	<tr style="font-size:9px" valign="top">
            		<td align="center"><?php echo $i++;?></td>
            		<td><?=$row->spk_no?></td>
            		<td><?=$row->descriptions?></td>
            		<td align="right"><?=number_format($row->amount,0,',','.')?></td>
            	</tr>
    	<?php 
            }
        ?>
            <tr>
    		  <th align="right" colspan="3">Total &nbsp; </th>
    		  <th align="right"><?=number_format($total,0,',','.')?></th>
            </tr>
        <?php
        }
        else{
        ?>
            <tr style="font-size:9px"> 
    		  <td align="center" colspan="4">No Data Available</td>
            </tr>
        <?php
        }
        ?>
    </table>
    <p>&nbsp;</p>
    <table width="100%" border="0" cellpadding="1" cellspacing="0">
    	<tr>
            <th width="85%">&nbsp;</th>
    		<th>
                <p>&nbsp;</p>
                <p>&nbsp;</p>
            </th>
    	</tr>
        <tr>
            <th>&nbsp;</th>
            <th style="border-bottom: solid 1px #000000;">
                <?=strtoupper($this->session->userdata('username'))?>
            </th>
        </tr>
        <tr>
            <th>&nbsp;</th>
            <td align="center">
                KASIR
            </td>
        </tr>
    </table>
    
</div>

</body>
</html>
