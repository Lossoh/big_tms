<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Print Invoice</title>
</head>

<body>

<style>
    table th,td{
        font-size: 10px;
    }
	body{
	   font-size: 10px;
       font-family: sans-serif;
	}
	 @page { margin: 150px 10px; }
     @page deliveryOrder {
      size: A4 portrait;
      margin: 150px 10px;
     }
    
     .deliveryOrder {
       page: deliveryOrder;
       page-break-after: always;
     }
     
     #header { position: fixed; left: 0px; top: -150px; right: 0px; text-align: center;  }
     #footer { position: fixed; left: 0px; bottom: 0px; right: 0px; font-size: 10px; font-family: sans-serif; text-align:right; }
	 #content{
	   border-bottom:0px solid #000000;
	 }
     #footer .page:after { content: counter(page, upper-roman); }
	#content{
	background-color:#FFFFFF;
	} 
</style>

<table width="100%" cellpadding="2" cellspacing="0">
    <tr>
        <td width="64%">
            <div style="margin-top:-10px">Billing To : </div>
            <p><b><?=strtoupper($get_data->debtor_name)?></b></p>
            <?=$get_data->address1?><br />
            <?=$get_data->address2?><br />
            <?=$get_data->address3?><br />
            NPWP &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; : <b><?=$get_data->npwp_no == '' ? '-' : $get_data->npwp_no?></b><br />
            Contact Person : <b><?=$get_data->contact_prs == '' ? '-' : ucfirst($get_data->contact_prs)?></b><br />
        </td>
        <td width="36%" valign="top">
            <div style="text-align:center;font-size: 20px;">
                <b><u><?= $get_data->debtor_type == 'internal' ? strtoupper('Biaya Pengangkutan') : strtoupper(lang('invoice')); ?></u></b>
            </div>
            <br />
            <table>
                <tr>
                    <td><b>Invoice No</b></td>
                    <td>:</td>
                    <td><?=$get_data->trx_no?> [<?=$get_data->tax == 0 ? 'TAX' : 'NON TAX'?>]</td>
                </tr>
                <tr>
                    <td><b>Invoice Date</b></td>
                    <td>:</td>
                    <td><?=date("d F Y",strtotime($get_data->trx_date))?></td>
                </tr>
                <tr>
                    <td><b>Invoice Type</b></td>
                    <td>:</td>
                    <td><?php
                            if($get_data->invoice_type == 'J')
                                echo "Job Order";
                            else if($get_data->invoice_type == 'A')
                                echo "Account Payable";
                            else if($get_data->invoice_type == 'M')
                                echo "Manual";
                            else
                                echo "-";
                        
                            if($get_data->jo_type == 1)
                                $jo_type = "Bulk";
                            else if($get_data->jo_type == 2)
                                $jo_type = "Container";
                            else
                                $jo_type = "Others";
                        
                            
                        ?>
                        [<?=$jo_type?> - <?=$get_data->wholesale == 0 ? 'Pcs' : 'All In'?>]
                    </td>
                </tr>
                <tr>
                    <td><b>JO No</b></td>
                    <td>:</td>
                    <td>
                        <?php
                        if($get_data->jo_no != '') 
                            echo $get_data->jo_no; 
                        else
                            echo '-';
                        ?>
                    </td>
                </tr>
                <tr>
                    <td><b>PO No</b></td>
                    <td>:</td>
                    <td><?=$get_data->po_spk_no == '' ? '-' : $get_data->po_spk_no?></td>
                </tr>
                <tr>
                    <td><b>Vessel Name</b></td>
                    <td>:</td>
                    <td><?=$get_data->vessel_name == '' ? '-' : ucwords(strtolower($get_data->vessel_name))?></td>
                </tr>
                <tr>
                    <td><b>Destination</b></td>
                    <td>:</td>
                    <td>
                        <?php
                            if($get_data->from_destination == '' && $get_data->to_destination == ''){
                                echo '-';
                            }
                            else{
                                echo ucwords(strtolower($get_data->from_destination)) .' - '. ucwords(strtolower($get_data->to_destination));
                            }
                        ?>
                    </td>
                </tr>
                <tr>
                    <td><b>Port/Gudang</b></td>
                    <td>:</td>
                    <td><?=$get_data->port_name == '' ? '-' : ucwords(strtolower($get_data->port_name))?></td>
                </tr>
                <tr>
                    <td><b>Item</b></td>
                    <td>:</td>
                    <td><?=$get_data->item_name == '' ? '-' : ucwords(strtolower($get_data->item_name))?></td>
                </tr>
                <tr>
                    <td><b>Remark</b></td>
                    <td>:</td>
                    <td><?=$get_data->descs == '' ? '-' : ucfirst(strtolower($get_data->descs))?></td>
                </tr>
            </table>
            
        </td>    
    </tr>
