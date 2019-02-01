<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Print Reimburse</title>
</head>

<body>

<style>
    table th,td{
        font-size: 12px;
    }
	body{
	   font-size: 12px;
       font-family: sans-serif;
	}
	 @page { margin: 10px; }
     @page deliveryOrder {
      size: A4 portrait;
      margin: 10px;
     }
    
     .deliveryOrder {
       page: deliveryOrder;
       page-break-after: always;
     }
     
     #header { position: fixed; left: 0px; top: -150px; right: 0px; text-align: center;  }
     #footer { position: fixed; left: 0px; bottom: 0px; right: 0px; font-size: 12px; font-family: sans-serif; text-align:right; }
	 #content{
	   border-bottom:0px solid #000000;
	 }
     #footer .page:after { content: counter(page, upper-roman); }
	#content{
	background-color:#FFFFFF;
	} 
</style>
<p align="right">Date : <?=date('d-m-Y',strtotime($get_data->reimburse_date))?></p>
<div style="text-align:center;">
    <b style="font-size: 20px;"><u>BUKTI PENGEMBALIAN UANG MUKA (REIMBURSE)</u></b><br />
    <span style="font-size: 14px;">No. <?=$get_data->reimburse_number?></span>
</div>
<br />            

<?php
if($get_data->jo_no != ''){
?>
<table width="100%" cellpadding="2" cellspacing="0">
    <tr>
        <td width="18%">No JO</td>
        <td width="2%">:</td>
        <td width="80%">
            <?php
            if($get_data->jo_no != '') 
                echo $get_data->jo_no; 
            else
                echo '-';
            ?>
        </td>
    </tr>
    <tr>
        <td>No PO</td>
        <td>:</td>
        <td><?=$get_data->po_spk_no == '' ? '-' : $get_data->po_spk_no?></td>
    </tr>
    <tr>
        <td>Nama Kapal</td>
        <td>:</td>
        <td><?=$get_data->vessel_name == '' ? '-' : ucwords(strtolower($get_data->vessel_name))?></td>
    </tr>
    <tr>
        <td>Tujuan</td>
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
        <td>Pelabuhan/Gudang</td>
        <td>:</td>
        <td><?=$get_data->port_name == '' ? '-' : ucwords(strtolower($get_data->port_name))?></td>
    </tr>
    <tr>
        <td>Cargo</td>
        <td>:</td>
        <td><?=$get_data->item_name == '' ? '-' : ucwords(strtolower($get_data->item_name))?></td>
    </tr>
</table>
<?php
}
?>
<br /><br />
<table width="100%" cellpadding="2" cellspacing="0">
    <tr>
        <td width="15%" style="border: #000 solid 1px;">
            Tipe Advance
        </td>
        <td width="85%" style="border: #000 solid 1px;">
            <?=$get_data->advance_name?>
        </td>    
    </tr>
    <tr>
        <td style="border: #000 solid 1px;">
            Untuk Keperluan
        </td>
        <td style="border: #000 solid 1px;">
            <?=$get_data->remark == '' ? '-' : ucfirst(strtolower($get_data->remark))?>
        </td>    
    </tr>
    <tr>
        <td style="border: #000 solid 1px;">
            Jumlah
        </td>
        <td style="border: #000 solid 1px;">
            Rp <?=number_format($get_data->advance_total,2,',','.')?>
        </td>    
    </tr>
    <tr>
        <td style="border: #000 solid 1px;">
            Terbilang
        </td>
        <td style="border: #000 solid 1px;">
            <i># <?=ucwords(strtolower($this->moneyformat->terbilang($get_data->advance_total)))?> Rupiah #</i>
        </td>    
    </tr>
</table>
<br /><br />
<div style="text-align:center;">
    <big><b><u>PERINCIAN REIMBURSE</u></b></big>
