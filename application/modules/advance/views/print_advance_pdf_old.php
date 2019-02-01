<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Print Advance</title>
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
<table width="100%" cellpadding="2" cellspacing="0">
    <tr>
        <td width="60%">
            <big><?=strtoupper($this->config->item('comp_name'))?></big>
        </td>
        <td width="40%" align="right">
            <table width="100%" cellpadding="2" cellspacing="0">
                <tr>
                    <td width="38%">
                        User / Waktu Cetak
                    </td>
                    <td width="2%">:</td>
                    <td width="60%">
                        <?=ucwords($this->session->userdata('username'))?> / <?=date('d-m-Y H:i:s')?>
                    </td>    
                </tr>
                <tr>
                    <td>
                        No Advance
                    </td>
                    <td>:</td>
                    <td>
                        <?=$get_data->advance_number?>
                    </td>    
                </tr>
                <tr>
                    <td>
                        Tanggal Advance
                    </td>
                    <td>:</td>
                    <td>
                        <?=date('d F Y',strtotime($get_data->advance_date))?>
                    </td>    
                </tr>
                <tr>
                    <td>
                        Tipe Advance
                    </td>
                    <td>:</td>
                    <td>
                        <?=$get_data->advance_name?>
                    </td>    
                </tr>
            </table>
        </td>    
    </tr>
</table>
<hr />
<br />
<div style="text-align:center;font-size: 20px;">
    <b><u>BUKTI PERMINTAAN ADVANCE</u></b>
</div>
<br />            

<?php
if($get_data->jo_no != ''){
?>
<table width="100%" cellpadding="2" cellspacing="0">
    <tr>
        <td width="60%">
            &nbsp;
        </td>
        <td width="40%" valign="top">
            <table width="100%">
                <tr>
                    <td width="38%">No JO</td>
                    <td width="2%">:</td>
                    <td width="60%">
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
                    <td>Item</td>
                    <td>:</td>
                    <td><?=$get_data->item_name == '' ? '-' : ucwords(strtolower($get_data->item_name))?></td>
                </tr>
            </table>
        </td>    
    </tr>
</table>
<?php
}
?>
<br /><br />
<table width="100%" cellpadding="2" cellspacing="0">
    <tr>
        <td width="15%" style="border: #000 solid 1px;">
            Diambil Oleh
        </td>
        <td width="85%" style="border: #000 solid 1px;">
            <?=$get_data->debtor_name == '' ? '-' : strtoupper($get_data->debtor_name)?>
            <?php
            if($get_data->dp_creditor_rowID != 0){
                $get_creditor = $this->advance_model->get_creditor_by_row_id($get_data->dp_creditor_rowID);
                echo "(DP : ".strtoupper($get_creditor->creditor_name).")";
            }
            ?>
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
    <big><b><u>PERINCIAN ADVANCE</u></b></big>
</div>
<br />
<table width="100%" cellpadding="2" cellspacing="0">
    <tr>
        <th width="5%" style="border: #000 solid 1px;">No</th>
        <th width="75%" style="border: #000 solid 1px;">Keterangan</th>
        <th width="20%" style="border: #000 solid 1px;">Jumlah</th>    
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
                <th style="border: #000 solid 1px;" align="right" colspan="2">Total Advance (Rp) &nbsp; </th>
                <th style="border: #000 solid 1px;" align="right"><?=number_format($total_amount,2,',','.')?></th>
            </tr>
    <?php
        }
        else{
            echo "<tr><th colspan='3' style='border: #000 solid 1px;'>No Available Data Advance Detail</th></tr>";
        }
    ?>
</table>
<p>&nbsp;</p>
<table width="100%" cellpadding="2" cellspacing="0">
    <tr>
        <td width="50%" valign="top" style="border: #000 solid 1px;">
             Dibuat Oleh : 
             <p>&nbsp;</p>
             <p>&nbsp;</p>
        </td>
        <td width="50%" valign="top" style="border: #000 solid 1px;">
             Disetujui :
             <p>&nbsp;</p>
             <p>&nbsp;</p>
        </td>    
    </tr>
</table>
<br />
Remark : 
<br />
</body>
</html>