</table>

<br />
<table width="100%" border="0" align="center" cellpadding="2" cellspacing="0" style="margin-top: -15px;">
	<tr style="background-color:#2e6da4;color:#fff;">
		<th width="5%" style="border:#2e6da4 solid 1px;"><div style="margin:5px;">No</div></th>
        <th width="75%" style="border:#2e6da4 solid 1px;">Description</th>
        <th width="20%" style="border:#2e6da4 solid 1px;">Price Amount</th>
	</tr>
	<?php 
    if(!empty($data_do)){
        $jumlah_20ft = 0;
        $jumlah_40ft = 0;
        $jumlah_45ft = 0;
        
        $biaya_20ft = 0;
        $biaya_40ft = 0;
        $biaya_45ft = 0;
        
        foreach($data_do as $do){
        
            $row = $this->invoice_model->get_data_do_by_row_id($do->do_id);
            
            $container_size = '1 x '.$row->container_size.' Feet';
                   
            
            // Menghitung jumlah data per container size
            if($row->container_size == 20){
                $jumlah_20ft++;
                
                if($row->wholesale == 1){
                    $biaya_20ft = $row->price_amount;
                }
                else{
                    $biaya_20ft = $row->price_20ft;
                }
            }
            elseif($row->container_size == 40){
                $jumlah_40ft++;
                
                if($row->wholesale == 1){
                    $biaya_40ft = $row->price_amount;
                }
                else{
                    $biaya_40ft = $row->price_40ft;
                }
            }
            elseif($row->container_size == 45){
                $jumlah_45ft++;
                
                if($row->wholesale == 1){
                    $biaya_45ft = $row->price_amount;
                }
                else{
                    $biaya_45ft = $row->price_45ft;
                }
            }
            
            
        }
    }
    
    if(!empty($get_data_detail)){
        $i=1;
        $jumlah_data = count($get_data_detail);
        $total_price_amount = $get_data->base_amt;
        $total_ppn = $get_data->tax_amt;
        $grand_total = $get_data->total_amt;
         
   	    foreach($get_data_detail as $val){
    	   if($i == $jumlah_data){
    	       $border_bottom = 'border-bottom:#2e6da4 solid 1px;';
    	   }
           else{
               $border_bottom = '';
           }
           
           if($val->jo_type == '1'){
                $get_receive = $this->invoice_model->get_data_do_by_jo($get_data->jo_no);
                $qty_dtl = $get_receive->received_weight;
           }
           else if($val->jo_type == '2'){
                $qty_dtl = '1';
           }
           else{
                $qty_dtl = '1';
           }
           
           if($i == 1){
                $description = '<br><b>Note :</b><br>';
                $no = 1;
                if($jumlah_20ft > 0){
                    $description .= $no.'. 1 x 20 Feet @ '.number_format($jumlah_20ft,0,',','.').' x '.number_format($biaya_20ft,0,',','.').' = '.number_format($jumlah_20ft*$biaya_20ft,0,',','.').'<br>';
                    $no++;
                }
                if($jumlah_40ft > 0){
                    $description .= $no.'. 1 x 40 Feet @ '.number_format($jumlah_40ft,0,',','.').' x '.number_format($biaya_40ft,0,',','.').' = '.number_format($jumlah_40ft*$biaya_40ft,0,',','.').'<br>';
                    $no++;
                }
                if($jumlah_45ft > 0){
                    $description .= $no.'. 1 x 45 Feet @ '.number_format($jumlah_45ft,0,',','.').' x '.number_format($biaya_45ft,0,',','.').' = '.number_format($jumlah_45ft*$biaya_45ft,0,',','.').'<br>';
                    $no++;
                }
                
           }
           else{
                $description = '';            
           }
           
	?>
            <tr style="font-size:9px;">
        		<td align="center" style="border-left:#2e6da4 solid 1px;border-right:#2e6da4 solid 1px;<?=$border_bottom?>"><?= $i++;?></td>
        		<td style="border-right:#2e6da4 solid 1px;<?=$border_bottom?>"><?= ucfirst(strtolower($val->descs)).' '.$description;?></td>
        		<td align="right" style="border-right:#2e6da4 solid 1px;<?=$border_bottom?>"><?= number_format($val->base_amt,0,',','.');?></td>
        	</tr>
	<?php 
        }
    }
    ?>
