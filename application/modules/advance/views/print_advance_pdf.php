<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Print Advance</title>
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
	 @page { margin: 10px; }
     @page deliveryOrder {
      size: A4 portrait;
      margin: 10px;
     }
    
     .deliveryOrder {
       page: deliveryOrder;
       page-break-after: always;
     }
     
     #header { position: fixed; left: 0px; top: 0px; right: 0px; text-align: center;  }
     #footer { position: fixed; left: 0px; bottom: 0px; right: 0px; font-size: 11px; font-family: sans-serif; text-align:right; }
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
        <td width="50%" align="left"><?=$this->config->item('comp_name')?></td>
        <td width="50%" align="right">Print Date Time : <?=date('d F Y H:i:s')?> </td>
    </tr>
</table>

<div style="text-align:center;font-size: 20px;">
    <b><u>ADVANCE REQUESTS</u></b><br />
    <span style="font-size: 14px;">No. <?=$get_data->advance_number.' / '.date('d-m-Y',strtotime($get_data->advance_date))?></span>
</div>

<?php
if($get_data->jo_no != ''){
?>
<table width="100%">
    <tr>
        <td width="15%">JO No</td>
        <td width="85%">:
            <?php
            if($get_data->jo_no != '') 
                echo $get_data->jo_no; 
            else
                echo '-';
            ?>
        </td>
    </tr>
    <tr>
        <td>PO No</td>
        <td>: <?=$get_data->po_spk_no == '' ? '-' : $get_data->po_spk_no?></td>
    </tr>
    <tr>
        <td>Vessel Name</td>
        <td>: <?=$get_data->vessel_name == '' ? '-' : $get_data->vessel_name?></td>
    </tr>
    <tr>
        <td>Destination</td>
        <td>:
            <?php
                if($get_data->from_destination == '' && $get_data->to_destination == ''){
                    echo '-';
                }
                else{
                    echo $get_data->from_destination .' - '. $get_data->to_destination;
                }
            ?>
        </td>
    </tr>
    <tr>
        <td>Port/Warehouse</td>
        <td>: <?=$get_data->port_name == '' ? '-' : $get_data->port_name?></td>
    </tr>
    <tr>
        <td>Cargo</td>
        <td>: <?=$get_data->item_name == '' ? '-' : $get_data->item_name?></td>
    </tr>
</table>
<?php
}
?>
<br />
<table width="100%" cellpadding="2" cellspacing="0">
    <tr>
        <td width="15%">
            Received
        </td>
        <td width="85%">:
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
        <td>
            Advance Type
        </td>
        <td>:
            <?=$get_data->advance_name?>
        </td>    
    </tr>
    <tr>
        <td>
            Description
        </td>
        <td>:
            <?=$get_data->remark == '' ? '-' : $get_data->remark?>
        </td>    
    </tr>
    <tr>
        <td>
            Amount
        </td>
        <td>:
            Rp <?=number_format($get_data->advance_total,2,',','.')?>
        </td>    
    </tr>
    <tr>
        <td>
            Says
        </td>
        <td>:
            <i># <?=ucwords(strtolower($this->moneyformat->terbilang($get_data->advance_total)))?> Rupiah #</i>
        </td>    
    </tr>
</table>
<br />
<table width="100%" cellpadding="2" cellspacing="0">
    <tr>
        <th width="5%" style="border: #000 solid 1px;">No</th>
        <th style="border: #000 solid 1px;">Description</th>
        <th width="14%" style="border: #000 solid 1px;">Amount</th>    
    </tr>
    <?php
        if(count($get_data_detail) > 0){
            $no = 1;
            $total_amount = 0;
            foreach($get_data_detail as $row){
    ?>
                <tr>
                    <td style="border: #000 solid 1px;" align="center"><?=number_format($no,0,',','.')?></td>
                    <td style="border: #000 solid 1px;"><?=$row->expense_name." (".$row->descs.")"?></td>
                    <td style="border: #000 solid 1px;" align="right"><?=number_format($row->amount,2,',','.')?></td>    
                </tr>
    <?php
                $total_amount += $row->amount;
                $no++;
            }
    ?>
            <tr>
                <th style="border: #000 solid 1px;" align="right" colspan="2">Advance Total (Rp) &nbsp; </th>
                <th style="border: #000 solid 1px;" align="right"><?=number_format($total_amount,2,',','.')?></th>
            </tr>
    <?php
        }
        else{
            echo "<tr><th colspan='3' style='border: #000 solid 1px;'>No Available Data Advance Detail</th></tr>";
        }
    ?>
</table>
<br />
<table width="100%" cellpadding="2" cellspacing="0">
    <tr>
        <th width="33%" valign="top" style="border: #000 solid 1px;" align="center">
             Created
        </th>
        <th width="34%" valign="top" style="border: #000 solid 1px;" align="center">
             Checked
        </th>
        <th width="33%" valign="top" style="border: #000 solid 1px;" align="center">
             Approved
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
<br />
Remark : 
</body>
</html>