</div>
<br />
<table width="100%" cellpadding="0" cellspacing="0">
    <tr>
        <td width="60%" valign="top">
            <table width="100%" cellpadding="2" cellspacing="0" style="padding-right:10px">
                <tr>
                    <th width="5%" style="border: #000 solid 1px;">No</th>
                    <th width="15%" style="border: #000 solid 1px;">No Advance</th>
                    <th style="border: #000 solid 1px;">Diambil Oleh</th>
                    <th width="35%" style="border: #000 solid 1px;">Keterangan</th>
                    <th width="15%" style="border: #000 solid 1px;">Jumlah</th>    
                </tr>
                <?php
                    if(count($get_data_advance_detail) > 0){
                        $no = 1;
                        $total_amount = 0;
                        foreach($get_data_advance_detail as $row_advance){
                ?>
                            <tr>
                                <td style="border: #000 solid 1px;" align="center"><?=number_format($no,0,',','.')?></td>
                                <td style="border: #000 solid 1px;"><?=$row_advance->advance_number?></td>
                                <td style="border: #000 solid 1px;"><?=ucfirst($row_advance->debtor_name)?></td>
                                <td style="border: #000 solid 1px;"><?=ucfirst($row_advance->expense_name)." (".$row_advance->descs.")"?></td>
                                <td style="border: #000 solid 1px;" align="right"><?=number_format($row_advance->amount,2,',','.')?></td>    
                            </tr>
                <?php
                            $total_advance_amount += $row_advance->amount;
                            $no++;
                        }
                ?>
                        <tr>
                            <th style="border: #000 solid 1px;" align="right" colspan="4">Total Advance (Rp) &nbsp; </th>
                            <th style="border: #000 solid 1px;" align="right"><?=number_format($total_advance_amount,2,',','.')?></th>
                        </tr>
                <?php
                    }
                    else{
                        echo "<tr><th colspan='5' style='border: #000 solid 1px;'>No Available Data Advance Detail</th></tr>";
                    }
                ?>
            </table>
        </td>
        <td width="40%" valign="top">
            <table width="100%" cellpadding="2" cellspacing="0">
                <tr>
                    <th width="5%" style="border: #000 solid 1px;">No</th>
                    <th width="65%" style="border: #000 solid 1px;">Keterangan</th>
                    <th width="30%" style="border: #000 solid 1px;">Jumlah</th>    
                </tr>
                <?php
                    if(count($get_data_detail) > 0){
                        $no = 1;
                        $total_amount = 0;
                        foreach($get_data_detail as $row){
                ?>
                            <tr>
                                <td style="border: #000 solid 1px;" align="center"><?=number_format($no,0,',','.')?></td>
                                <td style="border: #000 solid 1px;"><?=ucfirst($row->expense_name)." (".$row->descs.")"?></td>
                                <td style="border: #000 solid 1px;" align="right"><?=number_format($row->amount,2,',','.')?></td>    
                            </tr>
                <?php
                            $total_amount += $row->amount;
                            $no++;
                        }
                ?>
                        <tr>
                            <th style="border: #000 solid 1px;" align="right" colspan="2">Total Reimburse (Rp) &nbsp; </th>
                            <th style="border: #000 solid 1px;" align="right"><?=number_format($total_amount,2,',','.')?></th>
                        </tr>
                <?php
                    }
                    else{
                        echo "<tr><th colspan='3' style='border: #000 solid 1px;'>No Available Data Reimburse Detail</th></tr>";
                    }
                ?>
            </table>
        </td>
    </tr>
</table>
<br />
<table width="33%" cellpadding="2" cellspacing="0">
    <tr>
        <th width="55%" align="right" style="border: #000 solid 1px;">Total Advance (Rp) &nbsp; </th>
        <th width="45%" align="right" style="border: #000 solid 1px;"><?=number_format($total_advance_amount,2,',','.')?></th>
    </tr>
    <tr>
        <th align="right" style="border: #000 solid 1px;">Total Reimburse (Rp) &nbsp; </th>
        <th align="right" style="border: #000 solid 1px;"><?=number_format($total_amount,2,',','.')?></th>
    </tr>
    <tr>
        <?php
        $total_paid = $total_advance_amount - $total_amount;
        if($total_paid >= 0){
            $text_paid = "Lebih Bayar (Rp)";
        }
        else{
            $text_paid = "Kurang Bayar (Rp)";
        }
        ?>
        <th align="right" style="border: #000 solid 1px;"><?=$text_paid?> &nbsp; </th>
        <th align="right" style="border: #000 solid 1px;"><?=number_format($total_paid,2,',','.')?></th>
    </tr>
</table>        
<p>&nbsp;</p>
<table width="100%" cellpadding="2" cellspacing="0">
    <tr>
        <th width="33%" valign="top" style="border: #000 solid 1px;">
             Dibayar Oleh
        </th>
        <th width="33%" valign="top" style="border: #000 solid 1px;">
             Keuangan
        </th>    
        <th width="34%" valign="top" style="border: #000 solid 1px;">
             Disetujui
        </th>
    </tr>
    <tr>
        <td valign="top" style="border: #000 solid 1px;">
             <p>&nbsp;</p>
             <p>&nbsp;</p>
        </td>
        <td valign="top" style="border: #000 solid 1px;">
             <p>&nbsp;</p>
             <p>&nbsp;</p>
        </td>    
        <td valign="top" style="border: #000 solid 1px;">
             <p>&nbsp;</p>
             <p>&nbsp;</p>
        </td>
    </tr>
</table>
</body>
</html>