</table>
<table width="100%" border="0" align="center" cellpadding="2" cellspacing="0">
	<tr>
        <th align="right" width="80%" style="border:#2e6da4 solid 1px;background-color:#2e6da4;color:#fff;">Total (Rp)</th>
        <td align="right" width="20%" align="right" style="border:#2e6da4 solid 1px;"><?= number_format($total_price_amount,0,',','.');?></td>
	</tr>
	<tr>
        <th align="right" width="80%" style="border:#2e6da4 solid 1px;background-color:#2e6da4;color:#fff;">PPN 10% (Rp)</th>
        <td align="right" width="20%" align="right" style="border:#2e6da4 solid 1px;"><?= number_format($total_ppn,0,',','.');?></td>
	</tr>
	<tr>
        <th align="right" width="80%" style="border:#2e6da4 solid 1px;background-color:#2e6da4;color:#fff;">Grand Total (Rp)</th>
        <td align="right" width="20%" align="right" style="border:#2e6da4 solid 1px;"><?= number_format($grand_total,0,',','.');?></td>
	</tr>
	<tr>
        <td colspan="2" style="border:#2e6da4 solid 1px;">
            <i>Says : </i><br />
            <div style="text-align: left;"><i># <?=ucwords(strtolower($this->moneyformat->terbilang($grand_total)))?> Rupiah #</i></div>
        </td>
	</tr>
</table>
<br />
<table width="100%" border="0" align="center" cellpadding="2" cellspacing="0">
	<tr>
        <td align="left" valign="top" width="75%">
            PERHATIAN !<br />
            Pembayaran dapat ditransfer melalui rekening kami : <br />
            <b>Bank BII KCP PURI KENCANA</b><br />
            Komp. Puri Niaga III Jl. Puri Kencana Blok M-8 No 1 JKL <br />
            Jakarta Barat, DKI Jakarta, Indonesia 11610 <br />
            <b>A/C No 2288-20-1368</b><br />
            <b>A/N <?=strtoupper($this->config->item('comp_name'))?></b><br />
        </td>
        <td align="center" valign="top" width="25%">
            Jakarta, <?=date('d F Y')?>
            <p>&nbsp;</p>
            <p>&nbsp;</p><br />
            <u> &nbsp; &nbsp; &nbsp;  &nbsp;  &nbsp; <?=strtoupper($this->config->item('manager_keuangan'))?> &nbsp; &nbsp; &nbsp;  &nbsp;  &nbsp; </u><br />
            MANAGER KEUANGAN
        </td>
	</tr>
</table>

<h6 id="footer">Print Date Time : <?=date('d F Y H:i:s')?></h6>

<div class="deliveryOrder"></div>

<table width="100%" cellpadding="2" cellspacing="0">
    <tr>
        <td width="64%">
            &nbsp;
        </td>
        <td width="36%" valign="top">
            <div style="text-align:center;font-size: 20px;">
                <b><u>Delivery Order</b>
            </div>
            <br />
            <table>
                <tr>
                    <td><b>Invoice No</b></td>
                    <td>:</td>
                    <td><?=$get_data->trx_no?> [<?=$get_data->tax == 0 ? 'TAX' : 'NON TAX'?>]</td>
                </tr>
                <tr>
                    <td><b>Invoice Date</b></td>
                    <td>:</td>
                    <td><?=date("d F Y",strtotime($get_data->trx_date))?></td>
                </tr>
                <tr>
                    <td><b>Invoice Type</b></td>
                    <td>:</td>
                    <td><?php
                            if($get_data->invoice_type == 'J')
                                echo "Job Order";
                            else if($get_data->invoice_type == 'A')
                                echo "Account Payable";
                            else if($get_data->invoice_type == 'M')
                                echo "Manual";
                            else
                                echo "-";
                        
                            if($get_data->jo_type == '1')
                                $jo_type = "Bulk";
                            else if($get_data->jo_type == '2')
                                $jo_type = "Container";
                            else
                                $jo_type = "Others";
                        
                            
                        ?>
                        [<?=$jo_type?> - <?=$get_data->wholesale == 0 ? 'Pcs' : 'All In'?>]
                    </td>
                </tr>
                <tr>
                    <td><b>JO No</b></td>
                    <td>:</td>
                    <td>
                        <?php
                        if($get_data->jo_no != '') 
                            echo $get_data->jo_no; 
                        else
                            echo '-';
                        ?>
                    </td>
                </tr>
                <tr>
                    <td><b>PO No</b></td>
                    <td>:</td>
                    <td><?=$get_data->po_spk_no == '' ? '-' : $get_data->po_spk_no?></td>
                </tr>
                <tr>
                    <td><b>Vessel Name</b></td>
                    <td>:</td>
                    <td><?=$get_data->vessel_name == '' ? '-' : ucwords(strtolower($get_data->vessel_name))?></td>
                </tr>
                <tr>
                    <td><b>Destination</b></td>
                    <td>:</td>
                    <td>
                        <?php
                            if($get_data->from_destination == '' && $get_data->to_destination == ''){
                                echo '-';
                            }
                            else{
                                echo ucwords(strtolower($get_data->from_destination)) .' - '. ucwords(strtolower($get_data->to_destination));
                            }
                        ?>
                </td>
                </tr>
                <tr>
                    <td><b>Port/Gudang</b></td>
                    <td>:</td>
                    <td><?=$get_data->port_name == '' ? '-' : ucwords(strtolower($get_data->port_name))?></td>
                </tr>
                <tr>
                    <td><b>Item</b></td>
                    <td>:</td>
                    <td><?=$get_data->item_name == '' ? '-' : ucwords(strtolower($get_data->item_name))?></td>
                </tr>
                <tr>
                    <td><b>Remark</b></td>
                    <td>:</td>
                    <td><?=$get_data->descs == '' ? '-' : ucfirst(strtolower($get_data->descs))?></td>
                </tr>
            </table>
            
        </td>    
    </tr>
</table>

<br />
<table width="100%" border="0" align="center" cellpadding="2" cellspacing="0" style="margin-top: -15px;">
	<tr style="background-color:#2e6da4;color:#fff;">
		<th width="5%" style="border:#2e6da4 solid 1px;"><div style="margin:5px;">No</div></th>
        <?php
        if($get_data->invoice_type == 'A'){
            echo '<th width="10%" style="border:#2e6da4 solid 1px;">AP No</th>';        
            echo '<th width="10%" style="border:#2e6da4 solid 1px;">DO No</th>';        
        }
        else{
            echo '<th width="20%" style="border:#2e6da4 solid 1px;">DO No</th>';
        }
        ?>
		<th width="12%" style="border:#2e6da4 solid 1px;">Driver - Police No</th>
		<th width="11%" style="border:#2e6da4 solid 1px;">DO Date</th>
        <th width="12%" style="border:#2e6da4 solid 1px;">Container Size</th>
        <th width="10%" style="border:#2e6da4 solid 1px;">Container No</th>
        <th width="10%" style="border:#2e6da4 solid 1px;">Qty (Pcs/Kgs)</th>
        <th width="10%" style="border:#2e6da4 solid 1px;">Unit Price</th>
        <th width="10%" style="border:#2e6da4 solid 1px;">Price</th>
	</tr>

    <?php
        $i=1;
        $total_qty = 0;
        $total_price = 0;
        $total_amount = 0;
        
        if(!empty($data_do)){
            $jumlah_data = count($data_do);
            
            foreach($data_do as $do){
                if($i == $jumlah_data){
        	       $border_bottom = 'border-bottom:#2e6da4 solid 1px;';
        	    }
                else{
                   $border_bottom = '';
                }
                
                if($get_data->invoice_type == 'A')
                    $row = $this->invoice_model->get_data_ap_do_by_row_id($do->ap_id);
                else
                    $row = $this->invoice_model->get_data_do_by_row_id($do->do_id);
                
                $price = 0;
                
                $container_size = '1 x '.$row->container_size.' Feet';
                       
                $biaya = 0;
                if($row->container_size == 20){
                    $biaya = $row->price_20ft;
                }
                elseif($row->container_size == 40){
                    $biaya = $row->price_40ft;
                }
                elseif($row->container_size == 45){
                    $biaya = $row->price_45ft;
                }

                if($row->jo_type == 1){
                    $qty = $row->received_weight;
                    $price = $row->price_amount;
                }
                else if($row->jo_type == 2){
                    $qty = 1;
                    if($row->wholesale == 1){
                        $price = $row->price_amount;
                    }
                    else{
                        $price = $biaya;
                    }
                }
                else{
                    $qty = 1;
                    if($row->wholesale == 1){
                        $price = $row->price_amount;
                    }
                    else{
                        $price = $biaya;
                    }
                }
                
                if($row->wholesale == 1){
                    $price_amount = $price;
                }
                else{
                    $price_amount = $qty * $price;
                } 
                
                $total_qty += $qty;
        		$total_price = $price;
                $total_amount += $price_amount;
                
        ?>
        		<tr>		
                    <td align="center" style="border-left:#2e6da4 solid 1px;border-right:#2e6da4 solid 1px;<?=$border_bottom?>"><?=$i++?></td>						
        			<?php
                    if($get_data->invoice_type == 'A'){
                        echo '<td align="left" style="border-right:#2e6da4 solid 1px;'.$border_bottom.'">'.strtoupper($row->trx_no).'</td>';
                        echo '<td align="left" style="border-right:#2e6da4 solid 1px;'.$border_bottom.'">'.strtoupper($row->do_no).'</td>';
                    }
                    else{
                        echo '<td align="left" style="border-right:#2e6da4 solid 1px;'.$border_bottom.'">'.strtoupper($row->do_no).'</td>';
                    }
                    ?>
        			<td align="left" style="border-right:#2e6da4 solid 1px;<?=$border_bottom?>"><?=ucwords(strtolower($row->debtor_name)).' - '.$row->police_no?></td>
        			<td align="left" style="border-right:#2e6da4 solid 1px;<?=$border_bottom?>"><?=date("d F Y",strtotime($row->do_date))?></td>
        			<td align="left" style="border-right:#2e6da4 solid 1px;<?=$border_bottom?>"><?= $row->jo_type == 1 ? '-' : $container_size ?></td>
        			<td align="left" style="border-right:#2e6da4 solid 1px;<?=$border_bottom?>"><?= $row->container_no?></td>
        			<td align="left" style="border-right:#2e6da4 solid 1px;<?=$border_bottom?>"><?= number_format($qty,0,',','.')?></td>	
        			<td align="right" style="border-right:#2e6da4 solid 1px;<?=$border_bottom?>"><?= number_format($price,0,',','.')?></td>	
        			<td align="right" style="border-right:#2e6da4 solid 1px;<?=$border_bottom?>"><?= number_format($price_amount,0,',','.')?></td>	
        		</tr>
        <?php 
            }
        }
        else{
            echo '<tr><td align="center" colspan="8" style="border-left:#2e6da4 solid 1px;border-right:#2e6da4 solid 1px;">Data delivery order not available</td></tr>';
        }
        ?>
</table>
<table width="100%" border="0" cellpadding="2" cellspacing="0">
	<tr>
        <th width="70%" align="right" style="border:#2e6da4 solid 1px;background-color:#2e6da4;color:#fff;">Total (Rp)</th>
        <th width="10%" align="left" style="border:#2e6da4 solid 1px;"><?= number_format($total_qty,0,',','.');?></th>
        <th width="10%" align="right" style="border:#2e6da4 solid 1px;"><?= number_format($total_price,0,',','.');?></th>
        <th width="10%" align="right" style="border:#2e6da4 solid 1px;"><?= number_format($total_amount,0,',','.');?></th>
	</tr>
</table>

</body>
</html>
